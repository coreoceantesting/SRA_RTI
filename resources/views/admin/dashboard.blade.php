<x-admin.layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="heading">Dashboard</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

    <div class="row">
        <div class="col-12">
            <div class="d-flex flex-column h-100">
                <div class="row h-100">
                    <div class="col-12 d-none">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="alert alert-warning border-0 rounded-0 m-0 d-flex align-items-center" role="alert">
                                    <i data-feather="alert-triangle" class="text-warning me-2 icon-sm"></i>
                                    <div class="flex-grow-1 text-truncate">
                                        Your free trial
                                        expired in
                                        <b>17</b> days.
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="pages-pricing.html" class="text-reset text-decoration-underline"><b>Upgrade</b></a>
                                    </div>
                                </div>

                                <div class="row align-items-end">
                                    <div class="col-sm-8">
                                        <div class="p-3">
                                            <p class="fs-16 lh-base">
                                                Upgrade your
                                                plan from a
                                                <span class="fw-semibold">Free
                                                    trial</span>, to
                                                ‘Premium
                                                Plan’
                                                <i class="mdi mdi-arrow-right"></i>
                                            </p>
                                            <div class="mt-3">
                                                <a href="pages-pricing.html" class="btn btn-success">Upgrade
                                                    Account!</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="px-3">
                                            <img src="assets/images/user-illustarator-2.png" class="img-fluid" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-body-->
                        </div>
                    </div>
                    <!-- end col-->
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-animate" style="background-color: aqua;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3 class="fw-medium mb-0">
                                            Total RTI
                                        </h3>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value" data-target="{{ $rtiCounts }}">{{ $rtiCounts }}</span>
                                        </h2>
                                        <p class="mb-0 d-none">
                                            <span class="badge bg-light text-success mb-0"><i class="ri-arrow-up-line align-middle"></i>
                                                16.24 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="users" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div>
                    <!-- end col-->

                    <div class="col-md-4">
                        <div class="card card-animate" style="background-color: aquamarine;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3 class="fw-medium mb-0">
                                            Total Appeal
                                        </h3>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value" data-target="{{ $appealCount }}">{{ $appealCount }}</span>
                                        </h2>
                                        <p class="mb-0 d-none">
                                            <span class="badge bg-light text-danger mb-0">
                                                <i class="ri-arrow-down-line align-middle"></i>
                                                3.96 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="activity" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div>
                    <!-- end col-->

                    <div class="col-md-4">
                        <div class="card card-animate" style="background-color: rgb(212, 237, 162);">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3 class="fw-medium mb-0">
                                            Total Approve RTI
                                        </h3>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value" data-target="{{ $approveRtiCount }}">{{ $approveRtiCount }}</span>
                                        </h2>
                                        <p class="mb-0 d-none">
                                            <span class="badge bg-light text-danger mb-0">
                                                <i class="ri-arrow-down-line align-middle"></i>
                                                3.96 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="activity" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div>
                    <!-- end col-->

                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card border-primary p-2">
                            <div class="card-header bg-primary mt-3">
                                <h4 style="color: white">Latest RTI</h4>
                            </div>
                            <div class="card-body mt-3">
                                @php
                                    $serialNumber = 1;
                                @endphp
                                <table id="buttons-datatables" class="table table-bordered nowrap align-middle">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Application Name</th>
                                            <th>Mobile No</th>
                                            <th>Received Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rtilists as $list)
                                            <tr>
                                                <td>{{ $serialNumber++ }}</td>
                                                <td>{{ $list->applicant_name }}</td>
                                                <td>{{ $list->mobile_no }}</td>
                                                <td>{{ $list->received_date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- row close --}}

            </div>
        </div>

        <div class="col-xxl-7 d-none">
            <div class="row h-100">
                <div class="col-xl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">
                                Live Users By Country
                            </h4>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-soft-primary btn-sm">
                                    Export Report
                                </button>
                            </div>
                        </div>
                        <!-- end card header -->

                        <!-- card body -->
                        <div class="card-body">
                            <div id="users-by-country" data-colors='["--vz-light"]' class="text-center" style="height: 252px"></div>

                            <div class="table-responsive table-card mt-3">
                                <table class="table table-borderless table-sm table-centered align-middle table-nowrap mb-1">
                                    <thead class="text-muted border-dashed border border-start-0 border-end-0 bg-light-subtle">
                                        <tr>
                                            <th>
                                                Duration
                                                (Secs)
                                            </th>
                                            <th style="
                                                    width: 30%;
                                                ">
                                                Sessions
                                            </th>
                                            <th style="
                                                    width: 30%;
                                                ">
                                                Views
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        <tr>
                                            <td>0-30</td>
                                            <td>2,250</td>
                                            <td>4,250</td>
                                        </tr>
                                        <tr>
                                            <td>31-60</td>
                                            <td>1,501</td>
                                            <td>2,050</td>
                                        </tr>
                                        <tr>
                                            <td>61-120</td>
                                            <td>750</td>
                                            <td>1,600</td>
                                        </tr>
                                        <tr>
                                            <td>121-240</td>
                                            <td>540</td>
                                            <td>1,040</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-xl-6">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">
                                Sessions by Countries
                            </h4>
                            <div>
                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                    ALL
                                </button>
                                <button type="button" class="btn btn-soft-primary btn-sm">
                                    1M
                                </button>
                                <button type="button" class="btn btn-soft-secondary btn-sm">
                                    6M
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div>
                                <div id="countries_charts" data-colors='["--vz-info", "--vz-info", "--vz-info", "--vz-info", "--vz-danger", "--vz-info", "--vz-info", "--vz-info", "--vz-info", "--vz-info"]' class="apex-charts" dir="ltr">
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col-->
            </div>
            <!-- end row-->
        </div>
    </div>



    @push('scripts')
    @endpush

</x-admin.layout>
