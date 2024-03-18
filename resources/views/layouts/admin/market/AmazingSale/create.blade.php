@extends('layouts.admin.master')

@section('title','amazing-sale')

@section('content')
    <div class="main-content ">
        <form class="needs-validation" action="{{route('market.amazing-sale.store')}}" method="post"
              enctype="multipart/form-data" id="form" novalidate>
            @csrf
            <section
                class="d-flex flex-wrap justify-content-center align-items-center card p-5 rounded-5 w-75 mx-auto my-5">

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label " for="product_id">Product</label>
                                <select class="form-select" name="product_id" aria-label="product_id" id="product_id">

                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="start_date">Start Date</label>
                                <input type="datetime-local" id="start_date" name="start_date" class="form-control" required/>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="end_date">End Date</label>
                                <input type="datetime-local" id="end_date" name="end_date" class="form-control" required/>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="status">Status</label>
                                <select class="form-select" name="status" aria-label="status" id="status" required>
                                    <option value="">Select status</option>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="percentage">Percentage</label>
                                <input type="number" id="percentage" name="percentage" class="form-control" required/>

                            </div>
                        </div>
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

@endsection
