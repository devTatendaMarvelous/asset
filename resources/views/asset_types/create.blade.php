
<!-- `resources/views/asset_types/create.blade.php` -->
<x-master>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Asset Type</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('asset-types.store') }}" method="POST" class="row g-3">
                        @csrf

                        <div class="col-12">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                            @error('name') <p class="text-danger small">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                            @error('description') <p class="text-danger small">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-12 d-flex justify-content-center">
                            <a href="{{ route('asset-types.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-master>
