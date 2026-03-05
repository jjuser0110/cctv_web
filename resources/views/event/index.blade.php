@extends('layouts.app')

@section('content')

<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">RESPONSE </span></h4>

<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header flex-column flex-md-row">
        <div class="head-label">
            <h5 class="card-title mb-0">RESPONSE Listing</h5>
        </div>
    </div>

    <div class="card-datatable text-nowrap">
        <table class="dt-column-search table table-bordered" id="mytable">
            <thead>
                <tr>
                    <th>sendTime</th>
                    <th>eventId</th>
                    <th>eventType</th>
                    <th>status</th>
                    <th>human_id</th>
                    <th>name</th>
                    <th>wearMaskStatus</th>
                    <th>response_data</th>
                </tr>
            </thead>

            <tbody>
                @foreach($event as $row)
                <tr>
                    <td>{{ $row->sendTime }}</td>
                    <td>{{ $row->eventId }}</td>
                    <td>{{ $row->eventType }}</td>
                    <td>{{ $row->status }}</td>
                    <td>{{ $row->human_id }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->wearMaskStatus }}</td>

                    <td>
                        <a href="#" 
                           data-bs-toggle="modal" 
                           data-bs-target="#viewModal"
                           data-response_data='@json($row->response_data)'>
                           View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

</div>
<!-- / Content -->

<!-- Modal -->

<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">

        <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

            <div class="text-center mb-4">
                <h3>Response Data</h3>
            </div>

            <div class="row g-2">
                <div class="col mb-0">
                    <label class="form-label">Response Data</label>

                    <pre id="response_data"
                         class="bg-light p-3 border rounded"
                         style="max-height:500px; overflow:auto; font-size:13px;"></pre>

                </div>
            </div>

        </div>

    </div>
</div>

</div>

@endsection

@section('page-js')
@endsection

@section('scripts')

<script>

$(function(){

    // DataTable
    var table = $('#mytable').DataTable({
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>' +
             '<"table-responsive"t>' +
             '<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        pageLength: 10,
        displayLength: 5,
        ordering:false,
        lengthMenu: [5, 10, 25, 50, 75, 100],
    });


    // Modal show event
    $('#viewModal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var responseData = button.data('response_data');

        try {

            // Convert string/object to JSON and beautify
            var formatted = JSON.stringify(
                typeof responseData === 'string' 
                ? JSON.parse(responseData) 
                : responseData,
                null,
                4
            );

        } catch (e) {

            formatted = responseData;

        }

        $('#response_data').text(formatted);

    });

});

</script>

@endsection
