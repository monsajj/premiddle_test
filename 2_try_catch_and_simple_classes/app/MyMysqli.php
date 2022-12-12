<?php

namespace App;

class MyMysqli {

    private $mysqli;

    public function __construct($host, $user, $password, $database)
    {
        mysqli_report(MYSQLI_REPORT_OFF);
        $this->mysqli = @new \mysqli($host, $user, $password, $database);
        if ($this->mysqli->connect_errno)
            throw new \Exception($this->mysqli->connect_error, $this->mysqli->connect_errno);
    }

    public function getClient()
    {
        return $this->mysqli;
    }

    public function makeQuery($query)
    {
            $result = $this->mysqli->query($query);
            if ($this->mysqli->errno) {
                throw new \Exception($this->mysqli->error, $this->mysqli->errno);
            }

            return $result;
    }
}