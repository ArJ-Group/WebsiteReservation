@extends('layouts.admin')
@section('content')
<div>
    @if ($message = Session::get('fail'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Failed!!</strong><span> {{ $message }}</span>
    </div>
    @elseif ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!!</strong><span> {{ $message }}</span>
    </div>
    @endif
</div>
<div class="card pt-3">
    <div class="ml-3">
        <div class="page-header-title">
            <i class="icofont icofont-table bg-c-blue"></i>
            <div class="d-inline">
                <h4>Reservation Status</h4>
                <span>Here the Reservation Status</span>
            </div>
        </div>
    </div>
    <div class="card-header">
        <div class="card-header-right">
            <ul class="list-unstyled card-option">
                <li><i class="icofont icofont-simple-left "></i></li>
                <li><i class="icofont icofont-maximize full-card"></i></li>
                <li><i class="icofont icofont-minus minimize-card"></i></li>
                <li><i class="icofont icofont-refresh reload-card"></i></li>
                <li><i class="icofont icofont-error close-card"></i></li>
            </ul>
        </div>
    </div>
    <div class="card-block table-border-style">
        <div id="header-content">
            <div class="d-flex mx-3 mb-3" style="justify-content:space-between !important">
                <div class="pcoded-search" style="width: 500px !important;">
                    <span class="searchbar-toggle"></span>
                    <form method="get" action="{{ route('reservationStatus.index') }}">
                        @csrf
                        <div class="pcoded-search-box d-flex">
                            <input name="search" type="text" class="mr-3" placeholder="Search">
                            <span>
                                <button class="btn btn-info"><i class="ti-search"></i></button>
                            </span>
                        </div>

                    </form>
                </div>
                <a type="button" class="btn btn-primary ml-3" href="{{route('printPdf')}}" target="_blank"
                    rel="noopener noreferrer"><i class="ti-download"></i>Export To PDF</a>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover" id="serviceTable">
                <thead>
                    <tr>

                        <th>Reservation Code</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservationStatus as $rs)
                    <tr>
                        <td>{{$rs->reservation_code}}</td>
                        <td>{{$rs->price}}</td>
                        <td>
                            <div id="status{{$rs->reservation_status_id}}">
                                @if($rs->status)
                                Done
                                @else
                                Waiting Customer
                                @endif
                            </div>
                            <div id="editStatus{{$rs->reservation_status_id}}" style="display:none">
                                <form method="post"
                                    action="{{ route('reservationStatus.update', $rs->reservation_status_id) }}"
                                    style="display: flex">
                                    @csrf
                                    @method('PUT')
                                    <select style="margin-top: 5px" name="status" class="form-control">
                                        <option value="0">Waiting Customer</option>
                                        <option value="1">Done</option>
                                    </select>
                                    <div style="margin-top: 5px; margin-left: 10px">
                                        <button type="submit" class="btn btn-primary">Done</button>
                                        <a href="" class="btn btn-sm" onclick = "$('#editStatus{{$rs->reservation_status_id}}').hide(); $('#status{{$rs->reservation_status_id}}').show(); return false; ">&times;</a>
                                    </div>
                                </form>
                            </div>
                        </td>
                        <td style="display: flex">
                            <a type="button" class="btn btn-warning" href=""
                                onclick="$('#editStatus{{$rs->reservation_status_id}}').show(); $('#status{{$rs->reservation_status_id}}').hide(); return false; ">
                                <i class="ti-marker-alt"></i></a>
                            <form style="margin-left: 5px"
                                action="{{ route('reservationStatus.destroy',$rs->reservation_status_id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="ti-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>


@endsection