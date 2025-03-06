<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student Information System</title>
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Custom CSS -->
        <style>
            body {
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                min-height: 100vh;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            
            .navbar {
                background-color: #ffffff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            
            .hero-section {
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                margin-top: 2rem;
                margin-bottom: 2rem;
            }
            
            .hero-content {
                padding: 3rem;
            }
            
            .hero-image {
                background-color: #3b82f6;
                color: white;
                padding: 3rem;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
            }
            
            .feature-card {
                background-color: #f0f9ff;
                border-radius: 8px;
                padding: 1.5rem;
                height: 100%;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                transition: transform 0.3s ease;
            }
            
            .feature-card:hover {
                transform: translateY(-5px);
            }
            
            .feature-title {
                color: #3b82f6;
                font-weight: 600;
                margin-bottom: 0.75rem;
            }
            
            .btn-primary {
                background-color: #3b82f6;
                border-color: #3b82f6;
                padding: 0.5rem 1.5rem;
            }
            
            .btn-primary:hover {
                background-color: #2563eb;
                border-color: #2563eb;
            }
            
            .btn-outline-primary {
                color: #3b82f6;
                border-color: #3b82f6;
                padding: 0.5rem 1.5rem;
            }
            
            .btn-outline-primary:hover {
                background-color: #3b82f6;
                color: white;
            }
            
            .footer {
                background-color: #ffffff;
                padding: 1rem 0;
                box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.05);
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">Student Information System</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item me-2">
                                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Log in</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container">
            <div class="row hero-section">
                <div class="col-lg-8 hero-content">
                    <h1 class="display-5 fw-bold text-center mb-4">Student Information System</h1>
                    <p class="lead text-center mb-5">Manage your academic journey with ease</p>
                    
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h3 class="feature-title">Course Management</h3>
                                <p class="text-muted">Browse and enroll in available courses for your program.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h3 class="feature-title">Academic Records</h3>
                                <p class="text-muted">Access your grades, transcripts, and academic history.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h3 class="feature-title">Schedule Planner</h3>
                                <p class="text-muted">Plan your semester with our intuitive scheduling tools.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h3 class="feature-title">Student Resources</h3>
                                <p class="text-muted">Access learning materials and academic resources.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <p class="mb-4">Ready to get started? Login or register to access your student portal.</p>
                        <div class="d-flex justify-content-center gap-3">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 hero-image">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-mortarboard-fill mb-3" viewBox="0 0 16 16">
                        <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
                        <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
                    </svg>
                    <h2 class="fw-bold">Student Portal</h2>
                    <p class="text-light">Your gateway to academic excellence</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer mt-auto">
            <div class="container">
                <p class="text-center text-muted mb-0">&copy; {{ date('Y') }} Student Information System. All rights reserved.</p>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
