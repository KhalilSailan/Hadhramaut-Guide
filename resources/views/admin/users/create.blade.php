@extends('layouts.admin')

@section('header_title', 'إضافة مستخدم جديد')

@section('content')
<div class="container-fluid">
    @include('admin.users.partials.form', [
        'action' => route('admin.users.store'),
        'method' => 'POST',
        'buttonText' => 'إنشاء المستخدم',
        'villages' => $villages,
        'professions' => $professions,
    ])
</div>
@endsection
