<?php
session_start();
require_once 'databaseconfig.php';
?>

<html>

<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="styles/orderdone.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Done</title>

</head>
<?php include "header.php" ?>

<div class="wrapper-1">
    <div class="wrapper-2">
        <h1>Hooray!</h1>
        <p>Thank you <?php if (isset($_SESSION['UserID']) && $_SESSION['UserID'] != '') print $_SESSION['Name'] ?> for shopping with Radiant Skin &copy;.</p>
        <p> Your order is currently being processed and we will let you know once it is shipped. </p>
        <button onclick="location.href='products.php'" type="button" class="continue-shopping">
            Continue shopping
        </button>
    </div>
</div>
<?php include "footer.html" ?>

</html>