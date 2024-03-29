<?php
session_start();
require_once 'databaseconfig.php';

define('NOT_AUTHENTICATED', 0);
define('SUCCESSFUL_LOGIN', 1);
define('UNSUCCESSFUL_LOGIN', 3);

$_SESSION['logStatus'] = NOT_AUTHENTICATED;

if (isset($_SESSION['UserID']) && $_SESSION['UserID'] != '') {
    header("Location: home.php");
} else {
    // process user information
    $username = '';
    $password = '';

    if (isset($_POST['UserUsername'])) {
        $username = $_POST['UserUsername'];
        $password = $_POST['UserPassword'];

        $query = "SELECT * FROM `customer` WHERE Username = '$username' AND Passwrd = '$password'";

        $result = mysqli_query($connection, $query);
        $rows = mysqli_fetch_array($result);

        if (mysqli_num_rows($result) == 1) {

            $_SESSION['UserID'] = $rows['CustomerId'];
            $_SESSION['Username'] = $rows['Username'];
            $_SESSION['Email'] = $rows['Email'];
            $_SESSION['Name'] = $rows['FirstName'];

            $_SESSION['logStatus'] = SUCCESSFUL_LOGIN;
            header("Location: home.php");
        } else {
            $_SESSION['logStatus'] = UNSUCCESSFUL_LOGIN;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link href="styles/loginstyle.css" rel="stylesheet">
</head>

<body>
    <?php include "header.php"; ?>

    <div class="login-container">
        <div class="login-form">
            <div class="left-column">
                <div class="overlay">
                    <h1>Welcome back</h1>
                </div>
            </div>

            <div class="right-column">
                <h5>Login</h5>
                <!-- redirect to register page -->
                <p>New here? <a href="register.php">Register</a> right now!</p>
                <form id="login-form" action="" method="post">
                    <div class="inputs">
                        <br>
                        <input type="text" name="UserUsername" placeholder="Username" required>
                        <br>
                        <input type="password" name="UserPassword" placeholder="Password" required>
                    </div>
                    <?php
                    if (
                        $_SESSION['logStatus'] == UNSUCCESSFUL_LOGIN
                    ) {  ?>
                        <span class="error">Invalid username or password, please try again.</span>
                    <?php   }  ?>
                    <br><br>
                    <button class="login-button">Login</button>
                </form>
            </div>
        </div>
        <?php include "footer.html"; ?>
</body>

</html>