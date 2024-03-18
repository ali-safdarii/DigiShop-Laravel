<?php
namespace App\Http\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponses{

    protected function successResponse($data, $message = "", $code = 200)
    {
        return response()->json([
            'message' => $message,
            'status_code' => $code,
            'success' => true,
            'data' => $data
        ],$code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json([
            'message' => $message,
            'status_code' => $code,
            'success' => false
        ], $code);
    }


    protected function noDataSuccessResponse($message = "", $code = 200)
    {
        return response()->json([
            'message' => $message,
            'status_code' => $code,
            'success' => true,
        ],$code);
    }

  

    protected function authErrorResponse()
    {
        return response()->json([
              'message' => 'User not authenticated',
              'status_code' => 401,
              'success' => false
          ], 401);
    }

    protected function showAll(Collection $collection){
        return $this->successResponse(['data'=>$collection]);
    }

    protected function showOne(Model $model){
        return $this->successResponse(['data'=>$model]);
    }
}
