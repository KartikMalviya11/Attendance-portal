@extends('layouts.hr_dashboard_layout')
@section('title',"Dashboard")

@push('script')
    <script src="/js/approve.js"></script>
@endpush
@section('content')

    <!-- Header -->
    <div class="modal fade" id="viewDetails" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" >
              <div class="modal-header" style="border-bottom: 1px solid grey">
                  <h2 class="modal-title" style="font-size:30px">View Details</h2>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <div id="emp_det" class="details p-1 m-3 row">

              </div>
              <form action="/approve" method="post">
                @csrf
                <input id="emp_id" type="hidden" name="employee_id" value="">
              <div class="modal-body">
                <h3 class="modal-title mb-4 text-center" style="font-size:30px;border:">Provide Login Credentials</h3>
                <div class="form-group row">
                    <div class="col-lg-12 ">
                        <label>Assign Company Email Address:</label>
                        <input type="email" name="company_email" class="form-control"   required/>
                    </div>
                    <div class="col-lg-12 ">
                        <label>Assign Password:</label>
                        <input type="password"  id="password" name="password" class="form-control"   required/>
                    </div>
                </div>

              </div>
              <div class="modal-footer">
                  <input type="submit" name="submit" class="btn btn-success" value="Approve and Assign">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
            </div>

          </div>

    </div>
    <!-- Header -->
    <div class="header bg-primary pb-6 ">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              {{-- <h6 class="h2 text-white d-inline-block mb-0">Default</h6> --}}
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Employee Requests</li>
                </ol>
            </nav>

        </div>
        <div class="col-lg-6 col-5 text-right">
                <h1 aria-label="breadcrumb" class="mt-4 text-white"> Employee Requests </h1>
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
            @if (Session::get("approve") != null)
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
            @if (strlen(Session::get("approve")) < 3 )
            <h1 class="text-white " style="text-shadow: 1px 1px 1px red">You Don't Have any New Request Yet .</h1>
            @endif
            @endif
        </div>
      </div>
    </div>
    <!-- Page content -->


    <div class="container-fluid mt--6">
            <div class="col-xl-6 sa" style="height: 500px; overflow-y:scroll;">
              <div class="card">
                <div class="card-header border-0" style="position: sticky;top:0">
                  <div class="row align-items-center">
                    <div class="col">
                      <h3 class="mb-0">Today's Attendance</h3>
                    </div>
                    <div class="col text-right">
                      {{-- <a href="#!" class="btn btn-sm btn-primary">See all</a> --}}
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <!-- Projects table -->
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Name </th>
                        <th scope="col">Login Time</th>
                        <th scope="col"> Late Hours</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if (Session::has("todayAttendance"))
                        @foreach (Session::get('todayAttendance') as $item)
                        <tr>
                            <th scope="row">
                               {{$item->name}}
                            </th>
                            <td>
                                {{$item->in_time}}
                            </td>
                            <td>
                                {{$item->late_hours}} min
                              {{-- <div class="d-flex align-items-center">
                                <span class="mr-2">60%</span>
                                <div>
                                  <div class="progress">
                                    <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                  </div>
                                </div>
                              </div> --}}
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
       {{-- <div class="row">
        <div class="col-xl-8">
          <div class="card bg-default">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                  <h5 class="h3 text-white mb-0">Sales value</h5>
                </div>
                <div class="col">
                  <ul class="nav nav-pills justify-content-end">
                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales-dark" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                      <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                        <span class="d-none d-md-block">Month</span>
                        <span class="d-md-none">M</span>
                      </a>
                    </li>
                    <li class="nav-item" data-toggle="chart" data-target="#chart-sales-dark" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                      <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                        <span class="d-none d-md-block">Week</span>
                        <span class="d-md-none">W</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                  <h5 class="h3 mb-0">Total orders</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <canvas id="chart-bars" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
      {{-- <div class="row">
        <div class="col-xl-8">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Page visits</h3>
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
                    <th scope="col">Page name</th>
                    <th scope="col">Visitors</th>
                    <th scope="col">Unique users</th>
                    <th scope="col">Bounce rate</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">
                      /argon/
                    </th>
                    <td>
                      4,569
                    </td>
                    <td>
                      340
                    </td>
                    <td>
                      <i class="fas fa-arrow-up text-success mr-3"></i> 46,53%
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      /argon/index.html
                    </th>
                    <td>
                      3,985
                    </td>
                    <td>
                      319
                    </td>
                    <td>
                      <i class="fas fa-arrow-down text-warning mr-3"></i> 46,53%
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      /argon/charts.html
                    </th>
                    <td>
                      3,513
                    </td>
                    <td>
                      294
                    </td>
                    <td>
                      <i class="fas fa-arrow-down text-warning mr-3"></i> 36,49%
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      /argon/tables.html
                    </th>
                    <td>
                      2,050
                    </td>
                    <td>
                      147
                    </td>
                    <td>
                      <i class="fas fa-arrow-up text-success mr-3"></i> 50,87%
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">
                      /argon/profile.html
                    </th>
                    <td>
                      1,795
                    </td>
                    <td>
                      190
                    </td>
                    <td>
                      <i class="fas fa-arrow-down text-danger mr-3"></i> 46,53%
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
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
        </div>
      </div> --}}
      <!-- Footer -->

      @endsection
