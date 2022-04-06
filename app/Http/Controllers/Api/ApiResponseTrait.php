<?php

namespace App\Http\Controllers\Api;

trait ApiResponseTrait{


    /*
     * [
     *  "data" =>
     *  "status=>true,false
     *  "error"=>
     * ]
     */

    public function apiResponse ($data= null , $error = null , $code = 200){

        $array = [
            'data' => $data,
            'error' => $error,
            'status' => in_array($code , $this->successCode())  ? true : false
        ];

        return response($array,$code);

    }

    public function successCode (){
        return [
            200,
            201,
            202
        ];
    }
}