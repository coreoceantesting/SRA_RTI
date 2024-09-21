<x-admin.layout>
    <x-slot name="title">Second Appeal</x-slot>
    <x-slot name="heading">Second Appeal</x-slot>

        {{-- Add Form --}}
        <div class="row" id="editContainer">
            <div class="col">
                <form class="form-horizontal form-bordered" method="post" id="editForm">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Second Appeal</h4>
                        </div>
                        <div class="card-body py-2">
                            <input type="hidden" id="edit_model_id" name="edit_model_id" value="{{ $rtis->id }}">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="file_no">File No<span class="text-danger">*</span></label>
                                    <input class="form-control" id="file_no" name="file_no" type="text" placeholder="Enter File No">
                                    <span class="text-danger is-invalid file_no_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="who_came_from">Who Came From <span class="text-danger">*</span></label>
                                    <input class="form-control" id="who_came_from" name="who_came_from" type="text" placeholder="Enter Who Came From Name">
                                    <span class="text-danger is-invalid who_came_from_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="subject">Subject<span class="text-danger">*</span></label>
                                    <input class="form-control" id="subject" name="subject" type="text" placeholder="Enter Subject">
                                    <span class="text-danger is-invalid subject_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="old_document">old Document <span class="text-danger">*</span></label>
                                    <input class="form-control" id="old_document" name="old_document" type="file">
                                    <span class="text-danger is-invalid old_document_err"></span>
                                </div>
            
                                <div class="col-md-4">
                                    <label class="col-form-label" for="to_whom_it_was_entrusted">To whom it was entrusted <span class="text-danger">*</span></label>
                                    <input class="form-control" id="to_whom_it_was_entrusted" name="to_whom_it_was_entrusted" type="text" placeholder="Enter Name Of To whom it was entrusted">
                                    <span class="text-danger is-invalid to_whom_it_was_entrusted_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="who_was_presented">Who was presented? <span class="text-danger">*</span></label>
                                    <input class="form-control" id="who_was_presented" name="who_was_presented" type="text" placeholder="Enter Who was presented">
                                    <span class="text-danger is-invalid who_was_presented_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="who_was_sent">Who was sent <span class="text-danger">*</span></label>
                                    <input class="form-control" id="who_was_sent" name="who_was_sent" type="text" placeholder="Enter Who was sent">
                                    <span class="text-danger is-invalid who_was_sent_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="final_disposal">Date of final disposal <span class="text-danger">*</span></label>
                                    <input class="form-control" id="final_disposal" name="final_disposal" type="date">
                                    <span class="text-danger is-invalid final_disposal_err"></span>
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

<!-- store -->
<script>
    $(document).ready(function() {
        $("#editForm").submit(function(e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            var url = "{{ route('store_second_appeal') }}";
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


