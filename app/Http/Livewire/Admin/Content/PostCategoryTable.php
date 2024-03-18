<?php

namespace App\Http\Livewire\Admin\Content;

use App\Models\Admin\Content\PostCategory;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class PostCategoryTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $categories;

    public $selectedCategories = [];

    public $selectAll = false;
    public $search = '';


    public function mount()
    {
        $this->fetchCategories();
    }

    public function selectAll()
    {
        if (!$this->categories) {
            $this->fetchCategories();
        }

        $this->selectedCategories = $this->categories->pluck('id')->map(function ($id) {
            return (string)$id;
        });
    }

    public function deselectAll()
    {
        $this->selectedCategories = [];
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
        $selectedIds = $this->selectedCategories;

        try {
            $results = PostCategory::whereIn('id', $selectedIds)->get();

            foreach ($results as $item) {
                // Delete images associated with the brand.
                if (!empty($item->image) && isset($item->image['directory'])) {
                    $directory = public_path($item->image['directory']);
                    if (File::exists($directory)) {
                        File::deleteDirectory($directory);
                    }
                }
            }

            // Delete the selected brands from the database.
            $deleteSelected = PostCategory::whereIn('id', $selectedIds)->delete();

            if ($deleteSelected) {
                $this->selectedCategories = [];
                $this->fetchCategories();
                $this->selectAll = false;
                session()->flash('success', 'Selected categories deleted successfully.');
            } else {
                session()->flash('error', 'No categories were deleted.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting categories. Please try again later.');
        }
    }


    public function fetchCategories()
    {
        $this->categories = PostCategory::where('name', 'like', '%' . $this->search . '%')->latest()->paginate(5);
    }

    public function render()
    {
        $this->fetchCategories();
        return view('livewire.admin.content.post-category-table', [
            'categories' => $this->categories,
            'search' => $this->search,
        ]);
    }

}
