<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>108 Astro Yagya Sankalp Notification</title>
</head>
<body style="margin: 0; padding: 0; background-color: #120708; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #fdf6ec;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #120708; padding: 30px 10px;">
        <tr>
            <td align="center">
                <table width="640" cellpadding="0" cellspacing="0" style="max-width: 640px; background: linear-gradient(180deg, #220c0f 0%, #16080a 100%); border: 1px solid #d4af37; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.6);">
                    <!-- Header -->
                    <tr>
                        <td align="center" style="padding: 35px 25px; background: radial-gradient(circle at center, #3d1419 0%, #1c080b 100%); border-bottom: 2px solid #d4af37;">
                            <div style="font-size: 28px; color: #d4af37; letter-spacing: 2px; font-weight: bold; margin-bottom: 6px;">
                                ॐ 108 ASTRO YAGYA
                            </div>
                            <div style="font-size: 13px; color: #f3c267; letter-spacing: 1.5px; text-transform: uppercase;">
                                Sacred Vedic Traditions • Divine Planetary Remedies
                            </div>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 35px 30px;">
                            @if($recipientType === 'admin')
                                <div style="display: inline-block; padding: 6px 14px; background: rgba(212, 175, 55, 0.15); border: 1px solid #d4af37; border-radius: 20px; color: #f59e0b; font-size: 12px; font-weight: bold; text-transform: uppercase; margin-bottom: 15px;">
                                    New Inbound Inquiry
                                </div>
                                <h2 style="color: #ffffff; margin-top: 0; font-size: 22px;">Auspicious Sankalp Inquiry Received</h2>
                                <p style="color: #e2d9cc; font-size: 14px; line-height: 1.6;">
                                    A devotee has submitted a consultation/booking request on the 108 Astro Yagya portal. Below are the registered Vedic particulars:
                                </p>
                            @else
                                <div style="display: inline-block; padding: 6px 14px; background: rgba(212, 175, 55, 0.15); border: 1px solid #d4af37; border-radius: 20px; color: #f59e0b; font-size: 12px; font-weight: bold; text-transform: uppercase; margin-bottom: 15px;">
                                    Pranam & Blessings
                                </div>
                                <h2 style="color: #ffffff; margin-top: 0; font-size: 22px;">Hari Om, {{ $inquiry->full_name }} Ji 🙏</h2>
                                <p style="color: #e2d9cc; font-size: 14px; line-height: 1.6;">
                                    Your sacred Sankalp inquiry has been reverently received at the 108 Astro Yagya Kashi Ashram. Our head Vedic Acharya will review your astrological requirements and connect with you shortly via WhatsApp / Phone.
                                </p>
                            @endif

                            <!-- Details Table -->
                            <table width="100%" cellpadding="10" cellspacing="0" style="margin-top: 20px; background: rgba(0,0,0,0.3); border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 8px;">
                                <tr>
                                    <td width="35%" style="color: #f3c267; font-weight: bold; font-size: 13px; border-bottom: 1px solid rgba(212,175,55,0.15);">Seeker Name:</td>
                                    <td style="color: #ffffff; font-size: 14px; border-bottom: 1px solid rgba(212,175,55,0.15);">{{ $inquiry->full_name }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #f3c267; font-weight: bold; font-size: 13px; border-bottom: 1px solid rgba(212,175,55,0.15);">Phone / WhatsApp:</td>
                                    <td style="color: #ffffff; font-size: 14px; border-bottom: 1px solid rgba(212,175,55,0.15);">{{ $inquiry->phone }} @if($inquiry->whatsapp) (WA: {{ $inquiry->whatsapp }}) @endif</td>
                                </tr>
                                <tr>
                                    <td style="color: #f3c267; font-weight: bold; font-size: 13px; border-bottom: 1px solid rgba(212,175,55,0.15);">Email Address:</td>
                                    <td style="color: #ffffff; font-size: 14px; border-bottom: 1px solid rgba(212,175,55,0.15);">{{ $inquiry->email }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #f3c267; font-weight: bold; font-size: 13px; border-bottom: 1px solid rgba(212,175,55,0.15);">Inquiry Type:</td>
                                    <td style="color: #ffffff; font-size: 14px; border-bottom: 1px solid rgba(212,175,55,0.15); text-transform: uppercase;">
                                        {{ str_replace('_', ' ', $inquiry->inquiry_type) }}
                                    </td>
                                </tr>
                                @if($inquiry->service)
                                <tr>
                                    <td style="color: #f3c267; font-weight: bold; font-size: 13px; border-bottom: 1px solid rgba(212,175,55,0.15);">Requested Yagya / Service:</td>
                                    <td style="color: #ffd700; font-size: 14px; font-weight: bold; border-bottom: 1px solid rgba(212,175,55,0.15);">
                                        {{ $inquiry->service->title }} (Dakshina: ₹{{ number_format($inquiry->service->dakshina_inr) }})
                                    </td>
                                </tr>
                                @endif
                                @if($inquiry->astrologer)
                                <tr>
                                    <td style="color: #f3c267; font-weight: bold; font-size: 13px; border-bottom: 1px solid rgba(212,175,55,0.15);">Preferred Acharya:</td>
                                    <td style="color: #ffd700; font-size: 14px; border-bottom: 1px solid rgba(212,175,55,0.15);">
                                        {{ $inquiry->astrologer->name }} ({{ $inquiry->astrologer->title }})
                                    </td>
                                </tr>
                                @endif
                                @if($inquiry->date_of_birth || $inquiry->gotra || $inquiry->place_of_birth)
                                <tr>
                                    <td style="color: #f3c267; font-weight: bold; font-size: 13px; border-bottom: 1px solid rgba(212,175,55,0.15);">Vedic Birth Details:</td>
                                    <td style="color: #ffffff; font-size: 13px; line-height: 1.5; border-bottom: 1px solid rgba(212,175,55,0.15);">
                                        @if($inquiry->date_of_birth) <strong>DOB:</strong> {{ $inquiry->date_of_birth->format('d M Y') }}<br> @endif
                                        @if($inquiry->time_of_birth) <strong>Time:</strong> {{ $inquiry->time_of_birth }}<br> @endif
                                        @if($inquiry->place_of_birth) <strong>Place:</strong> {{ $inquiry->place_of_birth }}<br> @endif
                                        @if($inquiry->gotra) <strong>Gotra:</strong> {{ $inquiry->gotra }}<br> @endif
                                        @if($inquiry->rashi_nakshatra) <strong>Rashi/Nakshatra:</strong> {{ $inquiry->rashi_nakshatra }} @endif
                                    </td>
                                </tr>
                                @endif
                                @if($inquiry->problem_description)
                                <tr>
                                    <td style="color: #f3c267; font-weight: bold; font-size: 13px;">Prayer / Problem:</td>
                                    <td style="color: #ffffff; font-size: 13px; line-height: 1.5; font-style: italic;">
                                        "{{ $inquiry->problem_description }}"
                                    </td>
                                </tr>
                                @endif
                            </table>

                            <div style="margin-top: 30px; padding: 15px; background: rgba(212, 175, 55, 0.08); border-left: 3px solid #d4af37; border-radius: 4px;">
                                <p style="margin: 0; color: #f3c267; font-size: 12px; font-style: italic;">
                                    "यज्ञो वै श्रेष्ठतमं कर्म" — The sacred Yagya is the supreme deed that restores natural harmony and cosmic bliss.
                                </p>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding: 20px; background-color: #0b0304; border-top: 1px solid rgba(212, 175, 55, 0.2); font-size: 12px; color: #9c8a77;">
                            108 Astro Yagya Ashram, ED2/60 ADA Colony Naini, Allahabad. (UP) India.<br>
                            Direct Phone / WhatsApp: +91 8009767597 | Email: tarkeshwardeep@gmail.com
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
