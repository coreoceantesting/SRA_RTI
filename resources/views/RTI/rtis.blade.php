<x-admin.layout>
    <x-slot name="title">RTI</x-slot>
    <x-slot name="heading">RTI</x-slot>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Dispatch No</th>
                                    <th>Applicant Name</th>
                                    <th>Mobile No</th>
                                    <th>Received Date</th>
                                    <th>Date</th>
                                    <th>Subject</th>
                                    <th>Concerned Department</th>
                                    <th>Name Of Concerned Officer</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rtis as $index => $rti)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $rti->dispatch_no }}</td>
                                        <td>{{ $rti->applicant_name }}</td>
                                        <td>{{ $rti->mobile_no }}</td>
                                        <td>{{ $rti->received_date }}</td>
                                        <td>{{ $rti->date }}</td>
                                        <td title="{{ $rti->subject }}" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">
                                            {{ Str::limit($rti->subject, 20) }}
                                        </td>
                                        <td>{{ $rti->department_name }}</td>
                                        <td>{{ $rti->name_of_concerned_officer ?? 'NA'}}</td>
                                        <td>{{ $rti->note ?? 'NA'}}</td>
                                        <td>
                                            @can(['RTI.firstAppeal'])    
                                                @if ($rti->status == "Pending")
                                                    <a href="{{ route('first_appeal', $rti->id) }}" class="btn btn-sm btn-primary px-2 py-1" title="First Appeal">1st Appeal</a>              
                                                @endif
                                            @endcan
                                            {{-- @if ($rti->status == "First Appeal")
                                                <a href="{{ route('second_appeal', $rti->id) }}" class="btn btn-sm btn-info px-2 py-1" title="Second Appeal">2nd Appeal</a>
                                            @endif --}}
                                            @can(['RTI.edit'])
                                                @if ($rti->status == "Pending")
                                                <a href="{{ route('rti.edit', $rti->id) }}" class="edit-element btn text-secondary px-2 py-1" title="Edit RTI" data-id="{{ $rti->id }}"><i data-feather="edit"></i></a>
                                                @endif
                                            @endcan

                                            @can(['RTI.approval'])
                                                @if ($rti->approval_status == "Pending")                           
                                                    <button class="btn btn-success btn-sm approve-element px-2 py-1" title="Approve RTI" data-id="{{ $rti->id }}">Accept</button>
                                                    <button class="btn btn-info btn-sm transfer-element px-2 py-1" title="Transfer RTI" data-id="{{ $rti->id }}">Transfer</button>
                                                @endif
                                            @endcan

                                            @can(['RTI.note'])
                                                @if ($rti->approval_status == "Approved" && empty($rti->note))
                                                    <button class="btn btn-secondary btn-sm note px-2 py-1" title="Note" data-id="{{ $rti->id }}">Note</button>
                                                @endif
                                            @endcan

                                            @can(['RTI.transferDetails'])
                                                <button class="btn btn-dark btn-sm transfer-details px-2 py-1" title="Transfer RTI Details" data-id="{{ $rti->id }}">Transfer Details</button>    
                                            @endcan

                                            @can(['RTI.delete'])    
                                                <button class="btn btn-warning rem-element px-2 py-1" title="Delete RTI" data-id="{{ $rti->id }}"><i data-feather="trash-2"></i> </button>
                                            @endcan

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Approve Modal -->
                <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel">Approve RTI</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form id="approveForm">
                            <input type="hidden" id="rti_id" name="rti_id">
                            <div class="mb-3">
                            <label for="remark" class="form-label">Remark</label>
                            <textarea class="form-control" id="remark" name="remark" rows="3" required></textarea>
                            </div>
                        </form>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="saveRemark" class="btn btn-primary">Approve</button>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Transfer Modal -->
                <div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="transferModalLabel">Transfer RTI</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form id="transferForm">
                            <input type="hidden" id="transfer_rti_id" name="transfer_rti_id">
                            <div class="mb-3">
                            <label for="remark" class="form-label">Department <span class="text-danger">*</span></label>
                            <select class="form-control" name="department" id="department" required>
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="mb-3">
                            <label for="remark" class="form-label">Transfer Remark <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="transfer_remark" name="transfer_remark" rows="3" required></textarea>
                            </div>
                        </form>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="transferRemark" class="btn btn-primary">Transfer</button>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Transfer Modal -->
                <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="noteModalLabel">Note</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form id="noteForm">
                                <input type="hidden" id="note_rti_id" name="note_rti_id">
                                <div class="mb-3">
                                <label for="Note" class="form-label">Note<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="note" name="note" rows="3" required></textarea>
                                </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="storeNote" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- View Tracking Details --}}
                <div class="modal fade" id="trackin-details-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewPaymentSlips">View Department Tracking</h5>
                                <button type="button" class="close btn btn-secondary btn-sm" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="viewTrackingDetails"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
  
            </div>
        </div>
    </div>


</x-admin.layout>

<!-- Delete -->
<script>
    $("#buttons-datatables").on("click", ".rem-element", function(e) {
        e.preventDefault();
        swal({
            title: "Are you sure to delete this RTI?",
            // text: "Make sure if you have filled Vendor details before proceeding further",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('rti.destroy', ":model_id") }}";

                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'POST',
                    data: {
                        '_method': "DELETE",
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data, textStatus, jqXHR) {
                        if (!data.error && !data.error2) {
                            swal("Success!", data.success, "success")
                                .then((action) => {
                                    window.location.reload();
                                });
                        } else {
                            if (data.error) {
                                swal("Error!", data.error, "error");
                            } else {
                                swal("Error!", data.error2, "error");
                            }
                        }
                    },
                    error: function(error, jqXHR, textStatus, errorThrown) {
                        swal("Error!", "Something went wrong", "error");
                    },
                });
            }
        });
    });
</script>

{{-- approve rti --}}
<script>
    $(document).ready(function() {
      // When the approve button is clicked
      $('.approve-element').on('click', function() {
        var rtiId = $(this).data('id'); 
        $('#rti_id').val(rtiId); 
        $('#approveModal').modal('show');
      });
    
      // Handle form submission
      $('#saveRemark').on('click', function() {
        var rtiId = $('#rti_id').val();
        var remark = $('#remark').val();
    
        if(remark === '') {
          alert('Remark is required');
          return;
        }
    
        $.ajax({
          url: '{{ route("rti.approve") }}',
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            rti_id: rtiId,
            remark: remark
          },
          success: function(data)
            {
                $("#editSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('rti.index') }}';
                        });
                else
                    swal("Error!", data.error2, "error");
            },
        });
      });
    });
</script>

{{-- transfer rti --}}
<script>
    $(document).ready(function() {

      $('.transfer-element').on('click', function() {
        var rtiId = $(this).data('id'); 
        $('#transfer_rti_id').val(rtiId); 
        $('#transferModal').modal('show');
      });
    
      // Handle form submission
      $('#transferRemark').on('click', function() {
        var rtiId = $('#transfer_rti_id').val();
        var remark = $('#transfer_remark').val();
        var department = $('#department').val();
    
        if(department === '') {
          alert('Department is required');
          return;
        }

        if(remark === '') {
          alert('Remark is required');
          return;
        }

        
    
        $.ajax({
          url: '{{ route("rti.transfer") }}',
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            rti_id: rtiId,
            remark: remark,
            department: department
          },
          success: function(data)
            {

                if (!data.error2)
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('rti.index') }}';
                        });
                else
                    swal("Error!", data.error2, "error");
            },
        });
      });
    });
</script>


{{-- submit note --}}
<script>
    $(document).ready(function() {

      $('.note').on('click', function() {
        var rtiId = $(this).data('id'); 
        $('#note_rti_id').val(rtiId); 
        $('#noteModal').modal('show');
      });
    
      // Handle form submission
      $('#storeNote').on('click', function() {
        var rtiId = $('#note_rti_id').val();
        var note = $('#note').val();

        if(note === '') {
          alert('Note is required');
          return;
        }

        $.ajax({
          url: '{{ route("store.note") }}',
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            rti_id: rtiId,
            note: note,
          },
          success: function(data)
            {

                if (!data.error2)
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('rti.index') }}';
                        });
                else
                    swal("Error!", data.error2, "error");
            },
        });
      });
    });
</script>

{{-- Tracking details --}}
<script>
    $(document).ready(function() {

        $('.transfer-details').on('click', function() {
            var rtiId = $(this).data('id');

            $.ajax({
                url: '/view-transfer-details/' + rtiId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {

                    var tableHtml = '';
                    if (data.trackingDetails && data.trackingDetails.length > 0) {
                        tableHtml += '<br><h3 class="text-center"> Transfer Details </h3><br>';
                        tableHtml += '<table id="transferDetails" class="table table-bordered">';
                        tableHtml += '<thead><tr>';
                        tableHtml += '<th scope="col">Old Department</th>';
                        tableHtml += '<th scope="col">Transfer To New Department</th>';
                        tableHtml += '<th scope="col">Remark</th>';
                        tableHtml += '</tr></thead>';
                        tableHtml += '<tbody>';
                        // Loop through payment slip details
                        data.trackingDetails.forEach(function(list) {
                            tableHtml += '<tr>';
                            tableHtml += '<td>' + list.old_department_name + '</td>';
                            tableHtml += '<td>' + list.new_department_name + '</td>';
                            tableHtml += '<td>' + list.transfer_remark + '</td>';
                            tableHtml += '</tr>';
                        });
                        tableHtml += '</tbody></table>';
                    } else {
                        tableHtml += '<h3 class="text-center">No Data Available</h3>';
                    }

                    // Display table in the modal
                    $('#viewTrackingDetails').html(tableHtml);
                    $('#trackin-details-modal').modal('show');

                }, // <-- Removed the extra closing parenthesis here
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

