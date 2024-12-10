<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }
    public function create(){
        return view('admin.category.create');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/category'), $filename);
            $validatedData['image'] = 'uploads/category/'.$filename;
        }
        else{
            $validatedData['image'] = null;
        }

        Category::query()->create([
            'name' => $validatedData['name'],
            'image' => $validatedData['image'],
        ]);

        return redirect()->route('admin.categories.index')->with('success','Category created successfully');
    }

    public function edit($id){
        $categories = Category::query()->find($id);
        return view('admin.category.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $categories = Category::findOrFail($id);
    
        // Зураг орж ирсэн бол хадгална
        if ($request->hasFile('image')) {
            // Хуучин зураг байвал устгана
            if (File::exists($categories->image)) {
                File::delete($categories->image);
            }
    
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/category/', $filename);
            $validatedData['image'] = 'uploads/category/' . $filename;
        } else {
            // Хэрэв зураг орж ирээгүй бол default зураг хадгалагдана
            $validatedData['image'] = $categories->image ?: 'uploads/category/default.jpg';
        }
    
        // Update үйлдэл хийх
        $categories->update([
            'name' => $validatedData['name'],
            'image' => $validatedData['image'],
        ]);
    
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function imageDestroy($id)
    {
        $categories = CategoryImage::query()->findOrFail($id);

        if (File::exists($categories->image)){
            File::exists($categories->image);
        }

        $categories->delete();

        return redirect()->back()->width('delete', 'Зураг амжилттай устлаа.');
    }

    public function destroy($id){
        $categories = Category::query()->find($id);
        if(File::exists($categories->image)){
            File::exists($categories->image);
        }
        $categories->delete();

        return redirect()->route('admin.categories.index')->with('message','Category Deleted Successfully');
    }


}
