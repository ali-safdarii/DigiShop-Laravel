<div class="m-5">
    <div class="card m-5">

        <div class="d-flex justify-content-center">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show col-8" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show col-8">{{ session('error') }}
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

        </div>

        {{--Create Color Record--}}
        <div class="modal fade" id="createModal" tabindex="-1"
             aria-labelledby="createModalLabel" aria-hidden="true" wire:ignore>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Create Color Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="create">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" wire:model.defer="colorName" required>
                            </div>


                            <div class="mb-3">
                                <label for="price" class="form-label">Price Inc</label>
                                <input type="number" class="form-control" id="price" wire:model.defer="priceInc"
                                       required>
                            </div>

                            <div class="mb-3 d-flex">
                                <label for="colorCode" class="form-label fw-semibold">Color :</label>
                                <input type="color" class="form-control ms-2"
                                       id="colorCode" wire:model.defer="colorCode">
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Edit Color Record--}}
        <div wire:ignore class="modal fade" role="dialog" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Color Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="updateColor">
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="edit_name" wire:model.defer="colorName"
                                       required>
                            </div>


                            <div class="mb-3">
                                <label for="edit_price" class="form-label">Price Inc</label>
                                <input type="number" class="form-control" id="edit_price" wire:model.defer="priceInc"
                                       required>
                            </div>

                            <div class="mb-3 d-flex">
                                <label for="edit_colorCode" class="form-label fw-semibold">Color :</label>
                                <input type="color" id="edit_colorCode" wire:model.defer="colorCode"
                                       class="form-control ms-2"
                                >
                            </div>


                            <button type="submit" class="btn btn-primary">Update</button>
                            <button data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-5 p-2 ">

            <div>
                <button class="btn  btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" type="button">
                    Create
                    new
                </button>
            </div>


            <div class="text-center">
                <h5 class="">Adding Color for this Product</h5>
            </div>

        </div>


        <div class="m-5">

            <table class="table-responsive table ">
                <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">price inc</th>
                    <th scope="col">color</th>
                    <th scope="col">Default</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>

                @forelse($product->colors as $color)
                    <tr>

                        <td>
                            {{$loop->iteration }}
                        </td>

                        <td>
                            {{$color->name}}
                        </td>
                        <td>
                            {{$color->price_increase}}
                        </td>
                        <td>
                            <div class="color-circle"
                                 style="background-color: {{ $color->color_code }}; @if($color->color_code == '#ffffff') border: 2px solid gray; @endif">
                            </div>

                        </td>

                        <td>

                            <label>
                                <input type="radio" class="form-check-input" wire:model="selectedDefaultColorId"
                                       value="{{$color->id}}"
                                       wire:click="setDefaultColor({{$color->id}})" {{$color->id == $selectedDefaultColorId ? 'checked' : ''}}>
                            </label>

                        </td>

                        <td class="w-25">

                            <button class="btn btn-sm btn-danger" wire:click="deleteColor({{ $color->id }})">
                                delete
                            </button>

                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal"
                                    wire:click="editColor({{ $color->id }})">
                                update
                            </button>

                        </td>

                    </tr>
                @empty

                    <tr class="font-weight-normal ">
                        <td colspan="10">

                            <a class="text text-sm text-primary" data-bs-toggle="modal" data-bs-target="#createModal"
                               type="button"><i class="fa fa-add"></i> Create new one</a>

                        </td>


                    </tr>

                @endforelse


                </tbody>


            </table>
        </div>
    </div>
</div>
@push('scripts')
    <script>


        import Swal from "sweetalert2";

        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
        var createModal = new bootstrap.Modal(document.getElementById('createModal'));

        editModal._element.addEventListener('hidden.bs.modal', function () {
            document.body.classList.remove('modal-open');
            var modalBackdrop = document.querySelector('.modal-backdrop');
            if (modalBackdrop) {
                modalBackdrop.remove();
            }
        });

        createModal._element.addEventListener('hidden.bs.modal', function () {
            document.body.classList.remove('modal-open');
            var modalBackdrop = document.querySelector('.modal-backdrop');
            if (modalBackdrop) {
                modalBackdrop.remove();
            }
        });

        window.addEventListener('setDefaultColor', event => {
            console.log("event recived")
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Defualt Color is set',
                showConfirmButton: false,
                timer: 2000
            })
        })

        window.addEventListener('update_color', event => {
            console.log("update_color")
            editModal.hide();
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your Color is updated',
                showConfirmButton: false,
                timer: 2000
            })
        })

        window.addEventListener('create_color', event => {
            createModal.hide();
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Creating color ',
                showConfirmButton: false,
                timer: 2000
            })
        })

        window.addEventListener('delete_color', event => {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'color removed',
                showConfirmButton: false,
                timer: 2000
            })
        })

    </script>
@endpush
