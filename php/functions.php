<?php

$onDevelopment = false;

// DATABASE CONNECTION
function getConnection() {
    try {
        $connection = new PDO("mysql:host=localhost;dbname=unn_w16003995",
            "unn_w16003995", "MTG3QZQ5");
        $connection->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (Exception $e) {
        /* We should log the error to a file so the developer can look at any logs. However, for now we won't */
        throw new Exception("Connection error ". $e->getMessage(), 0, $e);
    }
}


// SESSION INITIALISATION
function initialiseSession() {
    ini_set("session.save_path", "/home/unn_w16003995/sessionData");
    session_start();
}


// CHECK IF USER IS SIGNED IN
function checkUserStatus() {
    if (isset($_SESSION['signed-in'])) {
        if ($_SESSION['signed-in']) {
            return true;
        }
        else {
            return false;
        }
    }
    else {
        return false;
    }
}

// IF ANY ERRORS DISPLAY THEM
function displayErrors($useCase) {
    if(isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        if ($useCase == "bookEditor") {
            echo "<div class='errorBox'>";
            echo "<p class='errorHeading'>Error(s)</p>";
        }
        foreach ($errors as $error) {
            echo "<p class='error'>$error</p>";
        }
        if ($useCase == "bookEditor") {
            echo "</div>";
        }
        unset ($_SESSION['errors']);
    }
}


// INVALID PASSWORD OUTPUT
function invalidPassword() {
    $errors[] = "The username and password you entered did not match our records. Please try again.";
    $_SESSION['errors'] = $errors;
    header('Location: ../sign-in');
}

// CHECK IF BOOK UPDATED SUCCESSFULLY
function checkIfBookUpdated() {
    if (isset($_SESSION['success'])) {
        if ($_SESSION['success']) {
            echo "<div id=\"dialog-message\" title=\"Success\">
            <p>
                <span style=\"color: #00b200; float:left; margin:0 7px 50px 0;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i></span>
                One record has been updated successfully.
            </p>
        </div>";
            unset ($_SESSION['success']);
        }
    }
}



// PAGE START
function makePageStart($pageTitle, $favicon, $cssFiles) {
    $pageStartContent = <<<PAGESTART
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>$pageTitle</title> 
        <link rel="shortcut icon" href="$favicon" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" type="text/css"/>

PAGESTART;

    foreach ($cssFiles as $cssFileName) {
        $pageStartContent .= "<link href='$cssFileName' rel='stylesheet' type='text/css' />\n";
    }

    $pageStartContent .= <<<PAGESTART
    <script src="https://use.fontawesome.com/ab3135c615.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" type="text/javascript"></script>
	</head>
	<body>
PAGESTART;
    $pageStartContent .="\n";
    return $pageStartContent;
}


// HEADER
function makeHeader($logo, $navOrderPath, $navEditBooksPath, $signInPath, $signOutPath){
    $headContent = <<<HEAD
    <header>
        <div id="social_signin">
            <a target="_blank" href="https://www.facebook.com/"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
            <a target="_blank" href="https://twitter.com/"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
            <a target="_blank" href="https://www.instagram.com/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a target="_blank" href="https://www.linkedin.com/"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
            <a target="_blank" href="https://plus.google.com/"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
HEAD;

    $headContent .= signInOutButton($signInPath, $signOutPath);
    $headContent .= <<<HEAD
        </div>
        
        <div id="logo_nav">
            <img id="logo" src="$logo" alt="NBC Logo" >
HEAD;

        if (checkUserStatus()) {
            $headContent .= makeNavMenu(array('/nbc' => 'HOME', $navOrderPath => 'ORDER', $navEditBooksPath => 'EDIT BOOKS'), array('homeLogged', 'orderLogged', 'editLogged'));
        }
        else {
            $headContent .= makeNavMenu(array('/nbc' => 'HOME', $navOrderPath => 'ORDER'), array('home', 'order'));
        }
        $headContent .= <<<HEAD
            <button><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
        
        <form id="search" style="float: right; display: none">
            <input type="text" id="searchBox" name="search" placeholder="Type to search">
            <p id="noResults"></p>
        </form>
    </header>
HEAD;

    $headContent .="\n";
    return $headContent;
}





// START HEADER (Used only if header layout is completely different on this page)
function startHeader() {
    return "<header>\n";
}

// END HEADER
function endHeader() {
    return "</header>\n";
}






// SIGN IN - SIGN OUT
function signInOutButton($signInPath, $signOutPath) {
    if(checkUserStatus()) {
        $username = $_SESSION['username'];
        return "<span id='username-logout'><i class='fa fa-user-circle-o' aria-hidden='true'></i> $username | <a href='$signOutPath'><i class='fa fa-power-off' aria-hidden='true'></i></a></span>\n\n";
    }
    else {
        return "<a id='signInButton' href='$signInPath'><i class='fa fa-user-circle-o' aria-hidden='true'></i>SIGN IN</a>\n";
    }
}


// NAVIGATION
function makeNavMenu($navLinks, $idName) {
    $navMenuContent = <<<NAVMENU
	<nav>
		<ul
NAVMENU;
    if(checkUserStatus()) {
        $navMenuContent .= " id='changeIfLogged'";
    }
    $navMenuContent .= ">\n";
    $idx = 0;
	foreach($navLinks as $linkPath=>$linkName){
	    $navMenuContent .= "            <li id='$idName[$idx]'><a href='$linkPath'>$linkName</a></li>\n";
	    $idx++;
	}
	$navMenuContent .= <<<NAVMENU
		</ul>	
	</nav>
NAVMENU;

    $navMenuContent .= "\n";
    return $navMenuContent;
}




// MAIN START
function startMain() {
    return "<main>\n";
}

// MAIN END
function endMain() {
    return "</main>\n";
}



// FOOTER
function makeFooter($footerLinks) {
    $footerContent = <<< FOOTER
<footer>
    <span>2018 &copy;</span>
    <a href='/nbc'>NORTHUMBRIA BOOK COMPANY</a>
    
    <div id="footerLinks">
FOOTER;

    foreach($footerLinks as $linkPath => $linkName) {
        $footerContent .= "<span>|&nbsp;</span><a href='$linkPath'>$linkName</a>\n";
    }

    $footerContent .= <<< FOOTER
    </div>
</footer>
FOOTER;
    $footerContent .="\n";
    return $footerContent;
}


// DIALOG UI STRUCTURE
function makeDialogStructure() {
    $dialog = <<< SCRIPT
<div id="dialog-book" title="Book details">
        <p id="chosenBook"></p>
        <p id="ISBN"></p>
        <p id="category"></p>
        <p id="publisher"></p>
        <p id="year"></p>
        <p id="price">Price(&pound): </p>
</div>

SCRIPT;

    $dialog .= "\n";
    return $dialog;
}



// PAGE END
function makePageEnd() {
    return "</body>\n</html>";
}

?>