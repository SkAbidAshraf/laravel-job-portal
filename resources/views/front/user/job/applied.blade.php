@extends('front.layouts.app')

@section('title', 'My Applied Jobs')

@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">My Applied Jobs</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                @include('front.user.sidebar')

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
                                <div>
                                    <h3 class="fs-4 mb-1">My Applied Jobs</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Job Status</th>
                                            <th scope="col">Applied date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @if ($applications->isNotEmpty())
                                            @foreach ($applications as $application)
                                                <tr class="active">
                                                    <td>
                                                        <div class="job-name fw-500">{{ $application->job->title }}</div>
                                                        <div class="info1">{{ $application->job->jobType->name }}</div>
                                                    </td>

                                                    <td>{{ $application->job->category->name }}</td>

                                                    <td>
                                                        <div class="job-status text-capitalize">
                                                            @if ($application->job->status == 1)
                                                                <span class="badge bg-success">Active</span>
                                                            @else
                                                                <span class="badge bg-danger">Inactive</span>
                                                            @endif
                                                        </div>
                                                    </td>

                                                    <td>{{ $application->carbonDate() }}</td>

                                                    <td class="text-center">
                                                        <div class="action-dots">
                                                            <button href="#" class="btn" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>

                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('jobs.details', $application->job->id) }}">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i>View
                                                                        details</a>
                                                                </li>

                                                                <li>
                                                                    <a class="dropdown-item" href="#"
                                                                        onclick="deleteApplication({{ $application->id }})">
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
                                                    <div class="job-name fw-500 text-center">No Jobs Available</div>
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
        function deleteApplication(applicationId) {
            if (confirm('Are you sure you want to delete this application?')) {
                $.ajax({
                    url: '{{ route('user.job.applicationDelete') }}',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        applicationId: applicationId
                    },
                    success: function(response) {
                        window.location.href = "{{ url()->current() }}";
                    }
                })
            }
        }
    </script>
@endsection
