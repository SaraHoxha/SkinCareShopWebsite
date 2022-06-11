<?php

session_start();
require_once 'databaseconfig.php';


$currentUser = '';
if (isset($_SESSION['UserID'])) {
    $userId = $_SESSION['UserID'];
    $query = "SELECT * FROM `customer` WHERE CustomerId = '$userId'";
    
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) === 1) {
        $currentUser = mysqli_fetch_array($result);
    } else {
        return '';
    }
}

function deleteItem($productId) {
    unset($_SESSION['Cart'][$productId]);
}

function clearCart() {
    unset($_SESSION['Cart']);
}


$productId = '';
$productQuantity = 0;
$cartItems = array();
if (isset($_POST['productQuantity'])) {
    $productId = $_POST['productId'];
    $productQuantity = $_POST['productQuantity'];
    
    if (!isset($cartItems[$productId])) {
        $cartItems[$productId] = intval($productQuantity);
    } else {
        $cartItems[$productId] += intval($productQuantity);
    }
    
    
    $_SESSION['Cart'] = $cartProducts;
}

if (isset($_SESSION['Cart'])) {
    $cartItems = $_SESSION['Cart'];

    if (isset($_GET['remove'])) {
        deleteItem($_GET['remove']);
    }
}


$subtotal = 0.00;
if (isset($_SESSION['Cart'])) {
        $cartItems = $_SESSION['Cart'];
        foreach ($cartItems as $itemId => $itemQuantity) {
         $query = "SELECT * FROM `orderitem` WHERE Id = '$itemId'";
         $result = mysqli_query($connection, $query);

         if (mysqli_num_rows($result) === 1) {
             $orderItem = mysqli_fetch_array($result);
             $subtotal += floatval($orderItem['Price']) * floatval($itemQuantity);
          }
            } 
}


define('NOT_DONE', 0);
define('SUCCESSFUL', 1);
define('UNSUCESSFUL', 2);
define('EMPTY', 3);

$orderResult = NOT_DONE;


if (isset($_POST['addToCartButton'])) {
    if (count($_SESSION['GuestCarts']) > 0) 
    {
        if (isset($_SESSION['UserID'])) 
        {
            $userId = $currentUser['CustomerId'];

            $query =  "INSERT INTO `customerorder` (`OrderDate`, `OrderStatus`, `CustomerId`) VALUES (CURRENT_TIME(), 'Processing', '$userId')";

            if (mysqli_query($connection, $query)) {

                $query = "SELECT Id FROM `customerorder` WHERE CustomerId='$userId' AND OrderStatus = 'Processing' LIMIT 1";
                $result = mysqli_fetch_array(mysqli_query($connection, $query));

                $orderId = $result['OrderId'];

                foreach ($cartItems as $itemId => $itemQuantity) {
                    $sql = "SELECT * FROM `orderitem` WHERE Id = '$itemId'";
                    $result = mysqli_query($connection, $sql);

                    if (mysqli_num_rows($result) === 1) {
                        $orderItem = mysqli_fetch_array($result);
                      }

                    $itemId = intval($orderItem['Id']);
                    $itemQuantity = intval($itemQuantity);

                    $sql = "INSERT INTO `orderitem` (`OrderId`, `ProductId`, `QuantityOrdered`) VALUES ($orderId, $itemId, $itemQuantity)";
                    mysqli_query($connection, $sql);
                }

                clearCart();
                $orderResult = SUCCESSFUL;
                header("Location: orderdone.php");
            }

            else { 
                $orderResult = UNSUCCESSFUL;
            }

        }
    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

        <div class="container">
            <?php include "header.php"; ?>
                <form action="" method="post">
                <table>
                <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price of Item</td>
                    <td>Quantity Available</td>
                    <td>Total to pay</td>
                </tr>
            </thead>
            <tbody>
            <?php if (count($cartItems) == 0): ?>
                <tr>
                    <td colspan="4" style="text-align:center;">No products added in your Shopping Cart found</td>
                </tr>
                <?php else: ?>
                <?php foreach ($cartItems as $product): ?>
                    <tr>
                    <td class="images">
                        <a href="productdetail.php?Id=<?=$product['ProductId']?>">
                            <img src="images/<?=$product['ProductImage']?>" width="50" height="50" alt="<?=$product['ProductName']?>">
                        </a>
                    </td>
                    <td>
                        <a href="productdetail.php?Id=<?=$product['ProductId']?>"><?=$product['ProductName']?></a>
                        <br>
                        <a href="shoppingcart.php?remove=<?=$product['ProductId']?>" class="remove">Remove</a>
                    </td>
                    <td class="Price">&dollar;<?=$product['Price']?></td>
                    <td class="quantity">
                        <input type="number" name="Quantity-<?=$product['ProductId']?>" value="<?=$cartItems[$product['ProductId']]?>" min="1" max="<?=$product['QuantityAvailable']?>" placeholder="Quantity" disabled>
                    </td>
                    <td class="Price">&dollar;<?=$product['Price'] * $cartItems[$product['ProductId']]?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="Text">Subtotal</span>
            <span class="Price">&dollar;<?=$subtotal?></span>
        </div>
        <div class="buttons">
            <input type="submit" value="Update" name="addToCartButton">
            <input type="submit" value="Place Order" name="orderdone">
</div>
</form>
</div>
</div>
</body>
</html>
<?php include "footer.html"; ?>