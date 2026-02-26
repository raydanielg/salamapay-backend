<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SalamaPay Verification Code</title>
</head>
<body style="margin:0; padding:0; background-color:#f0fdf4; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color:#1e293b;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
        <tr>
            <td align="center">
                <!-- MAIN CARD -->
                <table width="520" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:24px; overflow:hidden; box-shadow:0 10px 40px rgba(0,0,0,0.05); border: 1px solid #dcfce7;">
                    <!-- HEADER -->
                    <tr>
                        <td style="background:#10b981; padding:40px 30px; text-align:center; color:white;">
                            <div style="margin-bottom: 15px;">
                                <img src="{{ asset('salama-pay-logo.png') }}" alt="SalamaPay" style="height: 70px; width: auto; filter: brightness(0) invert(1);">
                            </div>
                            <h2 style="margin:0; font-size: 26px; letter-spacing: -0.025em; font-weight: 800;">SalamaPay</h2>
                            <p style="margin:5px 0 0; font-size:14px; opacity:0.9; font-weight: 500;">
                                Secure Escrow Payments Tanzania
                            </p>
                        </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                        <td style="padding:45px 40px; text-align:center;">
                            <div style="background: #f0fdf4; width: 64px; height: 64px; border-radius: 20px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                                <img src="https://img.icons8.com/fluency/48/shield.png" width="32" height="32" alt="Secure">
                            </div>
                            
                            <h3 style="margin:0 0 12px 0; color:#064e3b; font-size: 22px; font-weight: 800;">Your Verification Code</h3>
                            <p style="color:#475569; font-size:15px; line-height:1.6; margin: 0;">
                                Use the secure code below to complete your verification process.
                                <br><span style="color: #ef4444; font-weight: 700;">Usishirikishe namba hii na mtu yeyote.</span>
                            </p>

                            <!-- CODE BOX -->
                            <div style="display:inline-block; margin:35px 0; padding:20px 45px; font-size:42px; font-weight:800; letter-spacing:10px; background:#f0fdf4; color:#059669; border-radius:16px; border:2px dashed #10b981; font-family: 'Courier New', Courier, monospace;">
                                {{ $otp }}
                            </div>

                            <div style="display: flex; align-items: center; justify-content: center; gap: 8px; color:#64748b; font-size:13px; font-weight: 500;">
                                <img src="https://img.icons8.com/ios/20/94a3b8/clock.png" width="16" height="16" style="vertical-align: middle; margin-right: 5px;">
                                <span>Code hii itaisha muda wake baada ya dakika 10.</span>
                            </div>
                        </td>
                    </tr>

                    <!-- INFO SECTION -->
                    <tr>
                        <td style="padding:0 40px 40px 40px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc; border-radius:16px; padding:24px; border: 1px solid #f1f5f9;">
                                <tr>
                                    <td>
                                        <h4 style="margin:0 0 15px 0; color:#064e3b; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Unahitaji Msaada?</h4>
                                        <div style="display: block; margin-bottom: 12px; color: #475569; font-size: 14px;">
                                            <img src="https://img.icons8.com/material-rounded/20/10b981/mail.png" width="16" height="16" style="vertical-align: middle; margin-right: 8px;"> 
                                            info@zerixa.co.tz
                                        </div>
                                        <div style="display: block; margin-bottom: 12px; color: #475569; font-size: 14px;">
                                            <img src="https://img.icons8.com/material-rounded/20/10b981/phone.png" width="16" height="16" style="vertical-align: middle; margin-right: 8px;"> 
                                            +255 613 976 254
                                        </div>
                                        <div style="display: block; color: #475569; font-size: 14px;">
                                            <img src="https://img.icons8.com/material-rounded/20/10b981/whatsapp.png" width="16" height="16" style="vertical-align: middle; margin-right: 8px;"> 
                                            WhatsApp: +255 613 976 254
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="background:#f1f5f9; padding:35px 40px; text-align:center; color:#64748b;">
                            <div style="margin-bottom: 20px;">
                                <img src="https://img.icons8.com/material-rounded/24/10b981/facebook-new.png" width="20" height="20" style="margin: 0 8px;">
                                <img src="https://img.icons8.com/material-rounded/24/10b981/instagram-new.png" width="20" height="20" style="margin: 0 8px;">
                                <img src="https://img.icons8.com/material-rounded/24/10b981/twitter.png" width="20" height="20" style="margin: 0 8px;">
                            </div>
                            <p style="margin:0; font-size:12px; line-height: 1.5;">
                                &copy; {{ date('Y') }} SalamaPay (Zerixa Technologies). Haki zote zimehifadhiwa.
                            </p>
                            <p style="margin:10px 0 0 0; font-size:11px; color: #ef4444; font-weight: 600;">
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
