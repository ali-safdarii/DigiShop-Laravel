<?php

namespace App\Http\Services\Image;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;

class ImageService extends ImageToolsService
{

    public function save($image)
    {
        //set image
        $this->setImage($image);
        //execute provider
        $this->provider();
        //save image
        $result = Image::make($image->getRealPath())->save(public_path($this->getImageAddress()), null, $this->getImageFormat());
        return $result ? $this->getImageAddress() : false;
    }


    public function fitAndSave($image, $width, $height)
    {
        //set image
        $this->setImage($image);
        //execute provider
        $this->provider();
        //save image
        $result = Image::make($image->getRealPath())->fit($width, $height)->save(public_path($this->getImageAddress()), null, $this->getImageFormat());
        return $result ? $this->getImageAddress() : false;
    }

    public function createIndexAndSave($image)
    {

        try {//get data from config
            $imageSizes = Config::get('image.index-image-sizes');//set image
            $this->setImage($image);//set directory
            $this->getImageDirectory() ?? $this->setImageDirectory(date("Y") . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d'));
            $this->setImageDirectory($this->getImageDirectory() . DIRECTORY_SEPARATOR . time());//set name
            $this->getImageName() ?? $this->setImageName(time());
            $imageName = $this->getImageName();
            $indexArray = [];
            foreach ($imageSizes as $sizeAlias => $imageSize) {

                //create and set this size name
                $currentImageName = $imageName . '_' . $sizeAlias;

                \Log::debug($currentImageName);
                $this->setImageName($currentImageName);

                //execute provider
                $this->provider();

                //save image
                $result = Image::make($image->getRealPath())->resize($imageSize['width'], $imageSize['height'], function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path($this->getImageAddress()), null, $this->getImageFormat());

                if ($result)
                    $indexArray[$sizeAlias] = $this->getImageAddress();
                else {
                    return false;
                }

            }
            $images['indexArray'] = $indexArray;
            $images['directory'] = $this->getFinalImageDirectory();
            $images['currentImage'] = Config::get('image.default-current-index-image');
            $currentImageUrl = $this->getCurrentImageUrl($images);
            $images['currentImageUrl'] = $currentImageUrl;
            return $images;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return false;
        }
    }



    public function getCurrentImageUrl($images)
    {
        $currentImageSizeAlias = Config::get('image.default-current-index-image');

        if (isset($images['indexArray'][$currentImageSizeAlias])) {
            return URL::to($images['indexArray'][$currentImageSizeAlias]);
        } else {
            return Config::get('image.image-not-found'); // Return a placeholder URL if the size is not found
        }
    }

    public function deleteImage($imagePath)
    {
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    public function deleteIndex($images)
    {
        $directory = public_path($images['directory']);
        $this->deleteDirectoryAndFiles($directory);
    }

    public function deleteDirectoryAndFiles($directory)
    {
        if (!is_dir($directory)) {
            return false;
        }

        $files = glob($directory . DIRECTORY_SEPARATOR . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->deleteDirectoryAndFiles($file);
            } else {
                unlink($file);
            }
        }
        return rmdir($directory);
    }


}
