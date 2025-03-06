<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Wala Nakita Ana Si Josh</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #1e293b;
            color: #e2e8f0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .error-container {
            text-align: center;
            max-width: 600px;
            padding: 2rem;
        }
        
        .error-code {
            font-size: 8rem;
            font-weight: bold;
            color: #3b82f6;
            margin-bottom: 1rem;
            line-height: 1;
        }
        
        .error-message {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #f8fafc;
        }
        
        .error-description {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #94a3b8;
        }
        
        .btn-back {
            background-color: #3b82f6;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.2s;
        }
        
        .btn-back:hover {
            background-color: #2563eb;
            color: white;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <div class="error-message">Wala Nakita Ana Si Josh</div>
        <div class="error-description">
            The page you're looking for doesn't exist or has been moved to another URL.
        </div>
        <a href="{{ url('/') }}" class="btn-back">Back to Home</a>
    </div>
</body>
</html> 