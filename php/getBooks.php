<?php
require_once('functions.php');

try {
    require_once("../php/functions.php");
    $dbConn = getConnection();

    $sql = "SELECT bookISBN, bookTitle, bookYear, catDesc, bookPrice 
            FROM `nbc_books` LEFT JOIN `nbc_category` ON (nbc_books.catID = nbc_category.catID)
            ORDER BY bookTitle";

    $stmt = $dbConn->prepare($sql);
    $stmt->execute();

    echo "
        <h1>Available books to edit</h1>

        <table>
            <tr class='noHover'>
                <th>Title</th>
                <th>Year</th>
                <th>Category</th>
                <th>Price</th>
             </tr>
    
    ";
    while($rowObj = $stmt->fetchObject()){
        $bookISBN = $rowObj->bookISBN;
        $bookTitle = $rowObj->bookTitle;
        $bookYear = $rowObj->bookYear;
        $catDesc = $rowObj->catDesc;
        $bookPrice = $rowObj->bookPrice;

        echo "
                <tr>
                    <td><a href='../edit/bookEditor.php?bookISBN=$bookISBN' class='tableLinks'>$bookTitle</a></td>
                    <td>$bookYear</td>
                    <td>$catDesc</td>
                    <td>$bookPrice</td>
                </tr>
        ";
    }

    echo "</table>";

}
catch (Exception $e){
    if ($onDevelopment) {
        echo "<p>Query failed: ".$e->getMessage()."</p>\n";
    }
    else{
        echo "<div class='errorBox'>
                        <p class='errorHeading'>Error</p>
                        <p>A problem occurred. Please try again.</p>\n
                 </div>";
        echo "<p><a href='../edit'>Back</a></p>";
    }
}

?>
