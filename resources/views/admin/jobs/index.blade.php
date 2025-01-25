@extends('admin.layouts.main')

@section('title', 'All Jobs')

@section('admin_breadcrumb')
    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active">All Jobs</li>
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
                    <div>
                        <h3 class="fs-4 mb-1">All Jobs</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Listed By</th>
                                <th scope="col">Status</th>
                                <th scope="col">Featured</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            @if ($jobs->isNotEmpty())
                                @foreach ($jobs as $job)
                                    <tr class="active">
                                        <td>
                                            <div>{{ $job->title }}</div>
                                            @if ($job->application->count() > 0)
                                                <div>{{ '(' . $job->application->count() . ' Applications)' }}</div>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="info1">{{ $job->creator->name }}</div>
                                            <div class="job-name fw-500">{{ $job->creator->email }}</div>
                                        </td>

                                        <td>
                                            <div class="job-status text-capitalize mx-auto">
                                                @if ($job->status == 1)
                                                    <span class="badge bg-success">approved</span>
                                                @elseif($job->status == 0)
                                                    <span class="badge bg-warning text-dark">pending</span>
                                                @endif
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            {{-- {{ $job->featured }} --}}
                                            <input id="feature" type="checkbox" {{ $job->featured == 1 ? 'checked' : '' }}
                                                class="form-check-input text-center"
                                                onchange="featureUpdate({{ $job->id }})">
                                        </td>

                                        <td>{{ $job->carbonDate() }}</td>

                                        <td class="text-center">
                                            <div class="action-dots">
                                                <button href="#" class="btn" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.jobs.details', $job->id) }}">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>View Details</a>
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item" href="#"
                                                            onclick="statusUpdate({{ $job->id }})">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>Change Status</a>
                                                    </li>

                                                    @if ($job->creator->role != 'admin' || $job->creator->id == Auth::user()->id) 
                                                        <li>
                                                            <a class="dropdown-item" href="#"
                                                                onclick="deleteJob({{ $job->id }})">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>Delete Job</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="pending">
                                    <td colspan="6">
                                        <div class="job-name fw-500 text-center">No Jobs Available</div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>

                    </table>
                </div>
                {{ $jobs->links() }}
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
                        window.location.href = '{{ route('admin.jobs.index') }}';
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
                        window.location.href = '{{ route('admin.jobs.index') }}';
                    }
                });
            }
        };

        function featureUpdate(id) {
            $.ajax({
                url: '{{ route('admin.jobs.updateFeatured') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(response) {
                    window.location.href = '{{ route('admin.jobs.index') }}';
                }
            });
        }
    </script>
@endsection
