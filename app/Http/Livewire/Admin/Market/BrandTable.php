<?php

namespace App\Http\Livewire\Admin\Market;

use App\Http\Services\Image\ImageService;
use App\Models\Admin\Market\Brand;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;
use function session;
use function view;

class BrandTable extends Component
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

            $results = Brand::whereIn('id', $selectedIds)->get();

            foreach ($results as $item) {
                // Delete images associated with the $result.
                if (!empty($item->image) && isset($item->image['directory'])) {
                    $directory = public_path($item->image['directory']);
                    if (File::exists($directory)) {
                        File::deleteDirectory($directory);
                    }
                }
            }

            // Delete the selected brands from the database.
            $deleteSelected = Brand::whereIn('id', $selectedIds)->delete();

            if ($deleteSelected) {
                $this->selectedItems = [];
                $this->fetchitems();
                $this->selectAll = false;
                session()->flash('success', 'Selected brands deleted successfully.');
            } else {
                session()->flash('error', 'No brands were deleted.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting brands. Please try again later.');
        }


    }

    public function fetchitems()
    {
        $this->model = Brand::where('name', 'like', '%' . $this->search . '%')->latest()->paginate(5);
    }

    public function render()
    {
        $this->fetchitems();
        return view('livewire.admin.market.brand-table',[
            'brands' => $this->model,
            'search' => $this->search,
        ]);
    }
}
