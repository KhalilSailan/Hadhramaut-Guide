@extends('layouts.app')

@section('title', 'تفاصيل الرقم')

@section('content')
    <div class="container" style="padding-top: 2rem;">

        <div style="margin-bottom: 2rem;">
            <a href="/directory" style="color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-arrow-right"></i> العودة للدليل
            </a>
        </div>

        <div class="grid grid-cols-3 gap-6">
            <!-- Main Profile Info -->
            <div class="card" style="grid-column: span 2;">
                <div class="flex items-center gap-4"
                    style="margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--border-color);">
                    <div
                        style="width: 100px; height: 100px; border-radius: 50%; background-color: var(--bg-dark); border: 2px solid var(--gold-primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fa-solid fa-user-doctor" style="font-size: 2.5rem; color: var(--gold-primary);"></i>
                    </div>
                    <div>
                        <h1 style="margin-bottom: 0.25rem;">{{ $user->name }}</h1>
                        <span class="badge badge-gold">{{ $user->profession->name ?? 'بدون مهنة' }}</span>
                        <p style="color: var(--text-muted); margin-top: 0.5rem;">تاريخ التسجيل:
                            {{ $user->created_at ? $user->created_at->format('d M Y') : '' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <h3
                            style="color: var(--gold-primary); font-size: 1.1rem; border-bottom: 1px dashed var(--border-color); padding-bottom: 0.5rem; margin-bottom: 1rem;">
                            معلومات الاتصال</h3>

                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                            <div
                                style="width: 40px; height: 40px; border-radius: 8px; background-color: rgba(212, 175, 55, 0.1); display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-phone text-gold"></i>
                            </div>
                            <div>
                                <div style="color: var(--text-muted); font-size: 0.85rem;">رقم الجوال</div>
                                <div style="font-weight: 600; font-size: 1.1rem; direction: ltr; text-align: right;">
                                    {{ $user->phone }}</div>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                            <div
                                style="width: 40px; height: 40px; border-radius: 8px; background-color: rgba(212, 175, 55, 0.1); display: flex; align-items: center; justify-content: center;">
                                <i class="fa-brands fa-whatsapp text-gold"></i>
                            </div>
                            <div>
                                <div style="color: var(--text-muted); font-size: 0.85rem;">واتساب</div>
                                <div style="font-weight: 600; font-size: 1.1rem; direction: ltr; text-align: right;">
                                    {{ $user->phone }}</div>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                            <div
                                style="width: 40px; height: 40px; border-radius: 8px; background-color: rgba(212, 175, 55, 0.1); display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-envelope text-gold"></i>
                            </div>
                            <div>
                                <div style="color: var(--text-muted); font-size: 0.85rem;">البريد الإلكتروني</div>
                                <div style="font-weight: 600; font-size: 1.1rem; direction: ltr; text-align: right;">
                                    @if($user->email)
                                        <a href="mailto:{{ $user->email }}" style="color: inherit; text-decoration: none;">{{ $user->email }}</a>
                                    @else
                                        ---
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3
                            style="color: var(--gold-primary); font-size: 1.1rem; border-bottom: 1px dashed var(--border-color); padding-bottom: 0.5rem; margin-bottom: 1rem;">
                            الموقع والعنوان</h3>

                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                            <div
                                style="width: 40px; height: 40px; border-radius: 8px; background-color: rgba(212, 175, 55, 0.1); display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-map-location-dot text-gold"></i>
                            </div>
                            <div>
                                <div style="color: var(--text-muted); font-size: 0.85rem;">المدينة / القرية</div>
                                <div style="font-weight: 600; font-size: 1.1rem;">{{ $user->village->name ?? 'غير محدد' }}
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                            <div
                                style="width: 40px; height: 40px; border-radius: 8px; background-color: rgba(212, 175, 55, 0.1); display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-location-crosshairs text-gold"></i>
                            </div>
                            <div>
                                <div style="color: var(--text-muted); font-size: 0.85rem;">الحي / الشارع</div>
                                <div style="font-weight: 600; font-size: 1.1rem;">{{ $user->address ?? '---' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color);">
                    <h3 style="color: var(--gold-primary); font-size: 1.1rem; margin-bottom: 1rem;">تفاصيل إضافية</h3>
                    <p style="color: var(--text-main); line-height: 1.8;">
                        {{ $user->details ?? '---' }}
                    </p>
                </div>
            </div>

            <!-- Actions Sidebar -->
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div class="card" style="text-align: center;">
                    <h3 style="margin-bottom: 1.5rem;">تواصل الآن</h3>

                    <a href="tel:+967{{ $user->phone }}" class="btn btn-primary w-full"
                        style="margin-bottom: 1rem; font-size: 1.1rem;">
                        <i class="fa-solid fa-phone" style="margin-left: 0.5rem;"></i> اتصال
                    </a>
                    {{-- <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone) }}" target="_blank" class="btn w-full" style="background-color: #25D366; color: white; margin-bottom: 1rem; font-size: 1.1rem;"> --}}
                    <a href="https://wa.me/967{{ $user->phone }}?text={{ urlencode('wellcome to hadrumote connection') }}"
                        target="_blank" class="btn w-full"
                        style="background-color: #25D366; color: white; margin-bottom: 1rem; font-size: 1.1rem;">
                        <i class="fa-brands fa-whatsapp" style="margin-left: 0.5rem;"></i> رسالة واتساب
                    </a>

                    <button class="btn btn-outline w-full" style="font-size: 1.1rem;">
                        <i class="fa-solid fa-share-nodes" style="margin-left: 0.5rem;"></i> مشاركة الرقم
                    </button>
                </div>

                <div class="card">
                    <div style="display: flex; align-items: center; gap: 1rem; color: #ef4444; cursor: pointer;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>الإبلاغ عن رقم مزيف أو غير صحيح</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        // Logic to fetch user details using API: /api/users/show/{id}
    </script>
@endsection
