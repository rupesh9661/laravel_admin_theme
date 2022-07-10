@extends('layouts.panel')

@section('content')
  
    <div class="container-fluid bg-white mt-4 mb-3 border_radius box">
        <div class="row mt-4" >
            <div class="col-md-12 mt-4 mb-3">
                <form action="{{ route('master_routes_url.store') }}" method="POST">
                    @csrf
                    <div class="container-fluid">
                        <div class="row first_row_margin">
                            <div class="col-md-6">
                                <h2 class="form-control-sm form_style yash_heading"><i
                                        class="fas fa-university mr-2"></i><b>Add New Url</b></h2>
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
                                <label for="bank_Name" class="yash_star"
                                    style="margin-bottom:0px;">Url Name</label>
                                <input type="text" name="url_name" id="url_Name" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-3 mb-3 ">
                                <label for="bank_Name" class="yash_star"
                                    style="margin-bottom:0px;">Url </label>
                                <input type="text" name="url" id="url_Name" class="form-control"
                                     required>
                            </div>
                            {{-- <div class="col-md-3 mb-3 ">
                                <label class="yash_star" style="margin-bottom:0px;">Status </label>
                                <select name="status" class="fstdropdown-select" required>
                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div> --}}

                            <div class="col-md-12" style="text-align: right;">
                                <hr class="mt-3 border-dark bold">

                                <button class="blob-btn" id="cancelbtn" action="action" type="reset"><i
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
                        </div>
                    </div>
                </form>
            </div>
            <!-- Close Row -->
        </div>
        <!-- Close Container -->
    </div>
    @endsection
