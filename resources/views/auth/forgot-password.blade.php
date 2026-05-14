@extends('layouts.app')

@section('title', 'نسيت كلمة المرور')

@section('content')
<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: 80vh; padding: 2rem 0;">
    <div class="card" style="width: 100%; max-width: 450px;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <i class="fa-solid fa-key" style="font-size: 3rem; color: var(--gold-primary); margin-bottom: 1rem;"></i>
            <h2>استعادة كلمة المرور</h2>
            <p style="color: var(--text-muted);">أدخل البريد الإلكتروني المرتبط بحسابك لاستلام كود إعادة التعيين.</p>
        </div>

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

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
                <label for="email" class="form-label">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="أدخل بريدك الإلكتروني" value="{{ old('email') }}" required>
            </div>

            <button type="submit" class="btn btn-primary w-full mt-4" style="font-size: 1.1rem;">
                إرسال كود إعادة التعيين <i class="fa-solid fa-paper-plane" style="margin-right: 0.5rem;"></i>
            </button>
        </form>

        <div style="text-align: center; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color);">
            <p style="color: var(--text-muted);">تذكرت كلمة المرور؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>
        </div>
    </div>
</div>
@endsection
