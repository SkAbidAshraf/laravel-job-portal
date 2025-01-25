<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereNot('id', Auth::user()->id)->with('jobListings', 'jobApplications')->paginate(10);

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function details($id)
    {
        $user = User::find($id);

        return view('admin.users.details', [
            'user' => $user
        ]);
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);

        if ($user->role == 'admin') {
            session()->flash('error', 'Yoe are not allowed delete another admin!');

            return response()->json([
                'status' => false,
                'message' => 'Yoe are not allowed delete another admin!'
            ]);
        }

        $user->delete();

        session()->flash('success', 'User deleted successfully!');

        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully!'
        ]);
    }

    public function makeAdmin(Request $request){
        $user = User::find($request->id);

        if ($user->role == 'admin') {
            session()->flash('error', 'User is alreary an Admin!');

            return response()->json([
                'status' => false,
                'message' => 'User is alreary an Admin!'
            ]);
        }

        $user->role = 'admin';
        $user->save();


        session()->flash('success', 'User is promoted to Admin successfully!');

        return response()->json([
            'status' => true,
            'message' => 'User is promoted to Admin successfully!'
        ]);

    }
}
