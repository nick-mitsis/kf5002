<?php
    require_once('php/functions.php');
    echo initialiseSession();
    echo makePageStart("Welcome! | N B C", "media/favicon.png", array('styles/theme.css', 'styles/dialogui.css', 'styles/home.css',));
    echo makeHeader("media/logo.png", "order", "edit", "sign-in", "sign-in/signout.php");
    echo startMain();
?>

<section class="flexParent">
<div id="mainText" class="item">
<h1>Northumbria Book Company</h1>
<p>
Welcome to the official website of Northumbria Book Company. Here you can find a variety
of books for Programming and Computer Science, all at competitive prices.</p>
</div>
<aside class="item"><h2>Special Offer</h2><p id="target"></p><p id="slider"></p></aside>
</section>

<script type="text/javascript" src="js/search.js"></script>
<script type="text/javascript" src="js/dialog.js"></script>
<script type="text/javascript" src="js/special_offer.js"></script>

<?php
    echo endMain();
    echo makeFooter(array('contact' => 'CONTACT', 'credits' => 'CREDITS'));
    echo makeDialogStructure();
    echo makePageEnd();
?>


