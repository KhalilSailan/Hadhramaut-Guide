@extends('layouts.admin')

@section('header_title', 'إدارة المهن')

@section('content')
<div class="container-fluid">
    
    <div class="card mb-4">
        <div class="flex justify-between items-center">
            <div class="search-container" style="margin-bottom: 0; border: none; padding: 0; background: transparent; width: 50%;">
                <input type="text" class="form-control" placeholder="ابحث عن مهنة..." style="background-color: var(--bg-dark);">
            </div>
            
            <button class="btn btn-primary" onclick="document.getElementById('addProfessionModal').style.display='flex'">
                <i class="fa-solid fa-plus"></i> إضافة مهنة جديدة
            </button>
        </div>
    </div>

    <div class="card">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>الرقم التعريفي</th>
                        <th>اسم المهنة</th>
                        <th>تاريخ الإضافة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($professions as $profession)
                        <tr>
                            <td>#{{ $profession->id }}</td>
                            <td>
                                <form action="{{ route('admin.professions.update', $profession->id) }}" method="POST" class="flex gap-2 items-center">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="name" value="{{ old('professions.' . $profession->id . '.name', $profession->name) }}" class="form-control" required style="min-width: 220px;">
                                    <button type="submit" class="btn btn-outline" title="حفظ التعديل"><i class="fa-solid fa-floppy-disk"></i></button>
                                </form>
                            </td>
                            <td>{{ $profession->created_at ? $profession->created_at->format('d M Y') : '-' }}</td>
                            <td>
                                <form action="{{ route('admin.professions.destroy', $profession->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="حذف"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: var(--text-muted);">لا توجد مهن مسجلة حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Add Profession Modal -->
<div id="addProfessionModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; align-items: center; justify-content: center;">
    <div class="card" style="width: 400px;">
        <div class="flex justify-between items-center mb-4 pb-2" style="border-bottom: 1px solid var(--border-color);">
            <h3 style="margin: 0; color: var(--gold-primary);">إضافة مهنة</h3>
            <button class="btn btn-outline" style="padding: 0.25rem 0.5rem; border: none;" onclick="document.getElementById('addProfessionModal').style.display='none'">
                <i class="fa-solid fa-xmark" style="font-size: 1.25rem;"></i>
            </button>
        </div>
        
        <form action="{{ route('admin.professions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">اسم المهنة</label>
                <input type="text" name="name" class="form-control" placeholder="أدخل اسم المهنة" required>
            </div>
            
            <div class="flex justify-end gap-2 mt-4 pt-4" style="border-top: 1px solid var(--border-color);">
                <button type="button" class="btn btn-outline" onclick="document.getElementById('addProfessionModal').style.display='none'">إلغاء</button>
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
        </form>
    </div>
</div>
@endsection
