@extends('admin.layouts.main')

@section('title', 'Admin Dashboard')

@section('admin_breadcrumb')
    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
@endsection

@section('admin_content')
<div class="col-lg-9">
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow mb-4 p-3">
        <div class="card-body card-form">
            <div class="d-flex justify-content-between">
                <div class="text-center mx-auto">
                    <h3 class="fs-4 mb-1 text-center">Welcome {{ Auth::user()->name }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
