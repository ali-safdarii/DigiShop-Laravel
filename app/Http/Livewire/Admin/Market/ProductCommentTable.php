<?php

namespace App\Http\Livewire\Admin\Market;

use App\Models\Admin\Content\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCommentTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    protected $model;
    public $selectedItems = [];
    public $selectAll = false;
    public $search = '';
    public $approveStatus = [];


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
            $deleteSelected = Comment::whereIn('id', $selectedIds)->delete();

            if ($deleteSelected) {
                $this->selectedItems = [];
                $this->fetchitems();
                $this->selectAll = false;
                session()->flash('success', 'Selected comments deleted successfully.');
            } else {
                session()->flash('error', 'No comments were deleted.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting comments. Please try again later.');
        }
    }


    public function fetchitems()
    {
        $this->model = Comment::where('commentable_type', 'App\Models\Admin\Market\Product')
            ->latest()->paginate(5);

        // Get the IDs of comments with 'seen' field equal to 0
        $commentIds = $this->model->pluck('id')->toArray();

        if (!empty($commentIds)) {
            // Update the 'seen' field to 1 for the selected comment IDs
            Comment::whereIn('id', $commentIds)
                ->where('seen', 0)
                ->update(['seen' => 1]);
        }

    }

    public function render()
    {
        $this->fetchitems();
        return view('livewire.admin.market.product-comment-table', [
            'comments' => $this->model,
            'search' => $this->search
        ]);
    }
}
