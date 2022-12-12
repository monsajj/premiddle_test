<?php

abstract class SmsBase extends Auth
{
    protected string $provider;

    public function __construct()
    {
    }

    public function login($request) : array
    {
        $email = $request['phone'];
        $password = $request['code'];

        //validation
        //get user
        //auth

        return $this->sendSuccess('Auth success: ' . $email . ' && ' . $password);
    }

    public function getProviderForPrint() : string //Создано только что бы в index.php для теста можно было вывести нужные данные
    {
        return $this->getProviderName();
    }

    public function sendSms($phone)
    {
        $this->smsSender()->sendSms($phone);
    }

    protected function getProviderName() : string
    {
        return $this->provider;
    }

    protected function smsSender()
    {
        return SomeSendSMSLibrary::with($this->getProviderName());
    }
}