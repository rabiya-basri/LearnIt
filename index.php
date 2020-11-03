/*LearnIt is an online learning platform for the programming enthusiastic to 
learn any programming language and explore there ideas and view through commenting on the video or making there own channel.
This project is build using php, javascript, and mysql */
<?php 
require_once("other/header.php");
?>

<div class="videoSection">
<?php

$subscriptionsProvider = new SubscriptionsProvider($con, $usernameLoggedInObj);
$subscriptionVideos = $subscriptionsProvider->getVideos();

$videoGrid = new VideoGrid($con, $usernameLoggedInObj->getUsername());
if(User::isLoggedIn() && sizeof($subscriptionVideos) > 0){
    echo $videoGrid->create($subscriptionVideos, "Subscriptions", false);
}

echo $videoGrid->create(null, "Recommended", false);
?>

</div>
<?php 
require_once("other/footer.php");

?>










