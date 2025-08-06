<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Password Reset OTP - Aleef Pro</title>
</head>

<body style="margin:0;padding:0;background-color:#f7f7f7;">
    <center style="width:100%; background-color:#f7f7f7;">
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width:600px; margin:auto; background-color:#ffffff;">
            <tr>
                <td align="center" style="background-color:#ff6600; padding:20px;">
                    <h1 style="color:#ffffff; font-family:Arial,sans-serif; font-size:24px; margin:0;">ALEEF PRO</h1>
                </td>
            </tr>
            <tr>
                <td style="padding:30px; font-family:Arial,sans-serif;">
                    <h2 style="color:#003366; margin-top:0;">Hi {{ $data['name'] ?? 'User' }},</h2>
                    <p style="font-size:16px; color:#333;">You requested a password reset.</p>
                    <p style="font-size:16px; color:#333;">Your One-Time Password (OTP) is:</p>
                    <h1 style="color:#ff6600; font-size:36px;">{{ $data['otp'] }}</h1>
                    <p style="font-size:16px; color:#333;">Use this OTP to complete your password reset.</p>
                    <p style="font-size:14px; color:#999;">If you didn’t request this, please ignore this email or contact us.</p>
                </td>
            </tr>
            <tr>
                <td align="center" style="background-color:#003366; color:#ffffff; padding:15px; font-size:13px; font-family:Arial,sans-serif;">
                    © {{ date('Y') }} Aleef Pro. All rights reserved.
                </td>
            </tr>
        </table>
    </center>
</body>

</html>