<?php 
session_start();
require_once 'databaseconfig.php';

$productCategory = '';

if (isset($_GET['Category'])) {
    $productCategory = $_GET['Category'];
}


if ($productCategory !== '') {
    $query = "SELECT * FROM `product` WHERE Category = '$productCategory' ORDER BY ProductName";
} else {
    $query = "SELECT * FROM `product` ORDER BY ProductName";
}

$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php if (isset($_GET['Category'])) { print $_GET['Category']; }?> Products</title>
        <link rel="stylesheet" href="styles/productstyle.css">
    </head>
    <body>
        <?php include "header.php"; ?>
        <div class="title">
            <h1><?php if (isset($_GET['Category'])) { print $_GET['Category']; }?> Products</h1>
        </div>
        <div class="products">    
        <?php
               while ($product = mysqli_fetch_array($result)) {
         ?>
            <div class="product">
            <a href="product.php?id=<?php print $product['ProductId']; ?>">
            <img src="images/<?php print $product['ProductImage']; ?>"> </a>
            <h4 class="product-name"><?php print $product['ProductName']; ?></h4>
            <h3 class="product-price">Price: <?php print $product['Price'] ?> € </h3>
            <button class="add-to-cart">Add to cart</button>  
          </div>
        <?php
              }
        ?>
    </div>

        <?php include "footer.html"; ?>
    </body>
</html>

