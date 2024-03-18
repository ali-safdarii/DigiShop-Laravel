@extends('layouts.admin.master')

@section('title','category')
@section('content')


    <div class="main-content ">



        <x-custom-component.delete-modal :message="'Categories?'"
                                         :route=" route('content.postCategory.destroy', ['postCategory' => $postCategory->id]) "
        />

        <form id="post-category-form" class="needs-validation"
              action="{{route('content.postCategory.update',$postCategory->id)}}" method="post"
              enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            <div class="d-flex flex-wrap justify-content-center align-items-center card
                p-5 rounded-5 w-75 mx-auto my-5 ">

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
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="form-content ">
                        <div class="form-input has-validation">
                            <label class="form-label" for="name">Category Name</label>
                            <input type="text" value="{{$postCategory->name}}" id="name" name="name"
                                   class="form-control" required/>
                        </div>


                        <div class="form-input mt-3">

                            <label class="form-label" for="tags-input">Tags</label>
                            <input placeholder="" type="text" id="tags-input" name="tags-input"
                                   class="form-control"/>
                        </div>


                        <div type="hidden" style="display:none;" class="form-input">
                            <label class="form-label" for="tags-hidden-input"></label>
                            <input class="form-control" type="text" id="tags-hidden-input"
                                   name="tags[]"
                                   value="{{ implode(', ', $postCategory->tags()->pluck('name')->toArray()) }}"/>
                        </div>

                        <div class="mt-1" id="tags-container">
                        </div>

                        <div class="form mt-5">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select" name="status" aria-label="status" id="status" required>
                                <option value="1" {{ $postCategory->status == 1 ? 'selected' : '' }}>Enabled</option>
                                <option value="0" {{ $postCategory->status == 0 ? 'selected' : '' }}>Disabled</option>
                            </select>
                        </div>
                        <div class="form-input mt-3">
                            <input type="file" class="form-control"
                                   name="image" id="image"
                                   aria-label="Upload"
                            />

                        </div>
                        <div class="form-group mt-4">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" id="description"
                                      rows="10">{!! nl2br($postCategory->description) !!}</textarea>
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
            </div>
        </form>

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

