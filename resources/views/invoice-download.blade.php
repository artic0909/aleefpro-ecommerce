<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - {{ $order->order_id }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; color: #333; font-size: 14px; }
        .invoice-box { max-width: 900px; margin: auto; padding: 20px; border: 1px solid #eee; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        .header img { max-height: 60px; }
        .company-details { text-align: right; }
        h1 { margin: 0; font-size: 28px; color: #444; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; }
        .total { font-weight: bold; }
        .footer { margin-top: 30px; font-size: 12px; text-align: center; color: #777; }
    </style>
</head>
<body>
<div class="invoice-box">
    
    <!-- Header -->
    <div class="header">
        <div>
            <h1>INVOICE</h1>
            <p><strong>Invoice No:</strong> {{ $order->order_id }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</p>
        </div>
        <div class="company-details">
            <!-- <img src="{{ asset('./img/logo1.webp') }}" alt=""> -->
            <p><strong>Aleef Pro</strong></p>
            <p>123 Business Street, City</p>
            <!-- <p>Email: support@company.com</p> -->
            <!-- <p>Phone: +1 234 567 890</p> -->
        </div>
    </div>

    <!-- Customer Details -->
    <hr>
    <div style="display: flex; justify-content: space-between;">
        <div>
            <p><strong>Bill To:</strong></p>
            <p style="text-transform: capitalize;">Customer Name: {{ Auth::guard('customers')->user()->name }}</p>
            <p>Email: {{ Auth::guard('customers')->user()->email }}</p>
            <p>Mobile: {{ Auth::guard('customers')->user()->mobile }}</p>
        </div>
        <div>
            <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
            <p><strong>Shipment Status:</strong> {{ ucfirst($order->shipment_status) }}</p>
        </div>
    </div>

    <!-- Products Table -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Code</th>
                <th>Color</th>
                <th>Size</th>
                <th>Rate</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $i => $product)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $product['product_name'] }}</td>
                <td>{{ $product['product_code'] }}</td>
                <td>{{ $product['product_color'] }}</td>
                <td>{{ $product['product_size'] }}</td>
                <td>${{ number_format($product['product_rate'], 2) }}</td>
                <td>{{ $product['product_quantity'] }}</td>
                <td>${{ number_format($product['total_amount'], 2) }}</td>
            </tr>
            @endforeach
            <tr class="total">
                <td colspan="7" style="text-align: right;">Grand Total</td>
                <td>${{ number_format($order->overall_amount, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>Thank you for your business!</p>
        <p>This is a computer-generated invoice and does not require a signature.</p>
    </div>
</div>
</body>
</html>
