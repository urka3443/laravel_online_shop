<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request\ProductFromRequest;
use App\Models\Product;
use App\Models\ProductImage;
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
        return view('admin.product.edit', compact('products','brands','categories'));
    }

    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'slug' => 'required|unique:products,slug,' . $id,
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sale_percent' => 'required|numeric',
            'status' => 'nullable',
            'trending' => 'nullable',
        ]);
    
        $products = Product::query()->findOrFail($id);
    
        if ($request->hasFile('image')) {
            $destination = public_path($products->image);
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/product/'), $filename);
            $validatedData['image'] = 'uploads/product/' . $filename;
        } else {
            $validatedData['image'] = $products->image;
        }
    
        $products->update([
            'category_id' => $validatedData['category_id'],
            'brand_id' => $validatedData['brand_id'],
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'quantity' => $validatedData['quantity'],
            'slug' => $validatedData['slug'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'sale_percent' => $validatedData['sale_percent'],
            'status' => $request->has('status') ? 1 : 0,
            'trending' => $request->has('trending') ? 1 : 0,
        ]);
    
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }
    
    public function image($id){
        $products = Product::query()->FindOrFail($id);

        return view('admin.product.image', compact('products'));
    }

    public function imageStore(Request $request,$id){
        $products = Product::query()->findOrFail($id);

        if($request->hasFile('image')){
            $uploadPath = 'uploads/product/images/';

            $i = 1;
            foreach($request->file('image') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extension;
                $file->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath . $filename;

                $products->productImages()->create([
                    'product_id' => $products->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product image updated successfully');
    }

    public function imageDestroy($id){
        $image = ProductImage::query()->findOrFail($id);

        if(File::exists($image->image)){
            File::delete($image->image);
        }

        $image->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product image deleted successfully');
    }

    public function destroy($id){
        $products = Product::query()->findOrFail($id);
        $destination=$products->image;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $products->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }



   
}
