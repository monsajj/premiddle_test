<?php

class MysqliTest Extends \PHPUnit\Framework\TestCase
{

    private $correct = [
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'database' => 'zaitsev_test',
    ];

    public function testWrongHost()
    {
        try {
            $testMysqli = new App\MyMysqli('wrong', $this->correct['user'], $this->correct['password'], $this->correct['database']);
            $result = -1;
        }
        catch (Exception $exception) {
            $result = $exception->getCode();
        }
        $this->assertEquals('2002', $result);
    }

    public function testWrongUser()
    {
        try {
            $testMysqli = new App\MyMysqli($this->correct['host'], 'wrong', $this->correct['password'], $this->correct['database']);
            $result = -1;
        }
        catch (Exception $exception) {
            $result = $exception->getCode();
        }
        $this->assertEquals('1045', $result);
    }

    public function testWrongPassword()
    {
        try {
            $testMysqli = new App\MyMysqli($this->correct['host'], $this->correct['user'], 'wrong', $this->correct['database']);
            $result = -1;
        }
        catch (Exception $exception) {
            $result = $exception->getCode();
        }
        $this->assertEquals('1045', $result);
    }

    public function testWrongDatabase()
    {
        try {
            $testMysqli = new App\MyMysqli($this->correct['host'], $this->correct['user'], $this->correct['password'], 'wrong');
            $result = -1;
        }
        catch (Exception $exception) {
            $result = $exception->getCode();
        }
        $this->assertEquals('1049', $result);
    }

    public function testWrongTableName()
    {
        $query = 'SELECT * FROM ' . 'wrong_table_name';
        try {
            $testMysqli = new App\MyMysqli($this->correct['host'], $this->correct['user'], $this->correct['password'], $this->correct['database']);
            $data = $testMysqli->makeQuery($query);
            $result = -1;
        }
        catch (Exception $exception) {
            $result = $exception->getCode();
        }
        $this->assertEquals('1146', $result);
    }

    public function testWrongQuerySyntax()
    {
        try {
            $testMysqli = new App\MyMysqli($this->correct['host'], $this->correct['user'], $this->correct['password'], $this->correct['database']);
            $data = $testMysqli->makeQuery('wrong query');
            $result = -1;
        }
        catch (Exception $exception) {
            $result = $exception->getCode();
        }
        $this->assertEquals('1064', $result);
    }
}