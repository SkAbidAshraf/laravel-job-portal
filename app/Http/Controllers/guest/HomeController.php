<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\JobListing;
use App\Models\JobType;
use App\Models\SavedJobs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $popularCategories = Category::active()->with([
            'jobs' => function ($query) {
                $query->approved();
            }
        ])->withCount([
            'jobs as approved_jobs_count' => function ($query) {
                $query->approved();
            }
        ])->orderByDesc('approved_jobs_count')->take(8)->get();

        $categories = Category::active()->orderBy('name', 'ASC')->get();

        $featuredJobs = JobListing::approved()->featured()->with('jobType')->latest()->take(6)->get();

        $latestJobs = JobListing::approved()->with('jobType')->latest()->take(6)->get();

        return view('front.guest.home', [
            'popularCategories' => $popularCategories,
            'categories' => $categories,
            'featuredJobs' => $featuredJobs,
            'latestJobs' => $latestJobs
        ]);
    }

    public function jobs(Request $request)
    {
        $categories = Category::active()->orderBy('name', 'ASC')->get();
        $jobTypes = JobType::active()->orderBy('name', 'ASC')->get();

        $jobs = JobListing::approved();

        if (!empty($request->keyword)) {
            $jobs = $jobs->where(function ($query) use ($request) {
                $query->orWhere('title', 'like', '%' . $request->keyword . '%');
                $query->orWhere('keywords', 'like', '%' . $request->keyword . '%');
            });
        }

        if (!empty($request->location)) {
            $jobs = $jobs->where('location', 'like', '%' . trim($request->location) . '%');
        }

        if (!empty($request->category)) {
            $jobs = $jobs->where('category_id', $request->category);
        }

        $jobTypeArray = [];

        if (!empty($request->jobType)) {
            $jobTypeArray = explode(',', $request->jobType);

            $jobs = $jobs->whereIn('job_type_id', $jobTypeArray);
        }

        if (!empty($request->experience)) {
            $jobs = $jobs->where('experience', $request->experience);
        }

        $jobs = $jobs->with('jobType')->with('category');

        if (!empty($request->sort) && $request->sort == "oldest") {
            $jobs = $jobs->oldest();
        } else {
            $jobs = $jobs->latest();
        }

        $jobs = $jobs->paginate(12);

        return view('front.guest.jobs', [
            'categories' => $categories,
            'jobTypes' => $jobTypes,
            'jobs' => $jobs,
            'jobTypeArray' => $jobTypeArray
        ]);
    }

    public function jobDetails($id)
    {
        $job = JobListing::approved()->where('id', $id)->with(['jobType', 'category', 'creator'])->first();

        if (!$job) {
            abort(404);
        }

        $hasSaved = false;

        if (Auth::check()) {
            $hasSaved = SavedJobs::where([
                'user_id' => Auth::user()->id,
                'job_listing_id' => $job->id
            ])->exists();
        }

        return view('front.guest.job_details', [
            'job' => $job,
            'hasSaved' => $hasSaved
        ]);
    }
}
