@extends('layouts.hr_dashboard_layout')
@section('title',"Pending EOD")
@push('script')
    <script src="/js/approve.js"></script>
@endpush
@section('content')
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              {{-- <h6 class="h2 text-white d-inline-block mb-0">Default</h6> --}}
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item " aria-current="page">Pending EOD</li>
                </ol>
            </nav>

        </div>
        <div class="col-lg-6 col-5 text-right">
                <h1 aria-label="breadcrumb" class="mt-4 text-white"></h1>
              {{-- <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
            </div>
          </div>
          <!-- Card stats -->
             <br>
             @if (Session::get("success"))
             <div class="err-msg alert alert-success animate__animated animate__slideInUp p-3">{{Session::get("success")}}</div>
           @endif
           @if (Session::get("error"))
             <div class="err-msg alert alert-danger animate__animated animate__slideInUp p-3">{{Session::get("error")}}</div>
           @endif
            @if (Session::has("approve"))
            <div class="row">
                @foreach (Session::get("approve") as $item)
                    <div class="col-xl-6 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                            <div class="row">
                                <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">{{$item->name}} </h5>
                                <span class="h2 font-weight-bold mb-0">{{$item->contact}}</span>
                                </div>
                                <div class="col-auto">
                                <button id="getDetails" title="View Employee Details" data-sid="{{$item}}" data-toggle="modal" data-target="#viewDetails" class="getDetails btn icon icon-shape  bg-gradient-red text-white shadow">
                                    <i class="ni ni-folder-17"></i>
                                </button>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="fa fa-clock"></i>  &nbsp; &nbsp;<span class="text-dark">Since  </span> {{$item->created_at}} </span>
                            </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
      </div>
    </div>
    <!-- Page content -->


    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12">
              <div id="showData" class="card">
                <div class="card-header border-0">
                  <div class="row align-items-center">
                    <div class="col">
                      <h3 class="mb-0">Employee Details : </h3>
                    </div>
                    <div class="col text-right">
                      {{-- <a href="#!" class="btn btn-sm btn-primary">See all</a> --}}
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <!-- Projects table -->
                    <table id="attendance_data_table" class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Personal Email<br> Address</th>
                        <th scope="col">Company Email <br> Address</th>
                        <th scope="col">Contact No.</th>
                        <th scope="col">Date of Birth</th>
                        <th scope="col">Joining Date</th>
                        <th scope="col">Designation</th>
                        {{-- <th>Action</th> --}}

                      </tr>
                    </thead>

                    <tbody id="attendance_data_tbody">
                        @if (Session::get("employeeDetails"))
                        @foreach (Session::get("employeeDetails") as $item)
                        <tr>
                            <td>{{$item->name}} </td>
                            <td>{{$item->email}} </td>
                            <td>{{$item->company_email}} </td>
                            <td>{{$item->contact}} </td>
                            <td>{{$item->dob}} </td>
                            <td>{{$item->joining_date}} </td>

                            <td>{{$item->designation}} </td>
                            {{-- <td> <button type="button" class="btn btn-default">Get Attendance Details</button> --}}
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            No Pending Attendance .
                        </tr>
                        @endif
                    </tbody>
                  </table>

                </div>
              </div>
            </div>

          </div>
@endsection
