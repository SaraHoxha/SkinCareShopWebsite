<?php

session_start();
require_once 'databaseconfig.php';

define('NOT_DONE', 0);
define('SUCCESSFUL_ORDER', 1);
define('UNSUCESSFUL_ORDER', 2);
define('EMPTY', 3);
$orderResult = NOT_DONE;

if (isset($_SESSION['Cart'])) {
    $cartItems = $_SESSION['Cart'];

    if (isset($_GET['remove'])) {
        removeItem($_GET['remove']);
    }
}


$productId = '';
$productQuantity = 0;
//add items to cart
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $productQuantity = $_POST['productQuantity'];

    if (!isset($cartItems[$productId])) {
        $cartItems[$productId] = $productQuantity;
    } else {
        $cartItems[$productId] = $cartItems[$productId] + $productQuantity;
    }


    $_SESSION['Cart'] = $cartItems;
}


// get current user who's ordering
$currentUser = '';
if (isset($_SESSION['UserID'])) {
    $userId = $_SESSION['UserID'];
    $query = "SELECT * FROM `customer` WHERE CustomerId = '$userId'";

    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) === 1) {
        $currentUser = mysqli_fetch_array($result);
    }
} else {
    header('Location: login.php');
}


//remove item
function removeItem($productId)
{
    unset($_SESSION['Cart'][$productId]);
}

//clear cart
function clearCart()
{
    unset($_SESSION['Cart']);
}

//initialize total to 0.00
$total = 0.00;

//process order when user submits form
if (isset($_POST['OrderButton'])) {

    if (count($_SESSION['Cart']) > 0) {
        if (isset($_SESSION['UserID']) &&  $_SESSION['UserID'] !== '') {

            $userId = $_SESSION['UserID'];

            $currentDate = date("Y-m-d");

            //insert order into db
            $query =  "INSERT INTO `customerorder` (`OrderDate`, `OrderStatus`, `CustomerId`) VALUES ('$currentDate', 'Processing', $userId)";

            $queryResult = mysqli_query($connection, $query);

            if ($queryResult) {

                $query = "SELECT * FROM `customerorder` WHERE CustomerId = '$userId' AND OrderStatus = 'Processing' LIMIT 1";
                $costumerorder = mysqli_fetch_array(mysqli_query($connection, $query));

                $orderId = $costumerorder['OrderId'];

                //for each product in order, create an orderitem row in db
                foreach ($cartItems as $itemId => $itemQuantity) {
                    $sql = "SELECT * FROM `product` WHERE ProductId = '$itemId' LIMIT 1";
                    $result = mysqli_query($connection, $sql);
                    $product = mysqli_fetch_array($result);

                    $query = "INSERT INTO `orderitem` (`OrderId`, `ProductId`, `QuantityOrdered`) VALUES ('$orderId', '$itemId', '$itemQuantity')";
                    mysqli_query($connection, $query);

                    //update quantity of product after order has been done
                    $newQuantity = $product['QuantityAvailable'] - $itemQuantity;

                    $sql = "UPDATE `product` SET QuantityAvailable = $newQuantity WHERE ProductId = '$itemId'";
                    mysqli_query($connection, $sql);
                }

                clearCart();
                $orderResult = SUCCESSFUL_ORDER;
                header("Location: orderdone.php");
            } else {
                $orderResult = UNSUCESSFUL_ORDER;
            }
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
    <h5>Shopping Cart</h5>
        <?php if (!isset($_SESSION['Cart']) || count($_SESSION['Cart']) == 0 ) { ?>
            <div class="empty-cart">
                Your cart is empty. 
                <p><a class="shop"href="products.php"> Shop now</a><p>
            </div>
        <?php } else { ?>
            <table>
                <thead>
                    <tr class="header-row">
                        <td colspan="2">Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Subtotal</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $items = $_SESSION['Cart'];
                    foreach ($items as $itemId => $itemQuantity) {

                        $query = "SELECT * FROM `product` WHERE  ProductId = '$itemId'";
                        $result = mysqli_query($connection, $query);

                        if (mysqli_num_rows($result) === 1) {
                            $product = mysqli_fetch_array($result);
                        }

                        $total += $product['Price'] * $itemQuantity;
                    ?>
                        <tr>
                            <td class="image">
                                <a href="productdetail.php?Id=<?php print $product['ProductId'] ?>">
                                    <img src="images/<?php print $product['ProductImage'] ?>" width="150" height="150">
                                </a>
                            </td>
                            <td>
                                <a class="product-link" href="productdetail.php?Id=<?php print $product['ProductId'] ?>"><?php print $product['ProductName'] ?></a>
                            </td>
                            <td class="Price">&euro;<?php print $product['Price'] ?></td>
                            <td class="quantity">
                                <?php print $itemQuantity ?>
                            </td>
                            <td class="Subtotal">&euro;<?php print $product['Price'] * $itemQuantity ?></td>
                            <td>
                                <a href="shoppingcart.php?remove=<?php print $product['ProductId'] ?>" class="remove-link">Remove</a>
                            </td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
            <div class="Total">
                <span class="Text">Total</span>
                <span class="Price">&euro;<?php print $total ?></span>
            </div>
            <form action="" method="post" id="submit-order-form">
                <div class="button">
                    <input type="submit" value="Place Order" name="OrderButton" >
                </div>
            </form>
            <?php } ?>
    </div>
    <?php include "footer.html"; ?>
</body>
</html>