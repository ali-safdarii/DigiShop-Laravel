@extends('layouts.admin.master')

@section('title','discount')

@section('content')
    <div class="main-content ">
        <form class="needs-validation" action="{{route('market.discounts.store')}}" method="post"
              enctype="multipart/form-data" id="form" novalidate>
            @csrf
            <section
                class="d-flex flex-wrap justify-content-center align-items-center card p-5 rounded-5 w-75 mx-auto my-5">

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="discount_code">Discount Code</label>
                                <input type="text" id="discount_code" name="discount_code" class="form-control"
                                       required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="start_date">Start Date</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" required/>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="end_date">End Date</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" required/>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element " for="user_id">User</label>
                                <select class="form-select" name="user_id" aria-label="user_id" id="user_id"
                                >
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->FullName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label" for="discount_type">Discount Type</label>
                                <select class="form-select" name="discount_type" id="discount_type" required>
                                    <option value="Percentage">Percentage</option>
                                    <option value="Fixed Amount">Fixed Amount</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="discount_value">Discount Value</label>
                                <input class="form-control" type="number" id="discount_value" name="discount_value"
                                       step="0.01" required/>
                            </div>
                        </div>
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="minimum_order_amount">Min Amount</label>
                                <input class="form-control" type="number" id="minimum_order_amount"
                                       name="minimum_order_amount" step="0.01"/>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="maximum_uses">Max Uses</label>
                                <input type="number" id="maximum_uses" name="maximum_uses" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="usage_count">Usage Count</label>
                                <input type="number" id="usage_count" name="usage_count" class="form-control" required/>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="is_active">Is Active</label>
                                <select class="form-select" name="is_active" aria-label="is_active" id="is_active"
                                        required>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="is_public">Is Public</label>
                                <select class="form-select" name="is_public" aria-label="is_public" id="is_public"
                                        required>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-input mt-4">
                        <label class="form-label element" for="description">description</label>
                        <textarea class="form-control" name="description" id="description" rows="10"
                                  ></textarea>
                    </div>


                    <div class="text-center mt-5 mb-2">
                        <button class="btn w-50 btn-primary" type="submit">Create</button>
                    </div>


                </div>
            </section>

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

