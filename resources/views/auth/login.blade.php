@extends('layouts.app')

@section('title', 'تسجيل الدخول')

@section('content')
<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: 80vh;">
    
    <div class="card" style="width: 100%; max-width: 450px;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <i class="fa-solid fa-user-lock" style="font-size: 3rem; color: var(--gold-primary); margin-bottom: 1rem;"></i>
            <h2>تسجيل الدخول</h2>
            <p style="color: var(--text-muted);">مرحباً بك مجدداً في دليل حضرموت</p>
        </div>

        <form id="loginForm" action="{{ route('login') }}" method="POST">
            @csrf
            @if (session('success'))
                <div class="alert alert-success" style="margin-bottom: 1rem; text-align: right;">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success" style="margin-bottom: 1rem; text-align: right;">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" style="margin-bottom: 1rem; text-align: right;">
                    <ul style="margin: 0; padding-right: 1rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label for="phone" class="form-label">الهاتف</label>
                <input type="tel" name="phone" class="form-control" placeholder="أدخل هاتفك" value="{{ old('phone') }}" required>
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">كلمة المرور</label>
                <input type="password" name="password" class="form-control" placeholder="أدخل كلمة المرور" required>
            </div>
            
            <div class="form-group flex justify-between items-center">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" style="accent-color: var(--gold-primary);">
                    <span style="color: var(--text-muted); font-size: 0.9rem;">تذكرني</span>
                </label>
                <a href="{{ route('password.request') }}" style="font-size: 0.9rem;">نسيت كلمة المرور؟</a>
            </div>

            <button type="submit" class="btn btn-primary w-full mt-4" style="font-size: 1.1rem;">
                دخول <i class="fa-solid fa-arrow-right-to-bracket" style="margin-right: 0.5rem;"></i>
            </button>
        </form>

        <div style="text-align: center; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color);">
            <p style="color: var(--text-muted);">ليس لديك حساب؟ <a href="/register">إنشاء حساب جديد</a></p>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    // Placeholder logic for API integration
    // document.getElementById('loginForm').addEventListener('submit', function(e) {
    //     e.preventDefault();
    //     // Here we will use fetch() to send data to /api/login
    //     // and then save the Sanctum Token to localStorage.
    //     console.log('Login form submitted');
    // });
</script>
@endsection
