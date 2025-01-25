@extends('front.layouts.app')

@section('title', 'Create Job')

@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create Job</li>
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
                        <form action="" method="post" id="createJobForm" name="createJobForm">
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Create Job</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" placeholder="Enter Job Title" id="title" name="title"
                                            class="form-control">
                                        <p></p>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select a Category</option>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Job Nature<span class="req">*</span></label>
                                        <select name="jobType" id="jobType" class="form-control">
                                            <option value="">Select Job Nature</option>
                                            @if ($jobTypes->isNotEmpty())
                                                @foreach ($jobTypes as $jobType)
                                                    <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>

                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" min="1" placeholder="Enter Vacancy" id="vacancy"
                                            name="vacancy" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Salary (TK)</label>
                                        <input type="text" placeholder="Enter Salary in Taka" id="salary"
                                            name="salary" class="form-control">
                                        <p></p>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" placeholder="Enter location" id="location" name="location"
                                            class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea class="text-area rounded" name="description" id="description" style="min-height: 5rem !importent;"
                                        placeholder="Enter Description"></textarea>
                                    <p></p>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Benefits</label>
                                    <textarea class="text-area rounded" name="benefits" id="benefits" style="min-height: 5rem !importent;"
                                        placeholder="Enter Benefits"></textarea>
                                    <p></p>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Responsibilities</label>
                                    <textarea class="text-area rounded" name="responsibilities" id="responsibilities" style="min-height: 5rem !importent;"
                                        placeholder="Enter Responsibilities"></textarea>
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Qualifications</label>
                                    <textarea class="text-area rounded" name="qualifications" id="qualifications" style="min-height: 5rem !importent;"
                                        placeholder="Enter Qualifications"></textarea>
                                    <p></p>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Keywords</label>
                                    <input type="text" placeholder="Enter keywords" id="keywords" name="keywords"
                                        class="form-control">
                                    <p></p>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Experience <span class="req">*</span></label>
                                    <select name="experience" id="experience" class="form-control">
                                        <option value="">Select required experience</option>
                                        <option value="none">No experience required</option>
                                        <option value="1">1+ years of experience</option>
                                        <option value="2">2+ years of experience</option>
                                        <option value="3">3+ years of experience</option>
                                        <option value="4">4+ years of experience</option>
                                        <option value="5">5+ years of experience</option>
                                    </select>
                                    <p></p>
                                </div>

                                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Name<span class="req">*</span></label>
                                        <input type="text" placeholder="Enter Company Name" id="company_name"
                                            name="company_name" class="form-control">
                                        <p></p>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location</label>
                                        <input type="text" placeholder="Enter Company Location" id="company_location"
                                            name="company_location" class="form-control">
                                        <p></p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="" class="mb-2">Website Url<span class="req">*</span></label>
                                    <input type="text"
                                        placeholder="Enter Company Website Url. Ex:http://wwww.example.com"
                                        id="company_website" name="company_website" class="form-control">
                                    <p></p>
                                </div>

                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Contact Mail<span
                                                class="req">*</span></label>
                                        <input type="text" placeholder="Enter contact mail" id="email"
                                            name="email" class="form-control">
                                        <p></p>
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Contact Number<span
                                                class="req">*</span></label>
                                        <input type="tel" placeholder="Enter contact number" id="mobile"
                                            name="mobile" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer p-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
        $("#createJobForm").submit(function(e) {
            e.preventDefault()
            $("button[type='submit']").prop('disabled', true)
            $.ajax({
                url: "{{ route('user.job.submit') }}",
                type: 'post',
                dataType: 'json',
                data: $("#createJobForm").serializeArray(),
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
