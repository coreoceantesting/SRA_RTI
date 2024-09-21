<x-admin.layout>
    <x-slot name="title">First Appeal</x-slot>
    <x-slot name="heading">First Appeal</x-slot>

        {{-- Add Form --}}
        <div class="row" id="editContainer">
            <div class="col">
                <form class="form-horizontal form-bordered" method="post" id="editForm">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">First Appeal</h4>
                        </div>
                        <div class="card-body py-2">
                            <input type="hidden" id="edit_model_id" name="edit_model_id" value="{{ $rtis->id }}">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="applicant_name">Applicant Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="applicant_name" name="applicant_name" type="text" placeholder="Enter Applicant Name">
                                    <span class="text-danger is-invalid applicant_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="received_date">Received Date <span class="text-danger">*</span></label>
                                    <input class="form-control" id="received_date" name="received_date" type="date">
                                    <span class="text-danger is-invalid received_date_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="date">Date<span class="text-danger">*</span></label>
                                    <input class="form-control" id="date" name="date" type="date">
                                    <span class="text-danger is-invalid date_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="subject">Subject <span class="text-danger">*</span></label>
                                    <input class="form-control" id="subject" name="subject" type="text" placeholder="Enter subject">
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
                                    <label class="col-form-label" for="name_of_concerned_officer">Name Of Concerned Officer <span class="text-danger">*</span></label>
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



</x-admin.layout>

<!-- Update -->
<script>
    $(document).ready(function() {
        $("#editForm").submit(function(e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            var url = "{{ route('store_first_appeal') }}";
            //
            $.ajax({
                url: url,
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


