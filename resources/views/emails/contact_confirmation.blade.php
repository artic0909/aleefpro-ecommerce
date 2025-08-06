<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Confirmation - Aleef Pro</title>
</head>

<body style="Margin:0;padding:0;background-color:#f7f7f7;">
    <center style="width: 100%; background-color: #f7f7f7;">
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width: 600px; margin: auto; background-color: #ffffff;">
            <tr>
                <td align="center" style="background-color: #ff6600; padding: 20px;">
                    <h1 style="color: #ffffff; font-family: Arial, sans-serif; font-size: 24px; margin: 0;">ALEEF PRO</h1>
                </td>
            </tr>

            <tr>
                <td style="padding: 30px; font-family: Arial, sans-serif;">
                    <h2 style="color: #003366; margin-top: 0;">Hello {{ $data['name'] }},</h2>
                    <p style="font-size: 16px; color: #333;">We’ve received your message:</p>

                    <ul style="font-size: 16px; color: #333; padding-left: 20px;">
                        <li><strong>Email:</strong> {{ $data['email'] }}</li>
                        <li><strong>Subject:</strong> {{ $data['subject'] }}</li>
                        <li><strong>Message:</strong> {{ $data['message'] }}</li>
                    </ul>

                    <p style="font-size: 16px; color: #333;">Our team will respond to you shortly.</p>

                    <div style="margin: 30px 0; text-align: center;">
                        <a href="{{ url('/') }}" style="background-color: #003366; color: #ffffff; padding: 12px 24px; text-decoration: none; display: inline-block; font-size: 16px; border-radius: 4px;">Visit Our Website</a>
                    </div>

                    <p style="font-size: 14px; color: #999;">Need help? Email us at <a href="mailto:info@aleefpro.com" style="color: #6666ff;">info@aleefpro.com</a>.</p>
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