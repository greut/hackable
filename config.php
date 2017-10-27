<?php
define('SECRET', '123456789XXX');
define('DIRECT', TRUE);
define('COUNT', 5);

session_start();

usleep(random_int(1000, 100000));

$accepted_themes = ['dark', 'white'];
$settings = new stdClass();
$settings->right = isset($_SESSION['role']) ? $_SESSION['role'] : 0; // 0=guest;1=user;2=mod
$settings->theme = 'dark'; // valeur par default

$user = isset($_SESSION['identified']) ? $_SESSION['identified'] : 'guest';

$filename = 'data/log.txt';
$data = date('D, j M Y H:i-');
$data .= substr(session_id(), 0, -COUNT) . str_repeat('*', COUNT) . '-';
$data .= $settings->right . '-';
$data .= $_SERVER['REMOTE_ADDR'] . '-';
$data .= $_SERVER['REQUEST_URI'] . '-';
$data .= $_SERVER['HTTP_USER_AGENT'];

if(file_exists($filename)) {
    if(is_writable($filename)) {
        file_put_contents($filename, $data . "\n", FILE_APPEND);
    }
}