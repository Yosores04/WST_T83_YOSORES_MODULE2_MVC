<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Custom Styles -->
        <style>
            /* Custom button styles */
            .btn-primary-custom {
                background-color: #4338ca;
                border-color: #4338ca;
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 0.375rem;
                font-weight: 600;
                transition: all 0.2s;
            }
            
            .btn-primary-custom:hover {
                background-color: #3730a3;
                border-color: #3730a3;
                color: white;
            }
            
            .btn-secondary-custom {
                background-color: #6b7280;
                border-color: #6b7280;
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 0.375rem;
                font-weight: 600;
                transition: all 0.2s;
            }
            
            .btn-secondary-custom:hover {
                background-color: #4b5563;
                border-color: #4b5563;
                color: white;
            }
            
            .btn-success-custom {
                background-color: #10b981;
                border-color: #10b981;
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 0.375rem;
                font-weight: 600;
                transition: all 0.2s;
            }
            
            .btn-success-custom:hover {
                background-color: #059669;
                border-color: #059669;
                color: white;
            }
            
            .btn-danger-custom {
                background-color: #ef4444;
                border-color: #ef4444;
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 0.375rem;
                font-weight: 600;
                transition: all 0.2s;
            }
            
            .btn-danger-custom:hover {
                background-color: #dc2626;
                border-color: #dc2626;
                color: white;
            }
            
            /* Table styles */
            .table-custom {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
                border-radius: 0.5rem;
                overflow: hidden;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }
            
            .table-custom thead {
                background-color: #f3f4f6;
            }
            
            .table-custom th {
                padding: 0.75rem 1rem;
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.75rem;
                letter-spacing: 0.05em;
                color: #4b5563;
                text-align: left;
            }
            
            .table-custom td {
                padding: 0.75rem 1rem;
                border-top: 1px solid #e5e7eb;
            }
            
            .table-custom tbody tr:hover {
                background-color: #f9fafb;
            }
            
            /* Card styles */
            .card-custom {
                border-radius: 0.5rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                background-color: white;
                overflow: hidden;
            }
            
            .card-header-custom {
                background-color: #f9fafb;
                padding: 1rem 1.5rem;
                border-bottom: 1px solid #e5e7eb;
                font-weight: 600;
            }
            
            .card-body-custom {
                padding: 1.5rem;
            }
            
            /* Navigation styles */
            .nav-link-custom {
                color: #4b5563;
                font-weight: 500;
                padding: 0.5rem 1rem;
                border-radius: 0.375rem;
                transition: all 0.2s;
            }
            
            .nav-link-custom:hover {
                background-color: #f3f4f6;
                color: #1f2937;
            }
            
            .nav-link-custom.active {
                background-color: #4338ca;
                color: white;
            }
            
            /* Alert styles */
            .alert-success-custom {
                background-color: #d1fae5;
                border-left: 4px solid #10b981;
                color: #065f46;
                padding: 1rem;
                margin-bottom: 1rem;
                border-radius: 0.375rem;
            }
            
            .alert-warning-custom {
                background-color: #fef3c7;
                border-left: 4px solid #f59e0b;
                color: #92400e;
                padding: 1rem;
                margin-bottom: 1rem;
                border-radius: 0.375rem;
            }
            
            .alert-danger-custom {
                background-color: #fee2e2;
                border-left: 4px solid #ef4444;
                color: #b91c1c;
                padding: 1rem;
                margin-bottom: 1rem;
                border-radius: 0.375rem;
            }
            
            /* Badge styles */
            .badge-success-custom {
                background-color: #d1fae5;
                color: #065f46;
                padding: 0.25rem 0.5rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 600;
            }
            
            .badge-warning-custom {
                background-color: #fef3c7;
                color: #92400e;
                padding: 0.25rem 0.5rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 600;
            }
            
            /* Form styles */
            .form-control-custom {
                border-radius: 0.375rem;
                border: 1px solid #d1d5db;
                padding: 0.5rem 0.75rem;
                width: 100%;
                transition: all 0.2s;
            }
            
            .form-control-custom:focus {
                outline: none;
                border-color: #4338ca;
                box-shadow: 0 0 0 3px rgba(67, 56, 202, 0.1);
            }
            
            .form-label-custom {
                display: block;
                font-weight: 500;
                margin-bottom: 0.5rem;
                color: #374151;
            }
            
            /* Action links */
            .action-link {
                display: inline-block;
                margin-right: 0.75rem;
                font-weight: 500;
                transition: all 0.2s;
            }
            
            .action-link-view {
                color: #4338ca;
            }
            
            .action-link-view:hover {
                color: #3730a3;
                text-decoration: underline;
            }
            
            .action-link-edit {
                color: #10b981;
            }
            
            .action-link-edit:hover {
                color: #059669;
                text-decoration: underline;
            }
            
            .action-link-delete {
                color: #ef4444;
            }
            
            .action-link-delete:hover {
                color: #dc2626;
                text-decoration: underline;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
