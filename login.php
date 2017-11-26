<?php
if(!defined('DIRECT')) { exit("Direct access is not allowed!"); }

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
if(is_null($username) || $username === FALSE) {
    $username = NULL;
}
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
if(is_null($password) || $password === FALSE) {
    $password = NULL;
}
$captcha = filter_input(INPUT_POST, 'captcha', FILTER_SANITIZE_STRING);
if(is_null($captcha) || $captcha === FALSE) {
    $captcha = '';
}

unset($_SESSION['identified']);

if(
   strcmp($_SESSION['captcha'], $captcha) === 0 &&
   !is_null($username) && !is_null($password)
) {
    $username = trim($username);
    $password = trim($password);

    if (($handle = fopen('data/db.txt', 'r')) !== FALSE) {
        while (($infos = fgetcsv($handle, 4096, ';')) !== FALSE) {
            if (count($infos) === 3) {
                list($name, $hash, $role) = $infos;
                if (strcmp(trim($name) . trim($hash), $username . hash('sha256', $password)) === 0) {
                    $_SESSION['identified'] = $username;
                    $_SESSION['role'] = intval($role);
                    fclose($handle);
                    header('Location: home.html');
                    exit;
                }
            }
        }
        fclose($handle);
    }
}
?>
<form method="post" action="login.html">
    <fieldset>
        <legend>Credentials</legend>
        <p>
            <label for="username">Username :</label>
            <input id="username" type="text" name="username" autofocus="autofocus" value="<?php echo $username ?>">
        </p>
        <p>
            <label for="password">Password :</label>
            <input id="password" type="password" name="password">
        </p>
        <p class="no-label">
            <img id="img_captcha" src="captcha.php" alt="This is a Captcha, install GD if it doesn't appear">
        </p>
        <p>
            <label for="captcha">Captcha :</label>
            <input id="captcha" type="text" name="captcha">
        </p>
        <p class="no-label">
            <button type="submit">Try...</button>
        </p>
    </fieldset>
</form>
