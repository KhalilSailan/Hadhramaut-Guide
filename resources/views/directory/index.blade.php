@extends('layouts.app')

@section('title', 'دليل الأرقام')

@section('content')
<div class="container" style="padding-top: 2rem;">
    
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="color: var(--gold-primary); font-size: 2.5rem; margin-bottom: 0.5rem;">دليل هواتف حضرموت</h1>
        <p style="color: var(--text-muted); font-size: 1.1rem;">ابحث عن الأرقام، المهن، والخدمات في مختلف مدن وقرى حضرموت</p>
        @if(auth()->check() && auth()->user()->role === 'admin')
            <div style="margin-top: 1rem;">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary" style="background-color: var(--gold-primary); color: #0a192f;"><i class="fa-solid fa-shield-halved"></i> العودة للوحة الإدارة</a>
            </div>
        @endif
    </div>

    <!-- Search & Filter Section -->
    <div class="search-container">
        <form action="{{ route('directory.index') }}" method="GET" style="display: flex; gap: 1rem; width: 100%; flex-wrap: wrap;">
            <div class="search-input" style="flex: 1; min-width: 250px;">
                <input type="text" name="search" class="form-control" placeholder="ابحث بالاسم أو الرقم..." value="{{ request('search') }}" style="padding-right: 2.5rem; background-image: url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"%238892b0\" viewBox=\"0 0 16 16\">
            </div>
            
            <select class="form-control" name="village_id" style="width: 200px; appearance: none;" onchange="this.form.submit();">
                <option value="">كل القرى</option>
                @foreach($villages as $village)
                    <option value="{{ $village->id }}" {{ request('village_id') == $village->id ? 'selected' : '' }}>{{ $village->name }}</option>
                @endforeach
            </select>
            <select class="form-control" name="profession_id" style="width: 200px; appearance: none;" onchange="this.form.submit();">
                <option value="">كل المهن</option>
                @foreach($professions as $profession)
                    <option value="{{ $profession->id }}" {{ request('profession_id') == $profession->id ? 'selected' : '' }}>{{ $profession->name }}</option>
                @endforeach
            </select>
            
            <button type="submit" class="btn btn-primary" style="flex-shrink: 0; padding: 0 2rem;">بحث</button>
            @if(request()->hasAny(['search', 'village_id', 'profession_id']))
                <a href="{{ route('directory.index') }}" class="btn btn-outline" style="flex-shrink: 0; padding: 0 2rem;">إلغاء البحث</a>
            @endif
        </form>
    </div>

    <!-- Results Grid -->
    <div class="grid grid-cols-3 gap-6" id="directoryGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
        
        @forelse($users as $user)
        <div class="card" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background-color: var(--bg-dark); border: 2px solid var(--gold-primary); display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="fa-solid fa-user" style="font-size: 2rem; color: var(--gold-primary);"></i>
            </div>
            <h3 style="margin-bottom: 0.25rem;">{{ $user->name }}</h3>
            <span class="badge badge-gold mb-4">{{ $user->profession->name ?? 'بدون مهنة' }}</span>
            
            <div style="width: 100%; display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1.5rem; text-align: right;">
                <div style="color: var(--text-muted); font-size: 0.9rem;">
                    <i class="fa-solid fa-location-dot text-gold" style="width: 20px;"></i> {{ $user->village->name ?? 'غير محدد' }}
                </div>
                <div style="color: var(--text-main); font-weight: 600;">
                    <i class="fa-solid fa-phone text-gold" style="width: 20px;"></i> {{ $user->phone }}
                </div>
            </div>
            
            <a href="{{ route('directory.show', $user->id) }}" class="btn btn-outline w-full" style="margin-top: auto;">عرض التفاصيل</a>
        </div>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: var(--text-muted);">
            لا توجد أرقام مسجلة حالياً أو لم يتم العثور على نتائج للبحث.
        </div>
        @endforelse

    </div>

    <!-- Pagination -->
    <div style="display: flex; justify-content: center; margin-top: 3rem;">
        @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $users->appends(request()->query())->links() }}
        @endif
    </div>

</div>
@endsection
