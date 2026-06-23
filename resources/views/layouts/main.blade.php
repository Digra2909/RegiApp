<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>@yield('titre')</title>

    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>

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

        /* Desktop Sidebar */
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

        .sidebar-btn-darkmode {
            background: transparent;
            color: #94a3b8;
            border: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 8px;
        }
        .sidebar-btn-darkmode:hover {
            background: rgba(255,255,255,0.06);
            color: #e2e8f0;
        }

        /* Mobile Header */
        .mobile-header {
            position: sticky;
            top: 0;
            z-index: 1020;
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

        /* Offcanvas */
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

        /* Main Content */
        .main-content {
            min-height: 100vh;
            padding: 24px;
            transition: margin-left 0.3s ease;
        }
        @media (max-width: 767.98px) {
            .main-content { padding: 16px; }
        }

        /* Dark Mode */
        [data-theme="dark"] {
            --body-bg: #0f172a;
            --card-bg: #1e293b;
            --card-border: #334155;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --input-bg: #0f172a;
            --input-border: #475569;
            --table-bg: #0f172a;
            --table-hover: rgba(255,255,255,0.04);
        }
        [data-theme="dark"] body {
            background: var(--body-bg);
            color: var(--text-primary);
        }
        /* background helpers */
        [data-theme="dark"] .bg-white,
        [data-theme="dark"] .dashboard-wrapper {
            background: var(--card-bg) !important;
        }
        [data-theme="dark"] .main-content {
            background: var(--body-bg);
        }
        [data-theme="dark"] .container-fluid {
            background: transparent;
        }
        /* cards */
        [data-theme="dark"] .card,
        [data-theme="dark"] .custom-card {
            background: var(--card-bg) !important;
            border-color: var(--card-border) !important;
            --bs-card-color: var(--text-primary);
            color: var(--text-primary);
        }
        [data-theme="dark"] .card-header,
        [data-theme="dark"] .card-footer {
            background: var(--card-bg) !important;
            border-color: var(--card-border) !important;
        }
        [data-theme="dark"] .card-body {
            background: var(--card-bg) !important;
        }
        [data-theme="dark"] .kpi-card,
        [data-theme="dark"] .chart-block {
            background: var(--card-bg) !important;
            border-color: var(--card-border) !important;
        }
        /* modals */
        [data-theme="dark"] .modal-content {
            background: var(--card-bg);
            border-color: var(--card-border);
        }
        [data-theme="dark"] .modal-header,
        [data-theme="dark"] .modal-footer {
            background: var(--card-bg) !important;
            border-color: var(--card-border) !important;
        }
        [data-theme="dark"] .modal-body {
            background: var(--card-bg) !important;
        }
        [data-theme="dark"] .modal-title {
            color: var(--text-primary);
        }
        [data-theme="dark"] .btn-close {
            filter: invert(1);
        }
        /* forms */
        [data-theme="dark"] .form-control,
        [data-theme="dark"] .form-select,
        [data-theme="dark"] .form-control-custom,
        [data-theme="dark"] .form-select-custom,
        [data-theme="dark"] .form-control-modal,
        [data-theme="dark"] .form-select-modal {
            background: var(--input-bg) !important;
            border-color: var(--input-border) !important;
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .form-control:focus,
        [data-theme="dark"] .form-select:focus {
            background: var(--input-bg);
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
            color: var(--text-primary);
        }
        [data-theme="dark"] .form-control::placeholder {
            color: var(--text-muted);
        }
        [data-theme="dark"] .form-label,
        [data-theme="dark"] .form-label-custom {
            color: var(--text-secondary);
        }
        [data-theme="dark"] .input-group-text,
        [data-theme="dark"] .input-group-text-custom {
            background: var(--input-bg);
            border-color: var(--input-border);
            color: var(--text-secondary);
        }
        [data-theme="dark"] .form-check-input {
            background: var(--input-bg);
            border-color: var(--input-border);
        }
        /* tables */
        [data-theme="dark"] .table {
            color: var(--text-primary);
            --bs-table-color: var(--text-primary);
            --bs-table-bg: var(--table-bg);
            --bs-table-hover-bg: var(--table-hover);
            background: var(--table-bg);
        }
        [data-theme="dark"] .table td,
        [data-theme="dark"] .table th {
            color: var(--text-primary);
        }
        [data-theme="dark"] .table > :not(caption) > * > * {
            border-color: var(--card-border);
        }
        [data-theme="dark"] .table thead th,
        [data-theme="dark"] .table-light th,
        [data-theme="dark"] .table thead tr {
            color: var(--text-secondary);
            background: transparent !important;
        }
        [data-theme="dark"] .table-hover tbody tr:hover {
            color: var(--text-primary);
        }
        /* text */
        [data-theme="dark"] .text-muted {
            color: var(--text-muted) !important;
        }
        [data-theme="dark"] .text-dark {
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .text-secondary {
            color: var(--text-secondary) !important;
        }
        [data-theme="dark"] .text-slate-700 {
            color: var(--text-primary) !important;
        }
        /* badges */
        [data-theme="dark"] .badge.bg-light {
            background: #334155 !important;
            color: var(--text-primary) !important;
            border-color: #475569 !important;
        }
        [data-theme="dark"] .badge.bg-opacity-10,
        [data-theme="dark"] .badge.bg-opacity-25 {
            background: #334155 !important;
        }
        /* buttons */
        [data-theme="dark"] .btn-outline-primary {
            color: #60a5fa;
            border-color: #60a5fa;
        }
        [data-theme="dark"] .btn-outline-danger {
            color: #f87171;
            border-color: #f87171;
        }
        [data-theme="dark"] .btn-outline-secondary {
            color: var(--text-secondary);
            border-color: var(--card-border);
        }
        [data-theme="dark"] .btn-submit-custom {
            --bs-btn-bg: #3b82f6;
            --bs-btn-border-color: #3b82f6;
        }
        [data-theme="dark"] .btn-info {
            --bs-btn-bg: #0891b2;
            --bs-btn-border-color: #0891b2;
        }
        /* nav tabs */
        [data-theme="dark"] .nav-tabs .nav-link {
            color: var(--text-secondary);
        }
        [data-theme="dark"] .nav-tabs .nav-link.active {
            color: var(--text-primary);
            background: transparent;
        }
        /* alerts */
        [data-theme="dark"] .alert {
            background: var(--card-bg) !important;
            border-color: var(--card-border);
            color: var(--text-primary);
        }
        [data-theme="dark"] .card.bg-dark {
            background: #0f172a !important;
        }
        [data-theme="dark"] pre,
        [data-theme="dark"] .text-monospace {
            color: var(--text-primary) !important;
        }
        /* Activity log border bottom in dark mode */
        [data-theme="dark"] .border-light {
            border-color: var(--card-border) !important;
        }
        [data-theme="dark"] .dashboard-wrapper h3 {
            color: var(--text-primary) !important;
        }
        /* global: kpi-value + chart titles + kpi labels */
        [data-theme="dark"] .kpi-value {
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] .chart-block h6 {
            color: var(--text-primary);
        }
        [data-theme="dark"] .global-dashboard .kpi-card .text-muted {
            color: var(--text-primary) !important;
        }
        /* Equipement/index: Régie de distribution + KPI labels en blanc */
        [data-theme="dark"] .zone-header .text-muted,
        [data-theme="dark"] .section-kpi-row .text-muted {
            color: var(--text-primary) !important;
        }
        /* inline style overrides (livewire & legacy views) */
        [data-theme="dark"] div[style*="background-color: #ffffff"],
        [data-theme="dark"] div[style*="background-color:#ffffff"] {
            background-color: var(--card-bg) !important;
        }
        [data-theme="dark"] tbody[style*="color: #334155"],
        [data-theme="dark"] tbody[style*="color:#334155"] {
            color: var(--text-primary) !important;
        }
        [data-theme="dark"] tr[style*="border-color: #f1f5f9"],
        [data-theme="dark"] tr[style*="border-color:#f1f5f9"] {
            border-color: var(--card-border) !important;
        }
        [data-theme="dark"] [style*="border: 1px solid #e2e8f0"],
        [data-theme="dark"] [style*="border:1px solid #e2e8f0"] {
            border-color: var(--card-border) !important;
        }
        [data-theme="dark"] .alert-success[style*="background-color: #f0fdf4"],
        [data-theme="dark"] .alert-success[style*="background-color:#f0fdf4"] {
            background-color: #064e3b !important;
            color: #6ee7b7 !important;
        }
        /* bg-dark badges & icon containers */
        [data-theme="dark"] .badge.bg-dark,
        [data-theme="dark"] .bg-dark.bg-opacity-10,
        [data-theme="dark"] .bg-dark.bg-opacity-25 {
            background: #334155 !important;
        }
        [data-theme="dark"] .bg-dark.bg-opacity-10.text-dark,
        [data-theme="dark"] .bg-dark.bg-opacity-25.text-dark {
            color: var(--text-primary) !important;
        }
        /* custom utility overrides */
        [data-theme="dark"] .bg-slate-100 {
            background-color: #1e293b !important;
        }
        [data-theme="dark"] .text-slate-700 {
            color: #cbd5e1 !important;
        }
        [data-theme="dark"] .text-indigo {
            color: #818cf8 !important;
        }
        [data-theme="dark"] .bg-indigo {
            background-color: #312e81 !important;
        }
        /* misc */
        [data-theme="dark"] hr,
        [data-theme="dark"] .dropdown-divider {
            border-color: var(--card-border);
        }
        [data-theme="dark"] .border-secondary {
            border-color: var(--card-border) !important;
        }
        .theme-transition, .theme-transition * {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.15s ease !important;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.body.classList.add('theme-transition');
            const saved = localStorage.getItem('theme');
            if (saved === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
                updateDarkModeUI(true);
            }
        });
        function toggleDarkMode() {
            const html = document.documentElement;
            const isDark = html.getAttribute('data-theme') === 'dark';
            document.body.classList.add('theme-transition');
            setTimeout(() => document.body.classList.remove('theme-transition'), 400);
            if (isDark) {
                html.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
                updateDarkModeUI(false);
            } else {
                html.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                updateDarkModeUI(true);
            }
        }
        function updateDarkModeUI(isDark) {
            const btns = document.querySelectorAll('#darkModeToggle, #darkModeToggleMobile');
            btns.forEach(btn => {
                const icon = btn.querySelector('i');
                const span = btn.querySelector('span');
                if (isDark) {
                    icon.className = 'bi bi-sun';
                    span.textContent = 'Mode clair';
                } else {
                    icon.className = 'bi bi-moon-stars';
                    span.textContent = 'Mode sombre';
                }
            });
        }
    </script>
</head>
<body>

    @if(! $__env->hasSection('noSidebar'))
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
