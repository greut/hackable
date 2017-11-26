<?php
define('SECRET', '123456789XXX');
define('DIRECT', TRUE);
define('MASK_SIZE', 5);

define('GUEST', 0);
define('USER', 1);
define('MOD', 2);
define('ADMIN', 3);

session_start();

usleep(random_int(1000, 100000));

$accepted_themes = ['dark', 'white'];
$settings = new stdClass();
$settings->right = isset($_SESSION['role']) ? $_SESSION['role'] : GUEST;
$settings->theme = 'dark'; // valeur par default

$user = isset($_SESSION['identified']) ? $_SESSION['identified'] : 'guest';

$filename = 'data/log.txt';
if(file_exists($filename) && is_writable($filename)) {
    $data = [
        date('D, j M Y H:i'),
        substr(session_id(), 0, -MASK_SIZE) . str_repeat('*', MASK_SIZE),
        $settings->right,
        $_SERVER['REMOTE_ADDR'],
        $_SERVER['REQUEST_URI'],
        $_SERVER['HTTP_USER_AGENT']
    ];

    file_put_contents($filename, implode($data, '-') . "\n", FILE_APPEND);
}
