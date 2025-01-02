<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;


class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $getRandomProducts = Product::inRandomOrder()->limit(3)->get();

        return view('user.dashboard', compact('products','categories','brands', 'getRandomProducts'));
    }

}
