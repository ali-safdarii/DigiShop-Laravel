@extends('layouts.admin.master')

@section('title','Delivery')
@section('content')

    <div class="main-content ">
        <form class="needs-validation" action="{{route('market.delivery.store')}}" method="post"
              enctype="multipart/form-data" id="form" novalidate>
            @csrf
            <div
                class="d-flex flex-wrap justify-content-center align-items-center card p-5 rounded-5 w-75 mx-auto my-5 ">
                <div class="col-sm-12 col-md-6 col-lg-6 p-3">


                    <div class="form-content">
                        <div class="form-input">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required/>
                        </div>

                        <div class="form-input">
                            <label class="form-label bottom-element" for="amount">Amount</label>
                            <input type="number" id="amount" name="amount" class="form-control"/>
                        </div>

                      {{-- <div class="form-input">
                           <label class="form-label" for="delivery_time">Start</label>
                           <input id="delivery_time" name="delivery_time" class="form-control"
                                  type="date" />
                       </div>--}}

                        <div class="form bottom-element">
                            <select class="form-select" name="status" aria-label="status" id="status" required>
                                <option value="">Select status</option>
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>

                        <div class="form-input mt-4">
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
