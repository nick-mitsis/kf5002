<?php
    require_once('../php/functions.php');
    echo initialiseSession();
    echo makePageStart("Credits | N B C", "../media/favicon.png", array('../styles/theme.css', '../styles/dialogui.css'));
    echo makeHeader("../media/logo.png", "../order", "../edit", "../sign-in", "../sign-in/signout.php");
    echo startMain();
?>

    <!--Content-->
    <h1>Credits</h1>

    <h2>Fonts, Icons, Graphics and Images</h2>
    <p>Lawton, C. (2017) <i>Antique Books</i>.[online image] Available at: <a target="_blank" href="https://pixnio.com/objects/books/antique-book-old-bookshelf-colorful">here</a> (Downloaded: 02/11/2017).</p>
    <p><i>Snake</i> (no date). Available at: <a target="_blank" href="https://icons8.com/preloaders/en/free">here</a> (Downloaded: 18/11/2017).</p>
    <p>Dave Gandy (no date) <i>Font Awesome</i>. Available at: <a target="_blank" href="http://fontawesome.io/">here</a> (Accessed: 20/10/2017).</p>

    <h2>Websites</h2>
    <p>Davis, R. (no date) <i>The Wheel</i>. Available at: <a target="_blank" href="http://unn-isrd1.newnumyspace.co.uk/learn/">here</a> (Accessed: 18/11/2017).</p>
    <p>Refsnes Data (1997-2017) <i>w3schools.com</i>. Available at: <a target="_blank" href="https://www.w3schools.com/default.asp">here</a> (Accessed: 18/11/2017).</p>
    <p>The jQuery Foundation (2017) <i>jQuery User Interface</i>. Available at: <a target="_blank" href="https://jqueryui.com/">here</a> (Accessed: 18/11/2017).</p>

    <h2>Designed and Developed by</h2>
    <p>Nick Mitsis (w16003995)</p>

    <script type="text/javascript" src="../js/search.js"></script>
    <script type="text/javascript" src="../js/dialog.js"></script>

<?php
    echo endMain();
echo makeFooter(array('../contact' => 'CONTACT', '../credits' => 'CREDITS'));
    echo makeDialogStructure();
    echo makePageEnd();
?>