<?php
require_once 'config.php';

if(isset($_COOKIE['theme']) and !isset($_POST['theme'])) {
    $cookie = base64_decode($_COOKIE['theme']);
    $hash = hash('sha256', SECRET . $cookie);
    if ($hash !== $_COOKIE['theme_hash']) {
        print 'Tentative de hack. On ne modifie pas ce cookie, petit malin ! Toute tentative est logguée';
        exit;
    }

    $tab = explode("\n", $cookie);
    foreach($tab as $value) {
        $setting = unserialize($value);
        if(is_array($setting)) {
            foreach ($setting as $k => $v)
                $settings->{$k} = $v;
        }
    }
}
else {
    $t = "dark";
    if (isset($_POST['theme']) and !empty($_POST['theme']) and in_array($_POST['theme'], $accepted_themes)){
        $t = $_POST['theme'];
    }
    $settings->theme = $t;
    setcookie('theme', base64_encode(serialize([ 'theme' => $t ])), time() + 86400 * 30, '/',NULL,FALSE,TRUE);
    setcookie('theme_hash', hash('sha256', SECRET . serialize([ 'theme' => $t ])), time() + 86400 * 30, '/',NULL,FALSE,TRUE);
}

if (!in_array($settings->theme, $accepted_themes)){
    print 'Erreur. Theme invalide!';
    exit;
}

require_once 'head.php';

$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
if(is_null($page) or $page === FALSE) {
    $page = 'home';
}

switch($page) {
    case 'home':
        require_once 'home.php';
        break;
    case 'login':
        require_once 'login.php';
        break;
    case 'logout':
        require_once 'logout.php';
        break;
    case 'mod':
        if($settings->right === 2) {
            require_once 'mod.php';
        }
        else {
            print "<p>Vous n'avez pas les droits nécessaires</p>";
        }
        break;
    case 'admin':
        if ($settings->right === 3 and $user === 'admin') {
            require_once 'admin.php';
        }
        else {
            print "<p>Vous n'avez pas les droits nécessaires</p>";
        }
        break;
    default:
        require_once 'home.php';
        break;
}
require_once 'foot.php';