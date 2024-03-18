<?php

namespace App\Http\Livewire\Admin\User\Role;

use App\Models\Admin\User\Role;
use Livewire\Component;
use Livewire\WithPagination;

class RoleTable extends Component
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
            $deleteSelected = Role::whereIn('id', $selectedIds)->delete();

            if ($deleteSelected) {
                $this->selectedItems = [];
                $this->fetchitems();
                $this->selectAll = false;
                session()->flash('success', 'Selected roles deleted successfully.');
            } else {
                session()->flash('error', 'No roles were deleted.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting roles. Please try again later.');
        }
    }


    public function fetchitems()
    {
        $this->model = Role::where('name', 'like', '%' . $this->search . '%')->latest()->paginate(5);
    }


    public function render()
    {
        $this->fetchitems();
        return view('livewire.admin.user.role.role-table', [
            'roles' => $this->model,
            'search' => $this->search,
        ]);
    }
}
