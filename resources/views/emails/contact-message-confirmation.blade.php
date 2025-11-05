<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
        }
        .highlight-box {
            background: white;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Thank You for Contacting Us!</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $contactMessage->first_name }},</p>
        
        <p>Thank you for reaching out to AMD Global. We have received your message and our team will review it shortly.</p>
        
        <div class="highlight-box">
            <strong>Your Message Details:</strong><br><br>
            <strong>Subject:</strong> {{ ucfirst($contactMessage->subject) }}<br>
            @if($contactMessage->booking_ref)
            <strong>Booking Reference:</strong> {{ $contactMessage->booking_ref }}<br>
            @endif
            <strong>Submitted:</strong> {{ $contactMessage->created_at->format('M d, Y h:i A') }}
        </div>
        
        <p><strong>What happens next?</strong></p>
        <ul>
            <li>Our team will review your inquiry</li>
            <li>We typically respond within 24-48 hours</li>
            <li>For urgent matters, please call our support line</li>
        </ul>
        
        <p>If you have any urgent concerns, please don't hesitate to contact us directly at <a href="mailto:team@amdglobal.de">team@amdglobal.de</a></p>
        
        <center>
            <a href="{{ url('/') }}" class="button">Visit Our Website</a>
        </center>
    </div>
    
    <div class="footer">
        <p><strong>AMD Global</strong></p>
        <p>Email: team@amdglobal.de</p>
        <p>&copy; {{ date('Y') }} AMD Global. All rights reserved.</p>
    </div>
</body>
</html>