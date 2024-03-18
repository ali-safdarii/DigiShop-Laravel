@extends('layouts.admin.master')

@section('title','amazing-sale')

@section('content')
    <div class="main-content">

        <x-custom-component.delete-modal :message="'amazing-sales?'"
                                         :route=" route('market.amazing-sale.destroy', ['amazing_sale' => $amazingSale->id]) "
        />

        <form class="needs-validation" action="{{route('market.amazing-sale.update',$amazingSale)}}" method="post"
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
                                <label class="form-label" for="product_id">Product</label>
                                <select class="form-select" name="product_id" aria-label="product_id" id="product_id">
                                    <option value="">Select Product</option>
                                    @if(isset($amazingSale->product_id))
                                        @foreach($products as $product)
                                            <option
                                                value="{{$product->id}}" {{ $amazingSale->product->id == $product->id ? 'selected' : '' }} >{{$product->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">

                                <label class="form-label" for="start_date">Start Date</label>
                                <input value="{{ $amazingSale->start_date ? \Carbon\Carbon::parse($amazingSale->start_date)->format('Y-m-d') : '' }}" type="date" id="start_date" name="start_date"
                                       class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">

                                <label class="form-label" for="end_date">End Date</label>
                                <input value="{{ $amazingSale->end_date ? \Carbon\Carbon::parse($amazingSale->end_date)->format('Y-m-d') : '' }}" type="date" id="end_date" name="end_date"
                                       class="form-control" required/>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="status">Status</label>
                                <select class="form-select" name="status" aria-label="status" id="status" required>
                                    <option value="1" {{ $amazingSale->status == 1 ? 'selected' : '' }}>Enabled</option>
                                    <option value="0" {{ $amazingSale->status == 0 ? 'selected' : '' }}>Disabled</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="percentage">Percentage</label>
                                <input type="number" id="percentage" value="{{$amazingSale->percentage}}" name="percentage" class="form-control" required/>
                            </div>
                        </div>
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

@endsection
