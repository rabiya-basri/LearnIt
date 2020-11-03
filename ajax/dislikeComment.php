<?php
require_once("../other/config.php");
require_once("../other/classess/Comment.php");
require_once("../other/classess/User.php");


$usename = $_SESSION["userLoggedIn"];
 $videoId = $_POST["videoId"];
 $commentId = $_POST["commentId"];

 $usernameLoggedInObj = new User($con, $usename);
 $comment = new Comment($con, $commentId, $usernameLoggedInObj, $videoId);
 echo $comment->dislike();
?>