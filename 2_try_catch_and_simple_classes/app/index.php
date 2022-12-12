<?php
require_once('MyMysqli.php');

$localhost = 'localhost';
$user = 'root';
$password = '';
$database = 'zaitsev_test';

$query = 'SELECT * FROM action_type';

try {
    $testMysqli = new App\MyMysqli($localhost, $user, $password, $database);
    $testMysqliClient = $testMysqli->getClient();

    $result = $testMysqli->makeQuery($query);
    while( $row = $result->fetch_array() )
    {
        print_r($row['id'] . " - " . $row['name']);
        print_r(PHP_EOL);
    }
    print_r(PHP_EOL);
}
catch (Exception $exception) {
    print_r($exception->getCode() . PHP_EOL . $exception->getMessage() . PHP_EOL);
}


if (isset($testMysqli)) {
    // Тут можно делать другие действия с базой
    if (isset($testMysqliClient))
        print_r($testMysqliClient->ping());
}
else {
    // Тут можно сделать другую попытку коннекта и тут или вне(после) else выполнять действия не требующие базу данных
    // Например отправить емейл("например" взят из таска)
    print_r('First database not connected');
}

