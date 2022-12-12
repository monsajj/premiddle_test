<?php

class LoginPassword  extends Auth
{
    public function login($request) : array
    {
        $email = $request['email'];
        $password = $request['password'];

        //validation
        //get user
        //auth

        return $this->sendSuccess('Auth success: ' . $email . ' && ' . $password);
    }
}