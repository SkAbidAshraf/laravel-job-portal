<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobListingController extends Controller
{
    public function index()
    {
        $jobs = JobListing::with('creator', 'application')->latest()->paginate(10);

        return view('admin.jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function details($id)
    {
        $job = JobListing::where('id', $id)->with('creator')->first();

        return view('admin.jobs.details', [
            'job' => $job
        ]);
    }

    public function statusUpdate(Request $request)
    {
        $job = JobListing::find($request->id);

        if (!$job) {
            session()->flash('error', 'Job does not exist!');

            return response()->json([
                'status' => false,
                'message' => 'Job does not exist!'
            ]);
        }

        if ($job->status == 1) {
            $job->status = 0;
        } else {
            $job->status = 1;
        }
        $job->save();

        session()->flash('success', 'Job status updated successfully!');

        return response()->json([
            'status' => true,
            'message' => 'Job status updated successfully!'
        ]);
    }

    public function updateFeatured(Request $request)
    {
        $job = JobListing::find($request->id);

        if (!$job) {
            session()->flash('error', 'Job does not exist!');

            return response()->json([
                'status' => false,
                'message' => 'Job does not exist!'
            ]);
        }

        if ($job->featured == 1) {
            $job->featured = 0;
            $message = "Job removed from featured successfully!";
        } else {
            $job->featured = 1;
            $message = "Job added to featured successfully!";
        }
        $job->save();

        session()->flash('success', $message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function delete(Request $request)
    {
        $job = JobListing::where('id', $request->id)->with('creator')->first();

        if (!$job) {
            session()->flash('error', 'Job does not exist!');

            return response()->json([
                'status' => false,
                'message' => 'Job does not exist!'
            ]);
        }

        if ($job->creator->role == 'admin' && $job->creator->id != Auth::user()->id) {
            session()->flash('error', 'You can not delete a job created by another admin!');

            return response()->json([
                'status' => false,
                'message' => 'You can not delete a job created by another admin!'
            ]);
        }

        $job->delete();

        session()->flash('success', 'Job deleted successfully!');

        return response()->json([
            'status' => true,
            'message' => 'Job deleted successfully!'
        ]);
    }
}
