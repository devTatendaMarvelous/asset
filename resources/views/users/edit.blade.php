
<x-master>
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="{{ URL::asset('assets/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">

        </div>
    </div>

    <div class="row">
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            <img src="{{ $user->photo?asset('storage/'.$user->photo):URL::asset('assets/images/users/avatar-1.jpg') }}"
                                 class="  rounded-circle avatar-xl img-thumbnail user-profile-image"
                                 alt="user-profile-image">
{{--                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">--}}
{{--                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">--}}
{{--                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">--}}
{{--                                    <span class="avatar-title rounded-circle bg-light text-body">--}}
{{--                                        <i class="ri-camera-fill"></i>--}}
{{--                                    </span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
                        </div>
                        <h5 class="fs-16 mb-1">{{$user->last_name. ' '.$user->first_name}}</h5>
                        <p class="text-muted mb-0">@foreach($user->roles as $role)
                                {{$role->name}}
                                {{$loop->last?'':', '}}
                            @endforeach</p>
                    </div>
                </div>
            </div>

            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">

                                Personal Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">

                                Change Password
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <form action="{{route('users.update',[$user->id])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    @if($user->hasRole('Student'))
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="firstnameInput" class="form-label">Registration Number</label>
                                            <input type="text" class="form-control" id="firstnameInput"
                                                   placeholder="Enter your firstname" name="reg_number" value="{{$user->reg_number}}">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="firstnameInput" class="form-label">
                                                Name</label>
                                            <input type="text" class="form-control" id="firstnameInput"
                                                   placeholder="Enter your firstname" name="name" value="{{$user->name}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="lastnameInput" class="form-label">
                                                Phone
                                                </label>
                                            <input type="text" class="form-control" id="lastnameInput"
                                                   placeholder="Enter your lastname" name="phone" value="{{$user->phone}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Email
                                                Address</label>
                                            <input type="email" class="form-control" id="emailInput"
                                                   placeholder="Enter your email" name="email" value="{{$user->email??'N/A'}}">
                                        </div>
                                    </div>
                                        @if(!$user->hasRole('Student'))
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Status</label>
                                            <select class="js-example-basic-single"  name="role"  >
                                                @foreach($roles as $role)
                                                <option value="{{$role->name}}" {{$role->name===$user->roles()->first()->name?"selected":''}}>{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                        @else
                                            <input type="hidden" name="role" value="Student">
                                        @endif
                                    <!--end col-->

                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-soft-success">Cancel</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form action="{{route('users.password',[$user->id])}}" method="POST">
                                @csrf
                                <div class="row g-2">

                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="newpasswordInput" class="form-label">New
                                                Password*</label>
                                            <input type="password" class="form-control" name="password" id="newpasswordInput"
                                                   placeholder="Enter new password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="confirmpasswordInput" class="form-label">Confirm
                                                Password*</label>
                                            <input type="password" name="password_confirmation" class="form-control" id="confirmpasswordInput"
                                                   placeholder="Confirm password">
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Change
                                                Password</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>

                        </div>
                        <!--end tab-pane-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
</x-master>
