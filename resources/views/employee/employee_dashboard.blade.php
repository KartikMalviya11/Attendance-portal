@extends('layouts.employee_dashboard_layout')
@push('styles')
    <link rel="stylesheet" href="css/modal.css">
@endpush
@push('script')
    <script src="/js/time.js"></script>
    <script src="/js/attendanceData.js"></script>
@endpush
@section('content')
<input type="hidden" id="today"  name="date" class="form-control" value="{{date('Y-m-d')}}" readonly required/>

 {{-- =====================Attendance Modal==================== --}}
<div class="modal fade" id="attendanceModal"  role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
              <h2 class="modal-title" style="font-size:30px">Mark My Attendance</h2>
              {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
          </div>
          <form action="/mark" method="post">
            @csrf

            <input type="hidden" id="lateInput" name="late" value="0">
            <input type="hidden" name="employee_id" value="{{Session::get('employee')['id']}}">
          <div class="modal-body">
            <div class="form-group row">
                <div class="col-lg-6 ">
                    <label>Current Date:</label>
                    <input type="date"   name="date" class="form-control" value="{{date('Y-m-d')}}" readonly required/>
                </div>
                <div class="col-lg-6 ">
                    <label>Current Time:</label>
                    <input type="text"  id="time" name="time" class="form-control" aria-readonly="true" readonly required/>
                </div>

            </div>
            <div id="late">

            </div>

          </div>
          <div class="modal-footer">
              <input type="submit" name="submit" class="btn btn-success" value="Mark">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
        </div>

      </div>

</div>
    {{-- ===========================EOD Model======================= --}}
    <div class="modal fade" id="EodModal"  role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <h2 class="modal-title" style="font-size:30px"> Completed My Today's Tasks</h2>
                  {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
              </div>
              <div id="msg"></div>
              <form action="/eod" method="post">
                @csrf
                <input type="hidden" name="employee_id" value="{{Session::get('employee')['id']}}">
                <input type="hidden" id="incentives" name="incentives" value="0">
              <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-6 ">
                        <label>Current Date:</label>
                        <input type="date"   name="date" class="form-control" value="{{date('Y-m-d')}}" readonly required/>
                    </div>
                    <div class="col-lg-6 ">
                        <label>Current Time:</label>
                        <input type="text"  id="times" name="time" class="form-control" aria-readonly="true" readonly required/>
                    </div>

                </div>
                <div id="report">

                </div>
                <div id="extraWork">

                </div>
              </div>
              <div class="modal-footer">
                  <input type="submit" id="logout" name="submit" class="btn btn-success" value="Logout">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
            </div>

          </div>

    </div>
    {{-- ===================================Miss Punch MOdal-============================== --}}
    <div class="modal fade" id="missPunchModal"  role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <h2 class="modal-title" style="font-size:30px">Mark Your <b class="text-danger">Missed</b> EOD</h2>
                  {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
              </div>
              <div id="msg"></div>
              <form action="/miss/eod" method="post">
                @csrf
                <input type="hidden" name="employee_id" value="{{Session::get('employee')['id']}}">
                <input type="hidden" id="incentivess" name="incentives" value="0">
              <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-6 ">
                        <label>Current Date:</label>
                        <input type="date" id="missdate"   name="date" class="form-control" value="" readonly required/>
                    </div>
                    <div class="col-lg-6 ">
                        <label>Current Time:</label>
                        <input type="time"  id="times" name="time" class="form-control" aria-readonly="true" required/>
                    </div>

                </div>
                <div id="reporta">

                </div>
                <div id="inc">

                </div>
              </div>
              <div class="modal-footer">
                  <input type="submit" id="logout" name="submit" class="btn btn-success" value="punch it">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
            </div>

          </div>

    </div>
    {{-- ==============================Apply=========================== --}}
    <div class="modal fade" id="applyModal"  role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <h2 class="modal-title" style="font-size:30px">Apply For Leaves</h2>
                  {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
              </div>
              <div id="msg"></div>
              <form action="/apply" method="post">
                @csrf
                <input type="hidden" name="employee_id" value="{{Session::get('employee')['id']}}">
              <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg-10 ">
                        <label>Leave Type:</label>
                        <select name="leave_type" id="leaveType" class="form-control "  required>
                            <option value="">select</option>
                            <option value="Earned Leave">Earned Leaves</option>
                            <option value="Medical leave">Medical leave </option>
                            <option value="Personal leave">Personal leave</option>
                            <option value="Half Day Leave">Half Day Leave</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class=" col-lg-8">
                        <label class="form-control " style="border: none !important;font-size:20px !important"><input id="selectDays" type="checkbox" name="days" style="transform: scale(1.3)"> &nbsp; Single Day Leave</label>
                    </div>
                    <div class="col-lg-6 ">
                        <label>From Date:</label>
                        <input type="date" id="fromDate"   name="from_date"  class="form-control" value=""   required/>
                    </div>
                    <div class="col-lg-6 ">
                        <label>To Date:</label>
                        <input type="Date"  id="toDate" name="to_date" class="form-control"  required/>
                    </div>

                </div>

                <div class="form-group row">
                    <div class="col-lg-12 ">
                        <label>Reason : <i class="text-info">must be in detail</i> </label>
                         <textarea name="reason" class="form-control" id="reason" cols="30" rows="5" required></textarea>
                    </div>
                </div>

              </div>
              <div class="modal-footer">

                  <input type="submit" id="applyLeave" name="submit" class="btn btn-success" value="Apply For Leave">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
            </div>

          </div>

    </div>
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0"></h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  {{-- <li class="breadcrumb-item active" aria-current="page">Default</li> --}}
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              {{-- <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a> --}}
            </div>
          </div>
          <!-- Card stats -->
          @if (Session::get("success"))
            <div class="err-msg alert alert-success animate__animated animate__slideInUp p-3">{{Session::get("success")}}</div>
          @endif
          @if (Session::get("error"))
            <div class="err-msg alert alert-danger animate__animated animate__slideInUp p-3">{{Session::get("error")}}</div>
          @endif
          <div class="row">
              <div class="col-xl-3 col-md-6"></div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Mark&nbsp;My&nbsp;Attendance</h5>
                      {{-- <span class="h2 font-weight-bold mb-0">350,897</span> --}}
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <button id="mark" data-toggle="modal" data-target="#attendanceModal" class=" btn btn-warning  mb-0 text-sm"> Present </button>

                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Apply  for  Leave</h5>
                      {{-- <span class="h2 font-weight-bold mb-0">2,356</span> --}}
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="fa fa-arrow-up"></i>
                      </div>
                    </div>
                  </div>
                  <button id="applyBtn" data-toggle="modal" data-target="#applyModal" class=" btn btn-warning  mb-0 text-sm"> Apply </button>
                  {{-- <a href="" class=" btn btn-warning  mb-0 text-sm"> Apply </a> --}}
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">


      <div class="row">
        <div class="col-xl-8">
          <div id="showData" class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">My Attendance</h3>
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
                    <th scope="col">Date</th>
                    <th scope="col">Login Time</th>
                    <th scope="col">EOD Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>

                <tbody id="attendance_data_tbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
        {{-- <div class="col-xl-4">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Social traffic</h3>
                </div>
                <div class="col text-right">
                  <a href="#!" class="btn btn-sm btn-primary">See all</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Referral</th>
                    <th scope="col">Visitors</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">
                      Facebook
                    </th>
                    <td>
                      1,480
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="mr-2">60%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      Facebook
                    </th>
                    <td>
                      5,480
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="mr-2">70%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      Google
                    </th>
                    <td>
                      4,807
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="mr-2">80%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      Instagram
                    </th>
                    <td>
                      3,678
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="mr-2">75%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      twitter
                    </th>
                    <td>
                      2,645
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="mr-2">30%</span>
                        <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div> --}}
      </div>

      <!-- Footer -->

      @endsection
