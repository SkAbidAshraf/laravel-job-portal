@extends('front.layouts.app')

@section('title', 'Edit Job')

@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.job.myJobs') }}">My Jobs</a></li>
                            <li class="breadcrumb-item active">Edit Job</li>
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

                    <div class="card border-0 shadow mb-4 ">
                        <form action="" method="post" id="updateJobForm" name="updateJobForm">
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Edit Job Details</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" placeholder="Enter Job Title" id="title" name="title"
                                            class="form-control" value="{{ $job->title }}">
                                        <p></p>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select a Category</option>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                    <option {{ $job->category_id == $category->id ? 'selected' : '' }}
                                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Job Nature<span class="req">*</span></label>
                                        <select name="jobType" id="jobType" class="form-control"
                                            value="{{ $job->title }}">
                                            <option value="{{ $job->title }}">Select Job Nature</option>
                                            @if ($jobTypes->isNotEmpty())
                                                @foreach ($jobTypes as $jobType)
                                                    <option {{ $job->job_type_id == $jobType->id ? 'selected' : '' }}
                                                        value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>

                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" min="1" placeholder="Enter Vacancy" id="vacancy"
                                            name="vacancy" class="form-control" value="{{ $job->vacancy }}">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Salary Range (TK)</label>
                                        <input type="text" placeholder="Enter Range Salary in Taka" id="salary"
                                            name="salary" class="form-control" value="{{ $job->salary }}">
                                        <p></p>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" placeholder="Enter location" id="location" name="location"
                                            class="form-control" value="{{ $job->location }}">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea class="text-area" name="description" id="description" cols="5" rows="5"
                                        placeholder="Enter Description">{{ $job->description }}</textarea>
                                    <p></p>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Benefits</label>
                                    <textarea class="text-area" name="benefits" id="benefits" cols="5" rows="5"
                                        placeholder="Enter Benefits">{{ $job->benefits }}</textarea>
                                    <p></p>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Responsibilities</label>
                                    <textarea class="text-area" name="responsibilities" id="responsibilities" cols="5" rows="5"
                                        placeholder="Enter Responsibilities">{{ $job->responsibilities }}</textarea>
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Qualifications</label>
                                    <textarea class="text-area" name="qualifications" id="qualifications" cols="5" rows="5"
                                        placeholder="Enter Qualifications">{{ $job->qualifications }}</textarea>
                                    <p></p>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Keywords</label>
                                    <input type="text" placeholder="Enter keywords" id="keywords" name="keywords"
                                        class="form-control" value="{{ $job->keywords }}">
                                    <p></p>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Experience <span class="req">*</span></label>
                                    <select name="experience" id="experience" class="form-control">
                                        <option value="">Select required experience</option>
                                        <option {{ $job->experience == 'none' ? 'selected' : '' }} value="none">No
                                            experience required</option>
                                        <option {{ $job->experience == '1' ? 'selected' : '' }} value="1">1+ years
                                            of experience</option>
                                        <option {{ $job->experience == '2' ? 'selected' : '' }} value="2">2+ years
                                            of experience</option>
                                        <option {{ $job->experience == '3' ? 'selected' : '' }} value="3">3+ years
                                            of experience</option>
                                        <option {{ $job->experience == '4' ? 'selected' : '' }} value="4">4+ years
                                            of experience</option>
                                        <option {{ $job->experience == '5' ? 'selected' : '' }} value="5">5+ years
                                            of experience</option>
                                    </select>
                                    <p></p>
                                </div>

                                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Name<span class="req">*</span></label>
                                        <input type="text" placeholder="Enter Company Name" id="company_name"
                                            name="company_name" class="form-control" value="{{ $job->company_name }}">
                                        <p></p>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location</label>
                                        <input type="text" placeholder="Enter Company Location" id="company_location"
                                            name="company_location" class="form-control"
                                            value="{{ $job->company_location }}">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Website Url<span class="req">*</span></label>
                                    <input type="text"
                                        placeholder="Enter Company Website Url. Ex:http://wwww.example.com"
                                        id="company_website" name="company_website" class="form-control"
                                        value="{{ $job->company_website }}">
                                    <p></p>
                                </div>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Contact Mail<span
                                                class="req">*</span></label>
                                        <input type="text" placeholder="Enter contact mail" id="email"
                                            name="email" class="form-control" value="{{ $job->email }}">
                                        <p></p>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Contact Number<span
                                                class="req">*</span></label>
                                        <input type="tel" placeholder="Enter contact number" id="mobile"
                                            name="mobile" class="form-control" value="{{ $job->mobile }}">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer p-4">
                                <button type="submit" class="btn btn-primary">Update Job</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $("#updateJobForm").submit(function(e) {
            e.preventDefault()
            $("button[type='submit']").prop('disabled', true)
            $.ajax({
                url: "{{ route('user.job.update', $job->id) }}",
                type: 'post',
                dataType: 'json',
                data: $("#updateJobForm").serializeArray(),
                success: function(response) {
                    $("button[type='submit']").prop('disabled', false)
                    if (response.status === true) {
                        $("#title").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#category").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#jobType").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#vacancy").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#salary").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#location").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#description").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#benefits").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#responsibilities").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#qualifications").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#keywords").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#experience").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#company_name").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#company_location").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#company_website").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#email").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')
                        $("#mobile").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('')

                        window.location.href = "{{ route('user.job.myJobs') }}";

                    } else {
                        var errors = response.errors;

                        if (errors.title) {
                            $("#title").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.title)
                        } else {
                            $("#title").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.category) {
                            $("#category").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.category)
                        } else {
                            $("#category").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.jobType) {
                            $("#jobType").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.jobType)
                        } else {
                            $("#jobType").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.vacancy) {
                            $("#vacancy").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.vacancy)
                        } else {
                            $("#vacancy").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.salary) {
                            $("#salary").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.salary)
                        } else {
                            $("#salary").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.location) {
                            $("#location").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.location)
                        } else {
                            $("#location").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.description) {
                            $("#description").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.description)
                        } else {
                            $("#description").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.benefits) {
                            $("#benefits").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.benefits)
                        } else {
                            $("#benefits").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.responsibilities) {
                            $("#responsibilities").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.responsibilities)
                        } else {
                            $("#responsibilities").removeClass('is-invalid').siblings('p').removeClass(
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

                        if (errors.keywords) {
                            $("#keywords").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.keywords)
                        } else {
                            $("#keywords").removeClass('is-invalid').siblings('p').removeClass(
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

                        if (errors.company_name) {
                            $("#company_name").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.company_name)
                        } else {
                            $("#company_name").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.company_location) {
                            $("#company_location").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.company_location)
                        } else {
                            $("#company_location").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('')
                        }

                        if (errors.company_website) {
                            $("#company_website").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors.company_website)
                        } else {
                            $("#company_website").removeClass('is-invalid').siblings('p').removeClass(
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
        })
    </script>
@endsection
