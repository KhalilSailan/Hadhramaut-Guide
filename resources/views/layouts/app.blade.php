<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دليل حضرموت - @yield('title')</title>
    <!-- Custom CSS for Theme -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container flex justify-between items-center">
            <a href="/" class="brand">
                <i class="fa-solid fa-book-atlas"></i>
                دليل حضرموت
            </a>

            <ul class="nav-links">
                <li><a href="/directory" class="{{ request()->is('directory') ? 'active' : '' }} , btn btn-primary" style="padding: 0.5rem 1rem; color: #0a192f;">دليل الأرقام</a></li>
                @guest
                    <li><a href="{{ route('login') }}" class="{{ request()->is('login') ? 'active' : '' }}, btn btn-primary" style="padding: 0.5rem 1rem; color: #0a192f;">تسجيل الدخول</a>
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
                أو اتصل بنا عبر الهاتف: <a href="tel:+967776463185" style="color: var(--gold-primary); text-decoration: underline;">+967 776 463 185</a>
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
