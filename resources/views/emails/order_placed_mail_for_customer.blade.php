<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f7f9fc;
            color: #333;
            line-height: 1.6;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .order-confirmed {
            font-size: 28px;
            font-weight: 700;
            margin: 15px 0;
            letter-spacing: 0.5px;
        }

        .order-number {
            background: rgba(255, 255, 255, 0.2);
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 18px;
            font-weight: 600;
        }

        .content {
            padding: 30px;
        }

        .section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #4f46e5;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .detail-item {
            margin-bottom: 10px;
        }

        .detail-label {
            font-weight: 600;
            color: #666;
            font-size: 14px;
        }

        .detail-value {
            font-size: 16px;
            margin-top: 3px;
        }

        .shipment-status {
            background: #f0f9ff;
            border-left: 4px solid #38bdf8;
            padding: 15px;
            border-radius: 0 4px 4px 0;
            display: flex;
            align-items: center;
        }

        .status-icon {
            width: 40px;
            height: 40px;
            background: #e0f2fe;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: #0ea5e9;
            font-size: 18px;
        }

        .status-text {
            font-weight: 600;
        }

        .status-pending {
            color: #f59e0b;
            background: #fffbeb;
            border-left-color: #f59e0b;
        }

        .status-pending .status-icon {
            background: #fef3c7;
            color: #f59e0b;
        }

        .status-shipped {
            color: #10b981;
            background: #ecfdf5;
            border-left-color: #10b981;
        }

        .status-shipped .status-icon {
            background: #d1fae5;
            color: #10b981;
        }

        .status-delivered {
            color: #8b5cf6;
            background: #f5f3ff;
            border-left-color: #8b5cf6;
        }

        .status-delivered .status-icon {
            background: #ede9fe;
            color: #8b5cf6;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
        }

        .products-table th {
            text-align: left;
            padding: 12px 15px;
            background: #f8fafc;
            font-weight: 600;
            color: #64748b;
            font-size: 14px;
            border-bottom: 1px solid #e2e8f0;
        }

        .products-table td {
            padding: 15px;
            border-bottom: 1px solid #f1f5f9;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-image {
            width: 60px;
            height: 60px;
            background: #f1f5f9;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: #94a3b8;
            font-size: 24px;
        }

        .product-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .product-details {
            font-size: 14px;
            color: #64748b;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total-row {
            font-weight: 700;
            font-size: 18px;
            background: #f8fafc;
        }

        .footer {
            background: #f1f5f9;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #64748b;
        }

        .footer-links {
            margin-top: 10px;
        }

        .footer-links a {
            color: #4f46e5;
            text-decoration: none;
            margin: 0 10px;
        }

        @media (max-width: 600px) {
            .details-grid {
                grid-template-columns: 1fr;
            }

            .products-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">ALEEF PRO</div>
            <div class="order-confirmed">Order Confirmed!</div>
            <div class="order-number">Order #{{ $order->order_id }}</div>
        </div>

        <div class="content">
            <div class="section">
                <div class="section-title">
                    <i>📦</i> Shipment Status
                </div>
                <div class="shipment-status status-pending">
                    <div class="status-icon">
                        <i>⏱</i>
                    </div>
                    <div>
                        <div class="status-text">Pending</div>
                        <div>Your order is being processed and will be shipped soon</div>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-title">
                    <i>👤</i> Customer Details
                </div>
                <div class="details-grid">
                    <div class="detail-item">
                        <div class="detail-label">Customer Name</div>
                        <div class="detail-value">{{ $order->customer->name }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Email Address</div>
                        <div class="detail-value">{{ $order->customer->email }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Order Date</div>
                        <div class="detail-value">{{ $order->order_date }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Payment Status</div>
                        <div class="detail-value">{{ $order->payment_status }}</div>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-title">
                    <i>📝</i> Order Summary
                </div>
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->product_details as $item)
                        <tr>
                            <td>
                                <div class="product-info">
                                    <div>
                                        <div class="product-name">{{ $item['product_name'] }}</div>
                                        <div class="product-details">
                                            Color: {{ $item['product_color'] }} |
                                            Size: {{ $item['product_size'] }} |
                                            Code: {{ $item['product_code'] }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>${{ number_format($item['product_rate'], 2) }}</td>
                            <td class="text-center">{{ $item['product_quantity'] }}</td>
                            <td class="text-right">${{ number_format($item['total_amount'], 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="total-row">
                            <td colspan="3" class="text-right">Total</td>
                            <td class="text-right">${{ number_format($order->overall_amount, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="section">
                <div class="section-title">
                    <i>📍</i> Shipping Address
                </div>
                <div>
                    <div>{{ $order->customer->name }}</div>
                    <div>{{ $order->customer->address }}</div>
                    <div style="margin-top: 10px;">📱 {{ $order->customer->mobile }}</div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div>Thank you for shopping with us!</div>
            <div style="margin-top: 15px;">© 2025 Aleef Pro Factory Showroom. All rights reserved.</div>
        </div>
    </div>
</body>

</html>