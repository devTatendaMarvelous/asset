<x-master>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add {{$is_student?'Student':'User'}} </h4>
                </div>
                <!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <form class="row g-3" action="{{route(($is_student?'students':'users').'.store')}}"
                              method="POST">
                            @csrf
<input type="hidden" name="is_student" value="{{$is_student}}">
                            @if($is_student)
                                <div class="col-md-6">
                                    <label for="validationDefault02" class="form-label">Registration Number</label>
                                    <input type="text" class="form-control" id="validationDefault02" name="reg_number"
                                           id="reg_number" required>
                                    @error('reg_number')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            @endif
                            <div class="col-md-6">
                                <label for="validationDefault02" class="form-label">Name</label>
                                <input type="text" class="form-control" id="validationDefault02" name="name" id="name" required>
                                @error('name')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="validationDefault02" class="form-label">Email</label>
                                <input type="email" class="form-control" id="validationDefault02" name="email"
                                       id="email" required>
                                @error('email')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="validationDefault02" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="validationDefault02" name="phone"
                                       id="phone">
                                @error('phone')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            @if($is_student)
                                <input type="hidden" name="role" value="Student">
                                @else
                                <div class="col-md-6">
                                    <label for="validationDefault02" class="form-label">Role</label>
                                    <select class="form-control js-example-basic-single" name="role">
                                        @foreach($roles as $role)
                                            <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('phone')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            @endif
                            <div class="col-12 d-flex justify-content-center">
                                <button class="btn btn-primary" type="submit">
                                    Add {{$is_student?'Student':'User'}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</x-master>

