<?php

class Auth
{
    public function sendResponse($result, $message) : array
    {
        return [
            'success' => true,
            'status' => 200,
            'data' => $result,
            'message' => $message
        ];
    }

    public function sendSuccess($message) : array
    {
        return [
            'success' => true,
            'status' => 200,
            'message' => $message
        ];
    }

    public function sendError($error, $code = 404) : array
    {
        return [
            'success' => false,
            'status' => $code,
            'message' => $error
        ];
    }

}