@extends('layouts.admin')

@section('header_title', 'الملف الشخصي')

@section('content')
<div class="container-fluid">
    <div class="card" style="max-width: 500px; margin: 2rem auto;">
        <div class="flex flex-col items-center gap-4 py-6">
            <div style="width: 80px; height: 80px; border-radius: 50%; background-color: var(--bg-dark); display: flex; align-items: center; justify-content: center; color: var(--gold-primary); font-size: 2.5rem;">
                <i class="fa-solid fa-user"></i>
            </div>
            <h2 style="margin: 0;">{{ $user->name }}</h2>
            <div style="color: var(--text-muted);">{{ $user->phone }}</div>
            <div style="color: var(--text-muted);">{{ $user->email }}</div>
            <div style="color: var(--text-muted);">الدور: <span class="badge badge-gold">{{ $user->role }}</span></div>
            <div style="color: var(--text-muted);">القرية: {{ $user->village->name ?? '-' }}</div>
            <div style="color: var(--text-muted);">المهنة: {{ $user->profession->name ?? '-' }}</div>
            <div style="color: var(--text-muted);">دعم واتساب: {{ $user->type === 'true' ? 'نعم' : 'لا' }}</div>
        </div>
        <div class="flex justify-center pb-4">
            <a href="/settings" class="btn btn-primary">تعديل الملف الشخصي</a>
        </div>
    </div>
</div>
@endsection
