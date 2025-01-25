@extends('admin.layouts.main')

@section('title', 'All Categories')

@section('admin_breadcrumb')
    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
            <li class="breadcrumb-item active">All Categories</li>
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
            <form action="" class="mb-0" method="post" name="createCategoryForm" id="createCategoryForm">
                <div class="card-body p-4">
                    <h3 class="fs-4 mb-1">Create New Category</h3>
                    <div class="mb-4">
                        <label for="" class="mb-2">Name*</label>
                        <input type="text" name="name" id="name" placeholder="Enter Category Name"
                            class="form-control" value="">
                        <p></p>
                    </div>
                </div>

                <div class="card-footer  p-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

        <div class="card border-0 shadow mb-4 p-3">
            <div class="card-body card-form">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fs-4 mb-1">All Categories</h3>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Posts</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            @if ($categories->isNotEmpty())
                                @foreach ($categories as $category)
                                    <tr class="active">
                                        <td>{{ $category->name }}</td>

                                        <td>{{ $category->jobs->count() }}</td>

                                        <td>
                                            <div class="job-status text-capitalize mx-auto">
                                                @if ($category->status == 1)
                                                    <span class="badge bg-success">active</span>
                                                @elseif($category->status == 0)
                                                    <span class="badge bg-warning text-dark">inactive</span>
                                                @endif
                                            </div>
                                        </td>

                                        <td>{{ $category->carbonDate() }}</td>

                                        <td class="text-center">
                                            <div class="action-dots">
                                                <button href="#" class="btn" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" href="#"
                                                            onclick="statusUpdate({{ $category->id }})">
                                                            <i class="fa fa-exchange" aria-hidden="true"></i>Change Status</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"
                                                            onclick="deleteCategory({{ $category->id }})">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="pending">
                                    <td colspan="5">
                                        <div class="job-name fw-500 text-center">No Categories Available</div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        $("#createCategoryForm").submit(function(e) {
            e.preventDefault()

            $("button[type='submit']").prop('disabled', true);

            $.ajax({
                url: "{{ route('admin.categories.create') }}",
                type: 'post',
                dataType: 'json',
                data: $("#createCategoryForm").serializeArray(),
                success: function(response) {
                    $("button[type='submit']").prop('disabled', false);
                    if (response.status === true) {
                        $("#name").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')

                        window.location.href = '{{ url()->current() }}';
                    } else {
                        var errors = response.errors;

                        if (errors.name) {
                            $("#name").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.name)
                        } else {
                            $("#name").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }
                    }
                }
            })
        });

        function deleteCategory(id) {
            if (confirm(
                    'Are you sure you want to delete this category? This action will also delete all jobs associated with this category.'
                    )) {

                $.ajax({
                    url: '{{ route('admin.categories.delete') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        window.location.href = '{{ route('admin.categories.index') }}';
                    }
                });
            }
        };

        function statusUpdate(id) {
            if (confirm('Are you sure you want change the category status? This action will also affect all jobs associated with this category.')) {

                $.ajax({
                    url: '{{ route('admin.categories.statusUpdate') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        window.location.href = '{{ route('admin.categories.index') }}';
                    }
                });
            }
        };
    </script>
@endsection
