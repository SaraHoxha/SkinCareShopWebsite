<?php
session_start();
require_once 'databaseconfig.php';

define('NOT_REGISTERED', 0);
define('SUCCESSFUL_REGISTRATION', 1);
define('UNSUCCESSFUL_REGISTRATION', 2);

$_SESSION['logStatus'] == NOT_REGISTERED;

if (isset($_SESSION['UserID']) && $_SESSION['UserID'] != '') {
    header("Location: home.php");
} else {
    //process new user info
    $firstName = '';
    $lastName = '';
    $email = '';
    $address = '';
    $postalCode = '';
    $cardID = '';
    $username = '';
    $password = '';

    if (isset($_POST['UserUsername'])) {

        $firstName = $_POST['UserFName'];
        $lastName = $_POST['UserLName'];
        $email = $_POST['UserEmail'];
        $address = $_POST['UserAddress'];
        $postalCode = $_POST['UserPostalCode'];
        $cardNumber = $_POST['UserCardNumber'];
        $username = $_POST['UserUsername'];
        $password = $_POST['UserPassword'];

        $query = "INSERT INTO `customer` (`FirstName`, `LastName`, `Email`, `Address`, `PostalCode`, `CardNumber`, `Username`, `Passwrd`)  VALUES ('$firstName', '$lastName', '$email', '$address', '$postalCode', '$cardNumber', '$username', '$password')";

        if (mysqli_query($connection, $query)) {

            $sql = "SELECT * FROM `customer` WHERE Email = '$email'";
            $rows = mysqli_fetch_array(mysqli_query($connection, $sql));

            if (mysqli_num_rows(mysqli_query($connection, $sql)) == 1) {

                $_SESSION['UserID'] = $rows['CustomerId'];
                $_SESSION['Username'] = $rows['Username'];
                $_SESSION['Email'] = $rows['Email'];
                $_SESSION['Name'] = $rows['FirstName'];

                $_SESSION['logStatus'] = SUCCESSFUL_REGISTRATION
            ;
                header("Location: home.php");
            }
        } else {
            $_SESSION['logStatus'] = UNSUCCESSFUL_REGISTRATION
        ;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <link href="styles/loginstyle.css" rel="stylesheet">
    <link href="styles/registerstyle.css" rel="stylesheet">
</head>

<body>
    <?php include "header.php"; ?>

    <div class="register-container">
        <div class="register-form">
            <form class="row" id="register-form" action="" method="POST">
                <h5>Register</h5>
                <div class="right-column column">

                    <div class="inputs">
                        <input type="text" name="UserFName" placeholder="First Name" required>
                        <br>
                        <input type="text" name="UserLName" placeholder="Last Name" required>
                        <br>
                        <input type="email" name="UserEmail" placeholder="Email" required>
                    </div>
                </div>
                <div class="right-column column">
                    <div class="inputs">
                        <input type="text" name="UserAddress" placeholder="Address" required>
                        <br>
                        <input type="number" name="UserPostalCode" placeholder="Postal Code" required>
                        <br>
                        <input type="number" name="UserCardNumber" placeholder="Card Number" required>
                    </div>
                </div>
                <div class="right-column column">
                    <div class="inputs">
                        <input type="text" name="UserUsername" placeholder="Username" required>
                        <br>
                        <input type="password" name="UserPassword" placeholder="Password" required>
                    </div>
                    <?php
                    if ($_SESSION['logStatus'] == UNSUCCESSFUL_REGISTRATION
                ) {  ?>
                        <span class="error">There was a problem with your registration, please try again.</span>
                    <?php   }  ?>
                    <br><br>
                    <br><br>
                    <button class="register-button">Register</button>
                </div>
            </form>
        </div>
    </div>
    <?php include "footer.html"; ?>
</body>

</html>