@extends('layouts.admin')

@section('header_title', 'تعديل المستخدم')

@section('content')
<div class="container-fluid">
    @include('admin.users.partials.form', [
        'action' => route('admin.users.update', $user->id),
        'method' => 'PUT',
        'buttonText' => 'حفظ التعديلات',
        'user' => $user,
        'villages' => $villages,
        'professions' => $professions,
    ])
</div>
@endsection
