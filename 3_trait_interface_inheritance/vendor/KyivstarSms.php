<?php

class KyivstarSms extends SmsBase
{

    public function __construct()
    {
        parent::__construct();
        $this->provider = 'kyivstar';
    }

}