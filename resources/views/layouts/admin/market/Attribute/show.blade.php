@extends('layouts.admin.master')

@section('title','Attribute')

@section('content')
      <div class="main-content ">

          <x-custom-component.delete-modal :message="'attributes?'"
                                           :route=" route('market.attributes.destroy', ['attribute' => $attribute->id]) "
                                           />

          <form class="needs-validation" action="{{route('market.attributes.update',$attribute)}}" method="post"
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
                          <div class="form-input has-validation">
                              <label class="form-label" for="name">Name</label>
                              <input type="text" value="{{$attribute->name}}" id="name" name="name"
                                     class="form-control" required/>

                              <div class="invalid-feedback">
                                  Required.
                              </div>
                          </div>

                          <div class="form-input has-validation">
                              <label class="form-label bottom-element" for="unit">Unit</label>
                              <input type="text" value="{{$attribute->unit}}" id="unit" name="unit"
                                     class="form-control" required/>

                              <div class="invalid-feedback">
                                  Required.
                              </div>
                          </div>


                          <div class="form-group">
                              <label class="form-label bottom-element " for="category_id">Category</label>
                              <select class="form-select" name="category_id" aria-label="category_id" id="category_id"
                                      required>
                                  @foreach($categories as $cat)
                                      <option
                                          value="{{$cat->id}}" {{ $attribute->category->id == $cat->id ? 'selected' : '' }} >{{$cat->name}}</option>
                                  @endforeach
                              </select>
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
