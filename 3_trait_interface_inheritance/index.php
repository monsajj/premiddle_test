<?php

function my_autoloader($class) {
    include 'vendor/' . $class . '.php';
}
spl_autoload_register('my_autoloader');

$logPass = new LoginPassword;
print_r(PHP_EOL . 'login with sms via login+password:' . PHP_EOL);
print_r($logPass->login(['email' => 'test@email.ua', 'password' => 'ultra_secure']));

$life = new LifeSms;
print_r(PHP_EOL . 'login with sms via ' . $life->getProviderForPrint() . ' provider:' . PHP_EOL);
print_r($life->login(['phone' => '+380123456789', 'code' => '1234']));

$kyivstar = new KyivstarSms;
print_r(PHP_EOL . 'login with sms via ' . $kyivstar->getProviderForPrint() . ' provider:' . PHP_EOL);
print_r($kyivstar->login(['phone' => '+380987654321', 'code' => '5678']));

/*

Auth - класс "родитель" для классов авторизации.
LoginPassword - наследует  Auth. Для логина через логин(емейл) + пароль.
SmsBase - наследует Auth. Абстрактный класс - родитель для классов LifeSms и KyivstarSms.
В LifeSms и KyivstarSms только добавлены провайдеры, вся логика прописана в SmsBase.
Для проверки логина с кодом на телефон просто выводится авторизация по уже якобы полученному коду.
Отправка кода с "динамическим" провайдером сделана по аналогии импользования библиотеки Socialite для работы с авторизацией через разные социальные(и не только) сети.
В библиотеке при вызове указывается провайдер (в методе SmsBase::smsSender()) который получает нужного провайдера уже при вызове класса наследника,
что в примере выше видно по $life->getProviderForPrint() и $kyivstar->getProviderForPrint() которые выдают название своего провайдера.

*/
