<div class="col-lg-3">
    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush ">
                <li class="list-group-item d-flex justify-content-between p-3">
                    <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>

                <li class="list-group-item d-flex justify-content-between p-3">
                    <a class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}"
                        href="{{ route('admin.users.index') }}">Users</a>
                </li>

                <li class="list-group-item d-flex justify-content-between p-3">
                    <a class="{{ request()->routeIs('admin.jobs.index') ? 'active' : '' }}"
                        href="{{ route('admin.jobs.index') }}">Jobs</a>
                </li>

                <li class="list-group-item d-flex justify-content-between p-3">
                    <a class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}"
                        href="{{ route('admin.categories.index') }}">Categories</a>
                </li>

                <li class="list-group-item d-flex justify-content-between p-3">
                    <a class="{{ request()->routeIs('admin.jobTypes.index') ? 'active' : '' }}"
                        href="{{ route('admin.jobTypes.index') }}">Job Types</a>
                </li>
            </ul>
        </div>
    </div>
</div>
