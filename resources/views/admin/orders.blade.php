@extends('layouts.admin.layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Orders Management</h1>
            <p class="text-gray-500 mt-1">Manage and track all customer orders</p>
        </div>
        <div>
            <button class="px-4 py-2 border border-blue-500 text-blue-500 rounded-md hover:bg-blue-50 transition-colors" 
                    onclick="exportOrders()">
                <i class="fas fa-download mr-2"></i>Export
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Orders Card -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider">Total Orders</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_orders'] }}</p>
                </div>
                <div class="ml-4">
                    <i class="fas fa-shopping-bag text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Delivered Card -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-xs font-semibold text-green-600 uppercase tracking-wider">Delivered</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['delivered_orders'] }}</p>
                </div>
                <div class="ml-4">
                    <i class="fas fa-check-circle text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Pending Card -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-xs font-semibold text-yellow-600 uppercase tracking-wider">Pending</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['pending_orders'] }}</p>
                </div>
                <div class="ml-4">
                    <i class="fas fa-clock text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Total Revenue Card -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-cyan-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-xs font-semibold text-cyan-600 uppercase tracking-wider">Total Revenue</p>
                    <p class="text-2xl font-bold text-gray-800">₹{{ number_format($stats['total_revenue'], 2) }}</p>
                </div>
                <div class="ml-4">
                    <i class="fas fa-rupee-sign text-3xl text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-grey-800 rounded-lg shadow mb-6 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h6 class="text-base font-semibold text-gray-800">Filters</h6>
        </div>
        <div class="p-6">
            <form method="GET" action="{{ route('admin.orders') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
                <div class="space-y-1">
                    <x-tailwind.floating.dropdown name="status" id="status" label="Status" :listArray="$statusList" listValue="id" listLabel="name" value="{{request('status')}}" />
                </div>
                
                <div class="space-y-1">                    
                    <x-tailwind.floating.dropdown name="payment_status" id="payment_status" label="Payment Status" :listArray="$paymentStatusList" listValue="id" listLabel="name" value="{{request('payment_status')}}"/>
                </div>

                <div class="space-y-1">
                    <x-tailwind.floating.dropdown name="payment_method" id="payment_method" label="Payment Method" :listArray="$paymentMethods" listValue="id" listLabel="name" value="{{ request('payment_method') }}"/>
                </div>

                <div class="space-y-1">
                    <x-tailwind.floating.text-input name="date_from" id="date_from" label="From Date" type="date" value="{{ request('date_from') }}" />
                </div>
                <div class="space-y-1">
                    <x-tailwind.floating.text-input name="date_to" id="date_to" label="To Date" type="date" value="{{ request('date_to') }}" />
                </div>
                <div class="space-y-1">
                    <x-tailwind.floating.text-input name="search" id="search" label="Search" type="text" value="{{ request('search') }}" placeholder="Order #, Phone, Address..." />
                </div>
                <div class="flex items-end justify-end space-x-2 md:col-span-6">
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Apply Filters
                    </button>
                    <a href="{{ route('admin.orders') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Clear
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h6 class="text-base font-semibold text-gray-800">Orders List</h6>
            <span class="px-3 py-1 text-sm font-semibold text-white bg-blue-600 rounded-full">
                {{ $orders->total() }} orders found
            </span>
        </div>
        <div class="overflow-x-auto">
            <div class="align-middle inline-block min-w-full">
                <table class="min-w-full divide-y divide-gray-200" id="ordersTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Order #
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Items
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Payment
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $order->order_number }}</div>
                                @if($order->guest_identifier)
                                    <div class="text-sm text-gray-500">Guest Order</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($order->user)
                                    <div class="text-sm font-medium text-gray-900">{{ $order->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                                @else
                                    <div class="text-sm text-gray-500">Guest</div>
                                @endif
                                <div class="text-sm text-gray-500">{{ $order->delivery_phone }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $order->items->count() }} items
                                </span>
                                <div class="text-sm text-gray-500 mt-1">
                                    @foreach($order->items->take(2) as $item)
                                        {{ $item->menuItem->name }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                    @if($order->items->count() > 2)
                                        +{{ $order->items->count() - 2 }} more
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">₹{{ number_format($order->total_amount, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
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
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $paymentStatusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'paid' => 'bg-green-100 text-green-800',
                                        'failed' => 'bg-red-100 text-red-800',
                                    ][$order->payment_status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $paymentStatusColors }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                                <div class="text-xs text-gray-500 mt-1">{{ strtoupper($order->payment_method) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $order->created_at->format('M d, Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $order->created_at->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" 
                                       class="text-blue-600 hover:text-blue-900" 
                                       title="View Details">
                                        View
                                    </a>
                                    <button class="text-yellow-600 hover:text-yellow-900" 
                                            onclick="updateStatus({{ $order->id }}, '{{ $order->status }}')" 
                                            title="Update Status">
                                        Update
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="text-gray-400">
                                    <i class="fas fa-inbox text-4xl mb-3"></i>
                                    <p class="text-lg font-medium text-gray-500">No orders found</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                {{ $orders->appends(request()->query())->links() }}
            </div>
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

@section('scripts')
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

function exportOrders() {
    // Implement export functionality
    showAlert('Export feature coming soon', 'info');
}

function showAlert(message, type) {
    const alertTypes = {
        'success': 'bg-green-100 border-green-400 text-green-700',
        'error': 'bg-red-100 border-red-400 text-red-700',
        'info': 'bg-blue-100 border-blue-400 text-blue-700',
        'warning': 'bg-yellow-100 border-yellow-400 text-yellow-700'
    };

    const alertDiv = document.createElement('div');
    alertDiv.className = `border-l-4 p-4 mb-4 rounded ${alertTypes[type] || alertTypes['info']} relative`;
    
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