@extends('layouts.admin')
@section('content')
     <div class="container">
        <a href="{{route('admin.products.index')}}" class="btn btn-secondary mb-3">Back</a>
        <h1>{{$products->name}} <span class="fs-3 opacity-50">- Бүтээгдэхүүний Зургууд</span></h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                         <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('admin.products.image.store', $products->id)}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label>Бүтээгдэхүүний зургууд</label>
                <input type="file" name="image[]" class="form-control" multiple accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">
                SAVE
            </button>
        </form>

        <h2 class="mt-5">Оруулсан зургууд</h2>
        <div class="row">
            @if($products->productImages && $products->productImages->count() > 0)
                @foreach($products->productImages as $image)
                     <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="{{asset($image->image)}}" class="card-img-top" alt="Бүтээгдэхүүний зураг" width="200px" height="150px">
                            <div class="card-body">
                               
                                <form id="delete-image-form-{{$image->id}}" action="{{route('admin.products.image.destroy', $image->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger delete-image-button" data-id="{{$image->id}}">DELETE</button>
                                </form>
                            </div>
                        </div>
                     </div>
                @endforeach
            @else
                <p>Энэ бүтээгдэхүүний хувьд зургууд байхгүй </p>
            @endif
        </div>
     </div>
@endsection