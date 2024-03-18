@extends('layouts.admin.master')

@section('title','product')
@section('content')


    <div class="main-content ">


        <form class="needs-validation" action="{{route('market.product.store')}}" method="post"
              enctype="multipart/form-data" id="form" novalidate>
            @csrf
            <section
                class="d-flex flex-wrap justify-content-center align-items-center card p-5 rounded-5 w-75 mx-auto my-5">

                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <input value="{{ old('name') }}" type="text" id="name" name="name" class="form-control"
                                       required/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="model_name">Model</label>
                                <input value="{{ old('model_name') }}" type="text" id="model_name" name="model_name" class="form-control"
                                       required/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="price">Price</label>
                                <input value="{{ old('price') }}" type="number" id="price" name="price"
                                       class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 align-self-end">
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
                        <div class="col-md-4 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="brand_id">Brand</label>
                                <select class="form-select" name="brand_id" aria-label="brand_id" id="brand_id"
                                        required>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 align-self-end">
                            {{-- @if(count($colors) > 0)--}}
                                <div class="form-group">

                                    <label class="form-label bottom-element " for="default_color_id">Defualt
                                        Color</label>
                                    <select class="form-select" name="default_color_id" aria-label="default_color_id"
                                            id="default_color_id"
                                            required>

                                        @foreach($colors as $color)
                                            <option value="{{$color->id}}">{{$color->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="weight">Weight</label>
                                <input value="{{ old('weight') }}" type="number" id="weight" name="weight"
                                       class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="length">Length</label>
                                <input value="{{ old('length') }}" type="number" id="length" name="length"
                                       class="form-control"/>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="width">Width</label>
                                <input value="{{ old('width') }}" type="number" id="width" name="width"
                                       class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="height">Height</label>
                                <input value="{{ old('height') }}" type="number" id="height" name="height"
                                       class="form-control"/>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="status">Status</label>
                                <select class="form-select" name="status" aria-label="status" id="status" required>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="marketable">Marketable</label>
                                <select class="form-select" name="marketable" aria-label="marketable" id="marketable"
                                        required>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">

                                <label class="form-label bottom-element" for="tags-input">Tags</label>
                                <input placeholder="" type="text" id="tags-input" name="tags-input"
                                       class="form-control"/>

                            </div>

                        </div>


                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="image">Image</label>
                                <input type="file" class="form-control" name="image" id="image" aria-label="Upload"
                                       required/>
                            </div>

                        </div>


                    </div>

                    <div>
                        <div type="hidden" style="display:none;" class="form-group">
                            <label class="form-label" for="tags-hidden-input"></label>
                            <input class="form-control" type="text" id="tags-hidden-input"
                                   name="tags[]"/>
                        </div>
                        <div class="" id="tags-container"></div>

                    </div>


                    <div class="form-input mt-4">
                        <label class="form-label element" for="introduction">Introduction</label>
                        <textarea class="form-control" name="introduction" id="introduction" rows="10"
                                  required></textarea>
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


        console.log("Page loadeding")

        const tagsInput = document.getElementById("tags-input");
        const hiddenInput = document.getElementById("tags-hidden-input");
        const tagsContainer = document.getElementById("tags-container");

        let tags = [];

        tagsInput.addEventListener("keydown", function (event) {
            if (event.key === "Enter" || event.key === ",") {
                event.preventDefault();
                addTag(tagsInput.value.trim());
                tagsInput.value = "";
                hiddenInput.value = tags.join(",");

            }
        });

        function addTag(tag) {
            if (tag !== "" && !tags.includes(tag)) {
                tags.push(tag);
                tagsInput.value = tags.join(", ");
                const tagElement = document.createElement("span");
                tagElement.classList.add("tag");
                tagElement.textContent = tag;

                const removeButton = document.createElement("span");
                removeButton.classList.add("remove-button");
                removeButton.innerHTML = "&times;";
                tagElement.addEventListener("click", function () {
                    removeTag(tagElement);
                });
                tagElement.appendChild(removeButton);
                tagsContainer.appendChild(tagElement);
            }

        }


        function removeTag(tagElement) {
            const tag = tagElement.textContent.slice(0, -1); // remove the "×" character
            const tagIndex = tags.indexOf(tag);
            if (tagIndex !== -1) {
                tags.splice(tagIndex, 1);
                tagsInput.value = tags.join(", ");
                tagElement.remove();
                tagsInput.value = ''
                hiddenInput.value = tags.join(","); // update hidden input value

            }
        }


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
