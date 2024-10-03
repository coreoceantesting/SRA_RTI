<x-admin.layout>
    <x-slot name="title">Create RTI</x-slot>
    <x-slot name="heading">Create RTI</x-slot>

    <?php
        $today = date('Y-m-d'); // Format: yyyy-mm-dd
    ?>

    <!-- Add Form -->
    <div class="row" id="addContainer">
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
                                <label class="col-form-label" for="mobile_no">Mobile No <span class="text-danger">*</span></label>
                                <input class="form-control" id="mobile_no" name="mobile_no" type="number" placeholder="Enter Mobile No">
                                <span class="text-danger is-invalid mobile_no_err"></span>
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
                        {{-- <button type="reset" class="btn btn-warning">Reset</button> --}}
                        <a href="{{ route('rti.index') }}" class="btn btn-warning">Back</a>
                    </div>
                </form>
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

<script>
    document.getElementById('mobile_no').addEventListener('input', function (e) {
        let mobileNumber = e.target.value;

        // Validate if input is 10 digits
        if (mobileNumber.length > 10) {
            this.value = mobileNumber.slice(0, 10); // Limit to 10 digits
        }

        // Optionally, you can also add custom error messages
        if (mobileNumber.length < 10) {
            document.querySelector('.mobile_no_err').innerText = 'Mobile number must be 10 digits.';
        } else {
            document.querySelector('.mobile_no_err').innerText = '';
        }
    });
</script>