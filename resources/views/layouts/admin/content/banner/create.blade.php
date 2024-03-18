@extends('layouts.admin.master')

@section('title','Banner')

@section('content')
    <div class="main-content ">
        <form class="needs-validation" action="{{route('content.banners.store')}}" method="post"
              enctype="multipart/form-data" id="form" novalidate>
            @csrf
            <div
                class="d-flex flex-wrap justify-content-center align-items-center card p-5 rounded-5 w-75 mx-auto my-5 ">
                <div class="col-sm-12 col-md-6 col-lg-6 p-3">


                    <div class="form-content">
                        <div class="form-input">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" id="title" name="title" class="form-control" required/>
                        </div>


                        <div class="form-input bottom-element">
                            <label class="form-label" for="url">Url</label>
                            <input type="text" id="url" name="url" class="form-control" required/>
                        </div>

                        <div class="form bottom-element">
                            <label class="form-label" for="position">Position</label>
                            <select class="form-select" name="position" aria-label="status" id="position" required>
                                @foreach(\App\Models\Admin\Content\Banner::$positions  as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form bottom-element">
                            <label class="form-label" for="is_used_mobile">Smartphone</label>
                            <select class="form-select" name="is_used_mobile" aria-label="is_used_mobile"
                                    id="is_used_mobile" required>
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                            <div class="mt-2">
                                <span class="text-sm  text-danger form-label" style="font-size: 14px">Note: If is Enabled: only showing for <span
                                        class="text-sm text-danger fw-bold" style="text-decoration: underline">SmallDevices</span></span>

                            </div>
                        </div>


                        <div class="form bottom-element">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select" name="status" aria-label="status" id="status" required>
                                <option disabled value="">Select status</option>
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>
                        <div class="form-input bottom-element">
                            <input type="file" class="form-control" name="image" id="image" aria-label="Upload"
                                   required/>
                        </div>
                        <div class="form-input bottom-element">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="10"
                                      required></textarea>
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
