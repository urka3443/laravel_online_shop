<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request\ProductFromRequest;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create(){
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.product.create', compact('categories','brands'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'slug' => 'required|unique:products,slug',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sale_percent' => 'required|numeric',
            'status' => 'nullable',
            'trending' => 'nullable',
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/product/'), $filename);
            $validatedData['image'] = 'uploads/product/'.$filename;
        }
        else{
            $validatedData['image'] = null;
        }

        $products = Product::query()->create([
            'category_id' => $validatedData['category_id'],
            'brand_id' => $validatedData['brand_id'],
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'quantity' => $validatedData['quantity'],
            'slug' => $validatedData['slug'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'sale_percent' => $validatedData['sale_percent'],
            'status' => $request->true ? 1 : 0,
            'trending' => $request->true ? 1 : 0,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function edit($id){
        $products = Product::query()->findOrFail($id);
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.edit', compact('products','brands','categories'));
    }

    public function update(request $request, $id){
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'slug' => 'required|unique:products,slug',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sale_percent' => 'required|numeric',
            'status' => 'nullable',
            'trending' => 'nullable',
        ]);

        $brands = Brand::query()->find($id);
        if($request->hasFile('image')){
            $destination=$brands->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $dilename = time() . '.' . $extension;
            $file->move('uploads/product/', $filename);

            $validatedData['image'] = 'uploads/product/' . $filename;
        }

        $products = Product::query()->findOrFail($id)->update([
            'category_id' => $validatedData['category_id'],
            'brand_id' => $validatedData['brand_id'],
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'quantity' => $validatedData['quantity'],
            'slug' => $validatedData['slug'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'sale_percent' => $validatedData['sale_percent'],
            'status' => $request->true ? 1 : 0,
            'trending' => $request->true ? 1 : 0,
        ]);
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id){
        $products = Product::query()->FindOrFail($id);
        $destination = $products->image;
        If(File::exists($destination)){
            File::delete($destination);
        }
        $products->delete();
        return redirect()->route('admin.products.index')->with('success','Product deleted successfully');
    }

   
}
