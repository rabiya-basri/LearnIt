<?php
require_once("other/header.php");
require_once("other/classess/ProfileGenerator.php");

if(isset($_GET["username"])){
    $profileUsername = $_GET["username"];
}
else{
    echo "Channel not found";
    exit();
}

$profileGenerator = new ProfileGenerator($con, $usernameLoggedInObj, $profileUsername);
echo $profileGenerator->create();
?>