<?php

namespace App\Http\Livewire\Admin\Market;


use App\Models\Admin\Market\Delivery;
use Livewire\Component;
use Livewire\WithPagination;

class DeliveryTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $model;
    public $selectedItems = [];

    public $selectAll = false;
    public $search = '';


    public function mount()
    {
        $this->fetchitems();
    }

    public function selectAll()
    {
        if (!$this->model) {
            $this->fetchitems();
        }

        $this->selectedItems = $this->model->pluck('id')->map(function ($id) {
            return (string)$id;
        });
    }

    public function deselectAll()
    {
        $this->selectedItems = [];
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectAll();
        } else {
            $this->deselectAll();
        }
    }


    public function deleteSelected()
    {
        $selectedIds = $this->selectedItems;

        try {
            $deleteSelected = Delivery::whereIn('id', $selectedIds)->delete();

            if ($deleteSelected) {
                $this->selectedItems = [];
                $this->fetchitems();
                $this->selectAll = false;
                session()->flash('success', 'Selected deliveries deleted successfully.');
            } else {
                session()->flash('error', 'No deliveries were deleted.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting deliveries. Please try again later.');
        }
    }


    public function fetchitems()
    {
        $this->model = Delivery::where('name', 'like', '%' . $this->search . '%')->latest()->paginate(5);
    }

    public function render()

    {
        $this->fetchitems();
        return view('livewire.admin.market.delivery-table', [
            'deliveries' => $this->model,
            'search' => $this->search,
        ]);
    }
}
