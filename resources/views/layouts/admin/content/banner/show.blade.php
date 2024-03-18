@extends('layouts.admin.master')

@section('title','template')

@section('content')
    <div class="main-content ">


        <x-custom-component.delete-modal :message="'banners?'"
                                         :route=" route('content.banners.destroy', ['banner' => $banner->id]) "
        />


        <form class="needs-validation"
              action="{{route('content.banners.update',$banner->id)}}" method="post"
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

                        <div class="form-input has-validation">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" value="{{$banner->title}}" id="title" name="title"
                                   class="form-control" required/>

                            <div class="invalid-feedback">
                                Required.
                            </div>
                        </div>


                        <div class="form bottom-element">
                            <label class="form-label" for="position">Position</label>
                            <select class="form-select" name="position" aria-label="position" id="position" required>
                                @foreach (\App\Models\Admin\Content\Banner::$positions as $key => $value)
                                    <option value="{{ $key }}" {{ $key == $banner->position ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach

                            </select>
                        </div>


                        <div class="form-content">

                            <label class="bottom-element form-label" for="url">Url</label>
                            <div class="form-input">

                                <input type="text" value="{{$banner->url}}" id="url"
                                       name="url"
                                       class="form-control"/>
                            </div>


                            <div class="form bottom-element">
                                <label class="form-label" for="is_used_mobile">Smartphone</label>
                                <select class="form-select" name="is_used_mobile" aria-label="is_used_mobile"
                                        id="is_used_mobile" required>
                                    <option value="1" {{ $banner->is_used_mobile == 1 ? 'selected' : '' }}>Enable
                                    </option>

                                    <option value="0" {{ $banner->is_used_mobile == 0 ? 'selected' : '' }}>Disable
                                    </option>

                                </select>
                                <div class="mt-2">
                                <span class="text-sm  text-danger form-label" style="font-size: 14px">Note: If is Enabled: only showing for <span
                                        class="text-sm text-danger fw-bold" style="text-decoration: underline">SmallDevices</span></span>

                                </div>
                            </div>

                            <div class="form mt-4">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-select" name="status" aria-label="status" id="status" required>
                                    <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Enabled</option>
                                    <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Disabled</option>
                                </select>
                            </div>


                            <div class="form-input mt-3">
                                <input type="file" class="form-control"
                                       name="image" id="image"
                                       aria-label="Upload"
                                />

                            </div>
                            <div class="form-input mt-4">
                                <label class="form-label" for="description">Description</label>
                                <textarea dir="rtl" class="form-control text-start" name="description" id="description"
                                          rows="30"
                                          required style="height: 20rem">
                                {{$banner->description}}
                            </textarea>
                            </div>
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
