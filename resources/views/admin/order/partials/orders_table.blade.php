<!-- resources/views/admin/order/partials/orders_table.blade.php -->
<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Address</th>
            <th>Order Date</th>
            <th>Order Status</th>
            <th>Change Status</th>
            <th>Payment Status</th>
            <th>Voucher</th>
            <th>Total Amount</th>
            <th>Xem chi tiết</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($orders->unique('order_id') as $order)
        <tr>
            <td>{{ $order->order_id }}     <!-- Liên kết đến trang chi tiết đơn hàng -->
          </td>
            <td>{{ $order->full_name }}</td>
            <td>{{ $order->address}}</td>
            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y H:i') }}</td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>{{ $order -> payment_status }} </td>
            <td>
    <div class="dropdown">
        <button class="btn btn-outline-secondary btn-sm dropdown-toggle"
                type="button"
                id="paymentStatusDropdown{{ $order->order_id }}"
                data-bs-toggle="dropdown"
                aria-expanded="false">
            {{ ucfirst($order->payment_status) }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="paymentStatusDropdown{{ $order->order_id }}">
            @foreach(['unpaid', 'paid', 'refunded'] as $ps)
                @if($ps !== $order->payment_status)
                    <li>
                        <form action="{{ route('admin.orders.updateStatus', $order->order_id) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="payment_status" value="{{ $ps }}">
                            <button type="submit" class="dropdown-item">
                                {{ ucfirst($ps) }}
                            </button>
                        </form>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</td>
            <td>{{ $order->voucher_code ?? '-' }}</td>
            <td>{{ number_format($order->total_amount, 0, ',', '.') }} VND</td>
            <td>  <a href="{{ route('admin.order.details.show', $order->order_detail_id) }}" class="btn btn-primary">
                Xem chi tiết
            </a></td>
            <td>
                {{-- Order status transition --}}
                @if($order->status === 'pending')
                    <form action="{{ route('admin.orders.updateStatus', $order->order_id) }}" method="POST" class="d-inline">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="confirmed">
                        <input type="hidden" name="tab" value="{{ request('tab', 'pending') }}">
                        <button class="btn btn-sm btn-success">Confirm</button>
                    </form>
                    <form action="{{ route('admin.orders.updateStatus', $order->order_id) }}" method="POST" class="d-inline">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="cancelled">
                        <input type="hidden" name="tab" value="{{ request('tab', 'pending') }}">
                        <button class="btn btn-sm btn-danger">Cancel</button>
                    </form>
                @elseif($order->status === 'confirmed')
                    <form action="{{ route('admin.orders.updateStatus', $order->order_id) }}" method="POST" class="d-inline">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="deliver">
                        <input type="hidden" name="tab" value="{{ request('tab', 'confirmed') }}">
                        <button class="btn btn-sm btn-primary">Deliver</button>
                    </form>
                @elseif($order->status === 'deliver')
                    <form action="{{ route('admin.orders.updateStatus', $order->order_id) }}" method="POST" class="d-inline">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="delivered">
                        <input type="hidden" name="tab" value="{{ request('tab', 'deliver') }}">
                        <button class="btn btn-sm btn-success">Mark Delivered</button>
                    </form>
                @elseif($order->status === 'delivered')
                    <form action="{{ route('admin.orders.updateStatus', $order->order_id) }}" method="POST" class="d-inline">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="completed">
                        <input type="hidden" name="tab" value="{{ request('tab', 'delivered') }}">
                        <button class="btn btn-sm btn-primary">Complete</button>
                    </form>
                @elseif($order->status === 'completed')
                    <form action="{{ route('admin.orders.updateStatus', $order->order_id) }}" method="POST" class="d-inline">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="cancelled">
                        <input type="hidden" name="tab" value="{{ request('tab', 'completed') }}">
                        <button class="btn btn-sm btn-danger">Product return</button>
                    </form>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" class="text-center">No orders found.</td>
        </tr>
    @endforelse
    </tbody>
</table>


