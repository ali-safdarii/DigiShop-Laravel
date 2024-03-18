<div>

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

    {{-- Create Guarantee Record --}}
    <div class="modal fade" id="createGuaranteeModal" tabindex="-1"
         aria-labelledby="createGuaranteeModalLabel" aria-hidden="true" wire:ignore>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createGuaranteeModalLabel">Create Guarantee Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="createGuarantee">
                        <div class="mb-3">
                            <label for="guaranteeName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="guaranteeName" wire:model.defer="newGuaranteeName" required>
                        </div>
                        <div class="mb-3">
                            <label for="guaranteePrice" class="form-label">Price Increase</label>
                            <input type="text" class="form-control" id="guaranteePrice" wire:model.defer="newGuaranteePrice"
                                   required>
                        </div>
                        <button  type="submit" class="btn btn-primary">Create</button>
                        <button data-bs-dismiss="modal"  class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Edit Guarantee Record --}}
    <div wire:ignore class="modal fade" id="editGuaranteeModal" tabindex="-1" aria-labelledby="editGuaranteeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGuaranteeModalLabel">Edit Guarantee Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateGuarantee">
                        <div class="mb-3">
                            <label for="editGuaranteeName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editGuaranteeName" wire:model.defer="newGuaranteeName"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="editGuaranteePrice" class="form-label">Price Increase</label>
                            <input type="text" class="form-control" id="editGuaranteePrice" wire:model.defer="newGuaranteePrice"
                                   required>
                        </div>
                        <button  type="submit" class="btn btn-primary">Update</button>
                        <button data-bs-dismiss="modal"  class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="m-5 p-2 ">

        <div>
            <button class="btn  btn-primary" data-bs-toggle="modal" data-bs-target="#createGuaranteeModal" type="button">Create new</button>
        </div>


        <div class="text-center">
            <h5 class="">Adding Guarantee for this Product</h5>
        </div>

    </div>


    <div>

        <table class="table-responsive table">
            <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Price Increase</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>

            @forelse($product->guarantees as $guarantee)
                <tr>

                    <td>
                        {{$loop->iteration }}
                    </td>

                    <td>
                        {{$guarantee->name}}
                    </td>

                    <td>
                        {{$guarantee->price_increase}}
                    </td>

                    <td>

                        <button class="btn btn-sm btn-danger" wire:click="deleteGuarantee({{ $guarantee->id }})">
                            Delete
                        </button>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editGuaranteeModal"
                                wire:click="editGuarantee({{ $guarantee->id }})">
                            Update
                        </button>


                    </td>

                </tr>
            @empty

                <tr class="font-weight-normal ">
                    <td colspan="10">

                        <a class="text text-sm text-primary" data-bs-toggle="modal" data-bs-target="#createGuaranteeModal"
                           type="button"><i class="fa fa-add"></i> Create new one</a>

                    </td>


                </tr>

            @endforelse


            </tbody>


        </table>
    </div>
</div>

@section('custom-script')

@endsection
