<?php
    session_start();
    require_once 'databaseconfig.php';
    
    define('NOT_LOGGED', 0);
    define('SUCCESSFUL_LOGIN', 1);
    define('UNSUCCESSFUL_LOGIN', 2);
   
    $logStatus = NOT_LOGGED; 
    
     if (isset($_SESSION['UserID']) && $_SESSION['UserID']!='') {
        header("Location: home.php");
    } 
    else {
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

                $logStatus = SUCCESSFUL_LOGIN;
                header("Location: home.php");
            }
            else {
                $logStatus = UNSUCCESSFUL_LOGIN;
            }
        } 
    } 
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="styles/loginstyle.css" rel="stylesheet">
        <script src="assets/js/jquery.js"></script>
    </head>
    <body>
        <?php include "header.html"; ?>
        
        <div class="login-container">
        <div class="login-form">
	<div class="left-column">
		<div class="overlay">
		<h1>Welcome back</h1>
		</div>
	</div>
	
		<div class="right-column">
		<h5>Login</h5>
		<p>New here? <a href="#">Register</a> right now!</p>
        <form id="login-form" action="" method="post">
		<div class="inputs">
			<input type="text" name="UserUsername" placeholder="Username" required>
			<br>
			<input type="password" name="UserPassword" placeholder="Password" required>
		</div>
        <?php
            if ($logStatus == UNSUCCESSFUL_LOGIN) {  ?>
            <span class="error">Invalid username or password, please try again.</span>
        <?php   }  ?>
        <br><br>
        <button>Login</button>
        </form>
        </div>	
     </div>
    <?php include "footer.html"; ?>
</body>
</html>