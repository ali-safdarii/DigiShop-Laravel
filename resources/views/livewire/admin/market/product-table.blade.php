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
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmDeleteModalLabel" aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the selected products?
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    <button data-bs-dismiss="modal" type="button" class="btn btn-danger" wire:click="deleteSelected()">
                        Delete
                    </button>


                </div>
            </div>
        </div>
    </div>


    <div class="d-flex justify-content-between m-3 p-3 border-bottom">
        <a href="{{route('market.product.create')}}">
            <button class="btn btn-primary">Create
                <i class="fas ms-1 fa-add"></i>
            </button>
        </a>
        <h5 wire:loading.remove>Products ({{\App\Models\Admin\Market\Product::count()}})</h5>

        <div wire:loading class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="d-flex flex-column flex-md-row justify-content-center align-items-center">
            <div class="mb-2 mb-md-0 me-md-5">
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
        <table class="table">
            <thead class="table-primary">
                <tr>
                    <th scope="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAllCheckbox"
                                wire:model="selectAll">
                            <label class="form-check-label" for="selectAllCheckbox"></label>
                        </div>
                    </th>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price (IRR)</th>
                    <th scope="col">Default color</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                @php
                $category=$product->category
                @endphp
                <tr>
                    <th scope="row">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $product->id }}"
                                id="checkbox-{{ $product->id }}" wire:model="selectedItems">
                            <label class="form-check-label" for="checkbox-{{ $product->id }}"></label>
                        </div>
                    </th>
                    <td>{{ $loop->iteration }}</td>
                    <td class="">{{ \App\Utili\Helper::limitStr($product->name) }}</td>

                    <td>
                        @if ($category && $category->parent)

                            {{-- Get the last two parent categories --}}
                            @php
                                $lastTwoParents = $category->getLastTwoParentCategories();
                            @endphp

                            {{-- Display the last two parent categories --}}
                            @foreach ($lastTwoParents as $parent)
                                <a href="{{ route('market.category.show', $parent->id) }}">{{ $parent->name }}</a>

                                {{-- Add a separator between parent categories --}}
                                @unless ($loop->last)
                                &raquo;
                                @endunless
                            @endforeach
                        @endif
                    </td>


                    <td>

                        @if ($product->brand)
                        {{ \App\Utili\Helper::limitStr($product->brand->name) }}
                        @endif

                    </td>
                    <td>
                        <div>
                            <img src="{{ asset(\App\Utili\Helper::getcurrentImage($product,'small')) }}"
                                alt="{{ $product->name }}" class="thumbnail" loading="lazy" data-bs-toggle="modal"
                                data-bs-target="#fullSizeImageModal-{{ $product->id }}" height="100">
                            <x-full-size-image :image-url="\App\Utili\Helper::getcurrentImage($product,'large')"
                                :id="$product->id" :alt="$product->name" />
                        </div>
                    </td>
                    <td>
                        {{ (int)$product->price  }}
                    </td>
                    <td class="">
                        @if ($product->defaultColor)
                        {{ $product->defaultColor->name }}
                        @else
                        <span class="">no default color</span>
                        @endif
                    </td>
                    <td class="">
                        <div class="btn-group">
                            <button class="btn btn-primary  dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                options
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item me-auto"
                                        href="{{ route('market.product.show', $product) }}"><i class="far fa-eye"></i>
                                        Show</a></li>

                                <li><a class="dropdown-item me-auto"
                                        href="{{route('market.product.gallery.index',$product)}}">
                                        <i class="far fa-image"></i> Gallery </a></li>

                                <li>
                                    <a class="dropdown-item me-auto {{--@if ($product->colors->isEmpty()) disabled @endif--}}"
                                        href="{{ route('market.product.color.index', $product) }}">
                                        <i class="far fa-circle fa-xs"></i> Color
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="font-weight-normal">
                    <td colspan="10"><span>not any products found.</span></td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
</div>
