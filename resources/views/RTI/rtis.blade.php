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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rtis as $index => $rti)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $rti->id }}</td>
                                        <td>{{ $rti->applicant_name }}</td>
                                        <td>{{ $rti->mobile_no }}</td>
                                        <td>{{ $rti->received_date }}</td>
                                        <td>{{ $rti->date }}</td>
                                        <td title="{{ $rti->subject }}" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">
                                            {{ Str::limit($rti->subject, 20) }}
                                        </td>
                                        <td>{{ $rti->department_name }}</td>
                                        <td>{{ $rti->name_of_concerned_officer ?? 'NA'}}</td>
                                        <td>
                                            @if ($rti->status == "Pending")
                                                <a href="{{ route('first_appeal', $rti->id) }}" class="btn btn-sm btn-primary px-2 py-1" title="First Appeal">1st Appeal</a>              
                                            @endif
                                            @if ($rti->status == "First Appeal")
                                                <a href="{{ route('second_appeal', $rti->id) }}" class="btn btn-sm btn-info px-2 py-1" title="Second Appeal">2nd Appeal</a>
                                            @endif
                                            @if ($rti->status == "Pending")
                                            <a href="{{ route('rti.edit', $rti->id) }}" class="edit-element btn text-secondary px-2 py-1" title="Edit RTI" data-id="{{ $rti->id }}"><i data-feather="edit"></i></a>
                                            @endif
                                            <button class="btn text-danger rem-element px-2 py-1" title="Delete RTI" data-id="{{ $rti->id }}"><i data-feather="trash-2"></i> </button>      
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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

