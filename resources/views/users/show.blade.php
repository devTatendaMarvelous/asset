<x-master>
    <!-- Profile Background Banner -->
    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="{{ URL::asset('assets/images/profile-bg.jpg') }}" alt="" class="profile-wid-img"/>
        </div>
    </div>

    <!-- Profile Header Section -->
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
        <div class="row g-4">
            <!-- Profile Picture -->
            <div class="col-auto">
                <div class="avatar-lg">
                    <img src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}"
                         alt="student-img" class="img-thumbnail rounded-circle"/>
                </div>
            </div>

            <!-- Student Name & Details -->
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{$user->name}}</h3>
                    <p class="text-white-75"> {{$user->reg_number}}</p>
                    <div class="hstack text-white-50 gap-1">
                        <div class="me-2">
                            <i class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>
                            Computer Science Department
                        </div>
                        <div>
                            <i class="ri-building-line me-1 text-white-75 fs-16 align-middle"></i>
                            Class of 2025
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Stats -->
            <div class="col-12 col-lg-auto order-last order-lg-0">
                <div class="row text text-white-50 text-center">
                    <div class="col-lg-6 col-4">
                        <div class="p-2">
                            <h4 class="text-white mb-1">3.8</h4>
                            <p class="fs-14 mb-0">GPA</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-4">
                        <div class="p-2">
                            <h4 class="text-white mb-1">85</h4>
                            <p class="fs-14 mb-0">Credits</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="row">
        <div class="col-lg-12">
            <div>
                <!-- Tab Navigation -->
                <div class="d-flex">
                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                <i class="ri-airplay-fill d-inline-block d-md-none"></i>
                                <span class="d-none d-md-inline-block">Overview</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#assets-tab" role="tab">
                                <i class="ri-laptop-line d-inline-block d-md-none"></i>
                                <span class="d-none d-md-inline-block">Assets</span>
                            </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#courses-tab" role="tab">--}}
{{--                                <i class="ri-book-open-line d-inline-block d-md-none"></i>--}}
{{--                                <span class="d-none d-md-inline-block">Courses</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#records-tab" role="tab">--}}
{{--                                <i class="ri-folder-4-line d-inline-block d-md-none"></i>--}}
{{--                                <span class="d-none d-md-inline-block">Records</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                    <div class="flex-shrink-0">
                        <a href="#" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Edit
                            Profile</a>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="tab-content pt-4 text-muted">
                    <!-- Overview Tab -->
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-xxl-3">
                                <!-- Profile Completion Card -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-5">Profile Completion</h5>
                                        <div class="progress animated-progress custom-progress progress-label">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 85%"
                                                 aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                                <div class="label">85%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Student Information Card -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Student Information</h5>
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                <tr>
                                                    <th class="ps-0" scope="row">Full Name:</th>
                                                    <td class="text-muted">John Michael Doe</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Student ID:</th>
                                                    <td class="text-muted">STU-2024-0042</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Mobile:</th>
                                                    <td class="text-muted">(123) 456-7890</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Email:</th>
                                                    <td class="text-muted">john.doe@university.edu</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Department:</th>
                                                    <td class="text-muted">Computer Science</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Enrollment Date:</th>
                                                    <td class="text-muted">Sep 15, 2021</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Emergency Contact Card -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Emergency Contact</h5>
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                <tr>
                                                    <th class="ps-0" scope="row">Name:</th>
                                                    <td class="text-muted">Robert Doe</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Relation:</th>
                                                    <td class="text-muted">Father</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Contact:</th>
                                                    <td class="text-muted">(987) 654-3210</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-xxl-9">
                                <!-- About Student -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">About</h5>
                                        <p>Computer Science student specializing in Artificial Intelligence and Machine
                                            Learning. Active member of the University Robotics Club and Coding
                                            Competition Team. Looking to develop skills in software engineering and data
                                            science.</p>

                                        <div class="row mt-4">
                                            <div class="col-md-4">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                        <div
                                                            class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                            <i class="ri-graduation-cap-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="mb-1">Major:</p>
                                                        <h6 class="text-truncate mb-0">Computer Science</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                        <div
                                                            class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                            <i class="ri-building-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="mb-1">Dorm:</p>
                                                        <h6 class="text-truncate mb-0">West Hall, Room 304</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                        <div
                                                            class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                            <i class="ri-user-2-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <p class="mb-1">Advisor:</p>
                                                        <h6 class="text-truncate mb-0">Dr. Elizabeth Chen</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Recent Activity -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Recent Activity</h5>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item px-0">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-file-text-line text-primary fs-18 me-2"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Submitted Midterm Project</h6>
                                                        <p class="text-muted mb-0">CS401 - Advanced Algorithms - 2 days
                                                            ago</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item px-0">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-calendar-check-line text-success fs-18 me-2"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Registered for Spring Semester</h6>
                                                        <p class="text-muted mb-0">4 courses selected - 1 week ago</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item px-0">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0">
                                                        <i class="ri-award-line text-warning fs-18 me-2"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Dean's List Recognition</h6>
                                                        <p class="text-muted mb-0">Fall Semester 2023 - 2 months ago</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Overview Tab -->

                    <!-- Assets Tab -->
                    <div class="tab-pane" id="assets-tab" role="tabpanel">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h5 class="card-title mb-0 flex-grow-1">Assigned Assets</h5>
                                <div class="flex-shrink-0">
                                    <button class="btn btn-primary btn-sm">Request New Asset</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    @foreach($user->assets as $asset)
                                    <!-- Asset Card 1: Laptop -->
                                    <div class="col-md-6">
                                        <div class="card border shadow-none h-100">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-sm">
                                                                                                        <span
                                                                                                            class="avatar-title bg-primary-subtle text-primary rounded">
                                                                                                            <i class="ri-macbook-line fs-20"></i>
                                                                                                        </span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h5 class="mb-1">{{$asset->brand}}</h5>
                                                        <p class="text-muted mb-2">Asset ID: #{{$asset->serial_number}}</p>
                                                        <span class="badge bg-success-subtle text-success">Active</span>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-ghost-primary dropdown-toggle"
                                                                type="button" data-bs-toggle="dropdown">
                                                            <i class="ri-more-2-fill"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="{{route('gadgets.show',[$asset->id])}}"><i
                                                                        class="ri-eye-fill me-2 align-bottom text-muted"></i>View
                                                                    Details</a></li>
                                                            <li><a class="dropdown-item" href="{{route('assets.qr.download',[$asset->id])}}"><i
                                                                        class="ri-download-2-line me-2 align-bottom text-muted"></i>Download
                                                                    Asset Card</a></li>
                                                            <li><a class="dropdown-item" href="#"><i
                                                                        class="ri-error-warning-line me-2 align-bottom text-muted"></i>Report
                                                                    Issue</a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <hr class="my-3">

{{--                                                <div class="row text-center">--}}
{{--                                                    <div class="col-4">--}}
{{--                                                        <div>--}}
{{--                                                            <p class="text-muted mb-1">Condition</p>--}}
{{--                                                            <h6 class="mb-0 fs-14">Excellent</h6>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-4">--}}
{{--                                                        <div>--}}
{{--                                                            <p class="text-muted mb-1">Assigned</p>--}}
{{--                                                            <h6 class="mb-0 fs-14">Jan 12, 2023</h6>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-4">--}}
{{--                                                        <div>--}}
{{--                                                            <p class="text-muted mb-1">Due Return</p>--}}
{{--                                                            <h6 class="mb-0 fs-14">Dec 15, 2025</h6>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

                                                <hr class="my-3">

                                                <h6 class="text-muted mb-3">Recent Activity</h6>
                                                <ul class="list-unstyled mb-0">
                                                    <li class="d-flex mb-2">
                                                        <i class="ri-checkbox-circle-line text-success me-2 fs-15"></i>
                                                        <span
                                                            class="text-muted">Maintenance check completed on Jun 01</span>
                                                    </li>
                                                    <li class="d-flex">
                                                        <i class="ri-checkbox-circle-line text-success me-2 fs-15"></i>
                                                        <span
                                                            class="text-muted">Software update installed on May 15</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Assets Tab -->

                    <!-- Other tabs would be filled with relevant content -->
                    <div class="tab-pane" id="courses-tab" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Courses content would go here</h5>
                                <p class="card-text">This tab would contain the student's courses.</p>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="records-tab" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Records content would go here</h5>
                                <p class="card-text">This tab would contain the student's academic records.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master>
