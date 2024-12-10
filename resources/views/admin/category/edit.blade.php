@extends('layouts.admin')
@section('content')
     <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center p-2">
            <h6 class="m-2 font-weight-bold text-primary d-inline fs-5">Бүтээгдэхүүн Засах</h6>
            <a href="{{route('admin.categories.index')}}" class="btn btn-primary float-end">Буцах</a>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $ierror)
                          <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <form action="{{route('admin.categories.update', $categories->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>name</label>
                    <input type="text" name="name" class="form-control" placeholder="name" value="{{old('name', $categories->name)}}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>image</label>
                    <input type="file" name="image" class="form-control">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    @if($categories->image)
                        <img src="{{asset($categories->image)}}" alt="{{$categories->image}}" class="img-thumbnail mt-2" width="100">
                    @endif
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary float-end">Хадгалах</button>
                </div>
            </form>
        </div>
     </div>
@endsection