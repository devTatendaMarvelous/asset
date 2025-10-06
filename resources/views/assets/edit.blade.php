<x-master>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add New Asset </h4>
                </div>
                <!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <form class="row g-3" action="{{route('gadgets.update',$asset->id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="col-md-6">
                                <label for="validationDefault02" class="form-label">Asset Type</label>
                                <select class="form-select"  name="type_id">
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}" {{$type->id===$asset->type_id?'selected':''}}>{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="validationDefault02" class="form-label">Brand</label>
                                <input type="text" class="form-control" id="validationDefault02" name="brand"  value="{{$asset->brand}}" >
                                @error('brand')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="validationDefault01" class="form-label">Serial Number</label>
                                <input type="text" class="form-control" id="validationDefault01" name="serial_number"  value="{{$asset->serial_number}}" >
                                @error('serial_number')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="validationDefault02" class="form-label"> Description</label>
                                <textarea  class="form-control" id="validationDefault02" name="description"   >{{$asset->description}}</textarea>
                                @error('description')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

{{--                            @if(auth()->user()->hasRole('Student'))--}}
                                <input type="hidden" name="user_id" value="{{$asset->user_id}}">
{{--                            @else--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label for="validationDefault02" class="form-label">Student</label>--}}
{{--                                    <select class="form-select"  name="user_id">--}}
{{--                                        @foreach($students as $student)--}}
{{--                                            <option value="{{$student->id}}">{{$student->name}} {{$student->reg_number}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            @endif--}}

                            <div class="col-12 d-flex justify-content-center">
                                <button class="btn btn-primary" type="submit" >Add Asset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</x-master>
