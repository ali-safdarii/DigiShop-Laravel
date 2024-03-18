<div class="main-content">

    <form wire:submit.prevent="uploadImage">
        <section class="d-flex flex-wrap justify-content-center card p-5 rounded-5 w-25 mx-auto my-5">
            <p>you can upload image here ...</p>
            <div class="d-flex p-2">
                <input id="input_image" type="file" class="form-control" wire:model="image" accept="image/*" required>
                <button type="submit" class="ms-2 btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading wire:target="uploadImage" class="spinner-border spinner-border-sm me-2"
                          role="status" aria-hidden="true"></span>
                    Upload
                </button>

            </div>
        </section>
    </form>

    <section class="d-flex flex-wrap justify-content-center">
        @forelse($product->images as $gallery)
            <div class="card rounded-5 m-3" style="width: 18rem;">

                @php
                    $imageData = json_decode($gallery->image, true); // Decode the JSON data to an array
                @endphp

                @if($imageData && isset($imageData['indexArray']['medium']))
                    <img src="{{ asset($imageData['indexArray']['medium']) }}" alt="{{ $gallery->id }}" class="p-4">
                @else
                    <p>Image not found</p>
                @endif

                @if($imageData && isset($imageData['indexArray']['medium']))
                    <div class="align-content-center align-items-center text-center">
                        <x-full-size-image :image-url="  asset($imageData['indexArray']['large'])   "
                                           :id="$gallery->id" :alt="$gallery->id"/>
                    </div>
                @else
                    <p>Image not found</p>
                @endif


                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
                <div class="card-footer ms-auto p-4">
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal{{ $gallery->id }}">
                        Remove
                    </button>

                    <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#fullSizeImageModal-{{ $gallery->id }}">
                        FullSize
                    </button>
                </div>
            </div>
            <!-- Confirmation Modal -->
            <div class="modal fade" id="confirmationModal{{ $gallery->id }}" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationModalLabel">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this image?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" wire:click="delete({{ $gallery->id }})" data-bs-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

        @empty
            <span class="">No images found code here</span>
        @endforelse
    </section>

</div>


@push('scripts')
    <script>
        const input_image = document.getElementById("input_image");
        window.addEventListener('upload', event => {
            console.log("event recived")
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your Image is Uploaded',
                showConfirmButton: false,
                timer: 2000
            })


            if (input_image.value !== "") {
                input_image.value = "";
            }

        })

        window.addEventListener('image_remove', event => {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Your Image is Deleted',
                showConfirmButton: false,
                timer: 2000
            })
        })

    </script>
@endpush

