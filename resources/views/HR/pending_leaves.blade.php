@extends('layouts.hr_dashboard_layout')
@section('title',"Pending Leaves")
@push('script')
    <script src="/js/approve.js"></script>
@endpush
@section('content')
    <!-- Header -->
    <div class="fade modal" id="approveModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content col-lg-12" >
                <div class="modal-header row" style="border-bottom: 1px solid grey">
                    <h2 class="modal-title" style="font-size:30px">Confirm Leave</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body row col-lg-12 d-flex justify-content-center align-items-center">
                    <a href="" id="approveLeaveBtn" title=" Approve Leave" class="btn bg-gradient-red m-3 text-white shadow">
                        Approve<i class="ni ni-like-2"></i>
                    </a>
                    <a href="/yash" id="rejectLeaveBtn" title="Reject Leave" class="btn  bg-gradient-red m-3 text-white shadow">
                        Reject<i class="ni ni-like-2"></i>
                    </a>
                </div>
                <div class="modal-footer">
                    {{-- <input type="submit" name="submit" class="btn btn-success" value="Approve and Assign"> --}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            {{-- </form> --}}
            </div>

          </div>

    </div>
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
                  <li class="breadcrumb-item " aria-current="page">Pending Leaves</li>
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
            @if (Session::has("pendingLeaves"))
            <div class="row pendingLeavesRow">
                @foreach (Session::get("pendingLeaves") as $item)
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-header">
                                <div class="row">
                                        <h2 class=" text-uppercase  text-center text-muted "><i class="fas fa fa-3x"></i>{{$item->name}}</h2>
                                     {{-- <span class="h2 font-weight-bold mb-0">{{$item->apply_date}}</span> --}}
                                    </div>
                            </div>
                            <div class="card-body">
                                <div class="row col-xl-12 col-sm-12 mb-2">
                                    <div class="col-xl-12 col-sm-6 mb-1"><i class="fa fa-"></i> <span class=" h3 text-warning">Applied For : </span><span class="text-muted h4"> {{$item->leave_type}}</span></div>
                                    <div class="col-xl-12 col-sm-6"><i class="fa fa-"></i> <span class="h3 text-warning">Reason: </span><span class="text-muted h4"> {{$item->reason}}</span></div>
                                </div>
                                <div class="row col-xl-12 col-sm-12">
                                    <div class="col-xl-6 col-sm-6  text-center"><i class="fa fa-"></i> <span class=" h4 text-primary">From Date : </span><span class="text-muted h4"> {{$item->from_date}}</span></div>
                                    <div class="col-xl-6 col-sm-6 text-center"><i class="fa fa-"></i> <span class="h4 text-primary">To Date :&nbsp;&nbsp;&nbsp;&nbsp;  </span><span class="text-muted h4"> {{$item->to_date}}</span></div>
                                </div>
                                <div class="row col-xl-12 col-sm-12 mt-3">
                                    <div class="col-xl-12 col-sm-12  text-center"><i class="fa fa-"></i> <span class=" h4 text-muted">Leaves For<span class="text-warning"> {{$item->no_of_days}} days. </span></div>
                                </div>
                            </div>
                            <div class="card-footer col-auto">
                                <p class="mt-3 mb-0 text-sm float-left">
                                    <span class="text-success font-weight-bold mr-2"><i class="fa fa-clock"></i>  &nbsp; &nbsp;<span class="text-warning">Applied on :  </span> {{$item->apply_date}} </span>
                                </p>
                                <button id="approveBtn" title="Approve or Reject" data-sid="{{$item->id}}" data-toggle="modal" data-target="#approveModal" class="approveBtn float-right btn icon icon-shape  bg-gradient-red text-white shadow">
                                    <i class="ni ni-like-2"></i>
                                </button>
                                </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (strlen(Session::get("pendingLeaves")) < 3 )
            <h1 class="text-white " style="text-shadow: 1px 1px 1px red">You Don't Have any Pending Leaves Yet .</h1>
            @endif
            @endif
        </div>
      </div>
    </div>
    <!-- Page content -->


    <div class="container-fluid mt--6">
        <div class="row">
            {{-- <div class="col-xl-12">
              <div id="showData" class="card">
                <div class="card-header border-0">
                  <div class="row align-items-center">
                    <div class="col">
                      <h3 class="mb-0">Employee Details : </h3>
                    </div>
                    <div class="col text-right">
                      <a href="#!" class="btn btn-sm btn-primary">See all</a>
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
                        <th>Action</th>

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
                            <td> <button type="button" class="btn btn-default">Get Attendance Details</button>
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
            </div> --}}

          </div>
      @endsection
