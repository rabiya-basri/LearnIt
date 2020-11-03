<?php
require_once("../other/config.php");
require_once("../other/classess/Video.php");
require_once("../other/classess/User.php");


$usename = $_SESSION["userLoggedIn"];
 $videoId = $_POST["videoId"];

 $usernameLoggedInObj = new User($con, $usename);
 $video = new Video($con, $videoId, $usernameLoggedInObj);
 echo $video->like();
?>