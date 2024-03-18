@extends('layouts.admin.master')

@section('title','Admin')
@section('content')

    <div class="main-content ">
        <form class="needs-validation" action="{{route('admin.admin.store')}}" method="post"
              enctype="multipart/form-data" id="form" novalidate>
            @csrf
            <div
                class="d-flex flex-wrap justify-content-center align-items-center card p-5 rounded-5 w-75 mx-auto my-5 ">
                <div class="col-sm-12 col-md-6 col-lg-6 p-3">


                    <div class="form-content">
                        <div class="form-input">
                            <label class="form-label" for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" required/>
                        </div>

                        <div class="form-input">
                            <label class="form-label bottom-element" for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" required/>
                        </div>

                        <div class="form-input">
                            <label class="form-label bottom-element" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required/>
                        </div>

                        <div class="form-input">
                            <label class="form-label bottom-element" for="mobile">Phone</label>
                            <input type="tel" id="mobile" name="mobile" class="form-control" required/>
                        </div>

                        <div class="form-input">
                            <label class="form-label bottom-element" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required/>
                        </div>

                        <div class="form-input">
                            <label class="form-label bottom-element" for="password_confirmation">ConfirmPasswrod</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="form-control" required/>
                        </div>

                        <div class="form-input mt-5">
                            <label class="form-label" for="image">Avatar</label>
                            <input type="file" class="form-control" name="image" id="image"
                                   aria-label="Upload"
                                   />
                        </div>

                        <div class="form bottom-element">
                            <label class="form-label" for="status"> Status </label>
                            <select class="form-select" name="status" aria-label="status" id="status" required>
                                <option value="0">Disable</option>
                                <option value="1">Enable</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-5"></div>
                    <div class="text-center mt-5 mb-2">
                        <button class="btn w-50 btn-primary" type="submit">Create</button>
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
