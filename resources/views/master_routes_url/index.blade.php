@extends('layouts.panel')

@section('content')
    <style>
        button .list-group-item :hover {
            /* background-color: red;  */
        }

    </style>
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header card" id="grv_margin">
            <div class="row first_row_margin">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class=" fas fa-university mr-2"></i>
                        <div class="d-inline">
                            <h5> Url Information</h5>
                            <p class="heading_Bottom">url information</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <div class="buttons" style="text-align:right;margin:4px;">

                            <a href="{{ url('master_routes_url/create') }}"><button type="button"
                                    class="btn btn-primary btn_new"><i class="fas fa-plus mr-2"></i>Add New Url</button></a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid bg-white mt-2 mb-3 border_radius box">
                    <div class="row">
                        <div class="col-md-12 mt-3 mb-3">
                            <div class="container-fluid">
                                <div class="row first_row_margin">
                                    <div class="col-md-6">
                                        <h2 class="form-control-sm form_style yash_heading"><i
                                                class="fas fa-university mr-2"></i><b>Url Information</b>
                                        </h2>
                                    </div>
                                    <div class="col-md-6" style="text-align:right;">
                                        <a class="btn btn-link btn-primary" data-toggle="collapse"
                                            data-target="#collapseExample" aria-expanded="true"
                                            aria-controls="collapseExample" style="margin-top: 10px;">
                                            <i class="fa" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <hr class="border-dark bold">

                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="modulecontainer" data-toggle="table" style="display: inline-table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Url</th>
                                                   
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($master_route as $key => $value)
                                                    <td><input type="hidden" data-index="0" name="url_name"
                                                            value="{{ $value->id }}" readonly>{{ $value->url_name }}
                                                    </td>
                                                    <td><input type="hidden" data-index="0" name="url"
                                                            value="{{ $value->id }}" readonly>{{ $value->url }}
                                                    </td>
                                                  
                                                    <td><span class="dropdown open">
                                                        <button id="btnGroup" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="true"
                                                            class="btn btn-primary btn-sm dropdown-toggle dropdown-menu-right">
                                                            <i class="fas fa-cog"></i>
                                                        </button>
                                                        <span aria-labelledby="btnGroup"
                                                            class="dropdown-menu mt-1 dropdown-menu-right">
                                                            <form action="{{ route('master_routes_url.edit', $value->id) }}"
                                                                method="GET" class="blockuie dropdown-item"
                                                                style="margin-bottom:-10px">
                                                                @csrf

                                                                <button style="background:none;border: none;"
                                                                    type="submit"><i class="fas fa-pencil-alt"></i>
                                                                    Edit</button>
                                                            </form>

                                                            <form action="" method="GET" class="blockuie dropdown-item"
                                                                style="margin-bottom:-10px">
                                                                @csrf
                                                                <input type="text" id="route_id{{$value->id}}" name="route" hidden
                                                                    value="{{ 'master_routes_url' }}">
                                                                <input type="text" id="delete_id{{$value->id}}"  name="id" hidden
                                                                    value="{{ $value->id}}">
                                                                <button style="background:none;border: none;"
                                                                    type="button" onclick="confirMationAlert({{$value->id}})"><i
                                                                        class="fas fa-trash"
                                                                         ></i> delete</button>
                                                            </form>

                                                         
                                                        </span>
                                                    </span></td>

                                            
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   


                </div>
                <!-- Close Row -->
            </div>
            <!-- Close Container -->
        </div>
    @endsection
