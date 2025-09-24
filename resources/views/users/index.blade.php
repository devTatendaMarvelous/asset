<x-master>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0"> {{$is_student?'Students':'Users'}} List</h5>
                    <div>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staffFilterModal">
                            <i class='fa fa-sliders'></i> Filter</a>

                    </div>
                </div>
                <div class="card-body">
                    <table id="scroll-horizontal" class=" table  nowrap align-middle" style="width:100%">
                        <thead>
                        <tr>

                            <th> Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            @if(!str_contains(url()->current(), 'students'))
                                <th>Role</th>
                            @endif

                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>

                                <td>{{$user->name}} </td>
                                <td>{{$user->phone}} </td>
                                <td>{{$user->email??'N/A'}}</td>

                                @if(!str_contains(url()->current(), 'students'))
                                    <td>
                                        @foreach($user->roles as $role)
                                            {{$role->name}}
                                            {{$loop->last?'':', '}}
                                        @endforeach
                                    </td>
                                @endif

                                <td>{{$user->status}}</td>

                                <td class="d-flex justify-content-between">
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @if(str_contains(url()->current(), 'students'))
                                                <li>
                                                    <a href="{{route('users.show',[$user->id])}}" class="dropdown-item">
                                                        <i class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                        View
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{route('users.edit',[$user->id])}}"
                                                   class="dropdown-item edit-item-btn text-primary"><i
                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    Edit</a>
                                            </li>
                                    </div>
                                </td>

                            </tr>
                        @empty
                        @endforelse

                    </table>
                    <div class="d-flex justify-content-between">

                        {{--                        <div class="dataTables_info"  >Showing {{15*($students->currentPage())}} to {{15*($students->currentPage()-1)}} of {{$students->total()}} entries</div>--}}
                        <div class="dataTables_info"></div>
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->

    <!--end row-->
    <div class="modal fade" id="staffFilterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1220px!important;">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="mt-4">
                        <h4 class="mb-3">Please Enter Filter Parameters</h4>
                        <form action="{{route(($is_student?'students':'users').'.index')}}" method="GET">
                            @csrf

                            <div class="row">
                                @if($is_student)
                                    <div class="col-md-4 mb-3">
                                        <label for="validationDefault02" class="form-label">Registration Number</label>
                                        <input type="text" class="form-control" name="reg_number">
                                    </div>
                                @endif
                                <div class="col-md-4 mb-3">
                                    <label for="validationDefault02" class="form-label"> Name </label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationDefault02" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="validationDefault02" class="form-label"> </label>
                                    <input type="text" class="form-control" name="last_name">
                                </div>
                            </div>


                            <div class="hstack gap-2 justify-content-center">
                                <a href="javascript:void(0);" class="btn btn-danger  fw-medium" data-bs-dismiss="modal"><i
                                        class="ri-close-line me-1 align-middle"></i> Close</a>
                                <button type="submit" class="btn btn-secondary col-3 "><i class='fa fa-search'></i>
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-master>
