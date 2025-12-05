<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - {{ $order->order_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .order-info {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .order-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }
        .order-item:last-child {
            border-bottom: none;
        }
        .total-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Order Confirmed!</h1>
        <p>Thank you for your order, {{ $customerName }}!</p>
    </div>

    <div class="content">
        <div class="order-info">
            <h2>Order Details</h2>
            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p><strong>Status:</strong> <span class="status-badge status-pending">{{ $order->status }}</span></p>
            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
            <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('M j, Y, g:i A') }}</p>
        </div>

        <div class="order-info">
            <h3>Delivery Information</h3>
            <p><strong>Delivery Address:</strong><br>{{ $order->delivery_address }}</p>
            <p><strong>Phone:</strong> {{ $order->delivery_phone }}</p>
            @if($order->delivery_instructions)
                <p><strong>Delivery Instructions:</strong><br>{{ $order->delivery_instructions }}</p>
            @endif
        </div>

        <div class="order-info">
            <h3>Order Items</h3>
            @foreach($order->items as $item)
                <div class="order-item">
                    <h4>{{ $item->menuItem->name }} x {{ $item->quantity }}</h4>
                    <p>Price: ₹{{ number_format($item->unit_price, 2) }} each</p>
                    <p>Total: ₹{{ number_format($item->total_price, 2) }}</p>
                    @if($item->special_instructions)
                        <p><em>Special instructions: {{ $item->special_instructions }}</em></p>
                    @endif
                    @if($item->variations->isNotEmpty())
                        <p><strong>Variations:</strong></p>
                        <ul>
                            @foreach($item->variations as $variation)
                                <li>{{ $variation->name }} - ₹{{ number_format($variation->price, 2) }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="total-section">
            <h3>Order Summary</h3>
            <p><strong>Subtotal:</strong> ₹{{ number_format($order->subtotal, 2) }}</p>
            <p><strong>Tax Amount:</strong> ₹{{ number_format($order->tax_amount, 2) }}</p>
            <p><strong>Delivery Fee:</strong> ₹{{ number_format($order->delivery_fee, 2) }}</p>
            <hr>
            <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
        </div>

        <div class="footer">
            <p>We'll send you updates as your order progresses.</p>
            <p>If you have any questions, please contact our support team.</p>
            <p>Thank you for choosing Bistro!</p>
        </div>
    </div>
</body>
</html>
