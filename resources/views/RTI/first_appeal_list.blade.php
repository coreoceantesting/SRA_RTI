<x-admin.layout>
    <x-slot name="title">First Appeal List</x-slot>
    <x-slot name="heading">First Appeal List</x-slot>

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
                                    <th>Received Date</th>
                                    <th>Date</th>
                                    <th>Subject</th>
                                    <th>Concerned Department</th>
                                    <th>Name Of Concerned Officer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lists as $index => $list)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $list->id }}</td>
                                        <td>{{ $list->applicant_name }}</td>
                                        <td>{{ $list->received_date }}</td>
                                        <td>{{ $list->date }}</td>
                                        <td>{{ $list->subject }}</td>
                                        <td>{{ $list->department_name }}</td>
                                        <td>{{ $list->name_of_concerned_officer }}</td>
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