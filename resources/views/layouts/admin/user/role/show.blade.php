@extends('layouts.admin.master')

@section('title','Role')


@section('content')

    <div class="main-content">

        <x-custom-component.delete-modal :message="'role?'"
                                         :route=" route('admin.role.destroy', ['role' => $role->id]) "
        />


        <form id="brand-form" class="needs-validation"
              action="{{route('admin.role.update',$role->id)}}" method="post"
              enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            <div class="d-flex flex-wrap justify-content-center align-items-center card
                p-5 rounded-5 w-75 mx-auto my-5 ">

                <div class="ms-auto">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal">
                        <i class="fas fa-trash"></i>
                        <span class="ms-1">Delete</span>

                    </button>

                </div>


                <div class="col-sm-12 col-md-6 col-lg-6 p-3">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="form-content">
                        <div class="form-input">
                            <label class="form-label" for="name">Role Name</label>
                            <input value="{{$role->name}}" type="text" id="name" name="name" class="form-control"
                                   required/>
                        </div>
                    </div>

                    <div class="form-input mt-4">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="10"
                                  required>{{$role->description}}</textarea>
                    </div>


                    <div class="row">
                        <div class="mt-3 ms-3 mb-1">
                            <label class="">Permissions</label>
                            <hr/>
                        </div>
                        @foreach($permissions as $permission)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input ms-1" type="checkbox" name="permissions[]"
                                           value="{{ $permission->id }}"
                                           id="checkbox-{{ $permission->id }}"
                                           @if(in_array( $permission->id,$role->permissions->pluck('id')->toArray() )) checked @endif
                                    >
                                    <label class="form-check-label " for="checkbox-{{ $permission->id }}">
                                        {{ ucwords($permission->name) }}
                                    </label>
                                </div>
                            </div>
                            @if($loop->iteration % 3 == 0)
                    </div>
                    <div class="row">
                        @endif
                        @endforeach
                    </div>

                    <div class="mt-5"></div>
                    <div class="text-center mt-5 mb-2">
                        <button class="btn w-50 btn-secondary" type="submit">
                            Update
                            <i class="fas fa-edit ms-2"></i>
                        </button>
                    </div>

                </div>
            </div>
        </form>

    </div>
@endsection

@section('custom-script')
    <script>
        // Enable Bootstrap form validation
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endsection
