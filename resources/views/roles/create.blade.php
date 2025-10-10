<x-master>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Create New Role</h5>
                    <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
                </div>
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                    <br>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            @foreach ($groupedPermissions as $group => $permissions)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title mb-0"> <strong>{{ ucfirst($group) }} Permissions:</strong></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <br>
                                                @foreach ($permissions as $permission)
                                                    <label>
                                                        <input type="checkbox" name="permission[]" value="{{ $permission['name'] }}" class="name">
                                                        {{ $permission['name'] }}
                                                    </label>
                                                    <br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </x-master>
