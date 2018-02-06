<?php
    require_once('../php/functions.php');
    echo initialiseSession();
    if (!checkUserStatus()) {
        $errors[] = "You need to sign in first!";
        $_SESSION['errors'] = $errors;
        header("Location: ../sign-in");
    }
    echo makePageStart("Edit Books | N B C", "../media/favicon.png", array('../styles/theme.css', '../styles/table.css', '../styles/form.css', '../styles/editor.css', '../styles/dialogui.css'));
    echo makeHeader("../media/logo.png", "../order", "../edit", "../sign-in", "../sign-in/signout.php");
    echo startMain();

    try {
        require_once("../php/functions.php");
        $dbConn = getConnection();

        $bookISBN = filter_has_var(INPUT_GET, 'bookISBN')
                 ? $_GET['bookISBN'] : null;

        $sql = "SELECT bookISBN, bookTitle, bookYear, catDesc, bookPrice, pubName
                FROM `nbc_books` LEFT JOIN `nbc_category` ON (nbc_books.catID = nbc_category.catID)
                LEFT JOIN `nbc_publisher` ON (nbc_books.pubID = nbc_publisher.pubID)
                WHERE bookISBN = :bookISBN";

        $stmt = $dbConn->prepare($sql);
        $stmt->execute(array(':bookISBN' => $bookISBN));

        $rowObj = $stmt->fetchObject();

        if (!$rowObj) {
            echo "<div class='errorBox'>
                  <p class='errorHeading'>Ooops!</p>
                  <p>We could not find that one.</p>
                  </div>";

            echo "<a href='index.php' class='btnStyleLink'>Back to books list</a>";

            echo endMain();
            echo makeFooter(array('../contact' => 'CONTACT', '../credits' => 'CREDITS'));
            exit();
        }


        $bookTitle = $rowObj->bookTitle;
        $bookYear = $rowObj->bookYear;
        $catDesc = $rowObj->catDesc;
        $pubName = $rowObj->pubName;
        $bookPrice = $rowObj->bookPrice;


        echo "<h1>$bookTitle</h1>";

        echo displayErrors("bookEditor");

        // Form to edit a book
        echo "
            <form name='editBook' action='../php/validation.php' method='post'>
            <input name='bookISBN' type='text' value='$bookISBN' readonly  hidden/>
            <table>
                <tr class='noHover'>
                    <th>Column</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Title</td>
                    <td><input name='bookTitle' type='text' value='$bookTitle' /></td>
                </tr>
                <tr>
                    <td>Year</td>
                    <td><input name='bookYear' type='text' value='$bookYear'/></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>";

        try {
            $dbConn = getConnection();

            // Get available book categories from database
            $sql = "SELECT catID, catDesc
                    FROM `nbc_category` 
                    ORDER BY catDesc";

            $stmt = $dbConn->prepare($sql);
            $stmt->execute();

            $selectedCatDesc = $catDesc;
            echo "<select name='catID' class='catDesc'>";

            while($rowObj = $stmt->fetchObject()) {
                $catID = $rowObj->catID;
                $catDesc = $rowObj->catDesc;
                if($selectedCatDesc === $catDesc){
                    echo "<option value='$catID' selected>$catDesc</option>\n";
                }
                else{
                    echo "<option value='$catID'>$catDesc</option>\n";
                }
            }

            echo "</select>";

        }
        catch (Exception $e){
            echo "<p>Query failed: ".$e->getMessage()."</p>\n";
        }
        echo "    </td>
            </tr>
            <tr>
                    <td>Publisher</td>
                    <td>";
        try {
            $dbConn = getConnection();

            // Get available publishers from database
            $sql = "SELECT pubID, pubName
                    FROM `nbc_publisher` 
                    ORDER BY pubName";

            $stmt = $dbConn->prepare($sql);
            $stmt->execute();

            $selectedPubName = $pubName;
            echo "<select name='pubID' class='pubName' >";

            while($rowObj = $stmt->fetchObject()) {
                $pubID = $rowObj->pubID;
                $pubName = $rowObj->pubName;
                if($selectedPubName === $pubName){
                    echo "<option value='$pubID' selected>$pubName</option>\n";
                }
                else{
                    echo "<option value='$pubID'>$pubName</option>\n";
                }
            }

            echo "</select>";


        }
        catch (Exception $e){
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


        echo "    </td>
                </tr>
                <tr>
                        <td>Price(&pound)</td>
                        <td><input name='bookPrice' type='text' value='$bookPrice'/></td>
                </tr>
       </table>
       
       <p><input type='submit' name='submit' value='Update Book' disabled/></p>

       </form>";

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

    echo endMain();
    echo makeFooter(array('../contact' => 'CONTACT', '../credits' => 'CREDITS'));
?>

    <script type="text/javascript" src="../js/search.js"></script>
    <script type="text/javascript" src="../js/dialog.js"></script>
    <script type="text/javascript" src="../js/editor.js"></script>

<?php
    echo makeDialogStructure();
    echo makePageEnd();
?>