<x-auth>

        <div class="auth-page-wrapper pt-5">
            <!-- auth page bg -->
            <!-- auth page content -->
            <div class="auth-page-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="card mt-4">

                                <div class="card-body p-4">
                                    <div class="text-center mt-2">
                                        <img src="https://ww5.msu.ac.zw/wp-content/uploads/2018/08/main-logo.png" alt="{{config('app.name')}}" style="max-width:100%">

                                    </div>
                                    <div class="p-2 mt-4">
                                        <h3 class="text-center">Asset Management System</h3>
                                        <p class="text-muted text-center">Sign in to continue to.</p>
                                        <form action="{{ route('login') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Email</label>
                                                <input type="text" class="form-control @error('email') is-invalid @enderror"  id="username" name="email" placeholder="Enter username">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <div class="float-end">
                                                    <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                                                </div>
                                                <label class="form-label" for="password-input">Password</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror" name="password" placeholder="Enter password" id="password-input" >
                                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                            </div>
                                        </form>

                                        <div class=" mt-3   ">
                                            Do not have an account?
                                            <a href="{{ route('register') }}" class="text-muted">Register</a>
                                        </div>
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
