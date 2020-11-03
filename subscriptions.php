<?php
require_once("other/header.php");

if(!User::isLoggedIn()){
    header("Location: signIn.php");
}

$subscriptionsProvider = new SubscriptionsProvider($con, $usernameLoggedInObj);
$videos = $subscriptionsProvider->getVideos();

$videoGrid = new VideoGrid($con,$usernameLoggedInObj);
?>
<div class="largeVideoGridContainer">
    <?php
        if(sizeof($videos) > 0){
            echo $videoGrid->createLarge($videos, "New Videos From Your Subscriptions", false);

        }
        else{
                echo "No videos to show";
        }
    ?>
</div>