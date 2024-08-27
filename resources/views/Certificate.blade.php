<!DOCTYPE html>
<html>
<head>
    <title>Certificate of Achievement</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Open+Sans:wght@300;400;600;700&display=swap');

        @page {
            size: A4 landscape;
            margin: 0;
        }
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Open Sans', sans-serif;
            background-color: #f3f3f3;
            text-align: center;
        }
        .certificate-container {
            width: 90%;
            height: 80%;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .certificate-inner {
            width: 95%;
            height: 95%;
            padding: 50px;
            border: 10px solid #d4af37;
            box-sizing: border-box;
            background-color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .header {
            font-size: 60px;
            font-family: 'Great Vibes', cursive;
            margin-bottom: 20px;
            color: #d4af37;
        }
        .content {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .name {
            font-size: 40px;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            font-size: 20px;
            margin-top: 50px;
        }
        .issued-date {
            font-style: italic;
        }
        .note {
            font-size: 18px;
            margin-top: 50px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="certificate-inner">
            <div class="header">Certificate of Membership</div>
            <div class="content">This is to certify that</div>
            <div class="name">{{ $name }}</div>
            <div class="content">has successfully completed the course.</div>
            <div class="footer">
                <div class="issued-date">Issued on: {{ $membership_date }} </div>
            </div>
            <div class="note">This is a digitally provided certificate and does not require a signature.</div>
        </div>
    </div>
</body>
</html>