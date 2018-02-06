<?php
require_once('functions.php');
echo initialiseSession();
if (!checkUserStatus()) {
    $errors[] = "You need to sign in first!";
    $_SESSION['errors'] = $errors;
    header("Location: ../sign-in");
}
echo makePageStart("Edit Books | N B C", "../media/favicon.png", array('../styles/theme.css', '../styles/table.css', '../styles/form.css', '../styles/editor.css'));
echo makeHeader("../media/logo.png", "../", "../order", "../edit", "../sign-in", "../sign-in/signout.php");
echo startMain();

$bookISBN = filter_has_var(INPUT_POST, 'bookISBN')
    ? $_POST['bookISBN'] : null;
$bookTitle = filter_has_var(INPUT_POST, 'bookTitle')
    ? $_POST['bookTitle'] : null;
$bookYear = filter_has_var(INPUT_POST, 'bookYear')
    ? $_POST['bookYear'] : null;
$catID = filter_has_var(INPUT_POST, 'catID')
    ? $_POST['catID'] : null;
$bookPrice = filter_has_var(INPUT_POST, 'bookPrice')
    ? $_POST['bookPrice'] : null;
$pubID = filter_has_var(INPUT_POST, 'pubID')
    ? $_POST['pubID'] : null;

$bookTitle = trim($bookTitle);
$bookYear = trim($bookYear);
$catID = trim($catID);
$bookPrice = trim($bookPrice);
$pubID = trim($pubID);

if(empty($bookTitle)){
    $errors[] = "You have not entered a book title.";
    $_SESSION['errors'] = $errors;
}

if(empty($bookYear)){
    $errors[] = "You have not entered the year of publication.";
    $_SESSION['errors'] = $errors;
}


$intBookPrice = (int)$bookPrice;
if(empty($bookPrice)){
    $errors[] = "You have not entered a price.";
    $_SESSION['errors'] = $errors;
}
else if (strlen($intBookPrice) > 2) {
	$errors[] = "Price must not exceed 2 digits and 2 decimal places.";
    $_SESSION['errors'] = $errors;
}
else if ($bookPrice < 0) {
	$errors[] = "Price must be greater than zero.";
    $_SESSION['errors'] = $errors;
}



if(strlen($bookTitle) > 255){
    $errors[] = "Book title must not exceed 255 characters.";
    $_SESSION['errors'] = $errors;
}

if(strlen($bookYear) > 4){
    $errors[] = "Publication year must not exceed 4 characters.";
    $_SESSION['errors'] = $errors;
}



if(!(empty($errors))) {
    header("Location: ../edit/bookEditor.php?bookISBN=$bookISBN");
}
else {
    try {
        $dbConn = getConnection();

        $sqlInsert = "UPDATE `nbc_books`
                      SET bookTitle = :bookTitle, bookYear = :bookYear, catID = :catID, pubID = :pubID, bookPrice = :bookPrice
                      WHERE bookISBN = :bookISBN";

        $stmt = $dbConn->prepare($sqlInsert);
        $stmt->execute(array(':bookISBN' => $bookISBN, ':bookTitle' => $bookTitle, ':bookYear' => $bookYear, ':catID' => $catID, ':pubID' => $pubID, ':bookPrice' => $bookPrice));

        $success = true;
        $_SESSION['success'] = $success;
        header("Location: ../edit/");
    } catch (Exception $e) {
        if ($onDevelopment) {
            echo "<p>Query failed: " . $e->getMessage() . "</p>\n";
        } else {
            echo "<div class='errorBox'>
                        <p class='errorHeading'>Error</p>
                        <p>A problem occurred. Please try again.</p>\n
                        <p><a href='../edit'>Back</a></p>
                 </div>";
        }
    }
}

echo endMain();
echo makeFooter("2018 © NORTHUMBRIA BOOK COMPANY |", array('../about' => 'ABOUT US |', '../contact' => 'CONTACT |', '../credits' => 'CREDITS'));
echo searchButtonJS();
echo makePageEnd();
?>