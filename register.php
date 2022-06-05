<?php
    session_start();
    require_once 'databaseconfig.php';
    
    define('NOT_REGISTERED', 0);
    define('SUCCESSFUL_REGISTERED', 1);
    define('UNSUCCESSFUL_REGISTERED', 2);
   
    $logStatus = NOT_REGISTERED;

    function console_log($data, $add_script_tags = false) {
        $command = 'console.log('. json_encode($data, JSON_HEX_TAG).');';
        if ($add_script_tags) {
            $command = '<script>'. $command . '</script>';
        }
        echo $command;
    }

    
    
     if (isset($_SESSION['UserID']) && $_SESSION['UserID']!='') {
        header("Location: home.php");
    } 
    else {
        $firstName ='';
        $lastName ='';
        $email ='';
        $address ='';
        $postalCode ='';
        $cardID ='';
        $username = '';
        $password = '';
 
        if (isset($_POST['UserUsername'])) {
            $firstName = $_POST['UserFName'];
            $lastName = $_POST['UserLName'];
            $email = $_POST['UserEmail'];
            $address = $_POST['UserAddress'];
            $postalCode =$_POST['UserPostalCode'];
            $cardID = $_POST['UserPersonalID'];
            $username = $_POST['UserUsername'];
            $password = $_POST['UserPassword'];
            
            $query = "INSERT INTO `customer` (FirstName, LastName, Email, Address, PostalCode, PersonalCardId, Username, Passwrd)  VALUES('$firstName', '$lastName', '$email', '$address', '$postalCode', '$cardID', '$username', '$password')";

            $result = mysqli_query($connection, $query);

            if ($result) {
                $sql = "SELECT * FROM `customer` WHERE Email = '$email'";
                $rows = mysqli_fetch_array($mysqli_query($connection, $sql));

                $_SESSION['UserID'] = $rows['CustomerId'];
                $_SESSION['Username'] = $rows['Username'];
                $_SESSION['Email'] = $rows['Email'];
                $_SESSION['Name'] = $rows['FirstName'];

                $logStatus = SUCCESSFUL_REGISTERED;
                header("Location: home.php");
            }
            else {
                $logStatus = UNSUCCESSFUL_REGISTERED;
                echo mysqli_error($connection);
            }
        } 
    } 
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="styles/loginstyle.css" rel="stylesheet">
        <link href="styles/registerstyle.css" rel="stylesheet">
    </head>
    <body>
        <?php include "header.html"; ?>
        
        <div class="register-container">
        <div class="register-form"> 
         <form  class="row" id="register-form" action="" method="POST">
         <h5>Register</h5>
         <div class= "right-column column">
         
        <div class="inputs">
			<input type="text" name="UserFName" placeholder="First Name" required>
			<br>
			<input type="text" name="UserLName" placeholder="Last Name" required>
            <br>
			<input type="email" name="UserEmail" placeholder="Email" required>
		</div>
	</div>
    <div class= "right-column column">
        <div class="inputs">
			<input type="text" name="UserAddress" placeholder="Address" required>
			<br>
			<input type="text" name="UserPostalCode" placeholder="Postal Code" required>
            <br>
			<input type="text" name="UserPersonalID" placeholder="Card ID Number" required>
		</div>
	</div>
		<div class="right-column column">
		<div class="inputs">
			<input type="text" name="UserUsername" placeholder="Username" required>
			<br>
			<input type="password" name="UserPassword" placeholder="Password" required>
		</div>
        <?php
            if ($logStatus == UNSUCCESSFUL_REGISTERED) {  ?>
            <span class="error">There was a problem with your registration, please try again.</span>
        <?php   }  ?>
        <br><br>
        <br><br>
        <button>Register</button>
        </div>
        </form>
        </div>	
     </div>
    <?php include "footer.html"; ?>
</body>
</html>