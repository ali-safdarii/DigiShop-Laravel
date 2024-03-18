<?php

namespace App\Http\Livewire\Admin\Payment;

use App\Models\Admin\Payment\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentTable extends Component
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
            $deleteSelected = Payment::whereIn('id', $selectedIds)->delete();

            if ($deleteSelected) {
                $this->selectedItems = [];
                $this->fetchitems();
                $this->selectAll = false;
                session()->flash('success', 'Selected payments deleted successfully.');
            } else {
                session()->flash('error', 'No payment were deleted.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting payments. Please try again later.');
        }
    }


    public function fetchitems()
    {
        $this->model = Payment::where('payment_status', 'like', '%' . $this->search . '%')->latest()->paginate(5);
    }


    public function render()
    {
        $this->fetchitems();
        return view('livewire.admin.payment.payment-table',[
            'payments' => $this->model,
            'search' => $this->search,
        ]);
    }
}
