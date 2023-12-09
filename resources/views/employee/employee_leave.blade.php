@extends('layouts.employee_dashboard_layout')
@push('styles')
    <link rel="stylesheet" href="css/modal.css">
@endpush
@push('script')
    <script src="/js/time.js"></script>
    <script src="/js/attendanceData.js"></script>
@endpush
@section('content')
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
                  <li class="breadcrumb-item " aria-current="page">Leave Status</li>
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
                      <h3 class="mb-0">Applied Leaves Status : </h3>
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
                        <th scope="col">Applied On </th>
                        <th scope="col">Leave Type</th>
                        <th scope="col">Reason</th>
                        <th scope="col">From Date</th>
                        <th scope="col">To Date</th>
                        <th scope="col">Status</th>
                        {{-- <th>Action</th> --}}

                      </tr>
                    </thead>

                    <tbody>
                        @if (Session::get("leaves"))
                        @foreach (Session::get("leaves") as $item)
                        <tr>
                            <td>{{$item->apply_date}} </td>
                            <td>{{$item->leave_type}} </td>
                            <td>{{$item->reason}} </td>
                            <td>{{$item->from_date}} </td>
                            <td>{{$item->to_date}} </td>
                            <td>
                                @if($item->leave_status ==1)
                                <a class="btn text-success">Approved</a>
                                @elseif($item->leave_status ==2)
                                <a class="btn text-danger">Rejected</a>
                                @else
                                <a class="btn text-warning">Pending..</a>
                                @endif
                            </td>



                        </tr>
                        @endforeach

                        @endif
                    </tbody>
                  </table>

                </div>
              </div>
            </div>

          </div>
@endsection


