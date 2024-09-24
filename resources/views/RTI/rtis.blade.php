<x-admin.layout>
    <x-slot name="title">RTI</x-slot>
    <x-slot name="heading">RTI</x-slot>

    <?php
        $today = date('Y-m-d'); // Format: yyyy-mm-dd
    ?>
        <!-- Add Form -->
        <div class="row" id="addContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header">
                            <h4 class="card-title">Create RTI</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="applicant_name">Applicant Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="applicant_name" name="applicant_name" type="text" placeholder="Enter Applicant Name">
                                    <span class="text-danger is-invalid applicant_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="received_date">Received Date <span class="text-danger">*</span></label>
                                    <input class="form-control" id="received_date" name="received_date" max="<?php echo $today; ?>" type="date">
                                    <span class="text-danger is-invalid received_date_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="date">Date<span class="text-danger">*</span></label>
                                    <input class="form-control" id="date" name="date" value="<?php echo $today; ?>" type="date" readonly>
                                    <span class="text-danger is-invalid date_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="subject">Subject <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="subject" name="subject" cols="30" rows="2" placeholder="Enter subject"></textarea>
                                    {{-- <input class="form-control" id="subject" name="subject" type="text" placeholder="Enter subject"> --}}
                                    <span class="text-danger is-invalid subject_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="concerned_department">Concerned Deartment <span class="text-danger">*</span></label>
                                    <select class="form-control" name="concerned_department" id="concerned_department">
                                        <option value="">Select Concerned Deartment</option>
                                        @foreach ($departments as $list)
                                            <option value="{{ $list->id }}">{{ $list->department_name }}</option>
                                        @endforeach    
                                    </select>
                                    <span class="text-danger is-invalid concerned_department_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="name_of_concerned_officer">Name Of Concerned Officer</label>
                                    <input class="form-control" id="name_of_concerned_officer" name="name_of_concerned_officer" type="text" placeholder="Enter Name Of Concerned Officer">
                                    <span class="text-danger is-invalid name_of_concerned_officer_err"></span>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        {{-- Edit Form --}}
        <div class="row" id="editContainer" style="display:none;">
            <div class="col">
                <form class="form-horizontal form-bordered" method="post" id="editForm">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit RTI</h4>
                        </div>
                        <div class="card-body py-2">
                            <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="applicant_name">Applicant Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="applicant_name" name="applicant_name" type="text" placeholder="Enter Applicant Name">
                                    <span class="text-danger is-invalid applicant_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="received_date">Received Date <span class="text-danger">*</span></label>
                                    <input class="form-control" id="received_date" name="received_date" max="<?php echo $today; ?>" type="date">
                                    <span class="text-danger is-invalid received_date_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="date">Date<span class="text-danger">*</span></label>
                                    <input class="form-control" id="date" name="date" type="date">
                                    <span class="text-danger is-invalid date_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="subject">Subject <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="subject" name="subject" cols="30" rows="2" placeholder="Enter subject"></textarea>
                                    {{-- <input class="form-control" id="subject" name="subject" type="text" placeholder="Enter subject"> --}}
                                    <span class="text-danger is-invalid subject_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="concerned_department">Concerned Deartment <span class="text-danger">*</span></label>
                                    <select class="form-control" name="concerned_department" id="concerned_department">
                                        <option value="">Select Concerned Deartment</option>
                                        @foreach ($departments as $list)
                                            <option value="{{ $list->id }}">{{ $list->department_name }}</option>
                                        @endforeach    
                                    </select>
                                    <span class="text-danger is-invalid concerned_department_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="name_of_concerned_officer">Name Of Concerned Officer</label>
                                    <input class="form-control" id="name_of_concerned_officer" name="name_of_concerned_officer" type="text" placeholder="Enter Name Of Concerned Officer">
                                    <span class="text-danger is-invalid name_of_concerned_officer_err"></span>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" id="editSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <button id="addToTable" class="btn btn-primary">Create RTI <i class="fa fa-plus"></i></button>
                                    <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Dispatch No</th>
                                        <th>Applicant Name</th>
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
                                                <button class="edit-element btn text-secondary px-2 py-1" title="Edit RTI" data-id="{{ $rti->id }}"><i data-feather="edit"></i></button>
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


{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('rti.store') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('rti.index') }}';
                        });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#addSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#addSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

    });
</script>


<!-- Edit -->
<script>
    $("#buttons-datatables").on("click", ".edit-element", function(e) {
        e.preventDefault();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('rti.edit', ":model_id") }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {
                editFormBehaviour();
                if (!data.error)
                {
                    $("#editForm input[name='edit_model_id']").val(data.rti.id);
                    $("#editForm input[name='applicant_name']").val(data.rti.applicant_name);
                    $("#editForm input[name='received_date']").val(data.rti.received_date);
                    $("#editForm input[name='date']").val(data.rti.date);
                    $("#editForm textarea[name='subject']").val(data.rti.subject);
                    $("#editForm select[name='concerned_department']").val(data.rti.concerned_department);
                    $("#editForm input[name='name_of_concerned_officer']").val(data.rti.name_of_concerned_officer);
                }
                else
                {
                    alert(data.error);
                }
            },
            error: function(error, jqXHR, textStatus, errorThrown) {
                alert("Some thing went wrong");
            },
        });
    });
</script>


<!-- Update -->
<script>
    $(document).ready(function() {
        $("#editForm").submit(function(e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            formdata.append('_method', 'PUT');
            var model_id = $('#edit_model_id').val();
            var url = "{{ route('rti.update', ":model_id") }}";
            //
            $.ajax({
                url: url.replace(':model_id', model_id),
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
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
                statusCode: {
                    422: function(responseObject, textStatus, jqXHR) {
                        $("#editSubmit").prop('disabled', false);
                        resetErrors();
                        printErrMsg(responseObject.responseJSON.errors);
                    },
                    500: function(responseObject, textStatus, errorThrown) {
                        $("#editSubmit").prop('disabled', false);
                        swal("Error occured!", "Something went wrong please try again", "error");
                    }
                }
            });

        });
    });
</script>


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

