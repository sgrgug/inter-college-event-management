@extends('admin.layouts.adminapp')

@section('content')
<link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables/datatables.css') }}"/>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> {{ __('Review') }} </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">Review</li>
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
    
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    
                    <table style="font-size: 0.875rem; border: 0;" id="myTable">
                        <thead style="">
                            <tr style="">
                                <th>Event</th>
                                <th>User/Org</th>
                                <th>Rating</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody style="border: 0px;">
                            @foreach ($reviews as $item)
                                <tr style="{{ $loop->index % 2 == 0 ? 'background: #f8f8f8;' : '' }}">
                                    <td>
                                        <div>
                                            <b>{{ $item->event->name }}</b><br />
                                            @php
                                                $orgName = \App\Models\Organization::where('id', $item->event->organize_by)->first();
                                            @endphp
                                            {{ $orgName->name }}
                                        </div> 
                                    </td>
                                    <td>
                                        <div>
                                            @php
                                                $userName = \App\Models\User::where('id', $item->user_id)->first();
                                            @endphp
                                            {{ $userName->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-warning">{{ $item->rating }}</span>
                                    </td>
                                    <td>
                                        <div>
                                            {{ $item->comment }}
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