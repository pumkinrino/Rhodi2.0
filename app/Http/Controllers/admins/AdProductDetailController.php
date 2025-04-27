<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\FormatService;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Brand;
class AdProductDetailController extends Controller
{
    protected $format;

    public function __construct(FormatService $format)
    {
        $this->format = $format;
    }

    public function create($product_id)
    {
        // Lấy thông tin sản phẩm để hiển thị trong form
        $product = Product::findOrFail($product_id);
        return view('admin.product.addproductdetail', compact('product'));
    }

    // public function store(Request $request)
    // {
    //     // Xác thực dữ liệu đầu vào
    //     $validatedData = $request->validate([
    //         'product_id' => 'required|integer|exists:products,product_id',
    //         'dname' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'size' => 'required|string',

    //         'color' => 'required|string',
    //         'cost' => 'required|numeric',
    //         'stock_quantity' => 'required|integer|min:0',
    //         'images.*' => 'image|mimes:jpg,jpeg,png|max:524288', // 512 MB
    //     ]);

    //     try {
    //         // Tạo mã sản phẩm
    //         $productCode = $this->generateProductCode($validatedData['name'], $validatedData['brand'], $validatedData['size'], $validatedData['color']);

    //         // Lưu vào bảng product_detail
    //         $productDetail = ProductDetail::create([
    //             'product_id' => $validatedData['product_id'],
    //             'dname' => $validatedData['name'],
    //             'description' => $validatedData['description'],
    //             'brand' => $validatedData['brand'],
    //             'size' => $validatedData['size'],
    //             'color' => $validatedData['color'],
    //             'cost' => $validatedData['cost'],
    //             'stock_quantity' => $validatedData['stock_quantity'],
    //             'product_code' => $productCode, // Lưu product_code vào đây
    //         ]);

    //         // Xử lý upload ảnh nếu có
    //         if ($request->hasFile('images')) {
    //             foreach ($request->file('images') as $imageFile) {
    //                 // Tạo đường dẫn file
    //                 $fileName = $imageFile->getClientOriginalName(); // Lấy tên file gốc
    //                 $productFolder = 'detail_images/' . $productCode; // Tạo folder con với tên là product_id
    //                 $filePath = $productFolder . '/' . $fileName; // Đường dẫn lưu file

    //                 // Kiểm tra xem folder con đã tồn tại chưa
    //                 if (!Storage::disk('public')->exists($productFolder)) {
    //                     // Tạo folder con nếu chưa tồn tại
    //                     Storage::disk('public')->makeDirectory($productFolder);
    //                 }

    //                 // Kiểm tra xem file đã tồn tại chưa
    //                 if (Storage::disk('public')->exists($filePath)) {
    //                     // Xóa file cũ nếu tồn tại
    //                     Storage::disk('public')->delete($filePath);
    //                 }

    //                 // Lưu file mới
    //                 $imagePath = $imageFile->storeAs($productFolder, $fileName, 'public');

    //                 // Lưu vào bảng images
    //                 Image::create([
    //                     'product_detail_id' => $productDetail->id, // Lưu ID của product_detail
    //                     'product_code' => $productCode, // Lưu product_code
    //                     'image_url' => $imagePath, // Lưu đường dẫn hình ảnh
    //                 ]);
    //             }
    //         }

    //         // Chuyển hướng với thông báo thành công
    //         return redirect()->route('admin.productss.details.index', ['product_id' => $validatedData['product_id']])
    //             ->with('success', 'Chi tiết sản phẩm đã được thêm thành công.');
    //     } catch (\Exception $e) {
    //         // Ghi lại lỗi và trả về thông báo lỗi
    //         \Log::error('Lỗi khi lưu chi tiết sản phẩm: ' . $e->getMessage());
    //         return redirect()->back()->withErrors(['msg' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
    //     }
    // }

    // Lưu chi tiết sản phẩm
    public function store(Request $request, $product_id)
    {
        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'size' => 'required|string|max:30',
            'color' => 'required|string|max:30',
            'cost' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'description' => 'required|string',
            'stock_quantity' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048', // Kiểm tra ảnh
        ]);
    
        try {
            // Lấy thông tin sản phẩm
            $product = Product::findOrFail($product_id);
    
            // Tạo mã sản phẩm
            $productCode = $this->generateProductCode($product->pname, $product->brand->brand_name, $validatedData['size'], $validatedData['color']);
    
            // Lưu vào bảng product_detail
            $productDetail = new ProductDetail();
            $productDetail->product_id = $product_id;
            $productDetail->product_code = $productCode;
            $productDetail->size = $validatedData['size'];
            $productDetail->color = $validatedData['color'];
            $productDetail->cost = $validatedData['cost'];
            $productDetail->selling_price = $validatedData['selling_price'];
            $productDetail->description = $validatedData['description'];
            $productDetail->stock_quantity = $validatedData['stock_quantity'];
            $productDetail->imported_at = now();
            $productDetail->status = 'available'; // Giả sử trạng thái mặc định là 'available'
            $productDetail->save();
    
            // Xử lý ảnh nếu có
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $imageFile) {
                    $filePath = $imageFile->store('product_details', 'public');
                    Image::create([
                        'product_detail_id' => $productDetail->product_detail_id,
                        'image_url' => $filePath,
                    ]);
                }
            }
    
            // Chuyển hướng với thông báo thành công
            return redirect()->route('admin.products.details.index')->with('success', 'Chi tiết sản phẩm đã được thêm thành công.');
        } catch (\Exception $e) {
            // Lỗi khi thêm chi tiết sản phẩm
            return back()->withErrors(['msg' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }
    
    

    
    
    
    
    
    // Hiển thị danh sách chi tiết sản phẩm
    // Sử dụng phương thức index để lấy danh sách chi tiết sản phẩm theo product_id
    public function index($product_id)
    {
        $latestProductDetails = DB::table('product_detail as pd1')
            ->leftJoin('image', 'pd1.product_code', '=', 'image.product_code') // Sử dụng LEFT JOIN
            ->join('products', 'pd1.product_id', '=', 'products.product_id')
            ->where('pd1.product_id', $product_id) // Chỉ lấy bản ghi cho sản phẩm cụ thể
            ->select('pd1.*', 'image.image_url', 'products.pname')
            ->get();

        $groupedProductDetails = $latestProductDetails->groupBy('product_detail_id');


        return view('admin.products.productdetail', compact('product_id', 'groupedProductDetails'));
    }private function generateProductCode($productName, $brandName, $size, $color)
    {
        // Chuyển tên sản phẩm thành không dấu, viết thường và không có khoảng trắng
        $productNameSlug = Str::slug($productName, ''); // Sử dụng Str::slug để loại bỏ dấu và khoảng trắng
    
        // Tạo mã sản phẩm theo công thức
        return strtolower($productNameSlug) . '-' . strtolower($brandName) . '-' . strtolower($size) . '-' . strtolower($color);
    }
    

    public function updateStatus(Request $request, $id)
    {
        // Xác thực dữ liệu
        $request->validate([
            'status' => 'required|string|in:discontinued,available', // Chỉ cho phép các trạng thái cụ thể
        ]);

        // Lấy chi tiết sản phẩm
        $productDetail = ProductDetail::findOrFail($id);

        // Cập nhật trạng thái
        $productDetail->status = $request->status;

        // Lưu thay đổi
        $productDetail->save();

        // Chuyển hướng với thông báo thành công
        return redirect()->route('product.details.index', ['product_id' => $productDetail->product_id])
            ->with('success', 'Trạng thái sản phẩm đã được cập nhật thành công.');
    }



    //Cái này để sửa thông tin chi tiết sản phẩm
    public function edit($product_detail_id)
    {
        // Lấy chi tiết sản phẩm từ cơ sở dữ liệu
        $productDetail = ProductDetail::findOrFail($product_detail_id);

        // Trả về view với dữ liệu
        return view('admin.product.editproductdetail', compact('productDetail'));
    }

    public function update(Request $request, $product_detail_id)
    {
        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'dname' => 'nullable|string|max:255', // Cho phép để trống
            'description' => 'nullable|string',
            'size' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'cost' => 'nullable|numeric',
            'stock_quantity' => 'nullable|integer',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:524288',
        ]);

        // Lấy chi tiết sản phẩm từ cơ sở dữ liệu
        $productDetail = ProductDetail::findOrFail($product_detail_id);

        // Cập nhật thông tin sản phẩm, giữ giá trị cũ nếu trường bị bỏ trống
        $productDetail->dname = $validatedData['dname'] ?? $productDetail->dname;
        $productDetail->description = $validatedData['description'] ?? $productDetail->description;
        $productDetail->size = $validatedData['size'] ?? $productDetail->size;
        $productDetail->color = $validatedData['color'] ?? $productDetail->color;
        $productDetail->cost = $validatedData['cost'] ?? $productDetail->cost;
        $productDetail->stock_quantity = $validatedData['stock_quantity'] ?? $productDetail->stock_quantity;

        // Xử lý hình ảnh nếu có
        if ($request->hasFile('images')) {
            // Lấy tất cả hình ảnh cũ từ cơ sở dữ liệu
            $oldImages = Image::where('product_code', $productDetail->product_code)->get();

            // Xóa hình ảnh cũ trong storage
            foreach ($oldImages as $oldImage) {
                Storage::disk('public')->delete($oldImage->image_url);
            }

            // Xóa hình ảnh cũ trong cơ sở dữ liệu
            Image::where('product_code', $productDetail->product_code)->delete();

            // Lưu hình ảnh mới
            foreach ($request->file('images') as $imageFile) {
                $imagePath = $imageFile->store('product_images/', 'public'); // Lưu hình ảnh

                // Lưu vào bảng images
                Image::create([
                    'product_code' => $productDetail->product_code,
                    'image_url' => $imagePath,
                ]);
            }
        }

        // Lưu thay đổi
        $productDetail->save();
        dd($productDetail->toArray());

        // Chuyển hướng với thông báo thành công
        return redirect()->route('product.details.index', ['product_id' => $productDetail->product_id])
            ->with('success', 'Cập nhật chi tiết sản phẩm thành công!');
    }

}