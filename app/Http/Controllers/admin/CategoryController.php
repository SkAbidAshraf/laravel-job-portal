<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::with('jobs')->with('jobs')->latest()->paginate(8);
        return view('admin.categories.index',[
            'categories' => $categories
        ]);
    }
 
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:20|unique:categories,name'
        ]);

        if ($validator->passes()) {
            $category = new Category();
            $category->name = $request->input('name');
            $category->status = 0;
            $category->save();

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
        $category = Category::find($request->id);

        if (!$category) {
            session()->flash('error', 'Category does not exist!');

            return response()->json([
                'status' => false,
                'message' => 'Category does not exist!'
            ]);
        }

        $category->delete();

        session()->flash('success', 'Category deleted successfully!');

        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully!'
        ]);
    }

    public function statusUpdate(Request $request)
    {
        $category = Category::find($request->id);

        if (!$category) {
            session()->flash('error', 'Job type does not exist!');

            return response()->json([
                'status' => false,
                'message' => 'Job type does not exist!'
            ]);
        }

        if ($category->status == 0) {
            $category->status = 1;
            $message = "The job type has been successfully activated. Employers can now add jobs under this type, and job listings will be visible to users.";
        } else {
            $category->status = 0;
            $message = "The job type has been successfully deactivated. Job listings under this type will no longer be visible to users.";
        }

        $category->save();

        session()->flash('success', $message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }
}
