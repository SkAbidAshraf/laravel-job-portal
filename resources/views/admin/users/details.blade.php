@extends('admin.layouts.main')

@section('title', 'All Users')

@section('admin_breadcrumb')
    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">All Users</a></li>
            <li class="breadcrumb-item active">Details: {{ $user->name }}
                <i>{{ $user->role == 'admin' ? '(Admin)' : '' }}</i>
            </li>
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

        <div class="row">
            <div class="col-md-6">
                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        @if ($user->image == '')
                            <img src=" {{ asset('assets/images/avatar.jpg') }}" alt="avatar"
                                class="border border-1 img-fluid" style="max-height: 16rem;  object-fit:contain">
                        @else
                            <img src=" {{ asset('profile_picture/' . $user->image) }}" alt="avatar"
                                class="rounded border border-1 img-fluid" style="max-height: 16rem; object-fit:contain">
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <ul>
                            <li class="mb-2">Name: <span>{{ $user->name }}</span></li>
                            <li class="mb-2">Email: <span>{{ $user->email }}</span></li>
                            @if (!is_null($user->mobile))
                                <li class="mb-2">Phone no: <span>{{ $user->mobile }}</span></li>
                            @endif
                            @if (!is_null($user->date_of_birth))
                                <li class="mb-2">Date of Birth:
                                    <span>{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d M, y') }}</span>
                                </li>
                            @endif
                            @if (!is_null($user->address))
                                <li class="mb-2">Address: <span>{{ $user->address }}</span></li>
                            @endif
                            <li class="mb-2">Join date: <span>{{ $user->carbonDate() }}</span></span>
                            </li>
                        </ul>
                    </div>
                </div>
                @if ($user->role == 'user')
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body p-4 row">
                            <div class="col-6">
                                <a href="#" onclick="makeAdmin({{ $user->id }})" id="makeAdminBtn"
                                    class="btn btn-outline-primary col-12">Make Admin</a>
                            </div>

                            <div class="col-6">
                                <a href="#" onclick="deleteUser({{ $user->id }})" id="deleteUserBtn"
                                    class="btn btn-outline-danger col-12">Delete User</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div>

            <div class="card border-0 shadow mb-4">
                <div class="card-body p-4">
                    <h3 class="fs-4 mb-1">About {{ $user->name }}</h3>
                    <div class="pb-2">
                        @if (!empty($user->about) || !empty($user->qualifications) || !empty($user->experience) || !empty($user->portfolio))

                            @if (!empty($user->about))
                                <div class="single_wrap">
                                    <p class="text-secondary pb-4">{!! $user->about !!}</p>
                                </div>
                            @endif

                            @if (!empty($user->qualifications))
                                <div class="single_wrap">
                                    <h4 class="fs-5 fw-bold">Qualifications</h4>
                                    <p class="text-secondary pb-4">{!! $user->qualifications !!}</p>
                                </div>
                            @endif

                            @if (!empty($user->experience))
                                <div class="single_wrap">
                                    <h4 class="fs-5 fw-bold">Experience</h4>
                                    <p class="text-secondary pb-4">{!! $user->experience !!}</p>
                                </div>
                            @endif

                            @if (!empty($user->portfolio))
                                <div class="single_wrap">
                                    <h4 class="fs-5 fw-bold">Website</h4>
                                    <p class="text-secondary pb-4">
                                        <a href="{{ $user->portfolio }}" target="_blank" class="text-decoration-underline">
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
