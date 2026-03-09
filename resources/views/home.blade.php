@extends('layouts.app')

@section('content')

    <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="row">
        <!-- Referral Chart-->
        <div class="col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body text-center">
              <h2 class="mb-1">{{$registered->count()}}</h2>
              <span class="text-muted">Registered Members</span>
              <div id="referralLineChart"></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body text-center">
              <h2 class="mb-1">{{$member_present_today->count()}}</h2>
              <span class="text-muted">Member Present Today</span>
              <div id="referralLineChart"></div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body text-center">
              <h2 class="mb-1">{{$member_after_9am}}</h2>
              <span class="text-muted">Member After 9am</span>
              <div id="referralLineChart"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 col-md-12">
      <div class="row">
        <!-- Referral Chart-->
        <div class="col-sm-6 col-12 mb-4">
          <div class="card">
            <div class="card-body text-center">
              <table class="dt-column-search table table-bordered" id="mytable">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>DateTime</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($member_first_detected_today as $row)
                      <tr>
                          <td>{{ $row->name }}</td>
                          <td>{{ $row->first_detected }}</td>
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
</div>
<!-- / Content -->

@endsection
@section('page-js')
@endsection
@section('scripts')
@endsection
