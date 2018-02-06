<?php
    require_once('../php/functions.php');
    echo initialiseSession();
    if (checkUserStatus()){
        header('Location: ../');
    }
    echo makePageStart("Sign in | N B C", "../media/favicon.png", array('../styles/form.css', '../styles/signin.css'));
    echo startHeader();
?>

<img id="logo" src="../media/logo.png" alt="NBC Logo" >

<div id="social_signin">
    <a target="_blank" href="https://www.facebook.com/"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
    <a target="_blank" href="https://twitter.com/"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
    <a target="_blank" href="https://www.instagram.com/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
    <a target="_blank" href="https://www.linkedin.com/"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
    <a target="_blank" href="https://plus.google.com/"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
</div>

<?php
    echo endHeader();
    echo startMain();
    $origin_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
    $_SESSION['origin_url'] = $origin_url;
?>

<h1>Sign in</h1>

<form id="signinForm" action="signin.php" method="post">

    <input name="username" type="text" placeholder="Username" id="username"/>

    <input name="password" type="password" placeholder="Password" id="password"/>

    <input value="Log in" type="submit" id="loginButton"/>

</form>

<?php
    echo displayErrors("sign-in");
    echo endMain();
?>

<footer>
    <span>2018 &copy;</span><a href='/nbc'>NBC</a>
    <span>|&nbsp;</span><a href='../order'>ORDER</a>
    <span>|&nbsp;</span><a href='../contact'>CONTACT</a>
    <span>|&nbsp;</span><a href='../credits'>CREDITS</a>
</footer>

<?php
    echo makePageEnd();
?>
