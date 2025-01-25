@extends('front.layouts.app')

@section('title', 'User Details')

@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="s-body text-center mt-3">
                            @if ($jobApplication->user->image == '')
                                <img src=" {{ asset('assets/images/avatar.jpg') }}" alt="avatar"
                                    class="rounded-circle border border-1 img-fluid" style="width: 150px;">
                            @else
                                <img src=" {{ asset('profile_picture/' . $jobApplication->user->image) }}" alt="avatar"
                                    class="rounded border border-1 img-fluid" style="max-height: 32rem; object-fit:contain">
                            @endif
                        </div>
                        <div>
                            <ul class="mt-3">
                                <li class="mb-2">Name: <span>{{ $jobApplication->user->name }}</span></li>
                                <li class="mb-2">Email: <span>{{ $jobApplication->user->email }}</span></li>
                                @if (!is_null($jobApplication->user->mobile))
                                    <li class="mb-2">Phone no: <span>{{ $jobApplication->user->mobile }}</span></li>
                                @endif
                                @if (!is_null($jobApplication->user->date_of_birth))
                                    <li class="mb-2">Date of Birth:
                                        <span>{{ \Carbon\Carbon::parse($jobApplication->user->date_of_birth)->format('d M, y') }}</span>
                                    </li>
                                @endif
                                @if (!is_null($jobApplication->user->address))
                                    <li class="mb-2">Address: <span>{{ $jobApplication->user->address }}</span></li>
                                @endif
                                <li class="mb-2">Join date: <span>{{ $jobApplication->user->carbonDate() }}</span></span>
                                </li>
                            </ul>

                            @if ($jobApplication->status == 0)
                                <div class="d-grid mt-3">
                                    <a href="{{ route('user.job.approveApplication', ['jobId'=>$jobApplication->job->id, 'userId'=> $jobApplication->user->id]) }}"
                                        class="btn btn-primary btn-lg">Approve Request</a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
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

                    <div class="card border-0 shadow mb-4">
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">About {{ $jobApplication->user->name }}</h3>
                            <div class="pb-2">
                                @if (
                                    !empty($jobApplication->user->about) ||
                                        !empty($jobApplication->user->qualifications) ||
                                        !empty($jobApplication->user->experience) ||
                                        !empty($jobApplication->user->portfolio))

                                    @if (!empty($jobApplication->user->about))
                                        <div class="single_wrap">
                                            <p class="text-secondary pb-4">{!! (($jobApplication->user->about)) !!}</p>
                                        </div>
                                    @endif

                                    @if (!empty($jobApplication->user->qualifications))
                                        <div class="single_wrap">
                                            <h4 class="fs-5 fw-bold">Qualifications</h4>
                                            <p class="text-secondary pb-4">{!! (($jobApplication->user->qualifications)) !!}</p>
                                        </div>
                                    @endif

                                    @if (!empty($jobApplication->user->experience))
                                        <div class="single_wrap">
                                            <h4 class="fs-5 fw-bold">Experience</h4>
                                            <p class="text-secondary pb-4">{!! (($jobApplication->user->experience)) !!}</p>
                                        </div>
                                    @endif

                                    @if (!empty($jobApplication->user->portfolio))
                                        <div class="single_wrap">
                                            <h4 class="fs-5 fw-bold">Website</h4>
                                            <p class="text-secondary pb-4">
                                                <a href="{{ $jobApplication->user->portfolio }}" target="_blank"
                                                    class="text-decoration-underline">
                                                    {{ $jobApplication->user->portfolio }}
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
