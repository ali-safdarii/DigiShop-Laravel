<?php

namespace App\Http\Livewire\Admin\Market;

use App\Models\Admin\Market\AmazingSale;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class AmazingSaleTable extends Component
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
            $deleteSelected = AmazingSale::whereIn('id', $selectedIds)->delete();

            if ($deleteSelected) {
                $this->selectedItems = [];
                $this->fetchitems();
                $this->selectAll = false;
                session()->flash('success', 'Selected amazing_sales deleted successfully.');
            } else {
                session()->flash('error', 'No amazing_sales were deleted.');
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            session()->flash('error', 'An error occurred while deleting amazing_sales. Please try again later.');
        }


    }

    public function fetchitems()
    {
        $this->model = AmazingSale::latest()->paginate(5);
    }
    public function render()
    {
        $this->fetchitems();
        return view('livewire.admin.market.amazing-sale-table',[
            'amazing_sales' => $this->model
        ]);
    }
}
