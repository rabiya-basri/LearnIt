<?php
require_once("../other/config.php");
require_once("../other/classess/User.php");
require_once("../other/classess/Comment.php");

if(isset($_POST['commentText']) && isset($_POST['postedBy']) && isset($_POST['videoId'])){
 
    $usernameLoggedInObj = new User($con, $_SESSION["userLoggedIn"]);

    $query = $con->prepare("INSERT INTO comments(postedBy, videoId, responseTo, body) 
                            VALUES(:postedBy, :videoId, :responseTo, :body)");
    $query->bindParam(":postedBy", $postedBy);
    $query->bindParam(":videoId", $videoId);
    $query->bindParam(":responseTo", $responseTo);
    $query->bindParam(":body", $commentText);

    $postedBy = $_POST['postedBy'];
    $videoId = $_POST['videoId'];
    $responseTo = isset($_POST['responseTo']) ? $_POST['responseTo'] : 0;
    $commentText = $_POST['commentText'];
    $query->execute();

    
    $newComment = new Comment($con, $con->lastInsertId(), $usernameLoggedInObj, $videoId);
    echo $newComment->create();
}
else{
    echo "one or more parameters are not passed in the subscriber.php file";
}
?>