<?php
    session_start();
    require_once 'databaseconfig.php';
    
/*function getCountProducts() {
    if (isset($_SESSION['GuestCarts'])) {
        return count($_SESSION['GuestCarts']);
    }
    else {
        return 0;
    } 
} */
    
    $productId = '';
    if (isset($_GET['Id'])) {
        $productId = $_GET['Id'];
    }
    
    $query = "SELECT * FROM `product` WHERE ProductId = '$productId'";

    if(mysqli_query($connection, $query)) {
        $result =  mysqli_query($connection, $query);
    }
        
    if (mysqli_num_rows($result) === 1) {
        $product = mysqli_fetch_array($result);
    }
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php print $product['ProductName'];?></title>
        <link href="styles/productdetail.css" rel="stylesheet">
    </head>

    <body>
            <?php include "header.php"; ?>
            <body>
    <div class="wrapper">
    <div class="product-img">
      <img src="images/<?php print $product['ProductImage'];?>" >
    </div>
    <div class="product-info">
      <div class="product-text">
        <h1><?php print $product['ProductName'];?></h1>
        <h2>By <?php print $product['ProductBrand'];?></h2>
        <div class="description">
        <?php print $product['ProductDescription'];?>
        </div>
      </div>
      <div class="extra-information">
      <div class="product-price">
        <p> Price: <?php print $product['Price'];?> € </p>
      </div>
      <div class="quantity">
            <p>Quantity available: <?php print $product['QuantityAvailable'];?> </p>
        </div>
    </div>
    </div>
    <form id="add-to-cart" action="shoppingcart.php" method="post">
         <div class="add-to-cart">
               <input type="hidden" name="productId" value="<?php print $productId; ?>">
                <input type="submit" value="Add To Cart" name="addToCartButton">
                <input type="number" value="1" min="1" name="productQuantity"> 
               </div>
     </form>
  </div>   
            <?php include 'footer.html'; ?>
    </body>
</html>