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

    {{--Create Meta Record--}}
    <div class="modal fade" id="createMetaModal" tabindex="-1"
         aria-labelledby="createMetaModalLabel" aria-hidden="true" wire:ignore>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMetaModalLabel">Create Meta Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="createMeta">
                        <div class="mb-3">
                            <label for="metaKey" class="form-label">Meta Key</label>
                            <input type="text" class="form-control" id="metaKey" wire:model.defer="newMetaKey" required>
                        </div>
                        <div class="mb-3">
                            <label for="metaValue" class="form-label">Meta Value</label>
                            <input type="text" class="form-control" id="metaValue" wire:model.defer="newMetaValue"
                                   required>
                        </div>
                        <button  type="submit" class="btn btn-primary">Create</button>
                        <button data-bs-dismiss="modal"  class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Edit Meta Record--}}
    <div wire:ignore class="modal fade" id="editMetaModal" tabindex="-1" aria-labelledby="editMetaModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMetaModalLabel">Edit Meta Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateMeta">
                        <div class="mb-3">
                            <label for="editMetaKey" class="form-label">Meta Key</label>
                            <input type="text" class="form-control" id="editMetaKey" wire:model.defer="newMetaKey"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="editMetaValue" class="form-label">Meta Value</label>
                            <input type="text" class="form-control" id="editMetaValue" wire:model.defer="newMetaValue"
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
            <button class="btn  btn-primary" data-bs-toggle="modal" data-bs-target="#createMetaModal" type="button">Create
                new
            </button>
        </div>


        <div class="text-center">
           <h5 class="">Adding Meta for this Product</h5>
        </div>

    </div>


    <div>

        <table class="table-responsive table">
            <thead class="table-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">value</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>

            @forelse($product->metas as $meta)
                <tr>

                    <td>
                        {{$loop->iteration }}
                    </td>

                    <td>
                        {{$meta->meta_key}}
                    </td>

                    <td>
                        {{$meta->meta_value}}
                    </td>

                    <td>

                        <button class="btn btn-sm btn-danger" wire:click="deleteMeta({{ $meta->id }})">
                            delete
                        </button>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editMetaModal"
                                wire:click="editMeta({{ $meta->id }})">
                            update
                        </button>


                    </td>

                </tr>
            @empty

                <tr class="font-weight-normal ">
                    <td colspan="10">

                        <a class="text text-sm text-primary" data-bs-toggle="modal" data-bs-target="#createMetaModal"
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
