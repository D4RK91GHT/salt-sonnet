@extends('layouts.admin.layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Order Details</h1>
            <p class="text-gray-300 mt-1">Order Information</p>
        </div>
        <div>
            <a href="{{ route('admin.orders') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Back to Orders
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Order Information -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-gray-800">#{{ $order->order_number }}</h6>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <table class="w-full text-gray-800">
                                <tr class="border-b">
                                    <td class="py-2 pr-4 font-medium">Order Date:</td>
                                    <td class="py-2">{{ $order->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 pr-4 font-medium">Status:</td>
                                    <td class="py-2">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'confirmed' => 'bg-blue-100 text-blue-800',
                                                'preparing' => 'bg-indigo-100 text-indigo-800',
                                                'ready' => 'bg-purple-100 text-purple-800',
                                                'delivered' => 'bg-green-100 text-green-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                            ][$order->status] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 pr-4 font-medium">Payment Status:</td>
                                    <td class="py-2">
                                        @php
                                            $paymentStatusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'paid' => 'bg-green-100 text-green-800',
                                                'failed' => 'bg-red-100 text-red-800',
                                            ][$order->payment_status] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $paymentStatusColors }}">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 pr-4 font-medium">Payment Method:</td>
                                    <td class="py-2">{{ strtoupper($order->payment_method) }}</td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <table class="w-full">
                                <tr class="border-b">
                                    <td class="py-2 pr-4 font-medium">Subtotal:</td>
                                    <td class="py-2 text-right">₹{{ number_format($order->subtotal, 2) }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 pr-4 font-medium">Tax Amount:</td>
                                    <td class="py-2 text-right">₹{{ number_format($order->tax_amount, 2) }}</td>
                                </tr>
                                <tr class="border-b">
                                    <td class="py-2 pr-4 font-medium">Delivery Fee:</td>
                                    <td class="py-2 text-right">₹{{ number_format($order->delivery_fee, 2) }}</td>
                                </tr>
                                <tr class="border-b font-semibold">
                                    <td class="py-2 pr-4">Total Amount:</td>
                                    <td class="py-2 text-right">₹{{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-gray-800">Order Items</h6>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Variations</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($order->items as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($item->menuItem->images->first())
                                                <img src="{{ asset('storage/' . $item->menuItem->images->first()->image_path) }}" 
                                                     alt="{{ $item->menuItem->name }}" 
                                                     class="w-12 h-12 rounded object-cover mr-3">
                                            @endif
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $item->menuItem->name }}</div>
                                                @if($item->special_instructions)
                                                    <div class="text-sm text-gray-500 mt-1">{{ $item->special_instructions }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($item->variations->isNotEmpty())
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($item->variations as $variation)
                                                    <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                                        {{ $variation->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-500">No variations</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        ₹{{ number_format($item->unit_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right font-medium">
                                        ₹{{ number_format($item->total_price, 2) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer & Delivery Information -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Customer Information -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-gray-800">Customer Information</h6>
                </div>
                <div class="p-6">
                    @if($order->user)
                        <div class="mb-2">
                            <p class="text-sm font-medium text-gray-500">Name</p>
                            <p class="text-gray-900">{{ $order->user->name }}</p>
                        </div>
                        <div class="mb-2">
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p class="text-gray-900">{{ $order->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Phone</p>
                            <p class="text-gray-900">{{ $order->delivery_phone }}</p>
                        </div>
                    @else
                        <div class="mb-2">
                            <p class="font-medium text-gray-900">Guest Order</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Phone</p>
                            <p class="text-gray-900">{{ $order->delivery_phone }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Delivery Information -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-gray-800">Delivery Information</h6>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-500">Address</p>
                        <p class="text-gray-900 whitespace-pre-line">{{ $order->delivery_address }}</p>
                    </div>
                    
                    @if($order->delivery_instructions)
                        <div>
                            <p class="text-sm font-medium text-gray-500">Instructions</p>
                            <p class="text-gray-900 whitespace-pre-line">{{ $order->delivery_instructions }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Order Actions -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-gray-800">Order Actions</h6>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <button class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-yellow-800 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" 
                                onclick="updateStatus({{ $order->id }}, '{{ $order->status }}')">
                            <i class="fas fa-edit mr-2"></i>Update Status
                        </button>
                        
                        @if($order->payment_method === 'cod' && $order->payment_status === 'pending')
                            <button class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" 
                                    onclick="markPaymentReceived({{ $order->id }})">
                                <i class="fas fa-money-bill-wave mr-2"></i>Mark Payment Received
                            </button>
                        @endif
                        
                        <button class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" 
                                onclick="printOrder({{ $order->id }})">
                            <i class="fas fa-print mr-2"></i>Print Order
                        </button>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            @if($order->payment_method !== 'cod')
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h6 class="text-lg font-semibold text-gray-800">Payment Information</h6>
                </div>
                <div class="p-6">
                    <div class="mb-2">
                        <p class="text-sm font-medium text-gray-500">Gateway</p>
                        <p class="text-gray-900">{{ $order->payment_gateway }}</p>
                    </div>
                    @if($order->payment_id)
                        <div class="mb-2">
                            <p class="text-sm font-medium text-gray-500">Payment ID</p>
                            <p class="text-gray-900">{{ $order->payment_id }}</p>
                        </div>
                    @endif
                    @if($order->gateway_response)
                        <div>
                            <p class="text-sm font-medium text-gray-500">Gateway Response</p>
                            <pre class="mt-2 p-3 bg-gray-50 rounded-md text-xs text-gray-700 overflow-x-auto">{{ json_encode($order->gateway_response, JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div id="statusUpdateModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Update Order Status
                        </h3>
                        <div class="mt-5">
                            <form id="status-update-form">
                                <input type="hidden" id="update-order-id">
                                <div class="mb-4">
                                    <label for="new-status" class="block text-sm font-medium text-gray-700 mb-1">
                                        New Status
                                    </label>
                                    <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" 
                                            id="new-status" required>
                                        <option value="pending">Pending</option>
                                        <option value="confirmed">Confirmed</option>
                                        <option value="preparing">Preparing</option>
                                        <option value="ready">Ready</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" 
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                        onclick="updateOrderStatus()">
                    Update Status
                </button>
                <button type="button" 
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        onclick="document.getElementById('statusUpdateModal').classList.add('hidden')">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
function updateStatus(orderId, currentStatus) {
    document.getElementById('update-order-id').value = orderId;
    document.getElementById('new-status').value = currentStatus;
    document.getElementById('statusUpdateModal').classList.remove('hidden');
}

function updateOrderStatus() {
    const orderId = document.getElementById('update-order-id').value;
    const newStatus = document.getElementById('new-status').value;
    const modal = document.getElementById('statusUpdateModal');

    fetch(`/admin/orders/${orderId}/status`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: newStatus })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('Order status updated successfully', 'success');
            modal.classList.add('hidden');
            location.reload();
        } else {
            showAlert('Error updating order status', 'error');
        }
    })
    .catch(error => {
        console.error('Error updating order status:', error);
        showAlert('Error updating order status', 'error');
    });
}

function markPaymentReceived(orderId) {
    if (confirm('Mark this COD order as payment received?')) {
        fetch(`/admin/orders/${orderId}/payment-received`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Payment marked as received', 'success');
                location.reload();
            } else {
                showAlert('Error updating payment status', 'error');
            }
        })
        .catch(error => {
            console.error('Error updating payment status:', error);
            showAlert('Error updating payment status', 'error');
        });
    }
}

function printOrder(orderId) {
    window.open(`/admin/orders/${orderId}/print`, '_blank');
}

function showAlert(message, type) {
    const alertTypes = {
        'success': 'bg-green-100 border-l-4 border-green-500 text-green-700',
        'error': 'bg-red-100 border-l-4 border-red-500 text-red-700',
        'info': 'bg-blue-100 border-l-4 border-blue-500 text-blue-700',
        'warning': 'bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700'
    };

    const alertDiv = document.createElement('div');
    alertDiv.className = `p-4 mb-4 rounded ${alertTypes[type] || alertTypes['info']} relative`;
    
    alertDiv.innerHTML = `
        <div class="flex">
            <div class="flex-shrink-0">
                ${type === 'success' ? '<i class="fas fa-check-circle"></i>' : ''}
                ${type === 'error' ? '<i class="fas fa-exclamation-circle"></i>' : ''}
                ${type === 'info' ? '<i class="fas fa-info-circle"></i>' : ''}
                ${type === 'warning' ? '<i class="fas fa-exclamation-triangle"></i>' : ''}
            </div>
            <div class="ml-3">
                <p class="text-sm">${message}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" class="inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2" 
                            onclick="this.parentElement.parentElement.parentElement.remove()">
                        <span class="sr-only">Dismiss</span>
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    `;
    
    const container = document.querySelector('.container');
    container.insertBefore(alertDiv, container.firstChild);
    
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}
</script>
@endsection