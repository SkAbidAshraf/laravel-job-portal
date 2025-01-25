<div class="col-lg-3">
    @if (Auth::check())
        <div class="card border-0 shadow mb-4 p-3">
            <div class="s-body mt-3">
                <div class="text-center">
                    @if (Auth::user()->image == '')
                        <img src=" {{ asset('assets/images/avatar.jpg') }}" alt="avatar"
                            class="rounded-circle border border-1 img-fluid" style="width: 150px;">
                    @else
                        <img src=" {{ asset('profile_picture/' . Auth::user()->image) }}" alt="avatar"
                            class="rounded border border-1 img-fluid" style="max-height: 32rem; object-fit:contain">
                    @endif
                    <p id="designation-display" class="text-muted fs-6">{{ Auth::user()->designation }}</p>
                </div>

                @if (request()->routeIs('user.profile'))
                    <div class="text-center text-md-start">
                        <ul class="mt-3">
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
                        </ul>
                    </div>
                @endif

                @if (request()->routeIs('user.update'))
                    <div class="d-flex justify-content-center mt-1 mb-2">
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"
                            class="btn btn-primary">Change Profile Picture</button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" name="profilePicForm" id="profilePicForm">
                                            <div class="mb-3">
                                                @if (Auth::user()->image == '')
                                                    <img src=" {{ asset('assets/images/avatar.jpg') }}" alt="avatar"
                                                        class="rounded border border-1 img-fluid"
                                                        style="height: 250px; object-fit: contain">
                                                @else
                                                    <img src=" {{ asset('profile_picture/' . Auth::user()->image) }}"
                                                        alt="avatar" class="rounded border border-1 img-fluid"
                                                        style="height: 250px; object-fit: contain">
                                                @endif
                                                <br>
                                                <label for="exampleInputEmail1" class="form-label">Profile
                                                    Image</label>
                                                <input type="file" class="form-control" id="image"
                                                    name="image">
                                                <p></p>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary mx-3">Update</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush ">
                <li class="list-group-item d-flex justify-content-between p-3">
                    <a class="{{ request()->routeIs('user.profile') ? 'active' : '' }}"
                        href="{{ route('user.profile') }}">Profile</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a class="{{ request()->routeIs('user.job.create') ? 'active' : '' }}"
                        href="{{ route('user.job.create') }}">Create Job</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a class="{{ request()->routeIs('user.job.myJobs') ? 'active' : '' }}"
                        href="{{ route('user.job.myJobs') }}">My Jobs</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a class="{{ request()->routeIs('user.job.appliedJobs') ? 'active' : '' }}"
                        href="{{ route('user.job.appliedJobs') }}">Applied Jobs</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a class="{{ request()->routeIs('user.job.savedJobs') ? 'active' : '' }}"
                        href="{{ route('user.job.savedJobs') }}">Saved Jobs</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{ route('logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>
