<?php
session_start();

require_once 'databaseconfig.php';

$query = "SELECT * FROM `product` LIMIT 8";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radiant Skin Homepage</title>
    <link rel="stylesheet" href="styles/mainstyle.css">
    <link rel="stylesheet" href="styles/productstyle.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="page-container">
    <?php include "header.php" ;?>
<div class="slideshow-container">
    <div class="banner">
      <img src="images/banner1.jpeg" style="width:100%">
    </div>
    <a class="prev" onclick="nextSlide(1)">&#10094;</a>
    <a class="next" onclick="prevSlide(1)">&#10095;</a>
    </div>
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span> 
    <span class="dot" onclick="currentSlide(2)"></span> 
    <span class="dot" onclick="currentSlide(3)"></span> 
  </div>
<div class="products-container">
  <br>
    <div class="title"> Some of our products</div>
    <div class="products">    
        <?php
               while ($product = mysqli_fetch_array($result)) {
         ?>
            <div class="product">
            <a href="product.php?id=<?php print $product['ProductId']; ?>">
            <div class="photo">
            <img src="images/<?php print $product['ProductImage']; ?>"> </div> </a>
            <h4 class="product-name"><?php print $product['ProductName']; ?></h4>
            <h3 class="product-price">Price: <?php print $product['Price'] ?> € </h3>
            <button class="add-to-cart">Add to cart</button>  
          </div>
        <?php
              }
        ?>
    </div>
    <div class="products-button">
        <button  onclick="location.href='products.php'" type="button" class="button button5" >SEE ALL</button>
    </div>
    <br>
    <?php include "footer.html"; ?>
</div>
</div>
</body>
</html>