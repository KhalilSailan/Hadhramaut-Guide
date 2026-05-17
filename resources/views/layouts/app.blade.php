<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دليل حضرموت - @yield('title')</title>
    <!-- Custom CSS for Theme -->
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> --}}
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap');

        :root {
            /* Premium Dark Blue & Gold Palette */
            --bg-dark: #0a192f;
            --bg-card: #112240;
            --bg-card-hover: #233554;

            --gold-primary: #d4af37;
            --gold-hover: #f1c40f;

            --text-main: #ccd6f6;
            --text-muted: #8892b0;

            --border-color: rgba(212, 175, 55, 0.2);
            --border-hover: rgba(212, 175, 55, 0.5);

            --radius-sm: 6px;
            --radius-md: 12px;
            --radius-lg: 20px;

            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.5), 0 2px 4px -1px rgba(0, 0, 0, 0.3);
            --shadow-glow: 0 0 15px rgba(212, 175, 55, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cairo', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            line-height: 1.6;
            direction: rtl;
        }

        a {
            color: var(--gold-primary);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        a:hover {
            color: var(--gold-hover);
        }

        /* Typography */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--text-main);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .text-gold {
            color: var(--gold-primary);
        }

        /* Layout Utilities */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .flex {
            display: flex;
        }

        .flex-col {
            flex-direction: column;
        }

        .items-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .justify-center {
            justify-content: center;
        }

        .gap-1 {
            gap: 0.5rem;
        }

        .gap-2 {
            gap: 1rem;
        }

        .gap-3 {
            gap: 1.5rem;
        }

        .gap-4 {
            gap: 2rem;
        }

        .w-full {
            width: 100%;
        }

        .mt-4 {
            margin-top: 2rem;
        }

        .mb-4 {
            margin-bottom: 2rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid transparent;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: var(--gold-primary);
            color: var(--bg-dark);
        }

        .btn-primary:hover {
            background-color: var(--gold-hover);
            transform: translateY(-2px);
            box-shadow: var(--shadow-glow);
        }

        .btn-outline {
            background-color: transparent;
            border-color: var(--gold-primary);
            color: var(--gold-primary);
        }

        .btn-outline:hover {
            background-color: rgba(212, 175, 55, 0.1);
        }

        .btn-danger {
            background-color: transparent;
            border-color: #ef4444;
            color: #ef4444;
        }

        .btn-danger:hover {
            background-color: rgba(239, 68, 68, 0.1);
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-main);
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            color: var(--text-main);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--gold-primary);
            box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        /* Cards (Glassmorphism inspired) */
        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .card:hover {
            border-color: var(--border-hover);
            transform: translateY(-4px);
            box-shadow: var(--shadow);
        }

        /* Navbar */
        .navbar {
            background-color: rgba(10, 25, 47, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar .brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gold-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            color: var(--text-main);
            font-weight: 600;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--gold-primary);
        }

        /* Sidebar for Admin */
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background-color: var(--bg-card);
            border-left: 1px solid var(--border-color);
            padding: 2rem 1rem;
            flex-shrink: 0;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gold-primary);
            margin-bottom: 2rem;
            display: block;
            text-align: center;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--text-main);
            border-radius: var(--radius-sm);
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: rgba(212, 175, 55, 0.1);
            color: var(--gold-primary);
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        /* Grid Layouts */
        .grid {
            display: grid;
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }

        .grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .grid-cols-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .grid-cols-4 {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .gap-4 {
            gap: 1rem;
        }

        .gap-6 {
            gap: 1.5rem;
        }

        /* Tables */
        .table-container {
            overflow-x: auto;
            background-color: var(--bg-card);
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: right;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .table th {
            background-color: rgba(0, 0, 0, 0.2);
            color: var(--gold-primary);
            font-weight: 600;
        }

        .table tr:hover {
            background-color: rgba(255, 255, 255, 0.02);
        }

        /* Search Bar */
        .search-container {
            display: flex;
            gap: 1rem;
            background-color: var(--bg-card);
            padding: 1.5rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .search-input {
            flex: 1;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .badge-gold {
            background-color: rgba(212, 175, 55, 0.15);
            color: var(--gold-primary);
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {

            .grid-cols-2,
            .grid-cols-3,
            .grid-cols-4 {
                grid-template-columns: 1fr;
            }

            .admin-layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                border-left: none;
                border-bottom: 1px solid var(--border-color);
            }

            .search-container {
                flex-direction: column;
            }

            .nav-links {
                display: none;
                /* Can be toggled with JS */
            }
        }
    </style>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container flex justify-between items-center">
            <a href="/" class="brand">
                <i class="fa-solid fa-book-atlas"></i>
                دليل حضرموت
            </a>

            <ul class="nav-links">
                <li><a href="/directory" class="{{ request()->is('directory') ? 'active' : '' }} , btn btn-primary"
                        style="padding: 0.5rem 1rem; color: #0a192f;">دليل الأرقام</a></li>
                @guest
                    <li><a href="{{ route('login') }}" class="{{ request()->is('login') ? 'active' : '' }}, btn btn-primary"
                            style="padding: 0.5rem 1rem; color: #0a192f;">تسجيل الدخول</a>
                    </li>
                    <li><a href="{{ route('register') }}" class="btn btn-primary"
                            style="padding: 0.5rem 1rem; color: #0a192f;">حساب جديد</a></li>
                @else
                    {{-- @if (auth()->user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}" class="btn btn-outline" style="padding: 0.5rem 1rem; color: var(--gold-primary);"><i class="fa-solid fa-shield-halved"></i> لوحة الإدارة</a></li>
                    @endif --}}
                    <li><a href="{{ route('settings.profile') }}"
                            class="{{ request()->is('settings') ? 'active' : '' }}">الإعدادات</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline"
                                style="padding: 0.5rem 1rem; color: #ef4444; background:none; border:none; cursor:pointer;">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> تسجيل الخروج
                            </button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="min-height: calc(100vh - 140px);">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer
        style="background-color: var(--bg-card); padding: 2rem 0; text-align: center; border-top: 1px solid var(--border-color); margin-top: 2rem;">
        <div class="container">
            <p style="color: var(--text-muted);">&copy; {{ date('Y') }} دليل حضرموت. جميع الحقوق محفوظة.</p>
            <a href="https://whatsapp.com/sendphone=967776463185?text={{ urlencode('what you need help with?') }}"
                target="_blank" class="btn btn-outline"
                style="padding: 0.5rem 1rem; color: var(--gold-primary); background:none; border: 1px solid var(--gold-primary); cursor:pointer;">
                <i class="fa-brands fa-whatsapp" style="margin-left: 0.5rem;"></i> تواصل معنا
            </a>
            <p style="color: var(--text-muted); margin-top: 1rem;">
                أو اتصل بنا عبر الهاتف: <a href="tel:+967776463185"
                    style="color: var(--gold-primary); text-decoration: underline;">+967 776 463 185</a>
            </p>
        </div>
    </footer>

    <!-- Scripts (Placeholder for API interaction) -->
    <script>
        // Common JavaScript functions for the app
    </script>
    @yield('scripts')
</body>

</html>
