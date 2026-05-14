@extends('layouts.app')

@section('title', 'إعدادات الحساب')

@section('content')
<div class="container" style="padding-top: 2rem;">
    
    <div style="margin-bottom: 2rem;">
        <h2 style="color: var(--gold-primary); font-size: 2rem;">إعدادات الحساب</h2>
        <p style="color: var(--text-muted);">إدارة معلوماتك الشخصية وإعدادات الحساب</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom: 1.5rem; text-align: right;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 1.5rem; text-align: right;">
            <ul style="margin: 0; padding-right: 1rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-4 gap-6">
        
        <!-- Sidebar Menu -->
        <div style="grid-column: span 1;">
            <div class="card" style="padding: 1rem 0;">
                <ul style="list-style: none;">
                    <li>
                        <a href="#profile" class="active" style="display: block; padding: 1rem 1.5rem; border-right: 3px solid var(--gold-primary); color: var(--gold-primary); background-color: rgba(212, 175, 55, 0.1);">
                            <i class="fa-solid fa-user" style="width: 25px;"></i> الملف الشخصي
                        </a>
                    </li>
                    <li>
                        <a href="#security" style="display: block; padding: 1rem 1.5rem; color: var(--text-main); border-right: 3px solid transparent;">
                            <i class="fa-solid fa-shield-halved" style="width: 25px;"></i> الأمان وكلمة المرور
                        </a>
                    </li>
                    <li>
                        <a href="#settings" style="display: block; padding: 1rem 1.5rem; color: var(--text-main); border-right: 3px solid transparent;">
                            <i class="fa-solid fa-gear" style="width: 25px;"></i> الإعدادات العامة
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Main Form Content -->
        <div style="grid-column: span 3;">
            <div class="card">
                <h3 style="margin-bottom: 2rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">المعلومات الشخصية</h3>
                
                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf

                    <div style="display: flex; align-items: center; gap: 2rem; margin-bottom: 2rem;">
                        <div style="width: 100px; height: 100px; border-radius: 50%; background-color: var(--bg-dark); border: 2px dashed var(--gold-primary); display: flex; align-items: center; justify-content: center; cursor: pointer; position: relative;">
                            <i class="fa-solid fa-camera" style="font-size: 2rem; color: var(--text-muted);"></i>
                        </div>
                        <div>
                            <h4 style="margin-bottom: 0.5rem;">{{ $user->name }}</h4>
                            <p style="color: var(--text-muted); font-size: 0.9rem;">تعديل معلومات الحساب الشخصية الخاصة بك.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-group">
                            <label class="form-label">الاسم الكامل</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">رقم الهاتف</label>
                            <input type="text" class="form-control" value="{{ $user->phone }}" disabled style="opacity: 0.7; cursor: not-allowed;">
                        </div>
                        <div class="form-group">
                            <label class="form-label">دعم واتساب</label>
                            <select name="type" class="form-control" required>
                                <option value="true" {{ old('type', $user->type) === 'true' ? 'selected' : '' }}>نعم</option>
                                <option value="false" {{ old('type', $user->type) === 'false' ? 'selected' : '' }}>لا</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">الصلاحية</label>
                            <input type="text" class="form-control" value="{{ $user->role }}" disabled style="opacity: 0.7; cursor: not-allowed;">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-group" style="margin-bottom: 1rem;">
                            <label class="form-label">القرية / المنطقة</label>
                            <select name="village_id" class="form-control" required>
                                @foreach($villages as $village)
                                    <option value="{{ $village->id }}" {{ old('village_id', $user->village_id) == $village->id ? 'selected' : '' }}>{{ $village->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="margin-bottom: 1rem;">
                            <label class="form-label">المهنة</label>
                            <select name="profession_id" class="form-control" required>
                                @foreach($professions as $profession)
                                    <option value="{{ $profession->id }}" {{ old('profession_id', $user->profession_id) == $profession->id ? 'selected' : '' }}>{{ $profession->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 2rem;">
                        <label class="form-label">كلمة المرور الجديدة</label>
                        <input type="password" name="password" class="form-control" placeholder="اتركها فارغة إذا لم ترغب بالتغيير">
                    </div>
                    
                    <div style="display: flex; justify-content: flex-end; gap: 1rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary" style="background-color: var(--gold-primary); color: #0a192f;"><i class="fa-solid fa-shield-halved"></i> لوحة الإدارة</a>
                        @endif
                        <a href="{{ route('directory.index') }}" class="btn btn-outline">إلغاء</a>
                        <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>
@endsection

@section('scripts')
<script>
    // No extra JS needed for settings form.
</script>
@endsection
