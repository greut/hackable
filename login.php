<?php
if(!defined('DIRECT')) { print "Direct access not allowed!"; exit; }

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
if(is_null($username) or $username === FALSE) {
    $username = NULL;
}
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
if(is_null($password) or $password === FALSE) {
    $password = NULL;
}
$captcha = filter_input(INPUT_POST, 'captcha', FILTER_SANITIZE_STRING);
if(is_null($captcha) or $captcha === FALSE) {
    $captcha = '';
}

unset($_SESSION['identified']);

if(strcmp($_SESSION['captcha'], $captcha) === 0) {
    if (!is_null($username) and !is_null($password)) {
        $username = trim($username);
        $password = trim($password);

        if (($handle = fopen('data/db.txt', 'r')) !== FALSE) {
            while (($buffer = fgets($handle, 4096)) !== FALSE) {
                $infos = explode(';', $buffer);
                if (count($infos) === 3) {
                    if (strcmp(trim($infos[0]) . trim($infos[1]), $username . hash('sha256', $password)) === 0) {
                        $_SESSION['identified'] = $username;
                        $_SESSION['role'] = intval($infos[2]);
                        fclose($handle);
                        header('Location: index.php');
                        exit;
                    }
                }
            }
            fclose($handle);
        }
    }
}
?>
<form method="post" action="login.html">
    <fieldset>
        <legend>Credentials</legend>
        <p>
            <label for="username">Username : </label>
            <input id="username" type="text" name="username" autofocus="autofocus"/>
        </p>
        <p>
            <label for="password">Password : </label>
            <input id="password" type="text" name="password"/>
        </p>
        <p>
            <label for="img_captcha">&nbsp;</label>
            <img id="img_captcha" src="captcha.php" alt="Captcha"><br>
        </p>
        <p>
            <label for="captcha">Captcha : </label>
            <input id="captcha" type="text" name="captcha">
        </p>
        <p>
            <label for="try">&nbsp;</label>
            <input id="try" type="submit" value="Try...">
        </p>
    </fieldset>
</form>
