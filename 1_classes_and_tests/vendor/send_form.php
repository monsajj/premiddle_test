<?php

session_start();
$cache_file = $_SERVER['DOCUMENT_ROOT'] . '/cache.txt';
$resend_time = 10;

// Validation
$validation_message = "";
$contact_name = trim($_POST['name']);
$contact_email = trim($_POST['email']);
$contact_message = trim($_POST['contact_message']);

$_SESSION['contact_name'] = $contact_name;
$_SESSION['contact_email'] = $contact_email;
$_SESSION['contact_message'] = $contact_message;
if (!preg_match("/^([a-zA-Zа-яА-ЯёЁ' ]+)$/u",$contact_name))
    $validation_message .= 'Full name can only include letters, space and \'' . '<br><br>';
if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",$contact_email))
    $validation_message .= 'Invalid email format' . '<br><br>';
if ($contact_message == "")
    $validation_message .= 'Message must not be empty';
if ($validation_message) {
    $_SESSION['success'] = false;
    $_SESSION['message_class'] = 'error';
    $_SESSION['message'] = $validation_message;
    header('Location: ../index.php');
    die();
}

// Session check
$minutes_left = 0;
if ($_SESSION['last_request_time']) {
    $minutes_left = $resend_time - (int) ((time() - $_SESSION['last_request_time']) / 60);
}
$minutes_left = max($minutes_left, 0);

if ($minutes_left) {
    $error_message = 'Вы уже отправили запрос, повторный запрос можно отправить через ' . $minutes_left . ' минут';
    if ($minutes_left < 5 && $minutes_left > 1)
        $error_message .= 'ы';
    if ($minutes_left === 1)
        $error_message .= 'у';
    $_SESSION['success'] = false;
    $_SESSION['message_class'] = 'error';
    $_SESSION['message'] = $error_message;
    header('Location: ../index.php');
    die();
}

// Cache check
$cache_content = file_get_contents($cache_file);

foreach (file($cache_file) as $line) {
    if (strrpos($line, $contact_email) === 0) {
        $last_sended_timestamp = (int)mb_substr($line, strrpos($line, '=') + 1);
        $minutes_left = $resend_time - (int) ((time() - $last_sended_timestamp) / 60);
        $minutes_left = max($minutes_left, 0);
        if ($minutes_left) {
            $error_message = 'Вы уже отправили запрос для этого email, повторный запрос можно отправить через ' . $minutes_left . ' минут';
            if ($minutes_left < 5 && $minutes_left > 1)
                $error_message .= 'ы';
            if ($minutes_left === 1)
                $error_message .= 'у';
            $_SESSION['success'] = false;
            $_SESSION['message_class'] = 'error';
            $_SESSION['message'] = $error_message;
            header('Location: ../index.php');
            die();
        }
        $cache_content = str_replace($line, '', $cache_content);
        file_put_contents($cache_file, $cache_content);
        break;
    }
}

// Success
// ------------- Send contact Mail here -------------
// --------------------------------------------------
$time = time();
$_SESSION['success'] = true;
$_SESSION['message_class'] = 'success';
$_SESSION['last_request_time'] = $time;
$_SESSION['message'] = 'Вы уже отправили запрос, повторный запрос можно отправить через ' . $resend_time . ' минут';
file_put_contents($cache_file, $contact_email . '=' . $time . PHP_EOL,  FILE_APPEND);
unset($_SESSION['contact_name'], $_SESSION['contact_email'], $_SESSION['contact_message']);
header('Location: ../index.php');
die();
