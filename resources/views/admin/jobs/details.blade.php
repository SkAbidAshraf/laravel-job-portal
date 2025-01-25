@extends('admin.layouts.main')

@section('title', 'All Users')

@section('admin_breadcrumb')
    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.jobs.index') }}">All Jobs</a></li>
            <li class="breadcrumb-item active">Details: {{ $job->title }} </li>
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

        <div class="card border-0 shadow mb-4">
            <div class="card-body card-form p-4">
                <div class="descript_wrap white-bg">
                    <!-- Job Title -->
                    <p class="fs-4 mb-4">Listed By: <a class="text-decoration-underline"
                            href="{{ route('admin.users.details', $job->creator->id) }}">{{ $job->creator->name }}</a></p>

                    <div class="single_wrap">
                        <h3 class="fs-4">{{ $job->title }}</h3>
                    </div>

                    <div class="links_location d-flex align-items-center px-2 text-secondary">
                        <div class="location me-auto">
                            <p><i class="fa fa-map-marker"></i> {{ $job->location }}</p>
                        </div>
                        <div class="location mx-auto">
                            <p><i class="fa fa-clock-o"></i> {{ $job->jobType->name }}</p>
                        </div>
                        <div class="location mx-auto">
                            <p><i class="fa fa-object-group"></i> {{ $job->category->name }}</p>
                        </div>
                        <div class="location ms-auto">
                            <p><i class="fa fa fa-calendar-check-o"></i> {{ $job->carbonDate() }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="pb-2">

                        @if (!is_null($job->description))
                            <div class="single_wrap mb-5">
                                <h3 class="fs-4 pb-1">Job Description</h3>
                                <p class="text-secondary">{!! $job->description !!}</p>
                            </div>
                        @endif


                        @if (!is_null($job->responsibilities))
                            <div class="single_wrap mb-5">
                                <h3 class="fs-4 pb-1">Responsibilities</h3>
                                <p class="text-secondary">{!! $job->responsibilities !!}</p>
                            </div>
                        @endif

                        @if (!is_null($job->qualifications))
                            <div class="single_wrap mb-5">
                                <h3 class="fs-4 pb-1">Qualifications</h3>
                                <p class="text-secondary">{!! $job->qualifications !!}</p>
                            </div>
                        @endif

                        @if (!is_null($job->benefits))
                            <div class="single_wrap">
                                <h3 class="fs-4 pb-1">Benefits</h3>
                                <p class="text-secondary">{!! $job->benefits !!}</p>
                            </div>
                        @endif

                    </div>

                    <hr>

                    <div class="summery_header">
                        <h3 class="fs-4">Company Details</h3>
                    </div>
                    <div class="job_content pb-3">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <p>Name: <span class="text-secondary">{{ $job->company_name }}</span></p>
                            </div>
                            <div class="col-md-6">
                                @if (!is_null($job->company_location))
                                    <p>Location: <span class="text-secondary">{{ $job->company_location }}</span></p>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <p>Mobile: <span class="text-secondary">{{ $job->mobile }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p>Email: <span class="text-secondary">{{ $job->email }}</span></p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                <p>Website:
                                    <a href="{{ $job->company_website }}" class="text-decoration-underline"
                                        target="_blank">
                                        {{ Str::limit($job->company_website, 100) }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="pt-3 text-end">
                        @if ($job->creator->role != 'admin' || $job->creator->id == Auth::user()->id)
                            <a class="btn btn-secondary" href="#" onclick="deleteJob({{ $job->id }})">Delete</a>
                        @endif

                        <a href="#" onclick="statusUpdate({{ $job->id }})"
                            class="btn {{ $job->status == '1' ? 'btn-secondary' : 'btn-primary' }}">
                            {{ $job->status == '0' ? 'Approve post' : 'Move to Pending' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        function statusUpdate(id) {
            if (confirm('Are you sure you want to change the status of this job?')) {

                $.ajax({
                    url: '{{ route('admin.jobs.statusUpdate') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        window.location.href = '{{ url()->current() }}';
                    }
                });
            }
        };



        function deleteJob(id) {
            if (confirm('Are you sure you want to delete this job?')) {

                $.ajax({
                    url: '{{ route('admin.jobs.delete') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.status === true) {
                            window.location.href = '{{ route('admin.jobs.index') }}';
                        } else {
                            window.location.href = '{{ url()->current() }}';
                        }

                    }
                });
            }
        };
    </script>
@endsection
