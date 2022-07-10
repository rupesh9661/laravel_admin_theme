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
                            <h5>Url Access Information</h5>
                            <p class="heading_Bottom">Assign Url To User </p>
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

                            <form action="DesignationStore" method="POST">
                                @csrf
                                <div class="container-fluid">
                                    <div class="row first_row_margin">
                                        <div class="col-md-6">
                                            <h2 class="form-control-sm form_style yash_heading"><i
                                                    class="fas fa-university mr-2"></i><b>User Module Information</b>
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
                                    <div class="form-row mt-3 mb-3 collapse show" id="collapseExample">

                                        <div class="col-md-3 mb-3 ">
                                            <label class="yash_star" style="margin-bottom:0px;">Select User
                                            </label>

                                            <select name="user_id" id="user" class="chosen-select"
                                                onchange="getModulePrevAccess(this.value)">
                                                <option value="">Select</option>
                                                @foreach ($user as $key)
                                                    @if (Request::get('user_id') == $key->id)
                                                        <option selected value="{{ $key->id }}">{{ $key->full_name }}
                                                        @else
                                                        <option value="{{ $key->id }}">{{ $key->full_name }}
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>



                                        <div class="col-md-3 mb-3 ">
                                            <label class="yash_star" style="margin-bottom:0px;">Select Modules
                                            </label>

                                            <select name="module_id" id="module" class="chosen-select"
                                                onchange="getUserdata(this.value)">
                                                <option value="">Select</option>
                                                @foreach ($master_routes as $module)
                                                    @if (Request::get('master_routes') == $module->id)
                                                        <option selected value="{{ $module->id }}">{{ $module->url_name }}
                                                        @else
                                                        <option value="{{ $module->id }}">{{ $module->url_name }}
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                   <div class="col-md-6 mb-3 mt-3 ">
                                    <button class="blob-btn" id="cancelbtn" action="action"
                                    type="reset"><i
                                       class="fas fa-times pr-2"></i>
                                   Cancel
                                   <span class="blob-btn__inner">
                                       <span class="blob-btn__blobs">
                                           <span class="blob-btn__blob"></span>
                                           <span class="blob-btn__blob"></span>
                                           <span class="blob-btn__blob"></span>
                                           <span class="blob-btn__blob"></span>
                                       </span>
                                   </span>
                               </button>
                               <button id="submitbtn" type="submit" class="blob-btn1"><i
                                       class="fas fa-check pr-2"></i>
                                   Save Changes
                                   <span class="blob-btn__inner1">
                                       <span class="blob-btn__blobs1">
                                           <span class="blob-btn__blob1"></span>
                                           <span class="blob-btn__blob1"></span>
                                           <span class="blob-btn__blob1"></span>
                                           <span class="blob-btn__blob1"></span>
                                       </span>
                                   </span>
                               </button>
                                   </div>



                                    <div class="col-md-12">
                                        <table id="modulecontainer" data-toggle="table" class="table table-bordered w-100"
                                            style="display: none">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Permisson</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($master_routes as $module_key => $value)
                                                    <td><input type="hidden" name="url_name[]"
                                                            value="{{ $value->id }}">{{ $value->url_name }}</td>
                                                    <td ><input id="module{{ $value->id }}"
                                                            name="persmission[{{$value->id}}]" class="permission_checkbox" value="1"
                                                            type="checkbox"></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>



                                    <div class="col-md-12">
                                        <table id="usercontainer" data-toggle="table" class="table table-bordered w-100"
                                            style="display: none">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Permisson</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user as $user_key => $user_details)
                                                    <td>{{ $user_details->full_name }}</td>
                                                    <td ><input id="user{{ $user_details->id }}"
                                                            class="user_permission_checkbox"
                                                            name="user_permission[{{ $user_details->id }}]" value="1"
                                                            type="checkbox"></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>



                              

                                  
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- Close Row -->
            </div>
            <!-- Close Container -->
        </div>
    @endsection

    @section('js')
        <script>
            function getModulePrevAccess(user) {
                document.getElementById("usercontainer").style.display = "none";
                $("#module").val('').trigger("chosen:updated");

                $(".permission_checkbox").each(function() {
                    $(this).attr('checked', false);
                })

                var id = user;
                document.getElementById("modulecontainer").style.display = "block";

                $.ajax({
                    type: "GET",
                    url: 'GetUserId/' + id,

                    success: function(data) {
                        $.each(data, function(indexInArray, valueOfElement) {
                            $.each(valueOfElement, function(key, value) {
                                var ab = value.url_id;
                                var bb = value.persmission;
                                $("#module" + ab).attr('checked', 'checked');

                            });

                        });


                    }
                });




            }
        </script>

        <script>
            function getUserdata(id) {
                $(".user_permission_checkbox").each(function() {
                    $(this).attr('checked', false);
                })
                var module_id = id;
                document.getElementById("modulecontainer").style.display = "none";
                $("#user").val('').trigger("chosen:updated");

                document.getElementById("usercontainer").style.display = "block";


                $.ajax({
                    type: "GET",
                    url: 'getUsers/' + module_id,

                    success: function(data) {
                        $.each(data, function(data_key , data_value){
                            $.each(data_value, function(each_key , each_value){
                            checkboxid= each_value.user_id;
                            $("#user" + checkboxid).attr('checked', 'checked');
                        })
                    })

                       


                    }
                });
            }
        </script>
    @endsection
