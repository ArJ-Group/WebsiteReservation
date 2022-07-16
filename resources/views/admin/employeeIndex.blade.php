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
                <h4>Employee</h4>
                <span>Here List of our employee</span>
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
                    <form method="get" action="{{ route('employee.index') }}">
                        @csrf
                        <div class="pcoded-search-box d-flex">
                            <input name="search" type="text" class="mr-3" placeholder="Search">
                            <span>
                                <button class="btn btn-info"><i class="ti-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
                <button class="btn btn-primary ml-3" onclick="showFormAddEmployee(); return false;"><i
                        class="ti-plus"></i>Add Data</button>
            </div>
        </div>

        <!-- Form Add -->
        <div class="mx-3" style="display:none;" id="formAddEmployee">
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <h4 class="mb-3">New Employee</h4>
            <form method="post" action="{{ route('employee.store') }}" id="myForm" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Employee Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" placeholder="Enter Employee Name" name="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="skill" class="col-sm-3 col-form-label">Skill</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="skill" placeholder="Enter Employee Skill"
                            name="skill">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-8">
                        <textarea rows="5" cols="5" class="form-control" placeholder="Default textarea"
                            name="description" id="description"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="image">Photo</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="image" placeholder="Upload Image" name="image">
                    </div>
                </div>
                <div>
                    <a type="button" id="close" class="btn btn-primary btn-outline-primary"
                        onclick="hideForm()">Back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover" id="employeeTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Employee Name</th>
                        <th>Skill</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($employee as $e)
                    <tr>
                        <th scope="row">{{$no++}}</th>
                        <td>{{$e->name}}</td>
                        <td>{{$e->skill}}</td>
                        <td>{{$e->description}}</td>
                        <td><img width="45px" height="50px" src="{{asset('storage/'.$e->image) }}"></td>
                        <td style="display: flex">
                            <a type="button" class="btn btn-warning"
                                href="{{ route('employee.edit', $e->employee_id) }}"><i class="ti-marker-alt"></i></a>
                            <form style="margin-left: 5px" action="{{ route('employee.destroy', $e->employee_id) }}"
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

<script>
    function showFormAddEmployee(){
        console.log('OK')
        var formAdd = document.getElementById('formAddEmployee');
        var csTable = document.getElementById('employeeTable');
        var header = document.getElementById('header-content')
        console.log(header)
        if (formAdd.style.display === "none") {
            formAdd.style.display = "";
            csTable.style.display = "none";
            header.style.display= "none";
        } else {
            formAdd.style.display = "none";
            csTable.style.display = "";
            header.style.display = "block";
        }
    }

    function hideForm(){
        console.log('OK')
        var formAdd = document.getElementById('formAddEmployee');
        var csTable = document.getElementById('employeeTable');
        var header = document.getElementById('header-content')
        if (formAdd.style.display === "") {
            formAdd.style.display = "none";
            csTable.style.display = "";
            header.style.display= "";
        }
    }
</script>

@endsection