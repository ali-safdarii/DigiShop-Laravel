<?php

namespace App\Http\Livewire\Admin\Market;

use App\Models\Admin\Market\ProductCategory;
use File;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCategoryTable extends Component
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

            $result = ProductCategory::whereIn('id', $selectedIds)->get();

            foreach ($result as $item) {
                // Delete images associated with the brand.
                if (!empty($item->image) && isset($item->image['directory'])) {
                    $directory = public_path($item->image['directory']);
                    if (File::exists($directory)) {
                        File::deleteDirectory($directory);
                    }
                }
            }


            $deleteSelected = ProductCategory::whereIn('id', $selectedIds)->delete();

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
        $this->model = ProductCategory::where('name', 'like', '%' . $this->search . '%')->latest()->paginate(5);
    }

    public function render()
    {
        $this->fetchitems();
        return view('livewire.admin.market.product-category-table',
        [
            'categories' => $this->model,
            'search' => $this->search,
        ]
        );
    }
}
