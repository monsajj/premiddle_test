<?php

class LifeSms extends SmsBase
{

    public function __construct()
    {
        parent::__construct();
        $this->provider = 'life';
    }

}