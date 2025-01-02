@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-head">
                        <h4>
                            Add Product
                            <a href="{{route('admin.products.index')}}" class="btn btn-primary">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-warning">
                                @foreach($errors->all() as $error)
                                    <div>{{ $error }}</div>   
                                @endforeach
                            </div>
                        @endif

                        <form action="{{route('admin.products.update', $products->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" disabled>Disabled</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                                    <div class="mb-3">
                                        <select name="category_id" class="form-control" id="category_id" required>
                                            <option>Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <select name="brand_id" class="form-control" id="brand_id" required>
                                            <option>Select Brand</option>
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="text" name="name" class="form-control" value="{{old('name', $products->name)}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Product Slug</label>
                                        <input type="text" name="slug" class="form-control" value="{{old('slug', $products->slug)}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" class="form-control" row="4">{{old('description', $products->description)}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status">Status</label>
                                        <input type="checkbox" name="status" value="{{ old('status', $products->status) ? 'checked' : '' }}">
                                    </div>
                                    
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                                    <div class="mb-3">
                                        <label >Upload Image</label>
                                        <input type="file" name="image" class="form-control" >
                                        @if($products->image)
                                             <img src="{{asset($products->image)}}" alt="{{ $products->name }}" width="100px">
                                        @endif

                                    </div>
                                    <div class="mb-3">
                                        <label class="form-control">Price</label>
                                        <input type="number" name="price" class="form-control" value="{{old('price', $products->price)}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-control">Sale Percent</label>
                                        <input type="number" name="sale_percent" max="100" class="form-control" value="{{old('sale_percent', $products->sale_percent)}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-control">Quantity</label>
                                        <input type="number" name="quantity" class="form-control" value="{{old('quantity', $products->quantity)}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="trending">Trending</label>
                                        <input type="checkbox" name="trending"  class="form-checkbox" value="{{old('trending' ? 'checked' : '')}}">
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary" type="submit">
                                            Save
                                        </button>
                                    </div> 
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                                    
                                </div>
                                <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                

            </div>
        </div>
    </div>

@endsection
