<div class="shadow-3 card mt-5 p-3">

    <div class="d-flex justify-content-center">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show col-6" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show col-6">{{ session('error') }}
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </div>


    <!-- Confirm delete modal -->
    <div class="modal fade" id="confirmDeleteModal"
         tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
         aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the selected Roles?
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    <button data-bs-dismiss="modal" type="button" class="btn btn-danger" wire:click="deleteSelected()">
                        Delete
                    </button>

                </div>
            </div>
        </div>
    </div>


    <div class="d-flex justify-content-between m-3 p-3 border-bottom">

        <a href="{{route('admin.role.create')}}">
            <button class="btn btn-primary">Create
                <i class="fas ms-1 fa-add"></i>
            </button>
        </a>
        <h5 wire:loading.remove>Role ({{\App\Models\Admin\User\Role::count()}})</h5>

        <div wire:loading class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="d-flex flex-row justify-content-center align-content-center">

            <div class="mr-5">
                <div class="input-group rounded">
                    <label>
                        <input type="text" class="form-control" placeholder="Search" wire:model.debounce.500ms="search">
                    </label>
                </div>

            </div>


            <div>


                <p class="nav-item " role="button"
                   data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">

                    <i class="ms-3 fas fa-trash fa-lg" style="opacity: {{ empty($selectedItems) ? 0.5 : 1 }}"></i>
                    <span style="font-size: 10px" class="badge rounded-pill badge-notification mb-auto bg-danger">
                             {{ count($selectedItems) }}
                    </span>
                </p>

            </div>

        </div>
    </div>

    <div class="container mt-3 p-3">

        <table class="table-responsive table">
            <thead class="table-primary">
            <tr>
                <th scope="col">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAllCheckbox"
                               wire:model="selectAll">
                        <label class="form-check-label" for="selectAllCheckbox">

                        </label>
                    </div>

                </th>
                <th scope="col">#</th>
                <th scope="col">Role</th>
                <th scope="col">Permissions</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>

            @forelse($roles as $role)
                <tr>

                    <th scope="row">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $role->id }}"
                                   id="checkbox-{{ $role->id }}" wire:model="selectedItems">
                            <label class="form-check-label" for="checkbox-{{ $role->id }}"></label>
                        </div>
                    </th>
                    <td>
                        {{$loop->iteration }}
                    </td>
                    <td>
                        {{ $role->name }}
                    </td>

                    <td>
                        <ul style="list-style: none;">
                            <li class="nav-item dropdown">
                                @if($role->permissions->isEmpty())
                                    <span class="text-danger">No permissions found.</span>
                                @else
                                    <button class="btn btn-outline-primary btn-sm dropdown-toggle"  id="navbarDropdown"
                                      type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{--    @foreach($role->permissions as $key => $permission)
                                            @if($key === 0)
                                                <span class="">  {{ ucwords($permission->name)  }}</span>
                                            @endif
                                        @endforeach--}}
                                        <span class="text-dark">See</span>

                                    </button>
                                    <ul class="dropdown-menu p-2" aria-labelledby="navbarDropdown">
                                        @foreach($role->permissions as $permission)
                                            <li>

                                                <a class="dropdown-item disabled" href="#">
                                                    <img class="" src="{{asset('admin/images/icons/correct.png')}}"
                                                         alt="{{$permission->id}}" width="15" height="15"/>

                                                    <span class="text-dark">{{ ucwords($permission->name) }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                            <li><hr class="dropdown-divider bg-info"></li>
                                            <li class=""><a class="dropdown-item" href="{{route('admin.role.show',$role)}}">Edit <i class="fa fa-edit"></i> </a></li>
                                    </ul>
                                @endif
                            </li>
                        </ul>


                        {{--       @forelse($role->permissions as $key => $permission)
                                   @if($key === 0)
                                       <span class="">  {{ ucwords($permission->name) }}</span>
                                   @endif
                               @empty
                                   <span class="text-danger"> not any permissions found.</span>
                               @endforelse--}}
                    </td>

                    <td>
                        {{\App\Utili\Helper::limitStr($role->description)}}
                    </td>
                    <td>
                        <a class="btn btn-primary" type="submit" href="{{route('admin.role.show',$role)}}"
                           role="button">
                            show
                            <i class="ms-1 far fa-eye"></i>
                        </a>
                    </td>

                </tr>
            @empty

                <tr class="font-weight-normal ">
                    <td colspan="10"><span>not any role found.</span></td>
                </tr>

            @endforelse


            </tbody>


        </table>

        {{ $roles->links()}}

    </div>


</div>


@push('scripts')
    <script>

    </script>
@endpush
