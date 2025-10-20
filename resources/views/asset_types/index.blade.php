<!-- `resources/views/asset_types/index.blade.php` -->
<x-master>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title mb-0 flex-grow-1">Asset Types</h4>
                    <a href="{{ route('asset-types.create') }}" class="btn btn-sm btn-primary">Add New</a>
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($types as $type)
                                <tr>
                                    <td>{{ $type->id }}</td>
                                    <td>{{ $type->name }}</td>
                                    <td>{{ $type->description }}</td>
                                    <td>{{ $type->created_at->format('Y-m-d') }}</td>
                                    <td class="d-flex gap-2">

                                            <a href="{{ route('asset-types.edit', $type->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                            <form action="{{ route('asset-types.destroy', $type->id) }}" method="POST" onsubmit="return confirm('Delete this type?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                            </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">No asset types found.</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(method_exists($types, 'links'))
                        <div class="mt-3">{{ $types->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-master>
