<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SalamaPay Verification Code</title>
</head>
<body style="margin:0; padding:0; background-color:#f8fafc; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color:#1e293b;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
        <tr>
            <td align="center">
                <!-- MAIN CARD -->
                <table width="520" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:24px; overflow:hidden; box-shadow:0 10px 40px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">
                    <!-- HEADER -->
                    <tr>
                        <td style="background:#4f46e5; padding:40px 30px; text-align:center; color:white;">
                            <div style="margin-bottom: 15px;">
                                <img src="{{ asset('salama-pay-logo.png') }}" alt="SalamaPay" style="height: 60px; width: auto; filter: brightness(0) invert(1);">
                            </div>
                            <h2 style="margin:0; font-size: 24px; letter-spacing: -0.025em; font-weight: 800;">SalamaPay</h2>
                            <p style="margin:5px 0 0; font-size:14px; opacity:0.9; font-weight: 500;">
                                Secure Escrow Payments Platform
                            </p>
                        </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                        <td style="padding:45px 40px; text-align:center;">
                            <div style="background: #f5f3ff; width: 64px; height: 64px; border-radius: 20px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#4f46e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                            </div>
                            
                            <h3 style="margin:0 0 12px 0; color:#0f172a; font-size: 22px; font-weight: 800;">Your Verification Code</h3>
                            <p style="color:#64748b; font-size:15px; line-height:1.6; margin: 0;">
                                Use the secure code below to complete your verification process.
                                <br><strong>For your protection, do not share this code with anyone.</strong>
                            </p>

                            <!-- CODE BOX -->
                            <div style="display:inline-block; margin:35px 0; padding:20px 45px; font-size:42px; font-weight:800; letter-spacing:10px; background:#f8fafc; color:#4f46e5; border-radius:16px; border:2px dashed #e2e8f0; font-family: 'Courier New', Courier, monospace;">
                                {{ $otp }}
                            </div>

                            <div style="display: flex; align-items: center; justify-content: center; gap: 8px; color:#94a3b8; font-size:13px; font-weight: 500;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                <span>This code will expire in 10 minutes.</span>
                            </div>
                        </td>
                    </tr>

                    <!-- INFO SECTION -->
                    <tr>
                        <td style="padding:0 40px 40px 40px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc; border-radius:16px; padding:24px; border: 1px solid #f1f5f9;">
                                <tr>
                                    <td>
                                        <h4 style="margin:0 0 15px 0; color:#0f172a; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Need Help?</h4>
                                        <div style="display: block; margin-bottom: 8px; color: #475569; font-size: 14px;">
                                            <span style="color: #4f46e5; margin-right: 8px;">📧</span> support@salamapay.com
                                        </div>
                                        <div style="display: block; margin-bottom: 8px; color: #475569; font-size: 14px;">
                                            <span style="color: #4f46e5; margin-right: 8px;">📞</span> +255 712 345 678
                                        </div>
                                        <div style="display: block; color: #475569; font-size: 14px;">
                                            <span style="color: #4f46e5; margin-right: 8px;">🌐</span> www.salamapay.com
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="background:#f1f5f9; padding:35px 40px; text-align:center; color:#64748b;">
                            <p style="margin:0 0 15px 0; font-size:12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: #94a3b8;">
                                Follow SalamaPay
                            </p>
                            <div style="margin-bottom: 25px;">
                                <span style="margin: 0 10px; font-size: 13px; font-weight: 600; color: #4f46e5;">Facebook</span>
                                <span style="margin: 0 10px; font-size: 13px; font-weight: 600; color: #4f46e5;">Instagram</span>
                                <span style="margin: 0 10px; font-size: 13px; font-weight: 600; color: #4f46e5;">LinkedIn</span>
                            </div>
                            <p style="margin:0; font-size:12px; line-height: 1.5;">
                                &copy; {{ date('Y') }} SalamaPay. Haki zote zimehifadhiwa.
                            </p>
                            <p style="margin:10px 0 0 0; font-size:11px; opacity:0.8; font-style: italic; color: #ef4444; font-weight: 600;">
                                Tafadhali usijibu barua pepe hii (Do not reply to this message).
                            </p>
                        </td>
                    </tr>
                </table>
                <!-- END CARD -->
            </td>
        </tr>
    </table>
</body>
</html>
