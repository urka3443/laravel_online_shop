@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <div class="content-head">
                        <h6 class="text-white text-capitalize ps-2 mb-0">Add Brand</h6>

                        <a href="{{route('admin.brands.index')}}">
                            Back
                        </a>
                    </div>
                    <div class="content-body">
                        <form action="{{route('admin.brands.store')}}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <div class="mb-3 inputs">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 inputs">
                                <label>Upload Image</label>
                                <input type="file" name="image" class="form-control">
                                @error( 'image' )
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>
                            <div class="mb-3 inputs">
                                <label>Is Public or Private</label>
                                <input type="checkbox" name="status">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">
                                    SAVE
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
@endsection