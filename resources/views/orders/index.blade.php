@extends('layout')

@section('content')
<div class="container my-5 pb-5">
    <div class="card bg-dark-card border border-secondary mb-5">
        <div class="card-body p-4">
            <h2 class="fw-bold text-white mb-1">My Orders</h2>
            <p class="text-muted mb-0">Track your past purchases</p>
        </div>
    </div>

    @if($orders->count() > 0)
    <div class="row g-4">
        @foreach($orders as $order)
        <div class="col-md-12">
            <div class="card bg-dark-card border border-secondary">
                <div class="card-header bg-dark border-bottom border-secondary d-flex justify-content-between align-items-center p-3">
                    <div>
                        <span class="text-white fw-bold">Order #{{ $order->id }}</span>
                        <span class="text-muted small ms-2">{{ $order->created_at->format('d M Y, h:i A') }}</span>
                    </div>
                    <span class="badge bg-{{ $order->status == 'pending' ? 'warning text-dark' : 'success' }}">{{ ucfirst($order->status) }}</span>
                </div>
                <div class="card-body p-3">
                    <p class="mb-2 text-white"><span class="text-muted">Total:</span> <span class="fw-bold text-primary">Rs {{ $order->total_price }}</span></p>
                    <p class="mb-3 text-white"><span class="text-muted">Status:</span> {{ $order->payment_method }}</p>
                    
                    <div class="table-responsive">
                        <table class="table table-dark table-sm mb-0">
                            <thead>
                                <tr>
                                    <th class="text-muted">Item</th>
                                    <th class="text-muted">Qty</th>
                                    <th class="text-muted">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rs {{ $item->price }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <h4 class="text-white">No orders found.</h4>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Start Shopping</a>
    </div>
    @endif
</div>
@endsection
