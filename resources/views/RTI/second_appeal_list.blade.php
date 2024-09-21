<x-admin.layout>
    <x-slot name="title">Second Appeal List</x-slot>
    <x-slot name="heading">Second Appeal List</x-slot>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>File No</th>
                                    <th>Who Came From</th>
                                    <th>Subject</th>
                                    <th>Old Document</th>
                                    <th>To Whom It Was Entrusted</th>
                                    <th>Who Was Presented</th>
                                    <th>Who Was Sent</th>
                                    <th>Final Disposal Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lists as $index => $list)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $list->file_no }}</td>
                                        <td>{{ $list->who_came_from }}</td>
                                        <td>{{ $list->subject }}</td>
                                        <td><a target="blank" href="{{ asset('storage/'. $list->old_document ) }}">View Document</a></td>
                                        <td>{{ $list->to_whom_it_was_entrusted }}</td>
                                        <td>{{ $list->who_was_presented }}</td>
                                        <td>{{ $list->who_was_sent }}</td>
                                        <td>{{ $list->final_disposal }}</td>
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