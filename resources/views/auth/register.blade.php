<x-auth>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->


        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">


                <div class="row justify-content-center">
                    <div class="">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="d-flex justify-content-center mt-2 col-md-8 col-lg-6 col-xl-5">
                                    <img src="{{asset('logo-color.png')}}" alt="{{config('app.name')}}" style="max-width:100%">

                                </div>
                                <div class="p-2 mt-4">
                                    <p class="text-muted tex t-center">Create your Account</p>
                                    <form class="row g-3" action="{{route('staff.register')}}" method="POST">
                                        @csrf
                                        <div class="col-md-4">
                                            <label for="validationDefault01" class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="validationDefault01" name="first_name"  >
                                            @error('first_name')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationDefault02" class="form-label">Middle Name <small class="text-primary">optional</small></label>
                                            <input type="text" class="form-control" id="validationDefault02" name="middle_name"   >
                                            @error('middle_name')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationDefault01" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="validationDefault01" name="last_name"  >
                                            @error('last_name')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationDefaultUsername" class="form-label">Email</label>

                                            <input type="email" class="form-control" id="validationDefaultUsername" name="email"  >
                                            @error('email')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror

                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationDefault01" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="validationDefault01" name="phone"  >
                                            @error('phone')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationDefault03" class="form-label">Natonal ID</label>
                                            <input type="text" class="form-control" id="validationDefault03" name="national_id" >
                                            @error('national_id')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="validationDefault01" class="form-label">Gender</label>
                                            <select class="js-example-basic-single"  name="gender"  >
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            @error('type_id')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationDefault03" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="validationDefault03" name="password" >
                                            @error('password')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationDefault03" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="validationDefault03" name="password_confirmation" >

                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            <button class="btn btn-primary" type="submit" >Register</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <!-- end card body -->

                        </div>
                        <!-- end card -->


                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->
    </div>
    @section('script')
        <script src="{{ URL::asset('assets/libs/particles.js/particles.js.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/pages/particles.app.js') }}"></script>
        <script src="{{ URL::asset('assets/js/pages/password-addon.init.js') }}"></script>

    @endsection

</x-auth>
