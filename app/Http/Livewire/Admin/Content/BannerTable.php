<?php

namespace App\Http\Livewire\Admin\Content;

use App\Http\Services\Image\ImageService;
use App\Models\Admin\Content\Banner;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class BannerTable extends Component
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

            $banners = Banner::whereIn('id', $selectedIds)->get();



            $deleteSelected = Banner::whereIn('id', $selectedIds)->delete();
            if ($deleteSelected) {

                $this->selectedItems = [];
                $this->fetchitems();
                $this->selectAll = false;
                session()->flash('success', 'Selected banners deleted successfully.');
            } else {
                session()->flash('error', 'No banners were deleted.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting banners. Please try again later.');
        }
    }


    public function fetchitems()
    {
        $this->model = Banner::latest()->paginate(10);

    }

    public function render()
    {
        $this->fetchitems();
        $position = Banner::$positions;
        return view('livewire.admin.content.banner-table', [
            'banners' => $this->model,
            'search' => $this->search,
            'position' => $position,

        ]);
    }
}
