<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;

trait DeleteModelTrait {
    public function deleteModelTrait ($id, $model) 
    {
        try {
            $model->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Delete Success',
            ], 200);
        } catch (Exception $exception) {
            Log::error('message:' . $exception->getMessage() . 'line:' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Delete Error',
            ], 500);
        }
    }
    

};