<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karibu SalamaPay</title>
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
                                Usalama wa Malipo Yako Tanzania
                            </p>
                        </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                        <td style="padding:45px 40px; text-align:center;">
                            <div style="background: #f0fdf4; width: 64px; height: 64px; border-radius: 20px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                                <img src="https://img.icons8.com/fluency/48/handshake.png" width="32" height="32" alt="Welcome">
                            </div>
                            
                            <h3 style="margin:0 0 12px 0; color:#064e3b; font-size: 22px; font-weight: 800;">Karibu SalamaPay, {{ $name }}!</h3>
                            <p style="color:#475569; font-size:15px; line-height:1.6; margin: 0;">
                                Tumefurahi kukuona ukijiunga na familia ya SalamaPay. Sisi ni chaguo namba moja kwa usalama wa malipo yako mtandaoni nchini Tanzania kupitia mfumo wetu wa <strong>Escrow</strong>.
                            </p>

                            <div style="margin: 30px 0; text-align: left; background: #f8fafc; padding: 25px; border-radius: 16px; border: 1px solid #f1f5f9;">
                                <h4 style="margin: 0 0 15px 0; color: #10b981; font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em;">Unachoweza kufanya:</h4>
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="24" valign="top" style="padding-top: 4px;"><img src="https://img.icons8.com/material-rounded/16/10b981/checked.png" width="16" height="16"></td>
                                        <td style="padding-bottom: 10px; padding-left: 10px; font-size: 14px; color: #475569;">Fanya miamala kwa usalama (Escrow)</td>
                                    </tr>
                                    <tr>
                                        <td width="24" valign="top" style="padding-top: 4px;"><img src="https://img.icons8.com/material-rounded/16/10b981/checked.png" width="16" height="16"></td>
                                        <td style="padding-bottom: 10px; padding-left: 10px; font-size: 14px; color: #475569;">Pokea bidhaa kabla ya muuzaji kupata pesa</td>
                                    </tr>
                                    <tr>
                                        <td width="24" valign="top" style="padding-top: 4px;"><img src="https://img.icons8.com/material-rounded/16/10b981/checked.png" width="16" height="16"></td>
                                        <td style="font-size: 14px; color: #475569;">Kuza biashara yako kwa uaminifu zaidi</td>
                                    </tr>
                                </table>
                            </div>

                            <div style="text-align: center; margin-top: 30px;">
                                <a href="{{ config('app.url') }}/dashboard" style="display: inline-block; padding: 16px 35px; background-color: #10b981; color: #ffffff; text-decoration: none; border-radius: 14px; font-weight: 700; font-size: 15px;">Fungua Dashboard Yako</a>
                            </div>
                        </td>
                    </tr>

                    <!-- INFO SECTION -->
                    <tr>
                        <td style="padding:0 40px 40px 40px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc; border-radius:16px; padding:24px; border: 1px solid #f1f5f9;">
                                <tr>
                                    <td>
                                        <h4 style="margin:0 0 15px 0; color:#064e3b; font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Msaada wa Haraka</h4>
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
