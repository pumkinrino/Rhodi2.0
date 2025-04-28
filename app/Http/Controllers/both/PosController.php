<?php

namespace App\Http\Controllers\Both;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    // Hiển thị giao diện thanh toán
    public function index()
    {
        // Lấy tất cả các phương thức thanh toán với status 'active'
        $paymentMethods = DB::table('payment_method')->where('status', 'active')->get();
    
        
        // Giỏ hàng từ session
        $cart = session()->get('cart', []);
    
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['selling_price'] * $item['quantity'];
        }
    
        // Truyền dữ liệu vào view
        return view('admin.dashboard2', compact('paymentMethods', 'cart', 'totalAmount'));
    }

    // Tìm kiếm sản phẩm
    public function searchProducts(Request $request)
    {
        $searchTerm = $request->get('search_term');
        $products = DB::table('product_detail')
            ->join('products', 'product_detail.product_id', '=', 'products.product_id')
            ->where('products.pname', 'like', '%' . $searchTerm . '%')
            ->orWhere('product_detail.product_code', 'like', '%' . $searchTerm . '%')
            ->select(
                'product_detail.product_code',
                'products.pname as product_name',
                'product_detail.color',
                'product_detail.size',
                'product_detail.selling_price',
                'product_detail.stock_quantity'
            )
            ->get();

        return response()->json($products);
    }

    // Tìm kiếm khách hàng
    public function searchCustomers(Request $request)
    {
        $customerInfo = $request->get('customer_info');

        $customer = DB::table('customer')
            ->where('email', 'like', '%' . $customerInfo . '%')
            ->orWhere('phone', 'like', '%' . $customerInfo . '%')
            ->first();

        if ($customer) {
            return response()->json([
                'success' => true,
                'customer' => $customer,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy khách hàng.',
        ]);
    }

    // Tìm sản phẩm và thêm vào giỏ hàng
    public function addProductToCart(Request $request)
    {
        $productCode = $request->get('product_code');

        $product = DB::table('product_detail')
            ->join('products', 'product_detail.product_id', '=', 'products.product_id')
            ->where('product_detail.product_code', $productCode)
            ->select(
                'product_detail.product_code',
                'products.pname as product_name',
                'product_detail.color',
                'product_detail.size',
                'product_detail.selling_price',
                'product_detail.stock_quantity'
            )
            ->first();

        if (!$product) {
            return redirect()->route('admin.dashboard2')->with('error', 'Không tìm thấy sản phẩm.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productCode])) {
            $cart[$productCode]['quantity']++;
        } else {
            $cart[$productCode] = [
                'product_code' => $product->product_code,
                'product_name' => $product->product_name,
                'color' => $product->color,
                'size' => $product->size,
                'selling_price' => $product->selling_price,
                'stock_quantity' => $product->stock_quantity,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('admin.dashboard2')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }

    public function removeProductFromCart($productCode)
    {
        // Giỏ hàng từ session
        $cart = session()->get('cart', []);
    
        if (isset($cart[$productCode])) {
            unset($cart[$productCode]);
            session()->put('cart', $cart);
        }
    
        return redirect()->route('admin.pos.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }
    // Thanh toán và hoàn tất đơn hàng
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'products' => 'required|array',
            'products.*.quantity' => 'required|integer|min:1',
            'payment_method_id' => 'required|exists:payment_method,payment_method_id',
        ]);

        // Lấy customer_id từ form, nếu không có thì gán là 0
        $customerId = $request->has('customer_id') ? $request->get('customer_id') : 0;

        DB::transaction(function () use ($validated, $request, $customerId) {
            $cart = session()->get('cart', []);
            if (!$cart) {
                throw new \Exception('Giỏ hàng trống.');
            }

            $totalAmount = 0;
            $orderDetails = [];

            foreach ($validated['products'] as $productCode => $data) {
                $productDetail = DB::table('product_detail')->where('product_code', $productCode)->first();
                if (!$productDetail || $productDetail->stock_quantity < $data['quantity']) {
                    throw new \Exception('Sản phẩm ' . $productCode . ' không đủ hàng trong kho.');
                }

                $subtotal = $productDetail->selling_price * $data['quantity'];
                $totalAmount += $subtotal;

                DB::table('product_detail')->where('product_code', $productCode)->decrement('stock_quantity', $data['quantity']);

                $orderDetails[] = [
                    'product_code' => $productCode,
                    'quantity' => $data['quantity'],
                    'unit_price' => $productDetail->selling_price,
                    'subtotal' => $subtotal,
                ];
            }

            $orderId = DB::table('orders')->insertGetId([
                'customer_id' => $customerId, // Gắn customer_id vào đơn hàng
                'admin_id' => auth()->id(),
                'total_amount' => $totalAmount,
                'payment_method_id' => $validated['payment_method_id'],
                'order_date' => now(),
                'status' => 'completed',
                'payment_status' => 'paid',
            ]);

            foreach ($orderDetails as $detail) {
                DB::table('order_detail')->insert([
                    'order_id' => $orderId,
                    'product_code' => $detail['product_code'],
                    'quantity' => $detail['quantity'],
                    'unit_price' => $detail['unit_price'],
                    'subtotal' => $detail['subtotal'],
                ]);
            }
        });

        session()->forget('cart');

        return redirect()->route('admin.dashboard2')->with('success', 'Thanh toán thành công!');
    }
}
