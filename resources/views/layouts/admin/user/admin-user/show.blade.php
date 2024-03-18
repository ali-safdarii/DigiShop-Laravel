@extends('layouts.admin.master')

@section('title','admin')
@section('content')


    <div class="main-content">

        <x-custom-component.delete-modal :message="'admin-user?'"
                                         :route=" route('admin.admin.destroy', ['admin' => $user->id]) "
        />


        <form id="admin-form" class="needs-validation"
              action="{{route('admin.admin.update',$user->id)}}" method="post"
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

                            <label class="form-label" for="first_name">FirstName</label>
                            <input type="text" value="{{$user->first_name}}" id="first_name" name="first_name"
                                   class="form-control" required/>
                        </div>


                        <div class="form-content">

                            <div class="form-input">
                                <label class="bottom-element form-label" for="last_name">LastName</label>
                                <input type="text" value="{{$user->last_name}}" id="last_name" name="last_name"
                                       class="form-control"/>
                            </div>


                            <div class="form">
                                <label class="bottom-element form-label" for="status">Status</label>
                                <select class="form-select" name="status" aria-label="status" id="status" required>
                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Enabled</option>
                                    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Disabled</option>
                                </select>
                            </div>

                            <div class="form">
                                <label class="bottom-element form-label" for="status">Active</label>
                                <select class="form-select" name="activation" aria-label="activation" id="activation"
                                        required>
                                    <option value="1" {{ $user->activation == 1 ? 'selected' : '' }}>Enabled</option>
                                    <option value="0" {{ $user->activation == 0 ? 'selected' : '' }}>Disabled</option>
                                </select>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-input">
                            <label class="bottom-element form-label" for="image">Avatar</label>
                            <input type="file" class="form-control"
                                   name="image" id="image"
                                   aria-label="Upload"/>
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

