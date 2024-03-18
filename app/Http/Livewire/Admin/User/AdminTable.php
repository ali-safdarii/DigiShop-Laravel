<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTable extends Component
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
       /* $this->isActive = User::pluck('activation', 'id')->toArray();*/
        $this->fetchitems();
    }

    public function toggleActivation($id)
    {
        $model = User::findOrFail($id);
        $model->activation = !$model->activation;
        $model->save();
        if ($model->activation == 1)
            $this->dispatchBrowserEvent('toggleActivation');
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
            $results = User::whereIn('id', $selectedIds)->get();

            foreach ($results as $item) {
                // Delete images associated with the $result.
                if (!empty($item->image) && isset($item->image['directory'])) {
                    $directory = public_path($item->image['directory']);
                    if (File::exists($directory)) {
                        File::deleteDirectory($directory);
                    }
                }
            }
            $deleteSelected = User::whereIn('id', $selectedIds)->delete();

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
        $this->model = User::where('first_name', 'like', '%' . $this->search . '%')
            ->where('user_type', 1)->latest()->paginate(5);
    }

    public function render()
    {
        $this->fetchitems();
        return view(
            'livewire.admin.user.admin-table',
            [
                'admins' => $this->model,
                'search' => $this->search,
            ]

        );
    }
}
