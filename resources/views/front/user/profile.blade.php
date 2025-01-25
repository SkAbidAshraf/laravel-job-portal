@extends('front.layouts.app')

@section('title', 'Profile')

@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                @include('front.user.sidebar')

                <div class="col-lg-9">
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fs-4">About {{ $user->name }}</h3>
                                </div>
                                <div style="margin-top: -10px;">
                                    <a href="{{ route('user.update') }}" class="btn btn-primary">Update Profile</a>
                                </div>
                            </div>
                            <hr>
                            <div class="pb-2">
                                @if (!empty($user->about) || !empty($user->qualifications) || !empty($user->experience) || !empty($user->portfolio))
                                    @if (!empty($user->about))
                                        <div class="single_wrap">
                                            <p class="text-secondary pb-4">{!! (($user->about)) !!}</p>
                                        </div>
                                    @endif

                                    @if (!empty($user->qualifications))
                                        <div class="single_wrap">
                                            <h4 class="fs-5 fw-bold">Qualifications</h4>
                                            <p class="text-secondary pb-4">{!! (($user->qualifications)) !!}</p>
                                        </div>
                                    @endif

                                    @if (!empty($user->experience))
                                        <div class="single_wrap">
                                            <h4 class="fs-5 fw-bold">Experience</h4>
                                            <p class="text-secondary pb-4">{!! (($user->experience)) !!}</p>
                                        </div>
                                    @endif

                                    @if (!empty($user->portfolio))
                                        <div class="single_wrap">
                                            <h4 class="fs-5 fw-bold">Website</h4>
                                            <p class="text-secondary pb-4">
                                                <a href="{{ $user->portfolio }}" target="_blank"
                                                    class="text-decoration-underline">
                                                    {{ $user->portfolio }}
                                                </a>
                                            </p>
                                        </div>
                                    @endif
                                @else
                                    <div class="text-center text-muted">
                                        <p>No information available.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

