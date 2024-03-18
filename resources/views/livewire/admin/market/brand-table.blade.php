<div class="shadow-3 card mt-5 p-3">

    <div class="d-flex justify-content-center">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show col-6" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show col-6">{{ session('error') }}
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


    </div>

    <!-- Confirm delete modal -->
    <div class="modal fade" id="confirmDeleteModal"
         tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
         aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the selected brands?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>

                    <button data-bs-dismiss="modal" type="button" class="btn btn-danger"
                            wire:click="deleteSelected()">Delete
                    </button>


                </div>
            </div>
        </div>
    </div>

    <!-- ... -->


    <div class="d-flex justify-content-between m-3 p-3 border-bottom">
        <a href="{{ route('market.brand.create') }}">
            <button class="btn btn-primary">Create
                <i class="fas ms-1 fa-add"></i>
            </button>
        </a>
        <h5 wire:loading.remove>Brands ({{\App\Models\Admin\Market\Brand::count()}})</h5>

        <div wire:loading class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>

        <div class="d-flex flex-row justify-content-center align-content-center">
            <div class="mr-5">
                <div class="input-group rounded">
                    <label>
                        <input type="text" class="form-control" placeholder="Search" wire:model.debounce.500ms="search">
                    </label>
                </div>
            </div>
            <div>
                <p class="nav-item" role="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                    <i class="ms-3 fas fa-trash fa-lg" style="opacity: {{ empty($selectedItems) ? 0.5 : 1 }}"></i>
                    <span style="font-size: 10px" class="badge rounded-pill badge-notification mb-auto bg-danger">
                    {{ count($selectedItems) }}
                </span>
                </p>
            </div>
        </div>
    </div>

    <div class="container mt-3 p-3">

        <table class="table-responsive table">
            <thead class="table-primary">
            <tr>
                <th scope="col">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAllCheckbox"
                               wire:model="selectAll">
                        <label class="form-check-label" for="selectAllCheckbox">

                        </label>
                    </div>

                </th>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Slug</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>

            @forelse($brands as $brand)
                <tr>

                    <th scope="row">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $brand->id }}"
                                   id="checkbox-{{ $brand->id }}" wire:model="selectedItems">
                            <label class="form-check-label" for="checkbox-{{ $brand->id }}"></label>
                        </div>
                    </th>
                    <td>
                        {{$loop->iteration }}
                    </td>
                    <td>
                        {{\App\Utili\Helper::limitStr($brand->name)}}

                    </td>

                    <td>
                        <div class="image-container">
                            <img
                                src="{{ asset(\App\Utili\Helper::getcurrentImage($brand,'small'))}}"
                                alt="{{ $brand->name }}"
                                class="thumbnail"
                                loading="lazy"
                                data-bs-toggle="modal"
                                data-bs-target="#fullSizeImageModal-{{ $brand->id }}">

                            <x-full-size-image :image-url="\App\Utili\Helper::getcurrentImage($brand,'large')"
                                               :id="$brand->id"
                                               :alt="$brand->name"/>
                        </div>

                    </td>
                    <td>
                        {{\App\Utili\Helper::limitStr($brand->slug)}}
                    </td>


                    <td>
                        <a class="btn btn-primary" type="submit" href="{{route('market.brand.show',$brand)}}"
                           role="button">
                            show
                            <i class="ms-1 far fa-eye"></i>
                        </a>
                    </td>

                </tr>
            @empty

                <tr class="font-weight-normal ">
                    <td colspan="10"><span>not any brands found.</span></td>
                </tr>

            @endforelse


            </tbody>


        </table>

        {{ $brands->links()}}

    </div>


</div>


@push('scripts')
    <script>

    </script>
@endpush
