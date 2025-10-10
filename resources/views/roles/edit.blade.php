<x-master>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Edit Role</h5>
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

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" value="{{ $role->name }}" name="name" class="form-control"
                           placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Permission:</strong>
                    <br />

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
                                                    <input type="checkbox" name="permission[]" @if (in_array($permission->id, $rolePermissions)) checked @endif value="{{ $permission['name'] }}" class="name">
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

{{--                    @foreach ($groupedPermissions as $value)--}}
{{--                        <label>--}}
{{--                            <input type="checkbox" @if (in_array($value->id, $rolePermissions)) checked @endif name="permission[]"--}}
{{--                                   value="{{ $value->id }}" class="name">--}}
{{--                            {{ $value->name }}</label>--}}
{{--                        <br />--}}
{{--                    @endforeach--}}
                </div>
            </div>
            <div class="col-xs-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
                </div>
            </div>
        </div>
    </div>


    </x-master>
