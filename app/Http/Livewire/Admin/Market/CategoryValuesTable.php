<?php

namespace App\Http\Livewire\Admin\Market;

use App\Models\Admin\Market\CategoryAttribute;
use App\Models\Admin\Market\CategoryValue;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryValuesTable extends Component
{


    public $attribute;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $selectedItems = [];
    public $selectAll = false;
    public $search = '';

    public function selectAll()
    {
        if (!$this->attribute->values) {
            $this->fetchitems();
        }

        $this->selectedItems = $this->attribute->values->pluck('id')->map(function ($id) {
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
            $deleteSelected = CategoryValue::whereIn('id', $selectedIds)->delete();

            if ($deleteSelected) {
                $this->selectedItems = [];
                $this->fetchitems();
                $this->selectAll = false;
                session()->flash('success', 'Selected value(s) deleted successfully.');
            } else {
                session()->flash('error', 'No value(s) were deleted.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting values. Please try again later.');
        }
    }

    public function fetchitems()
    {
        $this->attribute->load('values');
    }

    public function mount($attribute)
    {
        $this->attribute = $attribute;
    }

    public function render()
    {
        return view('livewire.admin.market.category-values-table', [
            'values' => $this->attribute->values,
        ]);
    }


}
