<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Certificat de réussite</title>
    <style>
        @page {
            margin: 0;
            size  : A4 landscape;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            line-height: 1.6;
            text-align: center;
            padding: 40px;
            margin: 0;
            background: linear-gradient(45deg, #f8f9fa 25%, transparent 25%, transparent 75%, #f8f9fa 75%) 0 0,
                        linear-gradient(45deg, #f8f9fa 25%, transparent 25%, transparent 75%, #f8f9fa 75%) 20px 20px;
            background-size: 40px 40px;
            background-color: #ffffff;
        }
        .certificate {
            max-width: 1000px;
            margin: 0 auto;
            border: 2px solid #234;
            padding: 40px;
            position: relative;
            background: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            margin-bottom: 40px;
            border-bottom: 2px solid #234;
            padding-bottom: 20px;
        }
        .title {
            font-size: 42px;
            color: #234;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 4px;
        }
        .subtitle {
            font-size: 24px;
            color: #456;
            margin-bottom: 40px;
        }
        .content {
            font-size: 18px;
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }
        .name {
            font-size: 32px;
            color: #234;
            font-weight: bold;
            margin: 20px 0;
            border-bottom: 2px solid #234;
            display: inline-block;
            padding: 0 40px 10px;
        }
        .course-name {
            font-size: 24px;
            color: rgb(251, 11, 11));
            margin: 20px 0;
            font-style: italic;
        }
        .date {
            font-size: 18px;
            margin-top: 40px;
            color: #666;
        }
        .signature {
            margin-top: 60px;
            border-top: 1px solid #234;
            padding-top: 20px;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 120px;
            color: rgba(35, 68, 85, 0.05);
            z-index: 0;
            white-space: nowrap;
        }
        .verification {
            position: absolute;
            bottom: 20px;
            right: 20px;
            text-align: right;
            font-size: 12px;
            color: #666;
        }
        .verification-code {
            font-family: monospace;
            background: #f8f9fa;
            padding: 5px 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="watermark">CERTIFIÉ</div>

        <div class="header">
            @if(file_exists(public_path('images/logo.png')))
                <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="logo">
            @endif
            <div class="title">Certificat de réussite</div>
            <div class="subtitle">Ce certificat est décerné à</div>
        </div>

        <div class="content">
            <div class="name">{{ $user->name }}</div>

            <p>pour avoir complété avec succès le cours</p>

            <div class="course-name">"{{ $course->title }}"</div>

            <div class="date">
                Certifié le {{ $completion_date }}
            </div>
        </div>

        <div class="signature">
            <p>Signature du formateur</p>
            <p>{{ $course->teacher->name }}</p>
        </div>

        <div class="verification">
            <p>Code de vérification :</p>
            <span class="verification-code">{{ $verification_code }}</span>
            <p>Vérifiez l'authenticité de ce certificat sur :</p>
            <p>{{ url('/verify-certificate/' . $verification_code) }}</p>
        </div>
    </div>
</body>
</html>
