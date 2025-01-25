@extends('front.layouts.app')

@section('title', $job->title)

@section('content')
    <section class="section-4 bg-2">
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                {{-- <a class="" href="{{ route('jobs') }}"><i class="fa fa-arrow-left"
                                        aria-hidden="true"></i> &nbsp;Back to Jobs</a> --}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="container job_details_area">
            <div class="row pb-5">
                <div class="col-lg-8">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow mb-4" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (Session::has('warning'))
                        <div class="alert alert-warning alert-dismissible fade show shadow mb-4" role="alert">
                            {{ Session::get('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show shadow mb-4" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card shadow border-0">
                        <div class="job_details_header">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">

                                    <div class="jobs_conetent">
                                        <h4>{{ $job->title }}</h4>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p> <i class="fa fa-map-marker"></i>{{ $job->location }}</p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fa fa-clock-o"></i> {{ $job->jobType->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div class="apply_now">
                                        @if (Auth::check())
                                            <a id="saveJobBtn" href="javascript:void(0)"
                                                onclick="saveJob({{ $job->id }})" class="heart_mark {{ ($hasSaved == true) ? 'active' : '' }}">
                                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="heart_mark active" data-bs-toggle="popover"
                                                data-bs-trigger="hover focus" data-bs-placement="bottom"
                                                data-bs-content="Login to save job">
                                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="descript_wrap white-bg">
                            @if (!is_null($job->description))
                                <div class="single_wrap">
                                    <h4>Job description</h4>
                                    <p>{!! ($job->description) !!}</p>
                                </div>
                            @endif

                            @if (!is_null($job->responsibilities))
                                <div class="single_wrap">
                                    <h4>Responsibility</h4>
                                    <p>{!! ($job->responsibilities) !!}</p>
                                </div>
                            @endif


                            @if (!is_null($job->qualifications))
                                <div class="single_wrap">
                                    <h4>Qualifications</h4>
                                    <p>{!! ($job->qualifications) !!}</p>

                                </div>.
                            @endif

                            @if (!is_null($job->benefits))
                                <div class="single_wrap">
                                    <h4>Benefits</h4>
                                    <p>{!! ($job->benefits) !!}</p>
                                </div>
                            @endif

                            <div class="border-bottom"></div>
                            <div class="pt-3 text-end">
                                @if (Auth::check())
                                    {{-- <a id="saveJobBtn" href="#" onclick="saveJob({{ $job->id }})"
                                        class="btn btn-secondary">Save for letter</a> --}}

                                    <a id="applyJobBtn" href="#" onclick="applyJob({{ $job->id }})"
                                        class="btn btn-primary">Apply</a>
                                @else
                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus" data-bs-placement="bottom"
                                        data-bs-content="Login to Apply">
                                        <button class="btn btn-primary" type="button" disabled>Apply</button>
                                    </span>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-lg-0 mt-4">
                    <div class="card shadow border-0">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Listed by</h3>
                            </div>
                            <div class="job_content text-center pt-3">
                                @if ($job->creator->image == '')
                                    <img src=" {{ asset('assets/images/avatar.jpg') }}" alt="avatar"
                                        class="rounded-circle border border-1 img-fluid mx-atuo" style="width: 150px;">
                                @else
                                    <img src=" {{ asset('profile_picture/' . $job->creator->image) }}" alt="avatar"
                                        class="rounded border border-1 img-fluid"
                                        style="max-height: 32rem; object-fit:contain">
                                @endif
                                <ul class="mt-2">
                                    <span>Name: <span>{{ $job->creator->name }}</span></span><br>
                                    @if (!is_null($job->creator->designation))
                                        <span>Designation: <span>{{ $job->creator->designation }}</span></span><br>
                                    @endif
                                    <span>Email: <span>{{ $job->creator->email }}</span></span>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow my-4 border-0">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Job Summery</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>Published on: <span>{{ $job->carbonDate() }}</span></li>
                                    <li>Vacancy: <span>{{ $job->vacancy }} Position</span></li>
                                    @if (!is_null($job->salary))
                                        <li>Salary: <span>{{ $job->salary . ' Tk' }}</span></li>
                                    @endif
                                    <li>Location: <span>{{ $job->location }}</span></li>
                                    <li>Job Nature: <span> {{ $job->jobType->name }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow border-0 my-4">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Company Details</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>Name: <span>{{ $job->company_name }}</span></li>
                                    @if (!is_null($job->company_location))
                                        <li>Locaion: <span>{{ $job->company_location }}</span></li>
                                    @endif
                                    <li>Webite:
                                        <span>
                                            <a href="{{ $job->company_website }}">
                                                {{ Str::limit($job->company_website, 20) }}</a>
                                        </span>
                                    </li>
                                    <li>Email: <span>{{ $job->email }}</span></li>
                                    <li>Mobile: <span>{{ $job->mobile }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        function applyJob(id) {
            if (confirm("Are you sure you want to apply on this job?")) {
                $("#applyJobBtn").removeAttr('onclick')
                $.ajax({
                    url: '{{ route('user.job.apply') }}',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        window.location.href = '{{ url()->current() }}';
                    }

                });
            }
        }

        function saveJob(id) {
            $("#saveJobBtn").removeAttr('onclick')
            $.ajax({
                url: '{{ route('user.job.save') }}',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response)
                    window.location.href = '{{ url()->current() }}';
                }
            });
        }

        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>
@endsection
