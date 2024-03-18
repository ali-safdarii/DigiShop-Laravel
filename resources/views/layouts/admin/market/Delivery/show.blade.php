@extends('layouts.admin.master')

@section('title','delivery')
@section('content')


    <div class="main-content">

        <x-custom-component.delete-modal :message="'deliveries?'"
                                         :route=" route('market.delivery.destroy', ['delivery' => $delivery->id]) "
        />

        <form id="brand-form" class="needs-validation"
              action="{{route('market.delivery.update',$delivery->id)}}" method="post"
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
                            <label class="form-label" for="name">Name</label>
                            <input type="text" value="{{$delivery->name}}" id="name" name="name"
                                   class="form-control" required/>

                            <div class="invalid-feedback">
                                Required.
                            </div>
                        </div>


                        <div class="form-content ">

                            <div class="form-input">
                                <label class="bottom-element form-label" for="amount">Amount</label>
                                <input type="number" value="{{$delivery->amount}}" id="amount" name="amount"
                                       class="form-control"/>
                            </div>


                            <div class="form mt-5">
                                <select class="form-select" name="status" aria-label="status" id="status" required>
                                    <option value="1" {{ $delivery->status == 1 ? 'selected' : '' }}>Enabled</option>
                                    <option value="0" {{ $delivery->status == 0 ? 'selected' : '' }}>Disabled</option>
                                </select>
                            </div>


                        </div>


                        <div class="form-input mt-4">
                            <label class="form-label" for="description">Description</label>
                            <textarea dir="rtl" class="form-control text-start" name="description" id="description"
                                      rows="30"
                                      required style="height: 20rem">
                                {{$delivery->description}}
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

