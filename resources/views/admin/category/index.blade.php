@extends('layouts.admin')
@section('content')
    <table id="example" class="table table-striped" style="width:100%">
        <a href="{{route('admin.categories.create')}}" class="btn btn-primary">
             create
        </a>
        
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>
                        <img src="{{ asset($item->image) }}" alt="Image" width="100px">
                    </td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $item->id) }}">Edit</a> |
                        <form action="{{ route('admin.categories.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Устгахдаа итгэлтэй байна уу?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@endpush
