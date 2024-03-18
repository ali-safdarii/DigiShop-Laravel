<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductResource;
use App\Models\Admin\Market\Brand;
use Illuminate\Http\Request;

class BrandApiController extends Controller
{
    public function index()
    {
        return BrandResource::collection(Brand::all());
    }

    public function show($id)
    {
        $brand = Brand::findOrFail($id);

        return new BrandResource($brand);
    }

    public function productByBrand($id)
    {
        $brand = Brand::findOrFail($id);

        $products = $brand->products()->paginate(10);

        return ProductResource::collection($products);

    }
}
