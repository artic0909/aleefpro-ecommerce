<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart Enquiry - Aleef Pro</title>
</head>
<body style="Margin:0;padding:0;background-color:#f7f7f7;">
    <center style="width: 100%; background-color: #f7f7f7;">
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width: 700px; margin: auto; background-color: #ffffff;">
            <tr>
                <td align="center" style="background-color: #ff6600; padding: 20px;">
                    <h1 style="color: #ffffff; font-family: Arial, sans-serif; font-size: 24px; margin: 0;">ALEEF PRO</h1>
                </td>
            </tr>

            <tr>
                <td style="padding: 30px; font-family: Arial, sans-serif;">
                    <h2 style="color: #003366; margin-top: 0;">Hi {{ $data['customer_name'] }} !</h2>
                    <p style="font-size: 16px; color: #333;"><strong>Your Cart Enquiry has been received.</strong></p>

                    <p style="font-size: 16px; color: #333;">Enquiry Date: <strong>{{ \Carbon\Carbon::parse($data['enquiry_date'])->format('d M Y') }}</strong></p>

                    <h3 style="color: #003366;">Product Details:</h3>
                    <table width="100%" cellpadding="10" cellspacing="0" border="1" style="border-collapse: collapse; font-size: 14px;">
                        <thead style="background-color: #f2f2f2;">
                            <tr>
                                <th align="left">Product Name</th>
                                <th align="left">Code</th>
                                <th align="left">Color</th>
                                <th align="left">Size</th>
                                <th align="center">Rate</th>
                                <th align="center">Quantity</th>
                                <th align="center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['products'] as $product)
                            <tr>
                                <td>{{ $product['product_name'] }}</td>
                                <td>{{ $product['product_code'] }}</td>
                                <td>{{ $product['product_color'] }}</td>
                                <td>{{ $product['enquiry_size'] }}</td>
                                <td align="center">${{ number_format($product['product_rate'], 2) }}</td>
                                <td align="center">{{ $product['product_quantity'] }}</td>
                                <td align="center">${{ number_format($product['total_amount'], 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <p style="font-size: 16px; color: #333; margin-top: 20px;">
                        <strong>Total Enquiry Amount: ${{ number_format($data['overall_amount'], 2) }}</strong>
                    </p>

                    <div style="margin: 30px 0; text-align: center;">
                        <a href="{{ url('/') }}" style="background-color: #003366; color: #ffffff; padding: 12px 24px; text-decoration: none; display: inline-block; font-size: 16px; border-radius: 4px;">Visit Aleef Pro</a>
                    </div>

                    <p style="font-size: 14px; color: #999;">For questions, email us at <a href="mailto:info@aleefpro.com" style="color: #6666ff;">info@aleefpro.com</a>.</p>
                </td>
            </tr>

            <tr>
                <td align="center" style="background-color: #003366; color: #ffffff; padding: 15px; font-size: 13px; font-family: Arial, sans-serif;">
                    © {{ date('Y') }} Aleef Pro. All rights reserved.
                </td>
            </tr>
        </table>
    </center>
</body>
</html>
