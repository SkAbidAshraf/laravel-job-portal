@extends('front.layouts.app')

@section('title', 'Jobs')

@section('content')
    <section class="section-3 py-5 bg-2 ">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>Find Jobs</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <select name="sort" id="sort" class="form-control">
                            <option {{ Request::get('sort') == 'latest' ? 'selected' : '' }} value="latest">Latest
                            </option>
                            <option {{ Request::get('sort') == 'oldest' ? 'selected' : '' }} value="oldest">Oldest
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                    <form action="" name="searchForm" id="searchForm">
                        <div class="card border-0 shadow p-4">
                            <div class="mb-4">
                                <h2>Keywords</h2>
                                <input type="text" value="{{ Request::get('keyword') }}" name="keyword" id="keyword"
                                    placeholder="Keywords" class="form-control">
                            </div>

                            <div class="mb-4">
                                <h2>Location</h2>
                                <input type="text" value="{{ Request::get('location') }}" name="location" id="location"
                                    placeholder="Location" class="form-control">
                            </div>

                            @if ($categories->isNotEmpty())
                                <div class="mb-4">
                                    <h2>Category</h2>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select a Category</option>
                                        @foreach ($categories as $category)
                                            <option {{ Request::get('category') == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if ($jobTypes->isNotEmpty())
                                <div class="mb-4">
                                    <h2>Job Type</h2>
                                    @foreach ($jobTypes as $jobType)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input"
                                                {{ in_array($jobType->id, $jobTypeArray) ? 'checked' : '' }} name="job_type"
                                                type="checkbox" value="{{ $jobType->id }}"
                                                id="job-type-{{ $jobType->id }}">
                                            <label class="form-check-label"
                                                for="job-type-{{ $jobType->id }}">{{ $jobType->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mb-4">
                                <h2>Experience</h2>
                                <select name="experience" id="experience" class="form-control">
                                    <option value="">Select experience</option>
                                    <option {{ Request::get('experience') == 'none' ? 'selected' : '' }} value="none">No
                                        experience</option>
                                    <option {{ Request::get('experience') == '1' ? 'selected' : '' }} value="1">1+
                                        years of experience</option>
                                    <option {{ Request::get('experience') == '2' ? 'selected' : '' }} value="2">2+
                                        years of experience</option>
                                    <option {{ Request::get('experience') == '3' ? 'selected' : '' }} value="3">3+
                                        years of experience</option>
                                    <option {{ Request::get('experience') == '4' ? 'selected' : '' }} value="4">4+
                                        years of experience</option>
                                    <option {{ Request::get('experience') == '5' ? 'selected' : '' }} value="5">5+
                                        years of experience</option>
                                </select>
                            </div>

                            <div class="mb-4 d-grid">
                                <button class="btn btn-primary btn-lg" type="submit">Filter</button>
                                <a href="{{ route('jobs') }}" class="btn btn-outline-primary mt-2 btn-lg" type="submit">Clear</a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-8 col-lg-9 ">
                    @if ($jobs->isNotEmpty())
                        <div class="job_listing_area">
                            <div class="job_lists">
                                <div class="row">
                                    @foreach ($jobs as $job)
                                        <div class="col-12 col-lg-6 col-xxl-4">
                                            <div class="card border-0 p-3 shadow mb-4">
                                                <div class="card-body">
                                                    <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                                    <p>{{ Str::words(strip_tags($job->description), 10, '...') }}</p>
                                                    <div class="bg-light p-3 border">
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                            <span class="ps-1">{{ $job->location }}</span>
                                                        </p>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                            <span class="ps-1">{{ $job->jobType->name }}</span>
                                                        </p>
                                                        @if (!is_null($job->salary))
                                                            <p class="mb-0">
                                                                <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                                <span class="ps-1">{{ $job->salary . ' Tk' }}</span>
                                                            </p>
                                                        @endif
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-calendar"></i></span>
                                                            <span class="ps-1">{{ $job->carbonDate() }}</span>
                                                        </p>

                                                    </div>

                                                    <div class="d-grid mt-3">
                                                        <a href="{{ route('jobs.details',$job->id) }}" class="btn btn-primary btn-lg">Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 pt-3 border-top">{{ $jobs->withQueryString()->links() }}</div>
                    @else
                        <div class="fs-1 text-center p-5">No Jobs Found</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $("#searchForm").submit(function(e) {
            e.preventDefault();

            var url = "{{ route('jobs') }}?";

            var keyword = $("#keyword").val();
            var location = $("#location").val();
            var category = $("#category").val();
            var experience = $("#experience").val();
            var sort = $("#sort").val();
            var checkedJobTypes = $("input:checkbox[name='job_type']:checked").map(function() {
                return $(this).val();
            }).get();

            if (keyword != "") {
                url += "&keyword=" + keyword;
            }

            if (location != "") {
                url += "&location=" + location;
            }

            if (category != "") {
                url += "&category=" + category;
            }

            if (experience != "") {
                url += "&experience=" + experience;
            }

            if (checkedJobTypes.length > 0) {
                url += "&jobType=" + checkedJobTypes;
            }

            url += "&sort=" + sort;


            window.location.href = url;
        });

        $("#sort").change(function() {
            $("#searchForm").submit();
        })
    </script>
@endsection
