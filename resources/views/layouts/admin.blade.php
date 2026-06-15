<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard - VudBox')</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="shortcut icon" href="{{ url('logo.png') }}" type="image/x-icon">
    @vite('resources/js/app.js')
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
    <style>
        .admin-sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            background-color: #1a1e24 !important;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }
        .admin-header {
            background-color: #2b303c !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .admin-main {
            margin-left: 280px;
            min-height: 100vh;
        }
        @media (max-width: 991.98px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            .admin-sidebar.show {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
            }
        }
        .text-white-50 {
            color: rgba(255, 255, 255, 0.7) !important;
        }
        .text-secondary {
            color: rgba(255, 255, 255, 0.6) !important;
        }
        .table-hover tbody tr {
            transition: all 0.2s ease;
        }
    </style>
</head>

<body class="bg-primary text-foreground">
    
    <x-admin.sidebar />

    <main class="admin-main d-flex flex-column">
        @if(session('success'))
        <div class="alert bg-success text-white alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow border-0" style="z-index: 9999; min-width: 300px;" role="alert">
            <i class="bx bx-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert bg-danger text-white alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow border-0" style="z-index: 9999; min-width: 300px;" role="alert">
            <i class="bx bx-error-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if($errors->any())
        <div class="alert bg-danger text-white alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow border-0" style="z-index: 9999; min-width: 300px;" role="alert">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        <x-admin.header />

        <div class="p-4 flex-grow-1 overflow-y-auto">
            @yield('content')
        </div>
    </main>

</body>

</html>
