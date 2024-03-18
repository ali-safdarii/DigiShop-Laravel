@extends('layouts.admin.master')


@section('title','Payment')
@section('content')


    <div class="main-content ">
        <x-custom-component.delete-modal :message="'attributes?'"
                                         :route=" route('market.payments.destroy', ['payment' => $payment->id]) "
        />

        <form class="needs-validation" action="{{route('market.payments.update',$payment->id)}}" method="post"
              id="form" novalidate>
            @csrf
            @method('PUT')
            <div class="d-flex flex-wrap justify-content-center align-items-center card p-5 rounded-5 w-75 mx-auto my-5 ">

                <div class="ms-auto">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal">
                        <i class="fas fa-trash"></i>
                        <span class="ms-1">Delete</span>
                    </button>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6 p-3">



                    <div class="form-content">

                        <div class="form-input">
                            <label class="form-label" for="user_id">User</label>
                            <select class="form-select " name="user_id" id="user_id" required>
                                @foreach($users as $user)
                                    <option
                                        value="{{ $user->id }}" {{ $payment->user_id == $user->id ? 'selected' : '' }}>{{ $user->FullName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-input">
                            <label class="form-label bottom-element" for="payment_amount">Payment Amount:</label>
                            <input type="number" value="{{$payment->payment_amount}}" class="form-control"
                                   name="payment_amount" id="payment_amount"
                                   required>
                        </div>

                        <div class="form-input">
                            <label class="form-label bottom-element" for="payment_date">Payment Date:</label>
                            <input type="date" value="{{$payment->payment_date}}" class="form-control"
                                   name="payment_date" id="payment_date" required>
                        </div>

                        <div class="form-input">
                            <label class="form-label bottom-element" for="payment_method">Payment Method:</label>
                            <select class="form-select" name="payment_method" id="payment_method" required>
                                <option value="Cash" {{ $payment->payment_method == 'Cash' ? 'selected' : '' }}>Cash
                                </option>
                                <option value="Online" {{ $payment->payment_method == 'Online' ? 'selected' : '' }}>
                                    Online
                                </option>
                                <option value="Offline" {{ $payment->payment_method == 'Offline' ? 'selected' : '' }}>
                                    Offline
                                </option>
                            </select>
                        </div>

                        <div class="form-input">
                            <label class="form-label bottom-element" for="payment_status">Payment Status:</label>
                            <select class="form-select" name="payment_status" id="payment_status" required>
                                <option value="Pending" {{ $payment->payment_status == 'Pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option
                                    value="Completed" {{ $payment->payment_status == 'Completed' ? 'selected' : '' }}>
                                    Completed
                                </option>
                                <option
                                    value="Cancelled" {{ $payment->payment_status == 'Cancelled' ? 'selected' : '' }}>
                                    Cancelled
                                </option>
                            </select>
                        </div>

                        <div class="form-group mt-4">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" id="description"
                                      rows="10">{!! nl2br($payment->description) !!}</textarea>
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
