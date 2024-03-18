<?php

namespace App\Http\Livewire\Admin\Content;

use App\Models\Admin\Content\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class PostCommentTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    protected $model;
    public $selectedItems = [];
    public $selectAll = false;
    public $search = '';
    public $isActive = [];


    public function mount()
    {
        $this->isActive = Comment::pluck('approved', 'id')->toArray();
        $this->fetchitems();
    }

    public function toggleActivation($id)
    {
        $model = Comment::findOrFail($id);
        $model->approved = !$model->approved;
        $model->save();
        session()->flash('success', 'Approved status updated successfully.');
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
        $this->model = Comment::where('commentable_type', 'App\Models\Admin\Content\Post')
            ->latest()->paginate(5);

        // Get the IDs of comments with 'seen' field equal to 0


    }
    /**
     * @return void
     */
    public function unSeenComments(): void
    {
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
        $this->unSeenComments();
        return view('livewire.admin.content.post-comment-table', [
            'comments' => $this->model,
            'search' => $this->search
        ]);
    }


}
