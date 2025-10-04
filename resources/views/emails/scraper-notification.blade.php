<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        /* Reset and base styles */
        body, table, td {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        
        body {
            background-color: #f5f5f5;
            width: 100% !important;
            min-width: 100%;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        
        /* Container */
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Header */
        .header {
            background-color: #ffffff;
            text-align: center;
            padding: 30px 20px;
            border-bottom: 1px solid #eeeeee;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            border-radius: 8px;
        }
        
        .app-name {
            font-size: 24px;
            font-weight: 600;
            color: #333333;
            margin-bottom: 5px;
        }
        
        .tagline {
            font-size: 14px;
            color: #666666;
        }
        
        /* Content */
        .content {
            padding: 30px 20px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 20px;
        }
        
        .status-completed {
            background-color: #e8f5e8;
            color: #2d7d32;
            border: 1px solid #c8e6c9;
        }
        
        .status-failed {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }
        
        .title {
            font-size: 20px;
            font-weight: 600;
            color: #333333;
            margin-bottom: 15px;
        }
        
        .message {
            font-size: 16px;
            color: #555555;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        
        /* Info card */
        .info-card {
            background-color: #fafafa;
            border: 1px solid #eeeeee;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
        }
        
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }
        
        .info-row:last-child {
            margin-bottom: 0;
        }
        
        .info-label {
            display: table-cell;
            width: 30%;
            font-size: 13px;
            color: #888888;
            font-weight: 500;
            vertical-align: top;
            padding-right: 10px;
        }
        
        .info-value {
            display: table-cell;
            font-size: 14px;
            color: #333333;
            font-weight: 500;
        }
        
        /* Button */
        .button-container {
            text-align: center;
            margin: 25px 0;
        }
        
        .action-button {
            display: inline-block;
            background-color: #333333;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
        }
        
        .action-button:hover {
            background-color: #555555;
        }
        
        /* Footer */
        .footer {
            background-color: #fafafa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #eeeeee;
        }
        
        .footer-text {
            font-size: 12px;
            color: #888888;
            margin-bottom: 5px;
        }
        
        /* Mobile responsive */
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 4px;
            }
            
            .header, .content, .footer {
                padding: 20px 15px;
            }
            
            .logo {
                width: 60px;
                height: 60px;
            }
            
            .app-name {
                font-size: 20px;
            }
            
            .title {
                font-size: 18px;
            }
            
            .info-label, .info-value {
                display: block;
                width: 100%;
                padding-right: 0;
            }
            
            .info-label {
                margin-bottom: 3px;
            }
            
            .info-value {
                margin-bottom: 15px;
            }
        }
        
        /* Gmail specific fixes */
        .gmail-fix {
            display: none;
            mso-hide: all;
        }
        
        /* Prevent Gmail from changing styles */
        .ExternalClass {
            width: 100%;
        }
        
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
            line-height: 100%;
        }
    </style>
</head>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            @php
                $logoPath = public_path('image/web_icon.png');
                if (file_exists($logoPath)) {
                    $logoData = base64_encode(file_get_contents($logoPath));
                    $logoSrc = "data:image/png;base64,{$logoData}";
                } else {
                    $logoSrc = null;
                }
            @endphp
            
            @if($logoSrc)
                <img class="logo" src="{{ $logoSrc }}" alt="Zee Web Logo">
            @else
                <div class="logo" style="background-color: #333333; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 24px; border-radius: 8px; width: 80px; height: 80px; margin: 0 auto 15px;">
                    ZW
                </div>
            @endif
            <div class="app-name">{{ config('app.name', 'Zee Web') }}</div>
            <div class="tagline">Data Scraping & Analytics Platform</div>
        </div>
        
        <!-- Content Section -->
        <div class="content">
            <div class="status-badge {{ $status === 'Completed' ? 'status-completed' : 'status-failed' }}">
                {{ $status === 'Completed' ? '✓ Process Completed' : '✗ Process Failed' }}
            </div>
            
            <h1 class="title">Scraping Process Update</h1>
            
            <div class="message">
                Hello! We wanted to inform you that the data scraping process has been <strong>{{ strtolower($status) }}</strong>.
            </div>
            
            <div class="info-card">
                <div class="info-row">
                    <span class="info-label">Initiated by:</span>
                    <span class="info-value">{{ $username }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status:</span>
                    <span class="info-value">{{ $status }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Timestamp:</span>
                    <span class="info-value">{{ now()->format('M d, Y H:i') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Process Type:</span>
                    <span class="info-value">{{ $processType ?? 'Character Data Scraping' }}</span>
                </div>
            </div>
            
            @if($status === 'Completed')
                <div class="button-container">
                    <a href="{{ $actionUrl }}" class="action-button">View Results</a>
                </div>
            @endif
        </div>
        
        <!-- Footer Section -->
        <div class="footer">
            <div class="footer-text">
                This is an automated notification from {{ config('app.name', 'Zee Web') }}
            </div>
            <div class="footer-text">
                Please do not reply to this email.
            </div>
        </div>
    </div>
</body>
</html>