@extends('layouts.admin')

@section('header_title', 'نظرة عامة')

@section('content')
<div class="container-fluid">
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-4 gap-6 mb-4">
        
        <div class="card" style="border-top: 3px solid var(--gold-primary);">
            <div class="flex justify-between items-center mb-2">
                <h3 style="color: var(--text-muted); font-size: 1rem; margin: 0;">إجمالي المستخدمين</h3>
                <div style="width: 40px; height: 40px; border-radius: 8px; background-color: rgba(212, 175, 55, 0.1); display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-users text-gold"></i>
                </div>
            </div>
            <div style="font-size: 2rem; font-weight: 700; color: var(--text-main);">{{ $userCount }}</div>
        </div>

        <div class="card" style="border-top: 3px solid var(--gold-primary);">
            <div class="flex justify-between items-center mb-2">
                <h3 style="color: var(--text-muted); font-size: 1rem; margin: 0;">الأرقام المضافة</h3>
                <div style="width: 40px; height: 40px; border-radius: 8px; background-color: rgba(212, 175, 55, 0.1); display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-address-book text-gold"></i>
                </div>
            </div>
            <div style="font-size: 2rem; font-weight: 700; color: var(--text-main);">{{ $numbersCount }}</div>
        </div>

        <div class="card" style="border-top: 3px solid var(--gold-primary);">
            <div class="flex justify-between items-center mb-2">
                <h3 style="color: var(--text-muted); font-size: 1rem; margin: 0;">القرى المغطاة</h3>
                <div style="width: 40px; height: 40px; border-radius: 8px; background-color: rgba(212, 175, 55, 0.1); display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-map-location-dot text-gold"></i>
                </div>
            </div>
            <div style="font-size: 2rem; font-weight: 700; color: var(--text-main);">{{ $villageCount }}</div>
        </div>

        <div class="card" style="border-top: 3px solid var(--gold-primary);">
            <div class="flex justify-between items-center mb-2">
                <h3 style="color: var(--text-muted); font-size: 1rem; margin: 0;">المهن المسجلة</h3>
                <div style="width: 40px; height: 40px; border-radius: 8px; background-color: rgba(212, 175, 55, 0.1); display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-briefcase text-gold"></i>
                </div>
            </div>
            <div style="font-size: 2rem; font-weight: 700; color: var(--text-main);">{{ $professionCount }}</div>
        </div>

    </div>

    <!-- Recent Users Table Section -->
    <div class="grid grid-cols-1 mt-4">
        <div class="card">
            <div class="flex flex-wrap justify-between items-center gap-4 mb-4 pb-2" style="border-bottom: 1px solid var(--border-color);">
                <h3 style="margin: 0; color: var(--gold-primary);">أحدث المسجلين في الدليل</h3>
                <a href="/admin/users" class="btn btn-outline" style="padding: 0.4rem 1rem; font-size: 0.9rem;">عرض الكل</a>
            </div>

            <form action="{{ route('admin.dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <input type="hidden" name="filter_type" id="dashboard-filter-type" value="">
                <div>
                    <label class="form-label">بحث</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="بحث بالاسم أو الهاتف" style="background-color: var(--bg-dark);">
                </div>
                <div>
                    <label class="form-label">القرية</label>
                    <select name="village_id" class="form-control" style="background-color: var(--bg-dark);" onchange="document.getElementById('dashboard-filter-type').value='village'; this.form.submit();">
                        <option value="">كل القرى</option>
                        @foreach($villages as $village)
                            <option value="{{ $village->id }}" {{ request('village_id') == $village->id ? 'selected' : '' }}>{{ $village->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">المهنة</label>
                    <select name="profession_id" class="form-control" style="background-color: var(--bg-dark);" onchange="document.getElementById('dashboard-filter-type').value='profession'; this.form.submit();">
                        <option value="">كل المهن</option>
                        @foreach($professions as $profession)
                            <option value="{{ $profession->id }}" {{ request('profession_id') == $profession->id ? 'selected' : '' }}>{{ $profession->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>رقم الهاتف</th>
                            <th>القرية</th>
                            <th>المهنة</th>
                            <th>تاريخ التسجيل</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td style="direction: ltr; text-align: right;">{{ $user->phone }}</td>
                            <td>{{ $user->village->name ?? '-' }}</td>
                            <td>{{ $user->profession->name ?? '-' }}</td>
                            <td>{{ $user->created_at ? $user->created_at->diffForHumans() : '-' }}</td>
                            <td><span class="badge" style="background-color: rgba(34, 197, 94, 0.2); color: #22c55e;">نشط</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-muted);">لا توجد نتائج للمستخدمين.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

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

</div>
@endsection
