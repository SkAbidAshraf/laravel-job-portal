<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Mail\ApplicationApproveMail;
use App\Models\Category;
use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\JobType;
use App\Models\SavedJobs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class JobListingController extends Controller
{
    public function jobCreate()
    {
        $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
        $jobTypes = JobType::orderBy('name', 'ASC')->where('status', 1)->get();

        return view('front.user.job.create', [
            'categories' => $categories,
            'jobTypes' => $jobTypes,
        ]);
    }

    public function jobSubmit(Request $request)
    {
        response()->json(['status' => false, 'errors' => []]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:200',
            'category' => 'required|exists:categories,id',
            'jobType' => 'required|exists:job_types,id',
            'vacancy' => 'required|integer',
            'salary' => 'nullable|integer',
            'location' => 'required|string|min:3|max:100',
            'description' => 'required|string',
            'benefits' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'qualifications' => 'nullable|string',
            'keywords' => 'nullable|string',
            'experience' => 'required|in:none,1,2,3,4,5',
            'company_name' => 'required|string|min:3|max:75',
            'company_location' => 'nullable|string',
            'company_website' => 'required|url',
            'email' => 'required|email',
            'mobile' => 'required|numeric|regex:/^01[0-9]{9}$/'
        ]);

        if ($validator->passes()) {
            $job = new JobListing();

            $job->title = $request->title;
            $job->user_id = Auth::user()->id;
            $job->category_id = $request->category;
            $job->job_type_id = $request->jobType;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->responsibilities = $request->responsibilities;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
            $job->company_website = $request->company_website;
            $job->email = $request->email;
            $job->mobile = $request->mobile;
            $job->status = 0;
            $job->featured = 0;

            $job->save();

            session()->flash('success', 'Job added successfully! Your post will be visible after review.');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function myJobs()
    {
        $jobs = JobListing::where('user_id', Auth::user()->id)->with('jobType', 'category', 'application')->latest()->paginate(10);

        return view('front.user.job.all', [
            'jobs' => $jobs
        ]);
    }

    public function jobEdit($id)
    {
        $categories = Category::orderBy('name', 'ASC')->where('status', 1)->get();
        $jobTypes = JobType::orderBy('name', 'ASC')->where('status', 1)->get();

        $job = JobListing::Where([
            'id' => $id,
            'user_id' => Auth::user()->id
        ])->first();

        if ($job == null) {
            abort(404);
        }

        return view('front.user.job.edit', [
            'categories' => $categories,
            'jobTypes' => $jobTypes,
            'job' => $job
        ]);
    }

    public function jobUpdate(Request $request, $id)
    {
        response()->json(['status' => false, 'errors' => []]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:200',
            'category' => 'required|exists:categories,id',
            'jobType' => 'required|exists:job_types,id',
            'vacancy' => 'required|integer',
            'salary' => 'nullable|integer',
            'location' => 'required|string|min:3|max:100',
            'description' => 'required|string',
            'benefits' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'qualifications' => 'nullable|string',
            'keywords' => 'nullable|string',
            'experience' => 'required|in:none,1,2,3,4,5',
            'company_name' => 'required|string|min:3|max:75',
            'company_location' => 'nullable|string',
            'company_website' => 'required|url',
            'email' => 'required|email',
            'mobile' => 'required|numeric|regex:/^01[0-9]{9}$/'
        ]);

        if ($validator->passes()) {
            $job = JobListing::find($id);

            $job->title = $request->title;
            $job->user_id = Auth::user()->id;
            $job->category_id = $request->category;
            $job->job_type_id = $request->jobType;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->responsibilities = $request->responsibilities;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
            $job->company_website = $request->company_website;
            $job->email = $request->email;
            $job->mobile = $request->mobile;
            $job->featured = 0;

            $job->save();

            session()->flash('success', 'Job updated successfully! Your post will be visible after review.');

            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function jobDelete(Request $request)
    {
        $job = JobListing::where([
            'user_id' => Auth::user()->id,
            'id' => $request->jobId,
        ])->first();

        if ($job == null) {
            session()->flash('error', 'Job does not exist!');

            return response()->json([
                'status' => true,
                'message' => 'faild to delete'
            ]);
        }

        $job = JobListing::where('id', $request->jobId)->delete();

        session()->flash('success', 'Job deleted successfully!');

        return response()->json([
            'status' => true,
            'message' => 'deleted'
        ]);
    }

    public function jobView($id)
    {

        $job = JobListing::where([
            'id' => $id,
            'user_id' => Auth::user()->id
        ])->with(['jobType', 'category'])->first();

        if (!$job) {
            abort(404);
        }

        $applications = JobApplication::where([
            'job_listing_id' => $id,
        ])->with('user')->latest()->paginate(8);

        return view('front.user.job.details', [
            'job' => $job,
            'applications' => $applications,
        ]);
    }

    public function appliedJobs()
    {
        $applications = JobApplication::where('user_id', Auth::user()->id)->with('job', 'job.jobType', 'job.category')->latest()->paginate(10);

        return view('front.user.job.applied', [
            'applications' => $applications
        ]);
    }

    public function applicationDelete(Request $request)
    {

        $application = JobApplication::where([
            'user_id' => Auth::user()->id,
            'id' => $request->applicationId,
        ])->first();

        if ($application == null) {
            session()->flash('error', 'Job application does not exist!');

            return response()->json([
                'status' => true,
                'message' => 'faild to delete'
            ]);
        }

        $application = JobApplication::where('id', $request->applicationId)->delete();

        session()->flash('success', 'Job application deleted successfully!');

        return response()->json([
            'status' => true,
            'message' => 'deleted'
        ]);
    }

    public function savedJobs()
    {
        $savedJobs = SavedJobs::where('user_id', Auth::user()->id)->with('job', 'job.jobType', 'job.category')->latest()->paginate(10);

        return view('front.user.job.saved', [
            'savedJobs' => $savedJobs
        ]);
    }

    public function removeSave(Request $request)
    {

        $job = SavedJobs::where([
            'user_id' => Auth::user()->id,
            'id' => $request->jobId,
        ])->first();

        if ($job == null) {
            session()->flash('error', 'Record does not exist!');

            return response()->json([
                'status' => true,
                'message' => 'faild to remove'
            ]);
        }

        $job = SavedJobs::where('id', $request->jobId)->delete();

        session()->flash('success', 'job removed saved!');

        return response()->json([
            'status' => true,
            'message' => 'removed'
        ]);
    }

    public function removeApplicant(Request $request)
    {
        $jobApplication = JobApplication::where([
            'job_listing_id' => $request->jobListingId,
            'user_id' => $request->userId,
            'employer_id' => Auth::user()->id
        ])->first();

        if (!$jobApplication) {
            session()->flash('error', 'Job Application does not exist!');

            return response()->json([
                'status' => true,
                'message' => 'faild to delete'
            ]);
        }

        $jobApplication->delete();

        session()->flash('success', 'Job application deleted successfully!');

        return response()->json([
            'status' => true,
            'message' => 'deleted'
        ]);
    }

    public function applicantDetails($jobId, $userId)
    {
        $jobApplication = JobApplication::where([
            'job_listing_id' => $jobId,
            'user_id' => $userId,
            'employer_id' => Auth::user()->id
        ])->exists();

        if (!$jobApplication) {
            abort(404);
        } else {
            $jobApplication = JobApplication::where([
                'job_listing_id' => $jobId,
                'user_id' => $userId,
                'employer_id' => Auth::user()->id
            ])->with('job', 'user')->first();

            return view('front.user.job.applicant', [
                'jobApplication' => $jobApplication
            ]);
        }
    }

    public function approveApplication($jobId, $userId)
    {
        $jobApplication = JobApplication::where([
            'job_listing_id' => $jobId,
            'user_id' => $userId,
            'employer_id' => Auth::user()->id,
            'status' => 0
        ])->first();

        if (!$jobApplication) {
            abort(404);
        } else {
            $jobApplication->status = 1;
            $jobApplication->save();

            $employer = User::where('id', Auth::user()->id)->first();
            $job = JobListing::where('id', $jobId)->first();
            $user = User::where('id', $userId)->first();

            $mailData = [
                'employer' =>  $employer,
                'user' => $user,
                'job' => $job
            ];

            Mail::to($user->email)->send(new ApplicationApproveMail($mailData));

            return redirect()->back()->with('success', 'Application approved successfully! The applicant has been notified via email.');
        }
    }
}
