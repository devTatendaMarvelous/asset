<x-master>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">assets</h5>
                </div>
                <div class="card-body">
                    <table id="scroll-horizontal" class=" table  nowrap align-middle" style="width:100%">
                        <thead>
                        <tr>
                            <th>Student</th>
                            <th>Brand</th>
                            <th>Serial</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($assets as $asset)
                            <tr>
                                <td>{{$asset->user->name??'n/a'}}</td>
                                <td>{{$asset->brand}}</td>
                                <td>{{$asset->serial_number}}</td>
                                <td>{{$asset->description}}</td>
                            <td >
                                <p class="
                                @if($asset->status === 'ASSIGNED') bg-success text-white
                                @elseif($asset->status === 'LOST') bg-warning text-dark
                                @elseif($asset->status === 'STOLEN') bg-danger text-white
                                @endif
                                p-1 rounded text-center
                            ">
                                {{$asset->status}}
                                </p>
                            </td>
                                <td>{{$asset->created_at}}</td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a href="{{route('gadgets.show',[$asset->id])}}" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                            <li><a href="{{route('gadgets.edit',[$asset->id])}}" class="dropdown-item edit-item-btn text-primary"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse

                    </table>
                    <div class="d-flex justify-content-between">

                        {{--                        <div class="dataTables_info"  >Showing {{15*($students->currentPage())}} to {{15*($students->currentPage()-1)}} of {{$students->total()}} entries</div>--}}
                        <div class="dataTables_info"  ></div>
                        {{$assets->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->

</x-master>
