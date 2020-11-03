<?php 

require_once("other/config.php");
require_once("other/classess/Account.php");
require_once("other/classess/Constants.php");
require_once("other/classess/FormSanitizer.php");


$account = new Account($con);

if(isset($_POST["submitButton"])){
   $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
   $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

   $wasSuccessful = $account->login($username, $password);

    if($wasSuccessful){
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
    }
}
function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
    }
?>
<!DOCTYPE html>
<html>
<head><title>golearn</title>
<meta charset=utf-8>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="assest/style1.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</head>
<body>

<div class="signinContainer">
    <div class="column">
        <div class="header">
            <img src="images/logo3.png" title="logo" alt="site logo">
            <h3>Sign In</h3>
            <span>To Continue to learning</span>
        </div>
        
        <div class="loginForm">
        <form action="signIn.php" method="POST">
        <?php echo $account->getError(Constants::$loginFailed);?>
        <input type="text" name="username" placeholder="UserName" value="<?php getInputValue('username'); ?>" required autocomplete="off">
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" name="submitButton" value="SUBMIT">    
    </form>
        </div>
        <a class="signInMessage" href="signUp.php">Need an account? Sign Up here!</a>
    </div>
</div>
</body>
</html>