<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\File;


class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
    }

    public function create(){
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:brands|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'nullable',
        ]);
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
    
            $file->move('uploads/brand/', $filename);
            $validatedData['image'] = 'uploads/brand/' . $filename;
        } else {
            $validatedData['image'] = null;
        }
    
        Brand::create([
            'name' => $validatedData['name'],
            'image' => $validatedData['image'],
            'status' => $request->status ? 1 : 0,
        ]);
    
        return redirect()->route('admin.brands.index')->with('success', 'Brand added successfully');
    }
    
    public function edit($id){
        $brands = Brand::query()->find($id);
        return view('admin.brand.edit', compact('brands'));
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'status' => 'nullable',
    ]);

    $brands = Brand::findOrFail($id);

    // Зураг орж ирсэн бол хадгална
    if ($request->hasFile('image')) {
        // Хуучин зураг байвал устгана
        if (File::exists($brands->image)) {
            File::delete($brands->image);
        }

        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/brand/', $filename);
        $validatedData['image'] = 'uploads/brand/' . $filename;
    } else {
        // Хэрэв зураг орж ирээгүй бол default зураг хадгалагдана
        $validatedData['image'] = $brands->image ?: 'uploads/brand/default.jpg';
    }

    // Update үйлдэл хийх
    $brands->update([
        'name' => $validatedData['name'],
        'image' => $validatedData['image'],
        'status' => $request->status ? 1 : 0,
    ]);

    return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully');
}

    public function imageDestroy($id)
    {
        $brands = BrandImage::query()->findOrFail($id);

        if (File::exists($brands->image)){
            File::exists($brands->image);
        }

        $brands->delete();

        return redirect()->back()->width('delete', 'Зураг амжилттай устлаа.');
    }

    public function destroy($id){
        $brands = Brand::query()->find($id);
        if(File::exists($brands->image)){
            File::exists($brands->image);
        }
        $brands->delete();

        return redirect()->route('admin.brands.index')->with('message','Brand Deleted Successfully');
    }
}
