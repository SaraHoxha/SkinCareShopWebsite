<?php
session_start();
require_once 'databaseconfig.php';

//add prod
if (isset($_POST['ProductId'], $_POST['QuantityAvailable']) && is_numeric($_POST['Product_Id']) && is_numeric($_POST['QuantityAvailable'])) {
    
    $productId = (int)$_POST['ProductId'];
    $quantityAvailable = (int)$_POST['QuantityAvailable'];
    $stmt = $pdo->prepare('SELECT * FROM product WHERE ProductId = ?');
    $stmt->execute([$_POST['ProductId']]);
    $productId = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($productId && $quantityAvailable > 0) {
       
        if (isset($_SESSION['Card']) && is_array($_SESSION['Card'])) {
            if (array_key_exists($productId, $_SESSION['Card'])) {
                $_SESSION['Card'][$productId] += $quantityAvailable;
            } else {
                $_SESSION['Card'][$productId] = $quantityAvailable;
            }
        } else {
            $_SESSION['Card'] = array($productId => $quantityAvailable);
        }
    }   
    header('location: home.php?page=cart');
    exit;
}
//remove prod
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['Card']) && isset($_SESSION['Card'][$_GET['remove']])) {
    unset($_SESSION['Card'][$_GET['remove']]);
}
//update quantity
if (isset($_POST['addToCartButton']) && isset($_SESSION['Card'])) {

    foreach ($_POST as $k => $v) {
        if (strpos($k, 'QuantityAvailable') !== false && is_numeric($v)) {
            $id = str_replace('QuantityAvailable-', '', $k);
            $quantityAvailable = (int)$v;
            if (is_numeric($id) && isset($_SESSION['Card'][$id]) && $quantityAvailable > 0) {               
                $_SESSION['Card'][$id] = $quantityAvailable;
            }
        }
    }
    header('location: home.php?page=cart');
    exit;
}
//handles the placing of the order
if (isset($_POST['orderdone']) && isset($_SESSION['Card']) && !empty($_SESSION['Card'])) {
    header('Location: home.php?page=orderdone');
    exit;
}
//get prod in card and select from db
$products_card = isset($_SESSION['Card']) ? $_SESSION['Card'] : array();
$product = array();
$subtotal = 0.00;

if ($products_cart) {
    $array_to_question_marks = implode(',', array_fill(0, count($products_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM product WHERE ProductId IN (' . $array_to_question_marks . ')');
    $stmt->execute(array_keys($products_cart));  
    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($product as $prod) {
        $subtotal += (float)$prod['Price'] * (int)$products_cart[$prod['ProductId']];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

        <div class="container">
            <?php include "header.php"; ?>
                <form action="home.php?page=Card" method="post">
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
            <?php if (empty($products)): ?>
                <tr>
                    <td colspan="4" style="text-align:center;">No products added in your Shopping Cart found</td>
                </tr>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                    <td class="images">
                        <a href="home.php?page=product&id=<?=$product['ProductId']?>">
                            <img src="images/<?=$product['ProductImage']?>" width="50" height="50" alt="<?=$product['ProductName']?>">
                        </a>
                    </td>
                    <td>
                        <a href="home.php?page=product&ProductId=<?=$product['ProductId']?>"><?=$product['ProductName']?></a>
                        <br>
                        <a href="home.php?page=card&remove=<?=$product['ProductId']?>" class="remove">Remove</a>
                    </td>
                    <td class="Price">&dollar;<?=$product['Price']?></td>
                    <td class="quantity">
                        <input type="number" name="QuantityAvailable-<?=$product['ProductId']?>" value="<?=$products_card[$product['ProductId']]?>" min="1" max="<?=$product['QuantityAvailable']?>" placeholder="QuantityAvailable" required>
                    </td>
                    <td class="Price">&dollar;<?=$product['Price'] * $products_card[$product['ProductId']]?></td>
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