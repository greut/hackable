<?php if(!defined('DIRECT')) { exit("Direct access not allowed!"); } ?>
<h1>Welcome mod « <?php print isset($_SESSION['identified']) ? $_SESSION['identified'] : 'guest' ?> »</h1>
<pre><?php
    if(file_exists($filename)) {
        if(is_writable($filename)) {
            print htmlentities(file_get_contents($filename));
        }
    }
    ?></pre>
