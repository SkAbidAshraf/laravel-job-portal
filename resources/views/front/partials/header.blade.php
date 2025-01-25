<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <span style="font-size: 2rem"><i>Job</i><i style="color: #8bc471">Portal</i><i
                        style="font-size: 1rem">.bd</i></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link me-2 {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 {{ request()->routeIs('jobs') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('jobs') }}">Browse Jobs</a>
                    </li>
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link me-2 {{ request()->routeIs('user.profile') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('user.profile') }}">Profile</a>
                        </li>

                        @if (Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link me-2" aria-current="page" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                        @endif
                    @endif
                </ul>

                @if (!Auth::check())
                    <a class="btn btn-outline-primary me-2" href="{{ route('login') }}" type="submit">Login</a>
                @else
                    <div class="dropdown dropdown-center me-3 d-none d-lg-block">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (empty(Auth::user()->image))
                                <img src="{{ asset('assets/images/avatar.jpg') }}" alt="avatar"
                                    class="dropdown-toggle rounded-circle border border-1 img-fluid"
                                    style="height: 5vh; width: 5vh; object-fit: cover;">
                            @else
                                <img src="{{ asset('profile_picture/' . Auth::user()->image) }}" alt="avatar"
                                    class="dropdown-toggle rounded-circle border border-1 img-fluid"
                                    style="height: 5vh; width: 5vh; object-fit: cover;">
                            @endif
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('user.update') }}">Settings</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                            </li>
                        </ul>
                    </div>

                    <div class="d-block d-lg-none ">
                        <a class="btn btn-outline-dark mb-2" href="{{ route('logout') }}" type="submit">Logout</a>
                    </div>
                @endif
                <a class="btn btn-primary text-light" href="{{ route('user.job.create') }}" type="submit">Post Job</a>
            </div>
        </div>
    </nav>
</header>
