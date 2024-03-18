@extends('layouts.admin.master')

@section('title','values')

@section('content')

    <div class="main-content ">

            <x-custom-component.delete-modal :message="'values?'"
                                             :route=" route('market.attributes.value.update', ['attribute' => $attribute, 'value' => $value]) "
            />

        <form class="needs-validation"
              action="{{route('market.attributes.value.update', ['attribute' => $attribute, 'value' => $value])}}"
              method="post"
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

                <div class="col-sm-12 col-md-6 col-lg-6 p-3">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="form-content">


                        <div class="form-group">
                            <label class="form-label bottom-element " for="product_id">Product</label>
                            <select class="form-select" name="product_id" aria-label="product_id" id="product_id"
                                    required>
                                @foreach($attribute->category->products as $product)
                                    <option
                                        value="{{$product->id}}" {{ $value->product_id == $product->id ? 'selected' : '' }} >{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label class="form-label bottom-element" for="value">Value</label>
                            <input type="number" id="value" value="{{json_decode($value->value)->value ?? ''}}" name="value"
                                   class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label class="form-label bottom-element" for="price_inc">Price Inc</label>
                            <input type="number" id="price_inc" value="{{json_decode($value->value)->price_inc ?? ''}}"
                                   name="price_inc" class="form-control" required/>
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

            </section>

        </form>


    </div>
@endsection
