@extends('layouts.admin.master')



@section('title','Attribute')
@section('content')


    <div class="main-content ">
        <form class="needs-validation" action="{{route('market.attributes.store')}}" method="post"
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
                            <label class="form-label bottom-element" for="unit">Unit</label>
                            <input type="text" id="unit" name="unit" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label class="form-label bottom-element " for="category_id">Category</label>
                            <select class="form-select" name="category_id" aria-label="category_id" id="category_id"
                                    required>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
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
