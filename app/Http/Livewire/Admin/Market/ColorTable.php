<?php

namespace App\Http\Livewire\Admin\Market;

use App\Models\Admin\Market\Color;
use Livewire\Component;

class ColorTable extends Component
{
    public $product;
    public $editingId;
    public $defaultColorId;
    public $selectedDefaultColorId;

    public $colorName;
    public $colorCode;
    public $priceInc = 0;


    protected $rules = [
        'colorName' => 'required',
        'priceInc' => 'required',
        'colorCode' => 'required',

    ];

    public function mount()
    {
        $this->selectedDefaultColorId = $this->product->default_color_id;

    }

    public function setDefaultColor($colorId)
    {
        try {
            $this->selectedDefaultColorId = $colorId;
            $this->defaultColorId = $colorId;
            $this->product->default_color_id = $this->defaultColorId;
     /*       $color = Color::find($colorId);
            $color->is_default = 1;
            $color->save();*/
            $this->product->save();
            $this->dispatchBrowserEvent('setDefaultColor');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            \Log::error($e);
        }


    }



    public function editColor($colorId)
    {
        $color = Color::findOrFail($colorId);

        $this->editingId = $color->id;
        $this->colorName = $color->name;
        $this->colorCode = $color->color_code;
        $this->priceInc = $color->price_increase;


    }

    public function updateColor()
    {


        try {
            $this->validate();
            $color = Color::findOrFail($this->editingId);
            $color->update([
                'name' => $this->colorName,
                'price_increase' => $this->priceInc,
                'color_code' => $this->colorCode,
            ]);
            session()->flash('success', 'Color record updated successfully.');
            $this->resetForm();
            $this->product->load('colors');
            $this->dispatchBrowserEvent('update_color');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            \Log::error($e);
        }

    }

    public function create()
    {

        try {
            $this->validate();
            $color = Color::create([
                'name' => $this->colorName,
                'price_increase' => $this->priceInc,
                'color_code' => $this->colorCode,
            ]);
            $this->product->find($this->product->id);
            $this->product->colors()->attach($color);
            $this->resetForm();
            $this->product->load('colors');
            $this->dispatchBrowserEvent('create_color');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            \Log::error($e);
        }
    }


    public function resetForm()
    {
        $this->colorName = '';
        $this->priceInc = 0;
        $this->colorCode = '';
        $this->isDefualt = '';
        $this->editingId = null;
    }


    public function deleteColor($id)
    {

        try {
            $color = Color::findOrFail($id);
            $this->product->colors()->detach($color->id);
            $this->product->default_color_id = null;
            $this->product->save();
            $this->product->load('colors');
            $this->dispatchBrowserEvent('delete_color');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            \Log::error($e);
        }
    }


    public function render()
    {
        $this->product->load('colors');
        return view('livewire.admin.market.color-table', [
            'product' => $this->product,
        ]);
    }
}


