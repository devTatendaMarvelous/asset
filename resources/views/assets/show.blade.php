<!-- resources/views/assets/show.blade.php -->
<x-master>

    <div class="container mt-4">
        <div class="card shadow mx-auto">
            <!-- Asset Profile Header -->
            <div class="bg-primary bg-gradient p-4 text-white">
                <div class="d-flex align-items-center">
                    <div class="position-relative me-3">
                        <img src="https://elearning.msu.ac.zw/assets/images/logo.png" alt="Asset Image"
                             class="rounded-circle border border-2 border-white shadow" width="80" height="80">
                        <div
                            class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white d-flex align-items-center justify-content-center"
                            style="width: 24px; height: 24px;">
                            <i class="bi bi-check-lg text-white small"></i>
                        </div>
                    </div>
                    <div>
                        <h2 class="fs-3 fw-bold mb-0 text-white">{{$asset->brand}}</h2>
                        <p class="text-light mb-0">Asset ID: {{$asset->serial_number}}</p>
                    </div>
                    <span class="ms-auto badge @if($asset->status === 'ASSIGNED') bg-success text-white
                                @elseif($asset->status === 'LOST') bg-warning text-dark
                                @elseif($asset->status === 'STOLEN') bg-danger text-white
                                @endif rounded-pill px-3 py-2 shadow-sm">{{$asset->status}}</span>
                </div>

                <!-- Download Button -->
                <div class="mt-3 d-flex justify-content-end">
                    <a href="{{route('assets.qr.download',[$asset->id])}}" class="btn btn-light text-primary d-flex align-items-center gap-2">
                        <i class="bi bi-download"></i>
                        <span>Download Asset Card</span>
                    </a>
                </div>
                @if($asset->status === 'ASSIGNED')
                <!-- Download Button -->
                <div class="mt-3 d-flex justify-content-end">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#parentsFilterModal">
                        <i class="bi bi-download"></i>
                        <span>Blacklist Asset</span>
                    </a>
                </div>
                @endif
            </div>

            <!-- Asset Details -->
            <div class="p-4">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h3 class="card-title d-flex align-items-center mb-3">
                                    <i class="bi bi-info-circle text-primary me-2"></i>
                                    Details
                                </h3>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item bg-light d-flex justify-content-between">
                                        <span>Type:</span><span class="fw-medium">{{$asset->type->name??'N/A'}}</span>
                                    </li>
                                    <li class="list-group-item bg-light d-flex justify-content-between">
                                        <span>Serial:</span><span class="fw-medium">{{$asset->serial_number}}</span>
                                    </li>
                                    <li class="list-group-item bg-light d-flex justify-content-between">
                                        <span>Owner:</span><span class="fw-medium">{{$asset->user->name??'N/A'}}</span>
                                    </li>
                                    <li class="list-group-item bg-light d-flex justify-content-between">
                                        <span>Date Added:</span><span class="fw-medium">{{$asset->created_at}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Asset Logs -->
                <div class="mt-4">
                    <h3 class="d-flex align-items-center mb-3">
                        <i class="bi bi-calendar-event text-primary me-2"></i>
                        Activity Logs
                    </h3>
                    <div class="card bg-light">
                        <div class="card-body p-0">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Details</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($asset->logs as $log)
                                    <tr>
                                        <td>{{$log->action}}</td>
                                        <td>{{$log->details??'N/A'}}</td>
                                        <td>{{parseDate( $log->created_at)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                    <div class="mt-4">
                        <h3 class="d-flex align-items-center mb-3">
                            <i class="bi bi-calendar-event text-primary me-2"></i>
                            Blacklist Logs
                        </h3>
                        <div class="card bg-light">
                            <div class="card-body p-0">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Reason</th>
                                        <th>Is Active</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($asset->blacklists as $blacklist)
                                        <tr>
                                            <td>{{$blacklist->reason}}</td>
                                            <td>{{$blacklist->active?'Yes':'No'}}</td>
                                            <td>{{parseDate( $blacklist->created_at)}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


            </div>
        </div>
    </div>





    <div class="modal fade" id="parentsFilterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1220px!important;">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="mt-4">
                        <h4 class="mb-3">Please Enter Filter Parameters</h4>
                        <form action="{{route('assets.blacklist',[$asset->id])}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationDefault02" class="form-label">Type</label>
                                   <select class="form-control" name="type">
                                       <option value="LOST">LOST</option>
                                       <option value="STOLEN">STOLEN</option>
                                   </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationDefault02" class="form-label">Reason</label>
                                    <input type="text" class="form-control"  name="reason"  required>
                                </div>
                            </div>


                            <div class="hstack gap-2 justify-content-center">
                                <a href="javascript:void(0);" class="btn btn-danger  fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                                <button type="submit" class="btn btn-secondary col-3 ">Blacklist</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-master>
