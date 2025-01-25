@extends('front.layouts.app')

@section('title', 'Profile')

@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.profile') }}">Profile</a></li>
                            <li class="breadcrumb-item active">Update</li>
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

                    <div class="card border-0 shadow mb-4">
                        <form action="" method="post" name="userForm" id="userForm">
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-1">My Profile</h3>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Name*</label>
                                    <input type="text" name="name" id="name" placeholder="Enter Name"
                                        class="form-control" value="{{ $user->name }}">
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Email*</label>
                                    <input type="text" name="email" id="email" placeholder="Enter Email"
                                        class="form-control" value="{{ $user->email }}">
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Designation</label>
                                    <input type="text" name="designation" id="designation"
                                        placeholder="Enter Designation" class="form-control"
                                        value="{{ $user->designation }}">
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Mobile</label>
                                    <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile"
                                        class="form-control" value="{{ $user->mobile }}">
                                    <p></p>
                                </div>
                            </div>

                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>

                    <div class="card border-0 shadow mb-4">
                        <form action="" method="post" name="updateBio" id="updateBio">
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-1">Additional Information</h3>
                                <div class="mb-4">
                                    <label for="about" class="mb-2">About Me</label>
                                    <textarea name="about" id="about" placeholder="Write something about yourself" style="min-height: 8rem"
                                        class="text-area">{{ old('about', $user->about) }}</textarea>
                                    <p></p>
                                </div>

                                <div class="mb-4">
                                    <label for="qualifications" class="mb-2">Qualifications</label>
                                    <textarea name="qualifications" id="qualifications" placeholder="Write your qualifications" class="text-area"
                                        style="min-height: 8rem">{{ old('qualifications', $user->qualifications) }}</textarea>
                                    <p></p>
                                </div>

                                <div class="mb-4">
                                    <label for="experience" class="mb-2">Experience</label>
                                    <textarea name="experience" id="experience" placeholder="Enter Experience Details" style="min-height: 8rem"
                                        class="text-area">{{ old('experience', $user->experience) }}</textarea>
                                    <p></p>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="date_of_birth" class="mb-2">Date of Birth</label>
                                        <input type="date" name="date_of_birth" id="date_of_birth"
                                            class="form-control" value="{{ old('date_of_birth', $user->date_of_birth) }}">
                                        <p></p>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="address" class="mb-2">Address</label>
                                        <input type="text" placeholder="Enter address" id="address" name="address"
                                            class="form-control" value="{{ old('address', $user->address) }}">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="portfolio" class="mb-2">Website</label>
                                    <input type="url" name="portfolio" id="portfolio"
                                        placeholder="Enter website URL" class="form-control"
                                        value="{{ old('portfolio', $user->portfolio) }}">
                                    <p></p>
                                </div>
                            </div>

                            <div class="card-footer p-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>

                    <div class="card border-0 shadow mb-4">
                        <form action="" method="post" name="passwordForm" id="passwordForm">
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-1">Change Password</h3>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Current Password*</label>
                                    <input type="password" placeholder="Current Password" class="form-control"
                                        name="current_password" id="current_password">
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">New Password*</label>
                                    <input type="password" placeholder="New Password" class="form-control"
                                        name="new_password" id="new_password">
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Confirm New Password*</label>
                                    <input type="password" placeholder="Confirm Password" class="form-control"
                                        name="confirm_new_password" id="confirm_new_password">
                                    <p></p>
                                </div>
                            </div>
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script type="text/javascript">
        $("#userForm").submit(function(e) {
            e.preventDefault()

            $.ajax({
                url: "{{ route('user.update.information') }}",
                type: 'post',
                dataType: 'json',
                data: $("#userForm").serializeArray(),
                success: function(response) {
                    if (response.status === true) {
                        $("#name").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')

                        $("#email").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')

                        $("#designation").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')

                        $("#mobile").removeClass('is-invalid').siblings('p').removeClass(
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

                        if (errors.email) {
                            $("#email").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.email)
                        } else {
                            $("#email").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.designation) {
                            $("#designation").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.designation)
                        } else {
                            $("#designation").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.mobile) {
                            $("#mobile").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.mobile)
                        } else {
                            $("#mobile").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }
                    }
                }
            })
        });

        $("#updateBio").submit(function(e) {
            e.preventDefault()
            $("button[type='submit']").prop('disabled', true);
            $.ajax({
                url: "{{ route('user.update.bio') }}",
                type: 'post',
                dataType: 'json',
                data: $("#updateBio").serializeArray(),
                success: function(response) {
                    $("button[type='submit']").prop('disabled', false);
                    if (response.status === true) {
                        $("#about").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#qualifications").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#experience").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#date_of_birth").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#address").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#portfolio").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')

                        window.location.href = '{{ url()->current() }}';
                    } else {
                        var errors = response.errors;

                        if (errors.about) {
                            $("#about").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.about)
                        } else {
                            $("#about").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.qualifications) {
                            $("#qualifications").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.qualifications)
                        } else {
                            $("#qualifications").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.experience) {
                            $("#experience").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.experience)
                        } else {
                            $("#experience").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.date_of_birth) {
                            $("#date_of_birth").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.date_of_birth)
                        } else {
                            $("#name").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.address) {
                            $("#address").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.address)
                        } else {
                            $("#address").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.portfolio) {
                            $("#portfolio").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.portfolio)
                        } else {
                            $("#portfolio").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }
                    }
                }
            })
        });

        $("#profilePicForm").submit(function(e) {
            e.preventDefault()

            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('user.update.profilePic') }}",
                type: 'post',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === true) {
                        window.location.href = '{{ url()->current() }}';
                    } else {
                        var errors = response.errors;
                        if (errors.image) {
                            $("#image").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.image)
                        } else {
                            $("#image").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }
                    }
                }
            })
        });

        $("#passwordForm").submit(function(e) {
            e.preventDefault()
            $.ajax({
                url: "{{ route('user.update.password') }}",
                type: 'post',
                dataType: 'json',
                data: $("#passwordForm").serializeArray(),
                success: function(response) {
                    if (response.status === true) {
                        $("#current_password").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')

                        $("#new_password").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')

                        $("#confirm_new_password").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')

                        window.location.href = '{{ url()->current() }}';

                    } else {
                        var errors = response.errors;
                        if (errors.current_password) {
                            $("#current_password").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.current_password)
                        } else {
                            $("#current_password").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.new_password) {
                            $("#new_password").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.new_password)
                        } else {
                            $("#new_password").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.confirm_new_password) {
                            $("#confirm_new_password").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.confirm_new_password)
                        } else {
                            $("#confirm_new_password").removeClass('is-invalid').siblings('p')
                                .removeClass(
                                    'invalid-feedback').html('')
                        }
                    }
                }
            })
        })
    </script>
@endsection
