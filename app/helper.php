<?php

class Helper {

    public static function httpStatusOk()
    {
        $status = 200;
        return $status;
    }

    public static function httpStatusBadRequest()
    {
        $status = 400;
        return $status;
    }


    public static function httpResponseError()
    {
        $message = array(
            "status"  => $this->httpStatusBadRequest,
            "message" => "Get data failed, please try again",
            "data"    => null
        );

        return response()->json($message);
    }

    public static function httpResponseSucess($data = null){
        $message = array(
            "status"  => $this->httpStatusOk,
            "message" => "Get data failed, please try again",
            "data"    => $data
        );

        return response()->json($message);
    }


}
