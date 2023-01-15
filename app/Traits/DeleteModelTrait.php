<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait DeleteModelTrait

{
    public function deleteModelTrait($id, $model)
    {
        //
        try {
            //code...
            //delete data
            $model->find($id)->delete();

            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Message' . $e->getMessage() . 'line' . $e->getLine());


            //if have error
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}