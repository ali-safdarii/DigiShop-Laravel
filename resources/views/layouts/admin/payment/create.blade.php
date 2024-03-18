@extends('layouts.admin.master')


@section('title','Payment')
@section('content')

    <div class="main-content ">
        <form class="needs-validation" action="{{route('market.payments.store')}}" method="post"
              enctype="multipart/form-data" id="form" novalidate>
            @csrf
            <div
                class="d-flex flex-wrap justify-content-center align-items-center card p-5 rounded-5 w-75 mx-auto my-5 ">
                <div class="col-sm-12 col-md-6 col-lg-6 p-3">


                    <div class="form-content">

                        <div class="form-input">
                            <label class="form-label" for="user_id">User</label>
                            <select class="form-select " name="user_id" id="user_id" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->FullName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-input">
                            <label class="form-label bottom-element" for="payment_amount">Payment Amount:</label>
                            <input type="number" class="form-control" name="payment_amount" id="payment_amount"
                                   required>
                        </div>

                        <div class="form-input">
                            <label class="form-label bottom-element" for="payment_date">Payment Date:</label>
                            <input type="date" class="form-control" name="payment_date" id="payment_date" required>
                        </div>

                        <div class="form-input">
                            <label class="form-label bottom-element" for="payment_method">Payment Method:</label>
                            <select class="form-select" name="payment_method" id="payment_method" required>
                                <option value="Cash">Cash</option>
                                <option value="Online">Online</option>
                                <option value="Offline">Offline</option>
                            </select>
                        </div>

                        <div class="form-input">
                            <label class="form-label bottom-element" for="payment_status">Payment Status:</label>
                            <select class="form-select" name="payment_status" id="payment_status" required>
                                <option value="Completed">Completed</option>
                                <option value="Pending">Pending</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="form-input mt-4">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="10"
                                      ></textarea>
                        </div>


                        <div class="mt-5"></div>
                        <div class="text-center mt-5 mb-2">
                            <button class="btn w-50 btn-primary" type="submit">Create</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

@endsection

@section('custom-script')

    <script>

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
