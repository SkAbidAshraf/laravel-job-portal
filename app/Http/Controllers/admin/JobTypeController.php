<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class JobTypeController extends Controller
{
    public function index()
    {
        $jobTypes = JobType::with('jobs')->with('jobs')->latest()->paginate(8);
        return view('admin.jobtypes.index', [
            'jobTypes' => $jobTypes
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:20|unique:job_types,name'
        ]);

        if ($validator->passes()) {
            $jobType = new JobType();
            $jobType->name = $request->input('name');
            $jobType->status = 0;
            $jobType->save();

            session()->flash('success', 'New job type created successfully!');

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

    public function delete(Request $request)
    {
        $jobType = JobType::where('id', $request->id);

        if (!$jobType) {
            session()->flash('error', 'Job type does not exist!');

            return response()->json([
                'status' => false,
                'message' => 'Job type does not exist!'
            ]);
        }

        $jobType->delete();

        session()->flash('success', 'Job type deleted successfully!');

        return response()->json([
            'status' => true,
            'message' => 'Job type deleted successfully!'
        ]);
    }

    public function statusUpdate(Request $request)
    {
        $jobType = JobType::find($request->id);

        if (!$jobType) {
            session()->flash('error', 'Job type does not exist!');

            return response()->json([
                'status' => false,
                'message' => 'Job type does not exist!'
            ]);
        }

        if ($jobType->status == 0) {
            $jobType->status = 1;
            $message = "The job type has been successfully activated. Employers can now add jobs under this type, and job listings will be visible to users.";
        } else {
            $jobType->status = 0;
            $message = "The job type has been successfully deactivated. Job listings under this type will no longer be visible to users.";
        }

        $jobType->save();

        session()->flash('success', $message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }
}
