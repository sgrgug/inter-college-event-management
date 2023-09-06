@extends('admin.layouts.adminapp')

@section('content')
<link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables/datatables.css') }}"/>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> {{ __('Organization') }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin Panel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Organization</li>
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
                        <h5 class="modal-title" id="exampleModalLabel">New Organization</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <form action="{{ route('storeOrganization') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Name" value="" >
                                    @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Location <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="location" placeholder="location" value="" >
                                    @error('location')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control border-2 p-2" name="description" id="description" placeholder="Description" rows="10"></textarea>
                                    @error('description')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">User <span class="text-danger">*</span></label>
                                    {{-- <input type="text" class="form-control" name="user_id" placeholder="user_id" value="" > --}}
                                    <select name="user_id" class="form-control" id="">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Image <span class="text-danger">*</span></label><br />
                                    <input type="file" class="form-control" name="image">
                                    @error('image')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Please provide a valid zip.
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div></div>
                                    <input class="btn btn-primary" type="submit" value="Update">
                                </div>
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
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="border: 0px;">
                            @foreach ($organizations as $organization)
                                <tr style="{{ $loop->index % 2 == 0 ? 'background: #f8f8f8;' : '' }}">
                                    <td><img style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover;" src="{{ asset('uploads/'. $organization->photo) }}" alt=""></td>
                                    <td>{{ $organization->name }}</td>
                                    <td>{{ $organization->description }}</td>
                                    <td>{{ $organization->location }}</td>
                                    <td>
                                        <div class="d-flex justify-content-bewteen align-items-center">
                                            <div>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn text-success" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $organization->id }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal-{{ $organization->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-{{ $organization->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel-{{ $organization->id }}">{{ $organization->name }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                
                                                                <form action="{{ route('updateOrganization', $organization->id) }}" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">
                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $organization->name }}" >
                                                                            @error('name')
                                                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                                                            @enderror
                                                                            <div class="valid-feedback">
                                                                                Looks good!
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label">Location <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="location" placeholder="location" value="{{ $organization->location }}" >
                                                                            @error('location')
                                                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                                                            @enderror
                                                                            <div class="valid-feedback">
                                                                                Looks good!
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label">Description <span class="text-danger">*</span></label>
                                                                            <textarea class="form-control border-2 p-2" name="description" id="description" placeholder="Description" rows="10">{{ $organization->description }}</textarea>
                                                                            @error('description')
                                                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label">Creating Limit <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="noofcreation" placeholder="noofcreation" value="{{ $organization->noofcreation }}" >
                                                                            @error('noofcreation')
                                                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                                                            @enderror
                                                                            <div class="valid-feedback">
                                                                                Looks good!
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label">Pro Subscription</label><br/>
                                                                            <span class="{{ $organization->prosub == true ? 'text-success' : 'text-danger' }}">{{ $organization->prosub == true ? 'Subscribed' : 'Not Subscribed' }}</span>
                                                                        </div>
                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label">Image <span class="text-danger">*</span></label><br />
                                                                            <img style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;" src="{{ asset('uploads/'. $organization->photo) }}" alt="">
                                                                            <input type="file" class="form-control" name="image">
                                                                            @error('image')
                                                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                                                            @enderror
                                                                            <div class="invalid-feedback">
                                                                                Please provide a valid zip.
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <div></div>
                                                                            <input class="btn btn-primary" type="submit" value="Update">
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('deleteOrganization', $organization->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button data-toggle="tooltip" data-placement="top" title="Delete" class="btn text-danger" onclick="return confirm('Are you sure you want to delete this photo?')" ><i class="mdi mdi-delete-forever"></i></button>
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

<p class="text-primary">.text-primary</p>
<p class="text-secondary">.text-secondary</p>
<p class="text-success">.text-success</p>
<p class="text-danger">.text-danger</p>
<p class="text-warning">.text-warning</p>
<p class="text-info">.text-info</p>
<p class="text-light bg-dark">.text-light</p>
<p class="text-dark">.text-dark</p>
<p class="text-muted">.text-muted</p>
<p class="text-white bg-dark">.text-white</p>

<div class="p-3 mb-2 bg-primary text-white">.bg-primary</div>
<div class="p-3 mb-2 bg-secondary text-white">.bg-secondary</div>
<div class="p-3 mb-2 bg-success text-white">.bg-success</div>
<div class="p-3 mb-2 bg-danger text-white">.bg-danger</div>
<div class="p-3 mb-2 bg-warning text-dark">.bg-warning</div>
<div class="p-3 mb-2 bg-info text-white">.bg-info</div>
<div class="p-3 mb-2 bg-light text-dark">.bg-light</div>
<div class="p-3 mb-2 bg-dark text-white">.bg-dark</div>
<div class="p-3 mb-2 bg-white text-dark">.bg-white</div>

<script src="{{ asset('admin/assets/js/jquery.js') }}"></script>
<script src="{{ asset('admin/assets/vendors/datatables/datatables.js') }}"></script>
<script>
    let table = new DataTable('#myTable');
</script>
@endsection