@extends('admin.layouts.adminapp')

@section('content')
<link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables/datatables.css') }}"/>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> {{ __('Events') }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin Panel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Events</li>
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
                        
                        <form action="{{ route('storeEvent') }}" method="post" enctype="multipart/form-data">
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
                                    <label class="form-label">Time <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" name="time" placeholder="time" value="" >
                                    @error('time')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select name="cat_id" id="" class="form-control">
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Organize By <span class="text-danger">*</span></label>
                                    <select name="organize_by" id="" class="form-control">
                                        @foreach ($orgs as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
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
                                <th>Category</th>
                                <th>Description</th>
                                <th>Location</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody style="border: 0px;">
                            @foreach ($events as $event)
                                <tr style="{{ $loop->index % 2 == 0 ? 'background: #f8f8f8;' : '' }}">
                                    <td><img style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover;" src="{{ asset('uploads/event/'. $event->photo) }}" alt=""></td>
                                    <td>
                                        <div>
                                            {{ $event->name }}<br />
                                            <small style="font-weight: bolder;"><i>{{ $event->organization->name }}</i></small>
                                        </div>
                                    </td>
                                    <td>{{ $event->category->cat_name }}</td>
                                    <td>
                                        {{ Illuminate\Support\Str::limit($event->description, $limit = 120); }}
                                    </td>
                                    <td>{{ $event->location }}</td>
                                    <td>{{ $event->start }}</td>
                                    <td>
                                        <div class="d-flex justify-content-bewteen align-items-center">
                                            <div>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn text-success" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $event->id }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal-{{ $event->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-{{ $event->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel-{{ $event->id }}">{{ $event->name }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                
                                                                <form action="{{ route('updateEvent', $event->id) }}" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">
                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $event->name }}" >
                                                                            @error('name')
                                                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                                                            @enderror
                                                                            <div class="valid-feedback">
                                                                                Looks good!
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label">Location <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="location" placeholder="location" value="{{ $event->location }}" >
                                                                            @error('location')
                                                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                                                            @enderror
                                                                            <div class="valid-feedback">
                                                                                Looks good!
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label">Description <span class="text-danger">*</span></label>
                                                                            <textarea class="form-control border-2 p-2" name="description" id="description" placeholder="Description" rows="10">{{ $event->description }}</textarea>
                                                                            @error('description')
                                                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label">Time <span class="text-danger">*</span></label>
                                                                            <input type="datetime-local" class="form-control" name="time" placeholder="time" value="{{ $event->start }}" >
                                                                            @error('time')
                                                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                                                            @enderror
                                                                            <div class="valid-feedback">
                                                                                Looks good!
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label">Category <span class="text-danger">*</span></label>
                                                                            <select name="cat_id" id="" class="form-control">
                                                                                @foreach ($categories as $item)
                                                                                    <option @selected($event->cat_id == $item->id) value="{{ $item->id }}">{{ $item->cat_name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label">Organize By <span class="text-danger">*</span></label>
                                                                            <select name="organize_by" id="" class="form-control">
                                                                                @foreach ($orgs as $item)
                                                                                    <option @selected($event->organize_by == $item->id) value="{{ $item->id }}">{{ $item->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label">Image <span class="text-danger">*</span></label><br />
                                                                            <img style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;" src="{{ asset('uploads/event/'. $event->photo) }}" alt="">
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
                                            <form action="{{ route('deleteEvent', $event->id) }}" method="POST" style="display: inline-block;">
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