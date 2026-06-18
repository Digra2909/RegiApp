<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>@yield('titre')</title>

    @livewireStyles

    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-bg: #0f172a;
            --sidebar-hover: rgba(255,255,255,0.06);
            --sidebar-active: rgba(59,130,246,0.18);
            --sidebar-text: #94a3b8;
            --sidebar-text-active: #ffffff;
            --sidebar-accent: #3b82f6;
        }

        body {
            background: #f8fafc;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* ========== DESKTOP SIDEBAR ========== */
        .sidebar-desktop {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            display: none;
            flex-direction: column;
            z-index: 1030;
            overflow-y: auto;
        }
        .sidebar-desktop::-webkit-scrollbar { width: 4px; }
        .sidebar-desktop::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

        @media (min-width: 768px) {
            .sidebar-desktop { display: flex; }
            .main-content { margin-left: var(--sidebar-width); }
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 20px 0;
        }
        .sidebar-logo {
            max-width: 38px;
            height: auto;
            border-radius: 8px;
        }
        .sidebar-brand-text { line-height: 1.3; }
        .sidebar-title {
            color: #fff;
            font-weight: 700;
            margin: 0;
            font-size: 1rem;
        }
        .sidebar-subtitle {
            color: #64748b;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 600;
        }

        .sidebar-divider {
            height: 1px;
            background: rgba(255,255,255,0.06);
            margin: 18px 20px;
        }

        .sidebar-nav { padding: 0 12px; flex: 1; }
        .sidebar-section-label {
            color: #38bdf8;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 0 10px;
            margin-bottom: 12px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 8px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        .sidebar-link i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }
        .sidebar-link:hover {
            color: var(--sidebar-text-active);
            background: var(--sidebar-hover);
        }
        .sidebar-link.active {
            color: var(--sidebar-text-active);
            background: var(--sidebar-active);
            border-left-color: var(--sidebar-accent);
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }
        .sidebar-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            border: none;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .sidebar-btn-primary {
            background: var(--sidebar-accent);
            color: #fff;
            margin-bottom: 8px;
        }
        .sidebar-btn-primary:hover { background: #2563eb; color: #fff; }
        .sidebar-btn-danger {
            background: transparent;
            color: #f87171;
        }
        .sidebar-btn-danger:hover { background: rgba(248,113,113,0.1); color: #fca5a5; }

        .sidebar-copyright { margin-top: 12px; }
        .sidebar-copyright p {
            color: #64748b;
            font-size: 0.68rem;
            margin: 0 0 2px;
        }
        .sidebar-copyright span {
            color: #64748b;
            font-size: 0.6rem;
        }

        /* ========== MOBILE HEADER ========== */
        .mobile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--sidebar-bg);
            color: #fff;
            padding: 10px 16px;
        }
        @media (min-width: 768px) {
            .mobile-header { display: none; }
        }

        .mobile-header-btn {
            background: none;
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            padding: 6px 8px;
            border-radius: 6px;
            font-size: 1.2rem;
            line-height: 1;
            cursor: pointer;
            transition: background 0.2s;
        }
        .mobile-header-btn:hover { background: rgba(255,255,255,0.1); }
        .mobile-header-brand { font-size: 0.9rem; font-weight: 700; }
        .mobile-header-user { font-size: 0.8rem; opacity: 0.8; }

        /* ========== OFFCANVAS ========== */
        .offcanvas {
            background: var(--sidebar-bg) !important;
        }
        .offcanvas-header {
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding: 16px 20px;
        }
        .offcanvas-logo {
            max-width: 34px;
            border-radius: 6px;
        }
        .offcanvas-nav { padding: 16px 12px; flex: 1; }
        .offcanvas-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            min-height: 100vh;
            padding: 24px;
            transition: margin-left 0.3s ease;
        }
        @media (max-width: 767.98px) {
            .main-content { padding: 16px; }
        }

        /* No sidebar mode */
        .no-sidebar .main-content { margin-left: 0 !important; }
        .no-sidebar .mobile-header { display: none !important; }
        .no-sidebar .sidebar-desktop { display: none !important; }
    </style>
</head>
<body class="@if(View::hasSection('hideSidebar')) no-sidebar @endif">

    @if (!View::hasSection('hideSidebar'))
    <!-- Mobile Header -->
    <header class="mobile-header">
        <div class="d-flex align-items-center gap-2">
            <button class="mobile-header-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav" aria-controls="offcanvasNav">
                <i class="bi bi-list"></i>
            </button>
            <span class="mobile-header-brand">RegiApp</span>
        </div>
        <div>
            @auth
                <span class="mobile-header-user">{{ auth()->user()->name }}</span>
            @endauth
        </div>
    </header>

    <!-- Desktop Sidebar + Offcanvas Mobile -->
    @include('layouts.nav_box')
    @endif

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @livewireScripts
</body>
</html>
