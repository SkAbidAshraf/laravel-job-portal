<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller   // 
{
    public function profile()
    {
        $user = User::find(Auth::user()->id);

        return view('front.user.profile', [
            'user' => $user,
        ]);
    }

    public function update()
    {
        $user = User::find(Auth::user()->id);

        return view('front.user.update', [
            'user' => $user,
        ]);
    }

    public function updateInformation(Request $request)
    {
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:20',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
            'mobile' => 'nullable|numeric|regex:/^01[0-9]{9}$/|unique:users,mobile,' . $id . ',id',
            'designation' => 'nullable|string'
        ]);

        if ($validator->passes()) {
            $user = User::find($id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->designation = $request->designation;

            $user->save();

            session()->flash('success', 'Profile updated successfully!');

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

    public function updateBio(Request $request)
    {
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'about' => 'nullable|string|max:65535', 
            'qualifications' => 'nullable|string|max:65535', 
            'experience' => 'nullable|string|max:65535',
            'portfolio' => 'nullable|url|max:255', 
            'date_of_birth' => 'nullable|date|before:today', 
            'address' => 'nullable|string|max:255'
        ]);

        if ($validator->passes()) {
            $user = User::find($id);

            $user->about = $request->about;
            $user->qualifications = $request->qualifications;
            $user->experience = $request->experience;
            $user->date_of_birth = $request->date_of_birth;
            $user->address = $request->address;
            $user->portfolio = $request->portfolio;

            $user->save();

            session()->flash('success', 'Profile information updated successfully!');

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

    public function updateProfilePic(Request $request)
    {
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'image' => 'required|image'
        ]);

        if ($validator->passes()) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = $id . '-' . time() . '.' . $ext;

            $image->move(public_path('/profile_picture/'), $imageName);

            File::delete(public_path('/profile_picture/' . Auth::user()->image));

            User::where('id', $id)->update(['image' => $imageName]);

            session()->flash('success', 'Profile picture updated successfully!');

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

    public function updatePassword(Request $request)
    {
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|max:255|same:confirm_new_password|different:current_password',
            'confirm_new_password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        } else {
            if (Hash::check($request->current_password, Auth::user()->password) == false) {
                return response()->json([
                    'status' => false,
                    'errors' => [
                        'current_password' => 'Current Password is incorrect'
                    ]
                ]);
            } else {
                $user = User::find(Auth::user()->id);
                $user->password = Hash::make($request->new_password);
                $user->save();

                session()->flash('success', 'Password updated successfully!');

                return response()->json([
                    'status' => true,
                    'errors' => []
                ]);
            }
        }
    }
}
