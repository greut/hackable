<?php
require_once 'config.php';

if(isset($_COOKIE['theme']) && !isset($_POST['theme'])) {
    $cookie = base64_decode($_COOKIE['theme']);
    $hash = hash('sha256', SECRET . $cookie);
    if ($hash !== $_COOKIE['theme_hash']) {
        exit(
            'Tentative de hack. On ne modifie pas ce cookie, petit malin ! '.
            'Toute tentative est logguée'
        );
    }

    $tab = explode("\n", $cookie);
    foreach($tab as $value) {
        $setting = (array) unserialize($value);
        foreach ($setting as $k => $v) {
            $settings->{$k} = $v;
        }
    }
}
else {
    $t = "dark";
    if (isset($_POST['theme']) && !empty($_POST['theme']) && in_array($_POST['theme'], $accepted_themes)){
        $t = $_POST['theme'];
    }
    $settings->theme = $t;
    setcookie('theme', base64_encode(serialize([ 'theme' => $t ])), time() + 86400 * 30, '/',NULL,FALSE,TRUE);
    setcookie('theme_hash', hash('sha256', SECRET . serialize([ 'theme' => $t ])), time() + 86400 * 30, '/',NULL,FALSE,TRUE);
}

if (!in_array($settings->theme, $accepted_themes)){
    exit('Erreur. Theme invalide!');
}

$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
if(is_null($page) || $page === FALSE) {
    $page = 'home';
}

switch($page) {
    case 'home':
    case 'login':
    case 'logout':
        break;
    case 'mod':
        if($settings->right !== MOD) {
            exit("Vous n'avez pas les droits nécessaires");
        }
        break;
    case 'admin':
        if ($settings->right !== ADMIN || $user !== 'admin') {
            exit("Vous n'avez pas les droits nécessaires");
        }
        break;
    default:
        header('Location: home.html');
        exit();
}

require_once 'head.php';
require_once $page.'.php';
require_once 'foot.php';
