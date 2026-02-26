<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karibu SalamaPay</title>
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
                                Usalama wa Malipo Yako Tanzania
                            </p>
                        </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                        <td style="padding:45px 40px; text-align:center;">
                            <!-- SENDER AVATAR (LOGO) -->
                            <div style="margin-bottom: 24px;">
                                <div style="display: inline-block; width: 80px; height: 80px; border-radius: 50%; background: #f5f3ff; padding: 10px; border: 2px solid #e0e7ff;">
                                    <img src="{{ asset('salama-pay-logo.png') }}" alt="SalamaPay Team" style="width: 100%; height: auto;">
                                </div>
                            </div>
                            
                            <h3 style="margin:0 0 12px 0; color:#0f172a; font-size: 22px; font-weight: 800;">Karibu SalamaPay, {{ $name }}!</h3>
                            <p style="color:#64748b; font-size:15px; line-height:1.6; margin: 0;">
                                Akiba yako na miamala yako sasa vipo mikononi salama. Tumefurahia kukuona ukijiunga na familia ya SalamaPay.
                            </p>

                            <div style="margin: 30px 0; text-align: left; background: #f8fafc; padding: 25px; border-radius: 16px; border: 1px solid #f1f5f9;">
                                <h4 style="margin: 0 0 15px 0; color: #4f46e5; font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em;">Hatua inayofuata:</h4>
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="24" valign="top" style="padding-top: 4px;"><img src="https://img.icons8.com/material-rounded/16/4f46e5/checked.png" width="16" height="16"></td>
                                        <td style="padding-bottom: 10px; padding-left: 10px; font-size: 14px; color: #475569;">Kamilisha wasifu (Profile) yako</td>
                                    </tr>
                                    <tr>
                                        <td width="24" valign="top" style="padding-top: 4px;"><img src="https://img.icons8.com/material-rounded/16/4f46e5/checked.png" width="16" height="16"></td>
                                        <td style="padding-bottom: 10px; padding-left: 10px; font-size: 14px; color: #475569;">Anza miamala ya kwanza kwa usalama</td>
                                    </tr>
                                    <tr>
                                        <td width="24" valign="top" style="padding-top: 4px;"><img src="https://img.icons8.com/material-rounded/16/4f46e5/checked.png" width="16" height="16"></td>
                                        <td style="font-size: 14px; color: #475569;">Unganisha mbinu ya malipo (Wallet)</td>
                                    </tr>
                                </table>
                            </div>

                            <div style="text-align: center; margin-top: 30px;">
                                <a href="{{ config('app.url') }}/dashboard" style="display: inline-block; padding: 16px 35px; background-color: #4f46e5; color: #ffffff; text-decoration: none; border-radius: 14px; font-weight: 700; font-size: 15px;">Fungua Dashboard Yako</a>
                            </div>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="background:#f1f5f9; padding:35px 40px; text-align:center; color:#64748b;">
                            <div style="margin-bottom: 20px;">
                                <img src="https://img.icons8.com/material-rounded/20/4f46e5/mail.png" width="16" height="16" style="vertical-align: middle; margin-right: 5px;"> 
                                <span style="font-size: 13px; color: #475569;">info@zerixa.co.tz</span>
                                <span style="margin: 0 10px; color: #cbd5e1;">|</span>
                                <img src="https://img.icons8.com/material-rounded/20/4f46e5/whatsapp.png" width="16" height="16" style="vertical-align: middle; margin-right: 5px;"> 
                                <span style="font-size: 13px; color: #475569;">+255 613 976 254</span>
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
