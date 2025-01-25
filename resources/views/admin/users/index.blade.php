@extends('admin.layouts.main')

@section('title', 'All Users')

@section('admin_breadcrumb')
    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active">All Users</li>
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
                        <h3 class="fs-4 mb-1">All Users</h3>
                    </div>
                    <div style="margin-top: -10px;">
                        {{-- <a href="{{ route('user.job.create') }}" class="btn btn-primary">Create Job</a> --}}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Contact Info</th>
                                <th scope="col">Listed Jobs</th>
                                <th scope="col">Role</th>
                                <th scope="col">Joined Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            @if ($users->isNotEmpty())
                                @foreach ($users as $user)
                                    <tr class="active">
                                        <td>{{ $user->name }}</td>

                                        <td>
                                            <div class="info1">{{ $user->email }}</div>
                                            <div class="job-name fw-500">{{ $user->mobile }}</div>
                                        </td>

                                        <td>{{ $user->jobListings->count() . ' jobs' }}</td>

                                        <td>

                                            <div class="job-status text-capitalize mx-auto">
                                                @if ($user->role == 'admin')
                                                    <span class="badge bg-info text-primary">admin</span>
                                                @elseif($user->role == 'user')
                                                    <span class="badge bg-warning text-dark">user</span>
                                                @endif
                                            </div>

                                        </td>

                                        <td>{{ $user->carbonDate() }}</td>

                                        <td class="text-center">
                                            <div class="action-dots">
                                                <button href="#" class="btn" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.users.details', $user->id) }}">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>View Details</a>
                                                    </li>


                                                    @if ($user->role == 'user')
                                                        <li>
                                                            <a class="dropdown-item" href="#" id="makeAdminBtn"
                                                                onclick="makeAdmin({{ $user->id }})">
                                                                <i class="fa fa-edit" aria-hidden="true"></i>Make Admin</a>
                                                        </li>

                                                        <li>
                                                            <a class="dropdown-item" href="#" id="deleteUserBtn"
                                                                onclick="deleteUser({{ $user->id }})">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>Delete User
                                                            </a>
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
                                        <div class="job-name fw-500 text-center">No Users Available</div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>

                    </table>
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection


@section('customJs')
    <script>
        function deleteUser(id) {
            if (confirm("Are you sure you want to delete this user?")) {
                $("#deleteUserBtn").removeAttr('onclick')
                $.ajax({
                    url: '{{ route('admin.users.delete') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.status == true) {
                            window.location.href = '{{ route('admin.users.index') }}';
                        } else {
                            window.location.href = '{{ url()->current() }}';
                        }
                    }
                });
            }
        };

        function makeAdmin(id) {
            if (confirm("Are you sure you want promote this user to admin?")) {
                $("#makeAdminBtn").removeAttr('onclick')
                $.ajax({
                    url: '{{ route('admin.users.make.admin') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.status == true) {
                            window.location.href = '{{ url()->current() }}';
                        } else {
                            window.location.href = '{{ url()->current() }}';
                        }
                    }
                });
            }
        };
    </script>
@endsection
