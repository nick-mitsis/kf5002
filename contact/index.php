<?php
    require_once('../php/functions.php');
    echo initialiseSession();
    echo makePageStart("Contact | N B C", "../media/favicon.png", array('../styles/theme.css', '../styles/contact.css', '../styles/dialogui.css'));
    echo makeHeader("../media/logo.png", "../order", "../edit", "../sign-in", "../sign-in/signout.php");
    echo startMain();
?>

     <!--Content-->
    <h1>Contact us</h1>

    <section class="flexParent" >
            <div class="item">
                <h2><i class="fa fa-phone" aria-hidden="true"></i><br>Telephone</h2>
                <p>7447 000000</p>
            </div>
        
            <div class="item">
                <h2><i class="fa fa-envelope" aria-hidden="true"></i><br>E-mail</h2>
                <p>info@nbc.co.uk</p>
            </div>
        
            <div class="item">
                <h2><i class="fa fa-map-marker" aria-hidden="true"></i><br>Location</h2>
                <p>Northumberland St<br>Newcastle upon Tyne<br>NE1 1EN</p>
            </div>
    </section>


    <script type="text/javascript" src="../js/search.js"></script>
    <script type="text/javascript" src="../js/dialog.js"></script>

<?php
    echo endMain();
    echo makeFooter(array('/' => 'CONTACT', '../credits' => 'CREDITS'));
    echo makeDialogStructure();
    echo makePageEnd();
?>