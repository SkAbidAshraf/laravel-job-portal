<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Mail\JobNotificationEmail;
use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\SavedJobs;
use App\Models\User;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobApplicationController extends Controller
{
    public function applyJob(Request $request)
    {
        $job_id = $request->id;


        $job = JobListing::where('id', $job_id)->with('creator')->first();

        if ($job == null) {
            session()->flash('error', 'Job does not exist!');

            return response()->json([
                'status' => false,
                'message' => 'Job not found'
            ]);
        }

        $employer_id = $job->user_id;

        if ($employer_id == Auth::user()->id) {
            session()->flash('error', 'You can not apply to your own job!');

            return response()->json([
                'status' => false,
                'message' => 'You can not apply to your own job!'
            ]);
        }

        $applicationExists = JobApplication::where([
            'job_listing_id' => $job_id,
            'user_id' => Auth::user()->id
        ])->exists();

        // $applicationExists = Auth::user()->jobApplications()->where('job_listing_id', $job_id)->exists();

        if ($applicationExists) {
            session()->flash('warning', 'You have already applied to this job!');

            return response()->json([
                'status' => true,
                'message' => 'You have already applied to this job!'
            ]);
        }

        $application = new JobApplication();
        $application->job_listing_id = $job_id;
        $application->user_id = Auth::user()->id;
        $application->employer_id = $employer_id;
        $application->applied_date = now();
        $application->save();

        $employer = User::where('id', $employer_id)->first();

        $mailData = [
            'employer' =>  $employer,
            'user' => Auth::user(),
            'job' => $job
        ];

        Mail::to($employer->email)->send(new JobNotificationEmail($mailData));

        session()->flash('success', 'You have applied to this job successfully!');

        return response()->json([
            'status' => true,
            'message' => 'You have applied to this job successfully!'
        ]);
    }

    public function saveJob(Request $request)
    {
        $job_id = $request->id;

        $job = JobListing::find($job_id);

        if (!$job) {
            session()->flash('error', 'Job not found!');

            return response()->json([
                'status' => false,
                'message' => 'Job not found!'
            ]);
        }

        $recoardExists = SavedJobs::where([
            'job_listing_id' => $job_id,
            'user_id' => Auth::user()->id
        ])->exists();

        if ($recoardExists) {
            SavedJobs::where([
                'job_listing_id' => $job_id,
                'user_id' => Auth::user()->id
            ])->delete();

            session()->flash('warning', 'Job is removed for letter!');

            return response()->json([
                'status' => false,
                'message' => 'Job is removed for letter!'
            ]);
        }

        $saveJob = new SavedJobs();
        $saveJob->job_listing_id = $job_id;
        $saveJob->user_id = Auth::user()->id;
        $saveJob->save();

        session()->flash('success', 'Job is saved for letter!');

        return response()->json([
            'status' => true,
            'message' => 'Job is saved for letter!'
        ]);
    }
}
