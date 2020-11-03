<?php
require_once("other/header.php");
require_once("other/classess/TrendingProvider.php");

$trendingProvider = new TrendingProvider($con, $usernameLoggedInObj);
$videos = $trendingProvider->getVideos();

$videoGrid = new VideoGrid($con,$usernameLoggedInObj);
?>
<div class="largeVideoGridContainer">
    <?php
        if(sizeof($videos) > 0){
            echo $videoGrid->createLarge($videos, "Trending videos uploaded last week", false);

        }
        else{
                echo "No trending videos to show";
        }
    ?>
</div>