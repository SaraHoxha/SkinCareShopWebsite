<?php 

session_start(); 

define('NOT_LOGGED_IN', 0);

if(!isset($_SESSION['logStatus'])) {
$_SESSION['logStatus'] == NOT_LOGGED_IN;
}

?>
<html>
<head>
    <link href="styles/mainstyle.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3f0bf72528.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="page-container">
        <header class="page-header">
            <nav class="navigation-bar">
                <div class="top-bar">
                    <div class="logo-container"> <img class="logo" src="images/logo.png"></div>
                    <ul class="customer-actions-list">
                        <li class="zoom"><a href="#"><i class="fa-solid fa-cart-shopping"></i></a></li>
                        <li class="zoom"><i class="fa-solid fa-user"><button class="dropdown">
                        <div class="drop-content">
                            <?php if ($_SESSION['logStatus'] == NOT_LOGGED_IN) { ?> <a href="login.php">Log In</a>
                            <?php } else { ?>
                            <a href="logout.php">Log Out</a>
                            <?php } ?>
                        </div>
                    </button></i>
                        </li>
                    </ul>
                </div>
                <ul class="nav-list">
                    <li class="nav-item underline"><a href="home.php">Homepage</a></li>
                    <li class="nav-item underline"><a href="products.php?Category=Skincare">Skincare</a></li>
                    <li class="nav-item underline"><a href="products.php?Category=Hair">Hair</a></li>
                    <li class="nav-item underline"><a href="products.php?Category=Body">Body</a></li>
                    <li class="nav-item underline"><a href="products.php?Category=Makeup">Makeup</a></li>
                </ul>
            </nav>
        </header>
    </html>