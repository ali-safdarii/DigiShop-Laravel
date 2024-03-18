@extends('layouts.admin.master')

@section('title','discount')

@section('content')
    <div class="main-content ">
        <x-custom-component.delete-modal :message="'discounts?'"
                                         :route=" route('market.discounts.destroy', ['discount' => $discount->id]) "
        />

        <form class="needs-validation" action="{{route('market.discounts.update',$discount)}}" method="post"
              enctype="multipart/form-data" id="form" novalidate>
            @csrf
            @method('PUT')
            <section
                class="d-flex flex-wrap justify-content-center align-items-center card p-5 rounded-5 w-75 mx-auto my-5 ">

                <div class="ms-auto">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal">
                        <i class="fas fa-trash"></i>
                        <span class="ms-1">Delete</span>
                    </button>

                </div>


                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">

                                <label class="form-label" for="discount_code">Discount Code</label>
                                <input type="text" value="{{$discount->discount_code}}" id="discount_code"
                                       name="discount_code" class="form-control"
                                       required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">

                                <label class="form-label" for="start_date">Start Date</label>
                                <input value="{{ $discount->start_date ? \Carbon\Carbon::parse($discount->start_date)->format('Y-m-d') : '' }}" type="date" id="start_date" name="start_date"
                                       class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">

                                <label class="form-label" for="end_date">End Date</label>
                                <input value="{{ $discount->end_date ? \Carbon\Carbon::parse($discount->end_date)->format('Y-m-d') : '' }}" type="date" id="end_date" name="end_date"
                                       class="form-control" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element " for="user_id">User</label>
                                <select class="form-select" name="user_id" aria-label="user_id" id="user_id">
                                    <option value="">Select User</option>
                                    @if(isset($discount->user_id))
                                        @foreach($users as $user)
                                            <option
                                                value="{{$user->id}}" {{ $discount->user->id == $user->id ? 'selected' : '' }} >{{$user->FullName}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label" for="discount_type">Discount Type</label>
                                <select class="form-select" name="discount_type" id="discount_type" required>
                                    <option
                                        value="Percentage" {{ $discount->discount_type == 'Percentage' ? 'selected' : '' }} >
                                        Percentage
                                    </option>
                                    <option
                                        value="Fixed Amount" {{ $discount->discount_type == 'Fixed Amount' ? 'selected' : '' }}>
                                        Fixed Amount
                                    </option>
                                </select>
                            </div>
                        </div>


                    </div>


                    <div class="row">
                        <div class="col-md-3 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="discount_value">Discount Value</label>
                                <input value="{{$discount->discount_value}}" class="form-control" type="number"
                                       id="discount_value" name="discount_value"
                                       step="0.01" required/>
                            </div>
                        </div>
                        <div class="col-md-3 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="minimum_order_amount">Min Amount</label>
                                <input placeholder="Set Min Amount Here" value="{{$discount->minimum_order_amount }}" class="form-control" type="number"
                                       id="minimum_order_amount"
                                       name="minimum_order_amount" step="0.01"/>
                            </div>
                        </div>


                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="maximum_uses">Max Uses</label>
                                <input placeholder="Set Max Uses Here"  value="{{$discount->maximum_uses}}" type="number" id="maximum_uses"
                                       name="maximum_uses" class="form-control" required/>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-3 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="usage_count">Usage Count</label>
                                <input value="{{$discount->usage_count}}" type="number" id="usage_count"
                                       name="usage_count" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-md-3 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="is_active">IsActive</label>
                                <select class="form-select" name="is_active" aria-label="is_active" id="is_active"
                                        required>
                                    <option value="1" {{ $discount->is_active == 1 ? 'selected' : '' }}>Enabled</option>
                                    <option value="0" {{ $discount->is_active == 0 ? 'selected' : '' }}>Disabled
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="is_public">is Public</label>
                                <select class="form-select" name="is_public" aria-label="is_public" id="is_public"
                                        required>
                                    <option value="1" {{ $discount->is_public == 1 ? 'selected' : '' }}>Enabled</option>
                                    <option value="0" {{ $discount->is_public == 0 ? 'selected' : '' }}>Disabled
                                    </option>
                                </select>
                            </div>
                        </div>


                    </div>

                    <div class="form-input mt-4">
                        <label class="form-label element" for="description">Introduction</label>
                        <textarea class="form-control" name="description" id="description" rows="10"
                                  required>{{$discount->description}}</textarea>
                    </div>


                    <div class="text-center mt-5 mb-2">
                        <button class="btn w-50 btn-secondary" type="submit">Update</button>
                    </div>


                </div>

            </section>

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
