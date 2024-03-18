<?php

namespace App\Http\Livewire\Admin\Market;

use App\Http\Services\Image\ImageService;
use App\Models\Admin\Market\ProductGallery;
use App\Utili\Helper;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProductGalleryTable extends Component
{
    use WithFileUploads;

    public $product;
    public $image;

    private ImageService $imageService;


    protected $rules = [
        'image' => 'required|image',
        // Adjust the validation rules as needed
    ];

    public function boot(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function uploadImage()
    {


        $this->validate($this->rules);

        try {

            if ($this->image) {
                $this->imageService->setExclusiveDirectory('images/products/galleries');
                $result = $this->imageService->createIndexAndSave($this->image);

                if ($result) {
                    // Store the processed image path
                    $processedImagePath = $result;

                    ProductGallery::create([
                        'image' => json_encode($processedImagePath),
                        'product_id' => $this->product->id,
                    ]);


                    $this->dispatchBrowserEvent('upload');
                    $this->product->load('images');
                    $this->image = null;
                }
            }


        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong while uploading the image.');
            \Log::error($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            // Retrieve the product gallery record
            $productGallery = ProductGallery::findOrFail($id);

            // Get the image paths from the JSON-encoded data in the 'image' column
            $imagePaths = json_decode($productGallery->image, true);

            if (is_array($imagePaths)) {
                // Iterate through each image size and delete their directories
                foreach ($imagePaths as $sizeAlias => $imagePath) {
                    // Ensure $imagePath is a string before attempting to delete
                    if (is_string($imagePath)) {
                        $imageFullPath = public_path($imagePath);

                        // Check if it's a directory and remove it recursively
                        if (is_dir($imageFullPath)) {
                            $this->imageService->deleteDirectoryAndFiles($imageFullPath);
                        }
                    }
                }
            }


            // Delete the database record
            $productGallery->delete();

            $this->product->load('images');
            $this->dispatchBrowserEvent('image_remove');

        } catch (\Exception $e) {
            session()->flash('error', 'Something went wrong while deleting the image record.');
            \Log::error($e->getMessage());
        }
    }

    public function render()
    {
        if (!$this->product) {
            // Handle the case where $product is null
            // For example, you can display an error message or redirect the user
            session()->flash('error', 'Something went wrong ...');
        }

        $this->product->load('images');
        return view('livewire.admin.market.product-gallery-table', [
            'product' => $this->product,
        ]);
    }
}
