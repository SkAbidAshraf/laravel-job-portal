@extends('front.layouts.app')

@section('title', $job->title)

@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.job.myJobs') }}">My Jobs</a></li>
                            <li class="breadcrumb-item active">Job Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                @include('front.user.sidebar')

                <div class="col-lg-9">
                    <!-- Job Details Card -->
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form p-4">
                            <div class="descript_wrap white-bg">
                                <!-- Job Title -->
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
                                                <p>Location: <span
                                                        class="text-secondary">{{ $job->company_location }}</span></p>
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
                                                <a href="{{ $job->company_website }}" target="_blank">
                                                    {{ Str::limit($job->company_website, 100) }}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="pt-3 text-end">
                                    <a class="btn btn-secondary" href="#"
                                        onclick="deleteJob({{ $job->id }})">Delete</a>

                                    <a href="{{ route('user.job.edit', $job->id) }}" class="btn btn-primary">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow my-4" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show shadow my-4" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="card-body card-form">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Applied Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($applications->isNotEmpty())
                                            @foreach ($applications as $application)
                                                <tr class="active">
                                                    <td>{{ $application->user->name }}</td>

                                                    <td>
                                                        <div class="info1">Email: {{ $application->user->email }}</div>
                                                        @if (!is_null($application->user->mobile))
                                                            <div class="fw-500">Phone: {{ $application->user->mobile }}
                                                            </div>
                                                        @endif
                                                    </td>

                                                    <td>{{ $application->carbonDate() }}</td>

                                                    <td>
                                                        <div class="job-status text-capitalize">
                                                            @if ($application->status == 0)
                                                                <span class="badge bg-warning text-dark">Pending</span>
                                                            @elseif($application->status == 1)
                                                                <span class="badge bg-success">Approved</span>
                                                            @else
                                                                <span class="badge bg-danger">Regected</span>
                                                            @endif
                                                        </div>
                                                    </td>

                                                    <td class="text-center">
                                                        <div class="action-dots">
                                                            <button href="#" class="btn" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>

                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('user.job.applicant.details', ['jobId' => $job->id, 'userId' => $application->user->id]) }}">
                                                                        <i class="fa fa-eye"
                                                                            aria-hidden="true"></i>View</a>
                                                                </li>

                                                                <li>
                                                                    <a class="dropdown-item" href="#"
                                                                        onclick="deleteAppliction({{ $job->id }},{{ $application->user->id }})">
                                                                        <i class="fa fa-trash"
                                                                            aria-hidden="true"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="pending">
                                                <td colspan="5">
                                                    <div class="job-name fw-500 text-center">No Applicants Available</div>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                            {{ $applications->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script type="text/javascript">
        function deleteAppliction(jobListingId, userId) {
            if (confirm('Are you sure you want to delete this job application?')) {
                $.ajax({
                    url: '{{ route('user.job.removeApplicant', $job->id) }}',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        jobListingId: jobListingId,
                        userId: userId,
                    },
                    success: function(response) {
                        window.location.href = "{{ route('user.job.view', $job->id) }}";
                    }
                })
            }
        };
    </script>
@endsection
