@extends('layouts.admin')
@section('content')
<div class="card pt-3">
    <div class="ml-3">
        <div class="page-header-title">
            <i class="icofont icofont-table bg-c-blue"></i>
            <div class="d-inline">
                <h4>Judul Tabel</h4>
            </div>
        </div>
    </div>
    <div class="card-header">
        <h5>Basic table</h5>
        <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
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
        <div class="table-responsive">
            <div class="d-flex ml-3 mb-3">
                <div class="pcoded-search" style="width: 500px !important;">
                    <span class="searchbar-toggle"></span>
                    <form action="">
                        <div class="pcoded-search-box d-flex">
                            <input type="text" class="mr-3" placeholder="Search">
                            <span>
                                <button class="btn btn-info"><i class="ti-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
                <button class="btn btn-primary ml-3"><i class="ti-plus"></i>Add Data</button>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>
                            <button class="btn btn-warning"><i class="ti-marker-alt"></i></button>
                            <button class="btn btn-danger"><i class="ti-trash"></i></button>
                            <button class="btn btn-inverse" data-toggle="tooltip" data-original-title="lihat detail"><i
                                    class="ti-zoom-in"></i>Show</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Basic table card end -->
@endsection
