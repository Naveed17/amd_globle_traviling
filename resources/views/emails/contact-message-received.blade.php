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
        .info-row {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }
        .label {
            font-weight: bold;
            color: #667eea;
            display: inline-block;
            width: 150px;
        }
        .message-box {
            background: white;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
            border-left: 4px solid #667eea;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>New Contact Form Submission</h1>
    </div>
    
    <div class="content">
        <div class="info-row">
            <span class="label">Name:</span>
            <span>{{ $contactMessage->full_name }}</span>
        </div>
        
        <div class="info-row">
            <span class="label">Email:</span>
            <span><a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a></span>
        </div>
        
        @if($contactMessage->phone)
        <div class="info-row">
            <span class="label">Phone:</span>
            <span>{{ $contactMessage->phone }}</span>
        </div>
        @endif
        
        <div class="info-row">
            <span class="label">Subject:</span>
            <span>{{ ucfirst($contactMessage->subject) }}</span>
        </div>
        
        @if($contactMessage->booking_ref)
        <div class="info-row">
            <span class="label">Booking Reference:</span>
            <span>{{ $contactMessage->booking_ref }}</span>
        </div>
        @endif
        
        <div class="info-row">
            <span class="label">Submitted:</span>
            <span>{{ $contactMessage->created_at->format('M d, Y h:i A') }}</span>
        </div>
        
        <div class="message-box">
            <strong>Message:</strong>
            <p>{{ $contactMessage->message }}</p>
        </div>
    </div>
    
    <div class="footer">
        <p>This is an automated message from AMD Global contact form.</p>
        <p>&copy; {{ date('Y') }} AMD Global. All rights reserved.</p>
    </div>
</body>
</html>