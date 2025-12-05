ORDER CONFIRMATION
==================

Thank you for your order, {{ $customerName }}!

Order Details
-------------
Order Number: {{ $order->order_number }}
Status: {{ ucfirst($order->status) }}
Payment Method: {{ ucfirst($order->payment_method) }}
Payment Status: {{ ucfirst($order->payment_status) }}
Order Date: {{ $order->created_at->format('M j, Y, g:i A') }}

Delivery Information
-------------------
Delivery Address: {{ $order->delivery_address }}
Phone: {{ $order->delivery_phone }}
@if($order->delivery_instructions)
Delivery Instructions: {{ $order->delivery_instructions }}
@endif

Order Items
-----------
@foreach($order->items as $item)
{{ $item->menuItem->name }} x {{ $item->quantity }}
  Price: ₹{{ number_format($item->unit_price, 2) }} each
  Total: ₹{{ number_format($item->total_price, 2) }}
  @if($item->special_instructions)
  Special instructions: {{ $item->special_instructions }}
  @endif
  @if($item->variations->isNotEmpty())
  Variations:
    @foreach($item->variations as $variation)
    - {{ $variation->name }} - ₹{{ number_format($variation->price, 2) }}
    @endforeach
  @endif

@endforeach

Order Summary
-------------
Subtotal: ₹{{ number_format($order->subtotal, 2) }}
Tax Amount: ₹{{ number_format($order->tax_amount, 2) }}
Delivery Fee: ₹{{ number_format($order->delivery_fee, 2) }}
-------------------------------------------
Total Amount: ₹{{ number_format($order->total_amount, 2) }}

We'll send you updates as your order progresses. If you have any questions, please contact our support team.

Thank you for choosing Bistro!
