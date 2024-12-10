@extends('layouts.admin')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8">
                <form action="{{route('admin.categories.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 inputs">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
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
                    <button type="submit" class="btn btn-primary mt-2">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
