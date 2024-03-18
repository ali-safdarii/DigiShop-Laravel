<?php

namespace App\Http\Livewire\Admin\Market;

use App\Models\Admin\Market\Guarantees;
use Livewire\Component;

class GuaranteesTable extends Component
{
    public $product;

    public $newGuaranteeName;
    public $newGuaranteePrice;
    public $editingGuaranteeId;

    protected $rules = [
        'newGuaranteeName' => 'required',
        'newGuaranteePrice' => 'required',
    ];


    public function createGuarantee()
    {
        $this->validate();

        Guarantees::create([
            'product_id' => $this->product->id,
            'name' => $this->newGuaranteeName,
            'price_increase' => $this->newGuaranteePrice,
        ]);

        session()->flash('success', 'Guarantee record created successfully.');

        $this->newGuaranteeName = '';
        $this->newGuaranteePrice = '';

        $this->resetForm();
        $this->product->load('guarantees');
    }

    public function editGuarantee($guaranteeId)
    {
        $guarantee = Guarantees::findOrFail($guaranteeId);

        $this->editingGuaranteeId = $guarantee->id;
        $this->newGuaranteeName = $guarantee->name;
        $this->newGuaranteePrice = $guarantee->price_increase;
    }

    public function updateGuarantee()
    {
        $this->validate();

        $guarantee = Guarantees::findOrFail($this->editingGuaranteeId);
        $guarantee->update([
            'name' => $this->newGuaranteeName,
            'price_increase' => $this->newGuaranteePrice,
        ]);

        session()->flash('success', 'Guarantee record updated successfully.');

        $this->resetForm();
        $this->product->load('guarantees');

        $this->dispatchBrowserEvent('hide-edit-modal');
    }

    public function resetForm()
    {
        $this->newGuaranteeName = '';
        $this->newGuaranteePrice = '';
        $this->editingGuaranteeId = null;
    }

    public function deleteGuarantee($guaranteeId)
    {
        $guarantee = Guarantees::findOrFail($guaranteeId);
        $guarantee->delete();

        session()->flash('success', 'Guarantee record deleted successfully.');
        $this->product->load('guarantees');
    }

    public function render()
    {
        $this->product->load('guarantees');
        return view('livewire.admin.market.guarantees-table', [
            'product' => $this->product,
        ]);
    }
}
