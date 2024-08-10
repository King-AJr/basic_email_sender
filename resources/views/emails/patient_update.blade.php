<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Update Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header img {
            height: 40px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
            color: #674b9f;
        }

        .patient-info {
            margin: 20px 0;
        }

        .patient-info p {
            font-size: 18px;
            color: #555;
        }

        .section {
            margin: 20px 0;
            padding: 20px;
            border-top: 1px solid #ddd;
        }

        .section h3 {
            font-size: 18px;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .section h3 span {
            background-color: #674b9f;
            color: white;
            border-radius: 50%;
            padding: 5px 10px;
            margin-right: 10px;
        }

        .section p {
            margin: 10px 0 0 28px;
            font-size: 16px;
            color: #333;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #fff;
            border-top: 1px solid #ddd;
        }

        .footer .logo {
            display: flex;
            align-items: center;
        }

        .footer .logo img {
            height: 50px;
            margin-right: 10px;
        }

        .footer .company-info h2 {
            font-size: 16px;
            margin: 0;
            font-weight: bold;
        }

        .footer .company-info p {
            margin: 0;
            font-size: 14px;
            color: #777;
        }

        .footer .contact-info {
            text-align: right;
        }

        .footer .contact-info .social-icons {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 5px;
        }

        .footer .contact-info .social-icons img {
            height: 20px;
            margin-left: 10px;
        }

        .footer .contact-info p {
            margin: 0;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="width: 150px; height: 200px;">
            <h1>Patient Update Record</h1>
        </div>
        <div class="patient-info">
            <p>This document summarizes the recent medical updates for the patient: {{ $patient_name }}</p>
        </div>
        @php
            $counter = 1;
        @endphp
        @if (!empty($x_ray))
            <div class="section">
                <h3><span>{{ $counter++ }}</span> X-Ray</h3>
                <p>The patient underwent the following X-Ray examinations: {{ implode(', ', $x_ray) }}</p>
            </div>
        @endif

        @if (!empty($ultrasound_scan))
            <div class="section">
                <h3><span>{{ $counter++ }}</span> Ultrasound Scan</h3>
                <p>The patient underwent the following Ultrasound scans: {{ implode(', ', $ultrasound_scan) }}</p>
            </div>
        @endif

        @if (!empty($ct_scan))
            <div class="section">
                <h3><span>{{ $counter++ }}</span> CT Scans</h3>
                <p>The patient underwent the following CT scans: {{ implode(', ', $ct_scan) }}</p>
            </div>
        @endif

        @if (!empty($mri))
            <div class="section">
                <h3><span>{{ $counter++ }}</span>MRI</h3>
                <p>The patient underwent the following MRI scans: {{ implode(', ', $mri) }}</p>
            </div>
        @endif

        <div class="footer">
            <div class="logo">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">
                <div class="company-info">
                    <h2>Seven Healthcare</h2>
                    <p>Multi-Award-Winning Healthcare Recruitment</p>
                </div>
            </div>
            <div class="contact-info">
                <div class="social-icons">
                    <img src="{{ asset('images/fb-icon.png') }}" alt="Facebook">
                    <img src="{{ asset('images/ig-icon.png') }}" alt="Instagram">
                    <img src="{{ asset('images/x-icon.png') }}" alt="Twitter">
                </div>
                <p>Developed By: Atairoro Joshua</p>
                <p>talk2king.aj@gmail.com | +123456789</p>
            </div>
        </div>
    </div>
</body>

</html>
