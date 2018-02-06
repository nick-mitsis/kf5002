<?php
ini_set("session.save_path", "/home/unn_w16003995/sessionData");
session_start();

$_SESSION = array();

session_destroy();

if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
else {
    header('Location: http://unn-w16003995.newnumyspace.co.uk/nbc/sign-in/');
}
