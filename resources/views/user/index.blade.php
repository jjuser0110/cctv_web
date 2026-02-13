@extends('layouts.app')
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">User </span></h4>

        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-header flex-column flex-md-row">
                <div class="head-label">
                    <h5 class="card-title mb-0">User Listing</h5>
                </div>
                <div class="dt-action-buttons text-end pt-3 pt-md-0">
                    <div class="dt-buttons"> 
                        <a class="dt-button create-new btn btn-primary" type="button" href="{{route('user.sync')}}" onclick="showLoading()">
                            <span><i class="bx bx-plus me-sm-1"></i> 
                                <span class="d-none d-sm-inline-block">SYNC</span>
                            </span>
                        </a> 
                    </div>
                </div>
            </div>
            <div class="card-datatable text-nowrap">
                <table class="dt-column-search table table-bordered" id="mytable">
                    <thead>
                        <tr>
                            <th>personId</th>
                            <th>personCode</th>
                            <th>orgIndexCode</th>
                            <th>personFamilyName</th>
                            <th>personGivenName</th>
                            <th>gender</th>
                            <th>phoneNo</th>
                            <th>personPhoto</th>
                            <th>remark</th>
                            <th>beginTime</th>
                            <th>endTime</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $row)
                        <tr>
                            <td>{{$row->personId??""}}</td>
                            <td>{{$row->personCode??""}}</td>
                            <td>{{$row->orgIndexCode??""}}</td>
                            <td>{{$row->personFamilyName??""}}</td>
                            <td>{{$row->personGivenName??""}}</td>
                            <td>{{$row->gender??""}}</td>
                            <td>{{$row->phoneNo??""}}</td>
                            <td>{{$row->personPhoto??""}}</td>
                            <td>{{$row->remark??""}}</td>
                            <td>{{$row->beginTime??""}}</td>
                            <td>{{$row->endTime??""}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- / Content -->


    @endsection
    @section('page-js')
    @endsection
    @section('scripts')
      <script>
$(function(){
    var table = $('#mytable').DataTable({
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        pageLength: 10,
        displayLength: 5,
        ordering:false,
        lengthMenu: [5, 10, 25, 50, 75, 100],
    });
});
  </script>
    @endsection