<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Traits\ApiResponses;
use App\Models\Admin\Market\ProductCategory;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    use ApiResponses;

    public function index()
    {
        /*$categories = ProductCategory::where('parent_id', null)->where('status', 1)->get();

        return ProductCategoryResource::collection($categories);*/
        $categories = ProductCategory::where('parent_id', null)->where('status', 1)->get();

        return $this->successResponse(
            data:['items' =>ProductCategoryResource::collection($categories)]
        );

    }

    public function all()
    {

      //  return ProductCategoryResource::collection(ProductCategory::paginate());
        return $this->successResponse(
            data:['items' =>ProductCategoryResource::collection(ProductCategory::paginate())]
        );
    }



    public function productByCategory($id) {
        $category = ProductCategory::findOrFail($id);
        $products = $category->products()->get();

        return $this->successResponse(
            data:['items' =>ProductResource::collection($products)]
        );

    }
}
