@extends('front.layouts.app')

@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    @yield('admin_breadcrumb')
                </div>
            </div>
            <div class="row">
                @include('admin.layouts.sidebar')

                    @yield('admin_content')
            </div>
        </div>
    </section>
@endsection
