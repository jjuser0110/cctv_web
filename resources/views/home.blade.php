@extends('layouts.app')

@section('content')

    <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    
    <div class="col-md-6 col-12 mb-4">
        <form method="GET">
            <div class="input-group input-daterange" >
                <input type="date" class="form-control" name="today_date" value="{{$today_date??''}}"/>
                <button class="btn btn-primary" type="submit" >Filter</button>
            </div>
        </form>
    </div>
    <div class="col-lg-12 col-md-12">
      <div class="row">
        <!-- Referral Chart-->
        <div class="col-sm-3 col-12 mb-4">
          <div class="card">
            <div class="card-body text-center">
              <h2 class="mb-1">{{$registered->count()}}</h2>
              <span class="text-muted">Registered Members</span>
              <div id="referralLineChart"></div>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-12 mb-4">
          <div class="card">
            <div class="card-body text-center">
              <h2 class="mb-1">{{$member_present_today->count()}}</h2>
              <span class="text-muted">Member Present Today</span>
              <div id="referralLineChart"></div>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-12 mb-4">
          <div class="card">
            <div class="card-body text-center">
              <h2 class="mb-1">{{$member_after_9am}}</h2>
              <span class="text-muted">Member After 9am</span>
              <div id="referralLineChart"></div>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-12 mb-4">
          <div class="card">
            <div class="card-body text-center">
              <h2 class="mb-1">{{$phone_calls_detected}}</h2>
              <span class="text-muted">Phone Call Detected</span>
              <div id="referralLineChart"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 col-md-12">
      <div class="row">
        <!-- <button
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#popoutModal">
                          Launch modal
                        </button> -->
        <div class="col-sm-12 col-12 mb-4">
          <div class="card">
            <div class="card-body text-center">
              <table class="dt-column-search table table-bordered" id="mytable">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>First Detected</th>
                          <th>Last Detected</th>
                          <th>Duration</th>
                          <th>Total Detected</th>
                          <th>Wear Mask Count</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($member_first_detected_today as $row)
                      <tr>
                          <td>{{ $row->name }}</td>
                          <td>{{ $row->first_detected }}</td>
                          <td>{{ $row->last_detected }}</td>
                          <td>{{ $row->duration_readable }}</td>
                          <td>{{ $row->call_count }}</td>
                          <td>{{ $row->wear_mask_count }}</td>
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
<div class="modal fade" id="popoutModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Pop Out Message</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="popupMessage">
          This is a Bootstrap modal. You can use modals to display content in a
          layer above the main content. Modals are streamlined, but flexible,
          dialog prompts powered by JavaScript and CSS. They’re supported in
          all modern browsers.
        </p>
        <b id="popupTime">23-03-2025 12:33:22</b>
      </div>
    </div>
  </div>
</div>
<!-- / Content -->

@endsection
@section('page-js')
@endsection
@section('scripts')
<script>

  setInterval(() => {
      fetch('/popup')
          .then(res => res.json())
          .then(res => {
              console.log(res);
              console.log(res.message, res.messagetime);
              if (!res.messagetime) return;
              let lastTime = sessionStorage.getItem('lastTime');
              // Only trigger if new
              if (lastTime !== res.messagetime) {
                  sessionStorage.setItem('lastTime', res.messagetime);
                  showPopup(res.message, res.messagetime);
              }
          });
  }, 2000); // every 2 seconds

  function showPopup(message, messagetime) {
    document.getElementById('popupMessage').innerText = message;
    document.getElementById('popupTime').innerText = messagetime;

    // Show Bootstrap modal
    let modal = new bootstrap.Modal(document.getElementById('popoutModal'));
    modal.show();

    // Hide after 3 seconds
    setTimeout(() => modal.hide(), 3000);
  }
</script>
@endsection
