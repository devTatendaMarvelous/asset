
<x-master>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Assign Institution to {{$user->first_name.' '.$user->last_name}}</td></h4>
                </div>
                <!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <form class="row g-3" action="{{route('users.storeInstitution',[$user->id])}}" method="POST">
                            @csrf
                            <div class="col-md-4">
                                <label for="validationDefault01" class="form-label">Institution</label>
                                <select class="js-example-basic-single"  name="institution_id" >
                                    @forelse(getInstitutions() as $institution)
                                        <option value="{{$institution->id}}">{{$institution->name}}</option>
                                    @empty
                                    @endforelse
                                    @error('institution_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="validationDefault01" class="form-label">user Role(s)</label>
                                <select id="roles" class="js-example-basic-multiple"  name="roles[]"  multiple="multiple" >

                                    @forelse(getRoles() as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                    @empty
                                    @endforelse
                                    @error('type_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </select>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <button class="btn btn-primary" type="submit" >Assign </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</x-master>

