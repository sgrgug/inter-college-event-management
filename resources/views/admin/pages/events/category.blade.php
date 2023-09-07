@extends('admin.layouts.adminapp')

@section('content')
<link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables/datatables.css') }}"/>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> {{ __('Category') }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">Category</li>
            </ol>
        </nav>
    </div>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible text-white" role="alert">
            <span class="text-sm" style="color: #5c4d4d;">
                {{ session('status') }}
            </span>
            <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary text-white my-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <form action="{{ route('storeCategory') }}" method="post">
                            @csrf
                            <div class="row">
                                <div>
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Name" >
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary mt-3">Add</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    
                    <table style="font-size: 0.875rem; border: 0;" id="myTable">
                        <thead style="">
                            <tr style="">
                                <th>S.N</th>
                                <th>Category</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="border: 0px;">
                            @foreach ($categories as $item)
                                <tr style="{{ $loop->index % 2 == 0 ? 'background: #f8f8f8;' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div>
                                            {{ $item->cat_name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            {{ $item->created_at }}
                                        </div>
                                    </td>
                                    <td>
                                        
                                        <div class="d-flex justify-content-bewteen align-items-center">
                                            <div>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn text-success" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $item->id }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-{{ $item->id }}" aria-hidden="true">
                                                    <div class="modal-dialog        ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel-{{ $item->id }}">{{ $item->cat_name }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                
                                                                <form action="{{ route('updateCategory', $item->id) }}" method="post">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">
                                                                        <div>
                                                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $item->cat_name }}" >
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <button type="submit" class="btn btn-primary mt-3">Add</button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('deleteCategory', $item->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button data-toggle="tooltip" data-placement="top" title="Delete" class="btn text-danger" onclick="return confirm('Are you sure you want to delete this?')" ><i class="mdi mdi-delete-forever"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('admin/assets/js/jquery.js') }}"></script>
<script src="{{ asset('admin/assets/vendors/datatables/datatables.js') }}"></script>
<script>
    let table = new DataTable('#myTable');
</script>
@endsection