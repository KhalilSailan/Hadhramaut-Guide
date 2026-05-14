<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - دليل حضرموت</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <a href="/admin/dashboard" class="sidebar-brand">
                <i class="fa-solid fa-shield-halved"></i>
                لوحة الإدارة
            </a>
            
            <ul class="sidebar-menu">
                <li>
                    <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-chart-line"></i> الإحصائيات
                    </a>
                </li>
                <li>
                    <a href="/admin/users" class="{{ request()->is('admin/users') ? 'active' : '' }}">
                        <i class="fa-solid fa-users"></i> إدارة المستخدمين
                    </a>
                </li>
                <li>
                    <a href="/admin/numbers" class="{{ request()->is('admin/numbers') ? 'active' : '' }}">
                        <i class="fa-solid fa-address-book"></i> إدارة الأرقام
                    </a>
                </li>
                <li>
                    <a href="/admin/villages" class="{{ request()->is('admin/villages') ? 'active' : '' }}">
                        <i class="fa-solid fa-map-location-dot"></i> إدارة القرى
                    </a>
                </li>
                <li>
                    <a href="/admin/professions" class="{{ request()->is('admin/professions') ? 'active' : '' }}">
                        <i class="fa-solid fa-briefcase"></i> إدارة المهن
                    </a>
                </li>
                <li style="margin-top: 2rem;">
                    <a href="/directory">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> العودة للموقع
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content">
            <!-- Top Header in Admin -->
            <header class="flex justify-between items-center mb-4 pb-4" style="border-bottom: 1px solid var(--border-color);">
                <h2 style="margin:0;">@yield('header_title', 'لوحة التحكم')</h2>
                <div class="flex items-center gap-2">
                    <span style="color: var(--text-muted);">أهلاً بك، <strong class="text-gold">{{ auth()->user()->name ?? 'المشرف' }}</strong></span>
                    <a href="{{ route('admin.profile') }}" class="btn btn-outline" style="padding: 0.5rem; border-radius: 50%;">
                        <i class="fa-solid fa-user"></i>
                    </a>
                </div>
            </header>

            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
