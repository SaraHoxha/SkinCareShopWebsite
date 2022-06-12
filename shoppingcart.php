<?php

session_start();
require_once 'databaseconfig.php';


if (isset($_SESSION['Cart'])) {
    $cartItems = $_SESSION['Cart'];

    if (isset($_GET['remove'])) {
        removeItem($_GET['remove']);
    }
}


$productId = '';
$productQuantity = 0;
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $productQuantity = $_POST['productQuantity'];
    
    if (!isset($cartItems[$productId])) {
        $cartItems[$productId] = intval($productQuantity);
    } else {
        $cartItems[$productId] = $cartItems[$productId] + intval($productQuantity);
    }
    
    
    $_SESSION['Cart'] = $cartItems;
}


$currentUser = '';
if (isset($_SESSION['UserID'])) {
    $userId = $_SESSION['UserID'];
    $query = "SELECT * FROM `customer` WHERE CustomerId = '$userId'";
    
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) === 1) {
        $currentUser = mysqli_fetch_array($result);
    }
}
else {
    header('Location: login.php');
}


function removeItem($productId) {
    unset($_SESSION['Cart'][$productId]);
}

function clearCart() {
    unset($_SESSION['Cart']);
}



$total = 0.00;


define('NOT_DONE', 0);
define('SUCCESSFUL', 1);
define('UNSUCESSFUL', 2);
define('EMPTY', 3);

$orderResult = NOT_DONE;


if (isset($_POST['OrderButton'])) {
    
    if (count($_SESSION['Cart']) > 0) 
    {
        if (isset($_SESSION['UserID'])) 
        {
        
          $userId = $_SESSION['UserID'];

           // $currentDate = date("Y-m-d");
           
          $query =  "INSERT INTO `customerorder` (`CustomerId`) VALUES ($userId)";
         
          $queryResult = mysqli_query($connection, $query);
                  /*

           if ($queryResult) {

                $query = "SELECT Id FROM `customerorder` WHERE CustomerId='$userId' AND OrderStatus = 'Processing' LIMIT 1";
                $result = mysqli_fetch_array(mysqli_query($connection, $query));

                $orderId = $result['OrderId'];

                foreach ($cartItems as $itemId => $itemQuantity) {
                    $sql = "SELECT * FROM `product` WHERE ProductId = '$itemId'";
                    $result = mysqli_query($connection, $sql);

                    if (mysqli_num_rows($result) === 1) {
                        $product = mysqli_fetch_array($result);
                      }

                    $itemId = intval($product['Id']);
                    $itemQuantity = intval($itemQuantity);

                    $query = "INSERT INTO `orderitem` (`OrderId`, `ProductId`, `QuantityOrdered`) VALUES ('$orderId', '$itemId', '$itemQuantity')";
                    mysqli_query($connection, $query);

                    $newQuantity = $product['QuantityAvailable'] - $itemQuantity;

                    $sql = "UPDATE 'product SET 'QuantityAvailable' = '$newQuantity' WHERE 'ProductId' = '$itemId'";
                    mysqli_query($connection, $sql);
                }

                clearCart();
                $orderResult = SUCCESSFUL;
                header("Location: orderdone.php");
            }

            else { 
                $orderResult = UNSUCCESSFUL;
            }      
*/
        
        }
    }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/cartstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
        <?php include "header.php"; ?>
        <div class="container">
           
        <?php if (count($_SESSION['Cart']) == 0) {?>
                <div class="empty-cart">
                    Your cart is empty. <a href="products.php"> Shop now </a>
                </div> 
                <?php } else { ?>
                <table>
                <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>       
                </tr>
            </thead>
            <tbody>
            <?php
                    $products = $_SESSION['Cart'];
                foreach ($products as $itemId => $itemQuantity) {
                        
                        $query = "SELECT * FROM `product` WHERE  ProductId = '$itemId'";
                        $result = mysqli_query($connection, $query);
               
                        if (mysqli_num_rows($result) === 1) {
                            $product = mysqli_fetch_array($result); }

                            $total += $product['Price'] * $itemQuantity;
                    ?>
                    <tr>
                    <td class="image">
                        <a href="productdetail.php?Id=<?php print $product['ProductId']?>">
                            <img src="images/<?php print $product['ProductImage']?>" width="100" height="100">
                        </a>
                    </td>
                    <td>
                        <a href="productdetail.php?Id=<?php print $product['ProductId']?>"><?=$product['ProductName']?></a>
                    </td>
                    <td class="Price">&dollar;<?php print $product['Price']?></td>
                    <td class="quantity">
                        <?php print $itemQuantity ?>
                    </td>
                    <td class="Price">&dollar;<?php print $product['Price'] * $itemQuantity?></td>
                    <td>
                        <a href="shoppingcart.php?remove=<?php print $product['ProductId']?>" class="remove">Remove</a>
                    </td>
                </tr>
                <?php  } ?>
            </tbody>
        </table>
        <div class="Total">
            <span class="Text">Total</span>
            <span class="Price">&dollar;<?php print $total ?></span>
        </div>
        <form action="orderdone.php" method="post" id="submit-order-form">
        <div class="button">
            <input type="submit" value="Place Order" name="OrderButton">
            </div>
        </form>
<?php } ?>
</div>
</div>
<?php include "footer.html"; ?>
</body>
</html>
