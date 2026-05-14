@php
    $userName = old('name', $user->name ?? '');
    $userEmail = old('email', $user->email ?? '');
    $userPhone = old('phone', $user->phone ?? '');
    $userType = old('type', $user->type ?? 'false');
    $userRole = old('role', $user->role ?? 'user');
    $userVillage = old('village_id', $user->village_id ?? '');
    $userProfession = old('profession_id', $user->profession_id ?? '');
@endphp

@if ($errors->any())
    <div class="alert alert-danger" style="margin-bottom: 1rem; text-align: right;">
        <ul style="margin: 0; padding-right: 1rem;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <form action="{{ $action }}" method="POST">
        @csrf
        @if(!empty($method) && strtoupper($method) === 'PUT')
            @method('PUT')
        @endif

        <div class="grid grid-cols-2 gap-4">
            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label">الاسم الكامل</label>
                <input type="text" name="name" class="form-control" placeholder="الاسم الكامل" value="{{ $userName }}" required>
            </div>
            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" placeholder="example@example.com" value="{{ $userEmail }}" required>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label">رقم الهاتف</label>
                <input type="text" name="phone" class="form-control" placeholder="077XXXXXXX" value="{{ $userPhone }}" required>
            </div>
            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label">دعم واتساب</label>
                <select name="type" class="form-control" required>
                    <option value="true" {{ $userType === 'true' ? 'selected' : '' }}>نعم</option>
                    <option value="false" {{ $userType === 'false' ? 'selected' : '' }}>لا</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label">الصلاحية</label>
                <select name="role" class="form-control" required>
                    <option value="user" {{ $userRole === 'user' ? 'selected' : '' }}>مستخدم عادي</option>
                    <option value="admin" {{ $userRole === 'admin' ? 'selected' : '' }}>مشرف</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label">القرية / المنطقة</label>
                <select name="village_id" class="form-control" required>
                    <option value="" disabled {{ $userVillage ? '' : 'selected' }}>اختر القرية</option>
                    @foreach($villages as $village)
                        <option value="{{ $village->id }}" {{ $userVillage == $village->id ? 'selected' : '' }}>{{ $village->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label">المهنة</label>
                <select name="profession_id" class="form-control" required>
                    <option value="" disabled {{ $userProfession ? '' : 'selected' }}>اختر المهنة</option>
                    @foreach($professions as $profession)
                        <option value="{{ $profession->id }}" {{ $userProfession == $profession->id ? 'selected' : '' }}>{{ $profession->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label">كلمة المرور</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" {{ empty($method) || strtoupper($method) === 'POST' ? 'required' : '' }}>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" {{ empty($method) || strtoupper($method) === 'POST' ? 'required' : '' }}>
            </div>
            <div></div>
        </div>

        <div class="flex justify-end gap-2 mt-4 pt-4" style="border-top: 1px solid var(--border-color);">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline">إلغاء</a>
            <button type="submit" class="btn btn-primary">{{ $buttonText ?? 'حفظ' }}</button>
        </div>
    </form>
</div>
