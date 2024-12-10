@extends('layouts.admin')
@section('content')
    <table id="example" class="table table-striped" style="width:100%">
         <a href="{{route('admin.brands.create')}}" class="btn btn-primary">
             Create
        </a>

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Status</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($brands as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>
                        <img src="{{asset($item->image)}}" class="avatar avatar-sm me-3 border-radius-lg" alt="image" width="150px" height="150px">
                    </td>
                    <td class="align-middle text-sm">
                        @if($item->status==0)
                            <span class="badge badge-sm bg-gradient-success">Public</span>
                        @elseif($item->status==1)
                            <span class="badge badge-sm bg-gradient-primary">Private</span>
                        @else
                            <span class="badge badge-sm bg-gradient-warning">Other</span>
                        @endif

                    </td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td>
                        <a href="{{ route('admin.brands.edit', $item->id) }}">Edit</a> |
                        <form action="{{ route('admin.brands.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Устгахдаа итгэлтэй байна уу?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary btn-sm">Delete</button>
                        </form>
                    </td> 
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No data available</td>
                </tr>
            @endforelse
        </tbody>       
    </table>      
@endsection
@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#example').DataTable();
         });
    </script>
@endpush
