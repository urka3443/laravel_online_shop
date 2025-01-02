@extends('layouts.admin')
@section('content')
    <table id="example" class="table table-striped" style="width:100%">
         <a href="{{route('admin.products.create')}}" class="btn btn-primary">
             Create
        </a>

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Description</th>
                <th>Sale Percent</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Trending</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->slug}}</td>
                    <td>
                        <img src="{{asset($item->image)}}" class="avatar avatar-sm me-3 border-radius-lg" alt="image" width="50px">
                    </td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->sale_precent}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->quantity}}</td>
                    <td class="align-middle text-sm">
                        @if($item->status==0)
                            <span class="badge badge-sm bg-gradient-success">Public</span>
                        @elseif($item->status==1)
                            <span class="badge badge-sm bg-gradient-primary">Private</span>
                        @else
                            <span class="badge badge-sm bg-gradient-warning">Other</span>
                        @endif

                    </td>
                    <td class="align-middle text-sm">
                        @if($item->trending == 1)
                            <span class="badge badge-sm bg-gradient-success">Trending</span>
                        @else
                            <span class="badge badge-sm bg-gradient-warning">Not Trending</span>
                        @endif
                    </td>
                    <td>
                    <div class="dropdown">
                        <button class="btn btn-white dropdown-toggle border-black text-black border-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Үйлдлүүд
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{route('admin.products.edit', $item->id)}}">
                                <i class="bi bi-pencil-fill"></i> Edit
                                </a>
                            </li>
                            <li>
                                <form action="{{route('admin.products.destroy', $item->id)}}" method="POST" class="s-inline w-100">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger p-2">
                                        <i class="bi bi-archive-fill"></i> Delete
                                    </button>
                                </form>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{route('admin.products.image', $item->id) }}">
                                    Product Image
                                </a>
                            </li>
                        </ul>
                        </div>
                    </td>
                    
                </tr>
            @endforeach
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
