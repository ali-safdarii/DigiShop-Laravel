@extends('layouts.admin.master')

@section('title','product')
@section('content')


    <div class="main-content ">




        <x-custom-component.delete-modal :message="'products?'"
                                         :route=" route('market.product.destroy', ['product' => $product->id]) "
        />

        <form class="needs-validation" action="{{route('market.product.update',$product)}}" method="post"
              enctype="multipart/form-data" id="form" novalidate>
            @csrf
            @method('PUT')
            <section
                class="d-flex flex-wrap justify-content-center align-items-center card p-5 rounded-5 w-75 mx-auto my-5 ">

                <ul style="list-style: none;">
                    <li class="@if($product->category && $product->category->parent_id == null) text-danger @endif" style="">
                        <h4>Category: {{ $product->category ? $product->category->full_category_name : 'Parent' }}</h4>
                    </li>
                </ul>

                <div class="ms-auto">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal">
                        <i class="fas fa-trash"></i>
                        <span class="ms-1">Delete</span>
                    </button>

                </div>


                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" id="name" value="{{$product->name}}" name="name" class="form-control"
                                       required/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="model_name">Model</label>
                                <input type="text" id="model_name" value="{{$product->model_name}}" name="model_name" class="form-control"
                                       required/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="price">Price</label>
                                <input type="number" id="price" value="{{$product->price}}" name="price" class="form-control"
                                       required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element " for="category_id">Category</label>
                                <select class="form-select" name="category_id" aria-label="category_id" id="category_id"
                                        required>
                                    @foreach($categories as $cat)
                                        <option
                                            value="{{$cat->id}}" {{ $product->category->id == $cat->id ? 'selected' : '' }} >{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="brand_id">Brand</label>
                                <select class="form-select" name="brand_id" aria-label="brand_id" id="brand_id"
                                        required>

                                    @foreach($brands as $brand)
                                        <option
                                            value="{{$brand->id}}" {{ $product->brand->id == $brand->id ? 'selected' : '' }} >{{$brand->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                    </div>


                    <div class="row">
                        <div class="col-md-3 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="weight">Weight</label>
                                <input type="number" value="{{$product->weight}}" id="weight" name="weight"
                                       class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-3 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="length">Length</label>
                                <input type="number" value="{{$product->length}}" id="length" name="length"
                                       class="form-control"/>
                            </div>
                        </div>


                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="status">Status</label>
                                <select class="form-select" name="status" aria-label="status" id="status" required>
                                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Enabled</option>
                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Disabled</option>
                                </select>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-3 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="width">Width</label>
                                <input type="number" value="{{$product->width}}" id="width" name="width"
                                       class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-3 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="height">Height</label>
                                <input type="number" value="{{$product->height}}" id="height" name="height"
                                       class="form-control"/>
                            </div>
                        </div>

                        <div class="col-md-6 align-self-end">
                            <div class="form-group">
                                <label class="form-label bottom-element" for="marketable">Marketable</label>
                                <select class="form-select" name="marketable" aria-label="marketable" id="marketable"
                                        required>
                                    <option value="1" {{ $product->marketable == 1 ? 'selected' : '' }}>Enabled</option>
                                    <option value="0" {{ $product->marketable == 0 ? 'selected' : '' }}>Disabled
                                    </option>
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
                                />
                            </div>

                        </div>
                    </div>

                    <div>
                        <div type="hidden" style="display:none;" class="form-group">
                            <label class="form-label" for="tags-hidden-input"></label>
                            <input class="form-control" type="text" id="tags-hidden-input"
                                   name="tags[]"
                                   value="{{ implode(', ', $product->tags()->pluck('name')->toArray() ) }}"/>
                        </div>

                        <div class="mt-3" id="tags-container"></div>
                    </div>


                    <div class="form-input mt-4">
                        <label class="form-label element" for="introduction">Introduction</label>
                        <textarea class="form-control" name="introduction" id="introduction" rows="10"
                                  required>{{$product->introduction}}</textarea>
                    </div>


                    <div class="text-center mt-5 mb-2">
                        <button class="btn w-50 btn-secondary" type="submit">
                            Update
                            <i class="fas fa-edit ms-2"></i>
                        </button>
                    </div>


                </div>

            </section>

        </form>

      <div id="livewire-sections">
          <section class=" card p-5 rounded-5 w-75 mx-auto my-5">
              <livewire:admin.market.product-meta-table :product="$product"/>
          </section>

          <section class="  card p-5 rounded-5 w-75 mx-auto my-5">
              <livewire:admin.market.guarantees-table :product="$product"/>
          </section>
      </div>

    </div>



@endsection


@section('custom-script')
    <script>




        const tagsInput = document.getElementById("tags-input");
        const hiddenInput = document.getElementById("tags-hidden-input");
        const tagsContainer = document.getElementById("tags-container");

        let tags = hiddenInput.value.split(',').map(tag => tag.trim()).filter(tag => tag !== "");

        console.log(tags)

        tags.forEach(tag => {
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
        });


        tagsInput.addEventListener("keydown", function (event) {
            if (event.key === "Enter") {
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
                hiddenInput.value = tags.filter((value, index, self) => {
                    return self.indexOf(value) === index;
                }).join(",");

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
                tagElement.remove();
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
