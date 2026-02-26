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
                            <div style="background: #f5f3ff; width: 64px; height: 64px; border-radius: 20px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#4f46e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            </div>
                            
                            <h3 style="margin:0 0 12px 0; color:#0f172a; font-size: 22px; font-weight: 800;">Karibu SalamaPay, {{ $name }}!</h3>
                            <p style="color:#64748b; font-size:15px; line-height:1.6; margin: 0;">
                                Tumefurahi kukuona ukijiunga na familia ya SalamaPay. Sisi ni chaguo namba moja kwa usalama wa malipo yako mtandaoni nchini Tanzania kupitia mfumo wetu wa <strong>Escrow</strong>.
                            </p>

                            <div style="margin: 30px 0; text-align: left; background: #f8fafc; padding: 25px; border-radius: 16px; border: 1px solid #f1f5f9;">
                                <h4 style="margin: 0 0 15px 0; color: #4f46e5; font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em;">Unachoweza kufanya:</h4>
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="24" valign="top" style="padding-top: 4px;"><span style="color: #10b981; font-weight: bold;">✓</span></td>
                                        <td style="padding-bottom: 10px; padding-left: 10px; font-size: 14px; color: #475569;">Fanya miamala kwa usalama (Escrow)</td>
                                    </tr>
                                    <tr>
                                        <td width="24" valign="top" style="padding-top: 4px;"><span style="color: #10b981; font-weight: bold;">✓</span></td>
                                        <td style="padding-bottom: 10px; padding-left: 10px; font-size: 14px; color: #475569;">Pokea bidhaa kabla ya muuzaji kupata pesa</td>
                                    </tr>
                                    <tr>
                                        <td width="24" valign="top" style="padding-top: 4px;"><span style="color: #10b981; font-weight: bold;">✓</span></td>
                                        <td style="font-size: 14px; color: #475569;">Kuza biashara yako kwa uaminifu zaidi</td>
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
