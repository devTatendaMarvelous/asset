<x-master>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Show Role</h5>
                    <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
                </div>
                <div class="card-body">


    <div class="row">
        <div class="col-xs-12 mb-3">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 mb-3">
            <div class="form-group">
                <strong>Permissions:</strong>
                @if (!empty($rolePermissions))
                    @foreach ($rolePermissions as $v)
                        <label class="label label-secondary text-dark">{{ $v->name }},</label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
                </div>
            </div>
        </div>
    </div>
</x-master>
