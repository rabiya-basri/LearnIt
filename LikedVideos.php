<?php
require_once("other/header.php");
require_once("other/classess/LikedVideosProvider.php");

if(!User::isLoggedIn()){
    header("Location: signIn.php");
}

$likedVideosProvider = new LikedVideosProvider($con, $usernameLoggedInObj);
$videos = $likedVideosProvider->getVideos();

$videoGrid = new VideoGrid($con,$usernameLoggedInObj);
?>
<div class="largeVideoGridContainer">
    <?php
        if(sizeof($videos) > 0){
            echo $videoGrid->createLarge($videos, "Videos that you have liked", false);

        }
        else{
                echo "No videos to show";
        }
    ?>
</div>