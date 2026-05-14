@extends('layouts.admin')

@section('header_title', 'إدارة الأرقام')

@section('content')
<div class="container-fluid">
    
    <div class="card mb-4">
        <div class="flex flex-wrap justify-between items-center gap-3">
            <form action="{{ route('admin.numbers') }}" method="GET" style="display: flex; gap: 1rem; width: 100%; max-width: 640px;">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="ابحث عن رقم..." style="background-color: var(--bg-dark);">
                <button type="submit" class="btn btn-primary">بحث</button>
                @if(request()->has('search'))
                    <a href="{{ route('admin.numbers') }}" class="btn btn-outline">مسح البحث</a>
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
                        <th>صاحب الرقم</th>
                        <th>الرقم</th>
                        <th>نوع الرقم</th>
                        <th>تاريخ الإضافة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>#{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td style="direction: ltr; text-align: right; font-weight: 600; color: var(--gold-primary);">{{ $user->phone }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $user->type === 'true' ? 'rgba(34, 197, 94, 0.2)' : 'rgba(59, 130, 246, 0.2)' }}; color: {{ $user->type === 'true' ? '#22c55e' : '#3b82f6' }};">
                                {{ $user->type === 'true' ? 'واتساب' : 'اتصال' }}
                            </span>
                        </td>
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
                        <td colspan="6" style="text-align: center; color: var(--text-muted);">لا توجد أرقام مسجلة حالياً.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem; border-top: 1px solid var(--border-color); padding-top: 1rem;">
            <div style="color: var(--text-muted); font-size: 0.9rem;">
                عرض {{ $users->firstItem() ?? 0 }} إلى {{ $users->lastItem() ?? 0 }} من أصل {{ $users->total() }} رقم
            </div>
            <div>
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
