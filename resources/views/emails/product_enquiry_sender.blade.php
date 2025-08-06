<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product Enquiry Received - Aleef Pro</title>
</head>

<body style="margin:0;padding:0;background-color:#f7f7f7;">
    <center style="width:100%;background-color:#f7f7f7;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center" style="padding: 20px;">
                    <table width="600" style="background:white;border-radius:8px;padding:20px;">
                        <tr>
                            <td align="center">
                                <h2 style="color:#007bff;">New Product Enquiry Received!</h2>
                                <p style="font-size:14px;color:#555;">Below are the details of your request.</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Product Information</h4>
                                <table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse;font-size:14px;">
                                    <thead>
                                        <tr style="background:#f2f2f2;">
                                            <th>Product Name</th>
                                            <th>Product Code</th>
                                            <th>Category</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Rate</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $data['product_name'] }}</td>
                                            <td>{{ $data['product_code'] }}</td>
                                            <td>{{ $data['main_sub_category'] }}</td>
                                            <td>{{ $data['product_color'] }}</td>
                                            <td>{{ $data['enquiry_size'] }}</td>
                                            <td>₹{{ number_format($data['product_rate'], 2) }}</td>
                                            <td>{{ $data['product_quantity'] }}</td>
                                            <td>₹{{ number_format($data['total_amount'], 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h4 style="margin-top:30px;">Customer Information</h4>
                                <p><strong>Name:</strong> {{ $data['customer_name'] }}</p>
                                <p><strong>Email:</strong> {{ $data['customer_email'] }}</p>
                                <p><strong>Mobile:</strong> {{ $data['customer_mobile'] }}</p>
                                <p><strong>Address:</strong> {{ $data['customer_address'] }}</p>
                                <p><strong>Additional Enquiry:</strong> {{ $data['detail_enquiry'] }}</p>

                                <p style="margin-top:30px;font-size:12px;color:#888;">
                                    © {{ now()->year }} Aleef Pro. All rights reserved.
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>