<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Aleef Pro</title>
</head>
<body style="margin:0; padding:0; font-family:Arial, sans-serif; background-color:#f7f7f7;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td align="center" style="background-color: #ff6600; padding: 20px;">
                            <h1 style="color:white; font-weight: bold;">ALEEF PRO</h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 30px;">
                            <h2 style="color: #003366; margin-bottom: 20px;">Welcome to Aleef Pro, {{ $name }}!</h2>
                            <p style="font-size: 16px; color: #333;">Thank you for registering with us. We're excited to have you join our safety gear marketplace!</p>
                            <p style="font-size: 16px; color: #333;">At <strong>Aleef Pro</strong>, we specialize in high-quality safety jackets, pants, and PPE. Whether you're purchasing in bulk or want to customize items with your company logo, we've got you covered.</p>

                            <p style="font-size: 16px; color: #333;">Feel free to browse our collection and start customizing your gear today.</p>

                            <div style="margin: 30px 0;">
                                <a href="{{ url('/') }}" style="display: inline-block; background-color: #003366; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 4px;">Visit Our Store</a>
                            </div>

                            <p style="font-size: 14px; color: #999;">If you have any questions, feel free to reach out at <a href="mailto:info@aleefpro.com">info@aleefpro.com</a>.</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color: #003366; color: #fff; padding: 15px; font-size: 13px;">
                            © {{ date('Y') }} Aleef Pro. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
