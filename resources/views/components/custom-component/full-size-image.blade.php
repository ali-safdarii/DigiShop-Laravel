<div>
    <div class="modal fade" id="fullSizeImageModal-{{ $id }}" tabindex="-1" role="dialog"
         aria-labelledby="fullSizeImageModalLabel-{{ $id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fullSizeImageModalLabel-{{ $id }}">Full Size Image</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <img src="{{ asset($imageUrl) }} " class="img-fluid" alt="{{ $alt }}"  loading="lazy">
                </div>
            </div>
        </div>
    </div>
</div>
