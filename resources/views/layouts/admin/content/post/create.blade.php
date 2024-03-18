@extends('layouts.admin.master')

@section('title','post')
@section('content')


    <div class="main-content ">
        <form class="needs-validation" action="{{route('content.post.store')}}" method="post"
              enctype="multipart/form-data" id="form" novalidate>
            @csrf
            <div
                class="d-flex flex-wrap justify-content-center align-items-center card p-5 rounded-5 w-75 mx-auto my-5 ">
                <div class="col-sm-12 col-md-6 col-lg-6 p-3">


                    <div class="form-content">
                        <div class="form-input">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" id="title" name="title" class="form-control" required/>
                        </div>

                        {{-- <div class="form-input">
                                <label class="form-label" for="delivery_time">Start</label>
                                <input id="delivery_time" name="delivery_time" class="form-control"
                                     type="date" />
                            </div>--}}

                        <div class="form-input mt-3">

                            <label class="form-label" for="tags-input">Tags</label>
                            <input placeholder="" type="text" id="tags-input" name="tags-input" class="form-control"/>

                        </div>

                        <div type="hidden" style="display:none;" class="form-input">
                            <label class="form-label" for="tags-hidden-input"></label>
                            <input class="form-control" type="text" id="tags-hidden-input"
                                   name="tags[]"/>
                        </div>

                        <div class="" id="tags-container"></div>

                        <div class="form mt-3">
                            <label class="form-label" for="category_id">Category</label>
                            <select class="form-select" name="category_id" aria-label="category_id" id="category_id" required>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form mt-3">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select" name="status" aria-label="status" id="status" required>
                                <option value="">Select status</option>
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>

                        <div class="form mt-3">
                            <label class="form-label" for="status">Block Comment</label>
                            <select class="form-select" name="is_comment" aria-label="is_comment" id="is_comment" required>
                                <option value="0">Disable</option>
                                <option value="1">Enable</option>
                            </select>
                        </div>

                        <div class="form-input mt-3">
                            <input type="file" class="form-control" name="image" id="image" aria-label="Upload"
                                   required/>
                        </div>

                      {{--  <div class="form-input mt-4">
                            <label class="form-label" for="summery">summery</label>
                            <textarea class="form-control" name="summery" id="summery" rows="10"
                                      required></textarea>
                        </div>--}}

                        <div class="form-input mt-4">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="10"
                                      required></textarea>
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