<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SalamaPay SMTP Test</title>
</head>
<body style="margin:0; padding:0; background-color:#f8fafc; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color:#1e293b;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
        <tr>
            <td align="center">
                <!-- MAIN CARD -->
                <table width="520" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:24px; overflow:hidden; box-shadow:0 10px 40px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">
                    <!-- HEADER -->
                    <tr>
                        <td style="background:#10b981; padding:40px 30px; text-align:center; color:white;">
                            <div style="margin-bottom: 15px;">
                                <img src="{{ asset('salama-pay-logo.png') }}" alt="SalamaPay" style="height: 60px; width: auto; filter: brightness(0) invert(1);">
                            </div>
                            <h2 style="margin:0; font-size: 24px; letter-spacing: -0.025em; font-weight: 800;">SMTP Test Successful</h2>
                            <p style="margin:5px 0 0; font-size:14px; opacity:0.9; font-weight: 500;">
                                Mipangilio yako ya barua pepe inafanya kazi
                            </p>
                        </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                        <td style="padding:45px 40px; text-align:center;">
                            <div style="background: #ecfdf5; width: 64px; height: 64px; border-radius: 20px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </div>
                            
                            <h3 style="margin:0 0 12px 0; color:#0f172a; font-size: 22px; font-weight: 800;">Hongera, {{ $name }}!</h3>
                            <p style="color:#64748b; font-size:15px; line-height:1.6; margin: 0;">
                                Barua pepe hii ni uthibitisho kwamba mfumo wa usafirishaji wa barua pepe (SMTP) wa SalamaPay umesanidiwa kwa usahihi na unafanya kazi vizuri.
                            </p>

                            <div style="margin: 30px 0; text-align: left; background: #f8fafc; padding: 25px; border-radius: 16px; border: 1px solid #f1f5f9;">
                                <h4 style="margin: 0 0 15px 0; color: #10b981; font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em;">Maelezo ya Jaribio:</h4>
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="padding-bottom: 10px; font-size: 14px; color: #64748b;">Muda wa kutumwa:</td>
                                        <td style="padding-bottom: 10px; font-size: 14px; color: #1e293b; font-weight: 600; text-align: right;">{{ $time }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom: 10px; font-size: 14px; color: #64748b;">Hali:</td>
                                        <td style="padding-bottom: 10px; font-size: 14px; color: #10b981; font-weight: 600; text-align: right;">Imeunganishwa ✅</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 14px; color: #64748b;">Mtumaji:</td>
                                        <td style="font-size: 14px; color: #1e293b; font-weight: 600; text-align: right;">SalamaPay Admin</td>
                                    </tr>
                                </table>
                            </div>

                            <p style="color:#94a3b8; font-size:13px; line-height:1.5;">
                                Sasa unaweza kuendelea kutumia mfumo huu kwa ajili ya kutuma OTP na taarifa nyingine kwa watumiaji.
                            </p>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="background:#f1f5f9; padding:35px 40px; text-align:center; color:#64748b;">
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
