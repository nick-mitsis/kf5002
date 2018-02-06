<?php
    require_once('../php/functions.php');
    echo initialiseSession();
    echo makePageStart("Order Books | N B C", "../media/favicon.png", array('../styles/theme.css', '../styles/order.css', '../styles/form.css', '../styles/dialogui.css'));
    echo makeHeader("../media/logo.png", "../order", "../edit", "../sign-in", "../sign-in/signout.php");
    echo startMain();

    $url = "http://unn-izge1.newnumyspace.co.uk/KF5002/assessment/orderBooksFormInc.php";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    echo $result;

    /* Here you need to add Javascript or a link to a script to process the form as required for the assignment--HTML not PHP*/
    echo endMain();
    echo makeFooter(array('../contact' => 'CONTACT', '../credits' => 'CREDITS'));
?>

    <script type="text/javascript" src="../js/search.js"></script>
    <script type="text/javascript" src="../js/dialog.js"></script>
    <script type="text/javascript" src="../js/order_form.js"></script>

<?php
    echo makeDialogStructure();
    echo makePageEnd();
?>
