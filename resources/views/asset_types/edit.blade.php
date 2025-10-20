
<!-- `resources/views/asset_types/edit.blade.php` -->
<x-master>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title mb-0 flex-grow-1">Edit Asset Type</h4>
                    <a href="{{ route('asset-types.index') }}" class="btn btn-sm btn-outline-secondary">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('asset-types.update', $assetType->id) }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')

                        <div class="col-12">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="{{ old('name', $assetType->name) }}" class="form-control" required>
                            @error('name') <p class="text-danger small">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description', $assetType->description) }}</textarea>
                            @error('description') <p class="text-danger small">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-12 d-flex justify-content-between">
                            <div>
                                <a href="{{ route('asset-types.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Save</button>

                                <form action="{{ route('asset-types.destroy', $assetType->id) }}" method="POST" onsubmit="return confirm('Delete this type?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-master>
