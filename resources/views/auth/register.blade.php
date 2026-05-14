@extends('layouts.app')

@section('title', 'إنشاء حساب جديد')

@section('content')
    <div class="container"
        style="display: flex; justify-content: center; align-items: center; min-height: 80vh; padding: 2rem 0;">

        <div class="card" style="width: 100%; max-width: 550px;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <i class="fa-solid fa-user-plus"
                    style="font-size: 3rem; color: var(--gold-primary); margin-bottom: 1rem;"></i>
                <h2>حساب جديد</h2>
                <p style="color: var(--text-muted);">انضم إلى مجتمع دليل حضرموت</p>
            </div>

            <form id="registerForm" action="{{ route('register') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger" style="margin-bottom: 1rem; text-align: right;">
                        <ul style="margin: 0; padding-right: 1rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label for="name" class="form-label">الاسم الكامل</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="اسمك الثنائي أو الثلاثي" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label for="phone" class="form-label">رقم الهاتف</label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="مثال: 77XXXXXXX" value="{{ old('phone') }}" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="example@example.com" value="{{ old('email') }}" required>
                    </div>
                </div>

                <input type="hidden" name="role" value="user">

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label for="type" class="form-label">دعم واتساب</label>
                        <select id="type" name="type" class="form-control" required>
                            <option value="true" {{ old('type') === 'true' ? 'selected' : '' }}>نعم</option>
                            <option value="false" {{ old('type') === 'false' ? 'selected' : '' }}>لا</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label for="role" class="form-label">الصلاحية</label>
                        <input type="text" class="form-control" value="مستخدم" disabled>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label for="village_id" class="form-label">القرية / المنطقة</label>
                        <select id="village_id" name="village_id" class="form-control" required>
                            <option value="" disabled selected>اختر القرية</option>
                            @foreach($villages as $village)
                                <option value="{{ $village->id }}" {{ old('village_id') == $village->id ? 'selected' : '' }}>{{ $village->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label for="profession_id" class="form-label">المهنة</label>
                        <select id="profession_id" name="profession_id" class="form-control" required>
                            <option value="" disabled selected>اختر المهنة</option>
                            @foreach($professions as $profession)
                                <option value="{{ $profession->id }}" {{ old('profession_id') == $profession->id ? 'selected' : '' }}>{{ $profession->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-primary w-full mt-4" style="font-size: 1.1rem;">
                    إنشاء الحساب <i class="fa-solid fa-user-check" style="margin-right: 0.5rem;"></i>
                </button>
            </form>

            <div
                style="text-align: center; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color);">
                <p style="color: var(--text-muted);">لديك حساب بالفعل؟ <a href="/login">تسجيل الدخول</a></p>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <!-- No custom JS needed for default form submission -->
@endsection
