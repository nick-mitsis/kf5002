<?php
    require_once('../php/functions.php');
    echo initialiseSession();
    if (!checkUserStatus()) {
        $errors[] = "You need to sign in first!";
        $_SESSION['errors'] = $errors;
        header("Location: ../sign-in");
    }
    echo makePageStart("Edit Books | N B C", "../media/favicon.png", array('../styles/theme.css', '../styles/table.css', '../styles/dialogui.css'));
    echo makeHeader("../media/logo.png", "../order", "../edit", "../sign-in", "../sign-in/signout.php");
    echo startMain();
    include('../php/getBooks.php');
    echo endMain();
    echo makeFooter(array('../contact' => 'CONTACT', '../credits' => 'CREDITS'));
    echo makeDialogStructure();
?>

    <script type="text/javascript" src="../js/search.js"></script>
    <script type="text/javascript" src="../js/dialog.js"></script>
    <script type="text/javascript" src="../js/update_dialog.js"></script>

<?php
    echo checkIfBookUpdated();
    echo makePageEnd();
?>

