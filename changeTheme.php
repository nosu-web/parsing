<?php
$theme = $_GET['theme'];
setcookie('theme', $theme, time() + (3600 * 24 * 365));
