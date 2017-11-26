<?php if(!defined('DIRECT')) { exit("Direct access is not allowed!"); }?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hackable</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="img/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="img/apple-touch-icon-152x152.png">
    <link rel="icon" type="image/png" href="img/favicon-196x196.png" sizes="196x196">
    <link rel="icon" type="image/png" href="img/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="img/favicon-128.png" sizes="128x128">
    <meta name="application-name" content="Hackable">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="img/mstile-144x144.png">
    <meta name="msapplication-square70x70logo" content="img/mstile-70x70.png">
    <meta name="msapplication-square150x150logo" content="img/mstile-150x150.png">
    <meta name="msapplication-wide310x150logo" content="img/mstile-310x150.png">
    <meta name="msapplication-square310x310logo" content="img/mstile-310x310.png">

    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/<?php echo $settings->theme ?>.css">
</head>
<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
<?php
$lilo = isset($_SESSION['identified']) ? 'logout' : 'login'
?>
<nav class="menu">
    <ul>
        <li><a href="home.html">home</a></li>
        <li><a href="<?php echo $lilo ?>.html"><?php echo $lilo?></a></li>
        <li><a href="mod.html">modérateur</a></li>
    </ul>
    <form id="frm_theme" class="nav-right" method="post" action="">
        <select id="theme" name="theme">
            <option value="dark" <?php echo ($settings->theme==="dark") ? 'selected' : '' ?>>DARK</option>
            <option value="white" <?php echo ($settings->theme==="white") ? 'selected' : '' ?>>WHITE</option>
        </select>
    </form>
</nav>
