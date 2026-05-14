@extends('layouts.admin')

@section('header_title', 'إدارة المستخدمين')

@section('content')
<div class="container-fluid">
    
    <div class="card mb-4">
        <div class="flex flex-wrap justify-between items-center gap-3">
            <form action="{{ route('admin.users.index') }}" method="GET" style="display: flex; gap: 1rem; width: 100%; max-width: 640px;">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="ابحث عن مستخدم بالاسم أو البريد الإلكتروني أو الرقم..." style="background-color: var(--bg-dark);">
                <button type="submit" class="btn btn-primary">بحث</button>
                @if(request()->has('search'))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline">مسح البحث</a>
                @endif
            </form>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> إضافة مستخدم جديد
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="card mb-4">
            <div class="alert alert-success" style="margin: 0; padding: 1rem; background-color: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.25); color: #166534;">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="card">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>الرقم التعريفي</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>رقم الهاتف</th>
                        <th>الصلاحية</th>
                        <th>القرية</th>
                        <th>تاريخ التسجيل</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>#{{ $user->id }}</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <div style="width: 32px; height: 32px; border-radius: 50%; background-color: var(--bg-dark); display: flex; align-items: center; justify-content: center; color: var(--gold-primary);">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                {{ $user->name }}
                            </div>
                        </td>
                        <td style="direction: ltr; text-align: right;">{{ $user->email }}</td>
                        <td style="direction: ltr; text-align: right;">{{ $user->phone }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $user->role === 'admin' ? 'rgba(212, 175, 55, 0.2)' : 'rgba(255,255,255,0.1)' }}; color: {{ $user->role === 'admin' ? 'var(--gold-primary)' : 'var(--text-main)' }};">
                                {{ $user->role === 'admin' ? 'مشرف' : 'مستخدم عادي' }}
                            </span>
                        </td>
                        <td>{{ $user->village->name ?? '-' }}</td>
                        <td>{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</td>
                        <td>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline" style="padding: 0.25rem 0.5rem; font-size: 0.85rem;" title="تعديل"><i class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.85rem;" title="حذف"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; color: var(--text-muted);">لا توجد مستخدمين حالياً.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem; border-top: 1px solid var(--border-color); padding-top: 1rem;">
            <div style="color: var(--text-muted); font-size: 0.9rem;">
                عرض {{ $users->firstItem() ?? 0 }} إلى {{ $users->lastItem() ?? 0 }} من أصل {{ $users->total() }} مستخدم
            </div>
            <div>
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

</div>

<!-- Delete Confirmation Modal (Hidden by default) -->
<div style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; align-items: center; justify-content: center;">
    <div class="card" style="width: 400px; text-align: center;">
        <i class="fa-solid fa-triangle-exclamation" style="font-size: 3rem; color: #ef4444; margin-bottom: 1rem;"></i>
        <h3 style="margin-bottom: 1rem;">تأكيد الحذف</h3>
        <p style="color: var(--text-muted); margin-bottom: 2rem;">هل أنت متأكد من أنك تريد حذف هذا المستخدم بشكل نهائي؟ (يحتاج صلاحية المشرف `isAdmin` في الباك إند)</p>
        <div class="flex gap-4 justify-center">
            <button class="btn btn-outline w-full" onclick="this.closest('[style*=\'position: fixed\']').style.display='none'">إلغاء</button>
            <button class="btn btn-danger w-full">نعم، احذف</button>
        </div>
    </div>
</div>
@endsection
