<?php

namespace App\Http\Livewire\Admin\Market;

use App\Models\Admin\Market\ProductMeta;
use Livewire\Component;

class ProductMetaTable extends Component
{

    public $product;
    public $newMetaKey;
    public $newMetaValue;
    public $editingMetaId;

    protected $rules = [
        'newMetaKey' => 'required',
        'newMetaValue' => 'required',
    ];


    public function createMeta()
    {
        $this->validate();

        ProductMeta::create([
            'product_id' => $this->product->id,
            'meta_key' => $this->newMetaKey,
            'meta_value' => $this->newMetaValue,
        ]);

        session()->flash('success', 'Meta record created successfully.');

        $this->newMetaKey = '';
        $this->newMetaValue = '';

        $this->resetForm();
        $this->product->load('metas');
    }

    public function editMeta($metaId)
    {
        $meta = ProductMeta::findOrFail($metaId);

        $this->editingMetaId = $meta->id;
        $this->newMetaKey = $meta->meta_key;
        $this->newMetaValue = $meta->meta_value;


    }

    public function updateMeta()
    {
        $this->validate();

        $meta = ProductMeta::findOrFail($this->editingMetaId);
        $meta->update([
            'meta_key' => $this->newMetaKey,
            'meta_value' => $this->newMetaValue,
        ]);

        session()->flash('success', 'Meta record updated successfully.');

        $this->resetForm();
        $this->product->load('metas');

        $this->dispatchBrowserEvent('hide-edit-modal');
    }



    public function resetForm()
    {
        $this->newMetaKey = '';
        $this->newMetaValue = '';
        $this->editingMetaId = null;
    }




    public function deleteMeta($metaId)
    {
        $meta = ProductMeta::findOrFail($metaId);
        $meta->delete();

        session()->flash('success', 'Meta record deleted successfully.');
        $this->product->load('metas');
    }



    public function render()
    {
        $this->product->load('metas');

        return view('livewire.admin.market.product-meta-table', [
            'product' => $this->product,
        ]);
    }
}
