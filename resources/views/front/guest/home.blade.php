@extends('front.layouts.app')

@section('title', 'Home')

@section('content')
    @include('front.partials.hero')

    @if ($popularCategories->isNotEmpty())
        <section class="section-2 bg-2 py-5 bg-light">
            <div class="container">
                <h2>Popular Categories</h2>
                <div class="row pt-5">
                    @foreach ($popularCategories as $popularCategory)
                        <div class="col-lg-4 col-xl-3 col-md-6">
                            <div class="single_catagory border">
                                <a href="{{ route('jobs') . '?category=' . $popularCategory->id }}">
                                    <h4 class="pb-2">{{ $popularCategory->name }}</h4>
                                </a>
                                <p class="mb-0"> <span class="">{{ $popularCategory->jobs->count() }}</span> Available Jobs</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($featuredJobs->isNotEmpty())
        <section class="section-3  py-5 bg-white">
            <div class="container">
                <h2>Featured Jobs</h2>
                <div class="row pt-5">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">
                                @foreach ($featuredJobs as $featuredJob)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card border-0 p-3 shadow mb-4">
                                            <div class="card-body">
                                                <h3 class="border-0 fs-5 pb-2 mb-0">{{ $featuredJob->title }}
                                                </h3>
                                                <p>{{ Str::words(strip_tags($featuredJob->description), 10) }}</p>
                                                <div class="bg-light p-3 border">
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $featuredJob->location }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{ $featuredJob->jobType->name }}</span>
                                                    </p>
                                                    @if (!is_null($featuredJob->salary))
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1">{{ $featuredJob->salary . ' TK' }}</span>
                                                        </p>
                                                    @endif
                                                </div>

                                                <div class="d-grid mt-3">
                                                    <a href="{{ route('jobs.details',$featuredJob->id) }}" class="btn btn-primary btn-lg">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($latestJobs->isNotEmpty())
        <section class="section-3 bg-2 py-5 bg-light">
            <div class="container">
                <h2>Latest Jobs</h2>
                <div class="row pt-5">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">
                                @foreach ($latestJobs as $latestJob)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card border-0 p-3 shadow mb-4">
                                            <div class="card-body">
                                                <h3 class="border-0 fs-5 pb-2 mb-0">{{ $latestJob->title }}
                                                </h3>
                                                <p>{{ Str::words(strip_tags($latestJob->description), 10) }}</p>
                                                <div class="bg-light p-3 border">
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $latestJob->location }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{ $latestJob->jobType->name }}</span>
                                                    </p>
                                                    @if (!is_null($latestJob->salary))
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1">{{ $latestJob->salary . ' TK' }}</span>
                                                        </p>
                                                    @endif
                                                </div>

                                                <div class="d-grid mt-3">
                                                    <a href="{{ route('jobs.details',$latestJob->id) }}" class="btn btn-primary btn-lg">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
