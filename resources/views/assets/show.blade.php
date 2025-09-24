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
                        <p class="text-light mb-0">Asset ID: #A12345</p>
                    </div>
                    <span class="ms-auto badge bg-success rounded-pill px-3 py-2 shadow-sm">{{$asset->status}}</span>
                </div>

                <!-- Download Button -->
                <div class="mt-3 d-flex justify-content-end">
                    <a href="{{route('assets.qr.download',[$asset->id])}}" class="btn btn-light text-primary d-flex align-items-center gap-2">
                        <i class="bi bi-download"></i>
                        <span>Download Asset Card</span>
                    </a>
                </div>
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
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-light d-flex justify-content-between align-items-center">
                                    <span class="text-primary fw-medium">2024-06-01</span>
                                    <span>Routine maintenance completed</span>
                                </li>
                                <li class="list-group-item bg-light d-flex justify-content-between align-items-center">
                                    <span class="text-primary fw-medium">2024-05-15</span>
                                    <span>Assigned to Jane Doe</span>
                                </li>
                                <li class="list-group-item bg-light d-flex justify-content-between align-items-center">
                                    <span class="text-primary fw-medium">2024-04-10</span>
                                    <span>Warranty claim processed</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master>
