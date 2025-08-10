<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Updates</title>
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
            padding: 20px;
        }

        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .tab-btn {
            padding: 12px 30px;
            background: #e0e7ff;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            margin: 0 10px;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .tab-btn.active {
            background: #4f46e5;
            color: white;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.3);
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .email-container:hover {
            transform: translateY(-5px);
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
            margin-bottom: 10px;
        }

        .order-status {
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

        .section:last-child {
            border-bottom: none;
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
            padding: 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            margin: 20px 0;
        }

        .status-out-for-delivery {
            background: #fffbeb;
            border-left: 4px solid #f59e0b;
        }

        .status-delivered {
            background: #ecfdf5;
            border-left: 4px solid #10b981;
        }

        .status-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 24px;
        }

        .status-icon-out {
            background: #fef3c7;
            color: #f59e0b;
        }

        .status-icon-delivered {
            background: #d1fae5;
            color: #10b981;
        }

        .status-text {
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 5px;
        }

        .status-subtext {
            color: #64748b;
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

        .action-button {
            display: inline-block;
            padding: 12px 30px;
            background: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
            transition: all 0.3s ease;
        }

        .action-button:hover {
            background: #3730a3;
            transform: translateY(-2px);
        }

        .tracking-container {
            background: #f8fafc;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }

        .tracking-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin: 30px 0;
        }

        .tracking-steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 4px;
            background: #e2e8f0;
            z-index: 1;
        }

        .tracking-step {
            text-align: center;
            position: relative;
            z-index: 2;
            flex: 1;
        }

        .step-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: white;
            border: 3px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 18px;
        }

        .step-text {
            font-size: 13px;
            color: #64748b;
        }

        .step-active .step-icon {
            border-color: #4f46e5;
            background: #4f46e5;
            color: white;
        }

        .step-completed .step-icon {
            border-color: #10b981;
            background: #10b981;
            color: white;
        }

        .step-active .step-text,
        .step-completed .step-text {
            color: #4f46e5;
            font-weight: 600;
        }

        .driver-info {
            display: flex;
            align-items: center;
            background: #f0f9ff;
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
        }

        .driver-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #bae6fd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 15px;
            color: #0ea5e9;
        }

        .driver-details {
            flex: 1;
        }

        .driver-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .driver-contact {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .contact-btn {
            flex: 1;
            text-align: center;
            padding: 8px;
            background: #e0f2fe;
            border-radius: 6px;
            color: #0ea5e9;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }

        .contact-btn:hover {
            background: #bae6fd;
        }

        .delivery-map {
            height: 180px;
            background: #e2e8f0;
            border-radius: 8px;
            margin: 20px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-weight: 500;
        }

        .review-section {
            text-align: center;
            padding: 30px;
            background: #f8fafc;
            border-radius: 10px;
            margin-top: 20px;
        }

        .review-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #4f46e5;
        }

        .rating-stars {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin: 20px 0;
        }

        .star {
            font-size: 28px;
            color: #e2e8f0;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star:hover,
        .star.active {
            color: #f59e0b;
        }

        @media (max-width: 600px) {
            .details-grid {
                grid-template-columns: 1fr;
            }

            .products-table {
                display: block;
                overflow-x: auto;
            }

            .tracking-steps {
                flex-direction: column;
                align-items: flex-start;
            }

            .tracking-steps::before {
                display: none;
            }

            .tracking-step {
                display: flex;
                align-items: center;
                margin-bottom: 20px;
                text-align: left;
                width: 100%;
            }

            .step-icon {
                margin: 0 15px 0 0;
            }
        }
    </style>
</head>

<body>
    <!-- Out for Delivery Template -->
    <div id="out-for-delivery-template" class="email-container">
        <div class="header">
            <div class="logo">ALEEF PRO</div>
            <div class="order-status">Your Order Is Out For Delivery!</div>
            <div class="order-number">Order #{{ $order->order_id }}</div>
        </div>

        <div class="content">
            <div class="shipment-status status-out-for-delivery">
                <div class="status-icon status-icon-out">🚚</div>
                <div>
                    <div class="status-text">Out for Delivery</div>
                    <div class="status-subtext">Your package is on its way to your location</div>
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
        </div>

        <div class="footer">
            <div style="margin-top: 15px;">© 2025 Aleef Pro Factory Showroom. All rights reserved.</div>
        </div>
    </div>