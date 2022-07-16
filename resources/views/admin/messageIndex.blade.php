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
<div class="page-body">
    <div class="card">
        <div class="mt-3 ml-3">
            <div class="page-header-title">
                <i class="icofont icofont-table bg-c-blue"></i>
                <div class="d-inline">
                    <h4>Message</h4>
                    <span>Here list of message sent by Customer</span>
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
                    <div class="pcoded-search" id="search" style="width: 500px !important;">
                        <span class="searchbar-toggle"></span>
                        <form method="get" action="{{ route('message.index') }}">
                            @csrf
                            <div class="pcoded-search-box d-flex">
                                <input name="search" type="text" class="mr-3" placeholder="Search">
                                <span>
                                    <button class="btn btn-info"><i class="ti-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-hover" id="categoryServiceTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Title</th>
                            <th width="50px !important">Message Text</th>
                            <th>Show</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($msg as $m)
                        <tr>
                            <th scope="row">{{$no++}}</th>
                            <td>{{$m->name}}</td>
                            <td>{{$m->email}}</td>
                            <td>
                                <p class="long-title">{{$m->title}}</p>
                            </td>
                            <td>
                                <p class="long-text">{{$m->messagetext}}</p>
                            </td>
                            <td>
                                <div id="message{{$m->message_id}}">
                                    @if($m->show)
                                    Yes
                                    @else
                                    No
                                    @endif
                                </div>
                                <div id="editMessage{{$m->message_id}}" style="display:none">
                                    <form method="post" action="{{ route('message.update', $m->message_id) }}"
                                        style="display: flex">
                                        @csrf
                                        @method('PUT')
                                        <select style="margin-top: 5px" name="show" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                        <div style="margin-top: 5px; margin-left: 10px">
                                            <button type="submit" class="btn btn-sm btn-primary"><i
                                                    class="ti-check"></i></button>
                                                    <a href="" onclick="$('#editMessage{{$m->message_id}}').hide(); $('#message{{$m->message_id}}').show(); return false; " class = "btn btn-sm">&times;</a>
                                        </div>
                                    </form>
                                </div>
                            </td>
                            <td style="display: flex">
                                <a type="button" class="btn btn-warning" href=""
                                    onclick="$('#editMessage{{$m->message_id}}').show(); $('#message{{$m->message_id}}').hide(); return false; "><i
                                        class="ti-marker-alt"></i></a>
                                <form style="margin-left: 5px" action="{{ route('message.destroy', $m->message_id) }}"
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
</div>




@endsection