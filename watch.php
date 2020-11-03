<?php
require_once("other/header.php");
require_once("other/classess/VideoPlayer.php");
require_once("other/classess/VideoInfoSection.php");
require_once("other/classess/Comment.php");
require_once("other/classess/CommentSection.php");

if(!isset($_GET["id"])){
echo "No url passed into this page";
exit();
}

$video = new Video($con, $_GET["id"], $usernameLoggedInObj);
$video->incrementViews();
 
?>
<script src="jss/videoPlayerActions.js"></script>
<script src="jss/CommentActions.js"></script>

<div class="watchLeftColumn">
<?php
$videoPlayer = new VideoPlayer($video);
echo $videoPlayer->create(true);

$videoPlayer = new VideoInfoSection($con, $video, $usernameLoggedInObj);
echo $videoPlayer->create();

$commentSection = new CommentSection($con, $video, $usernameLoggedInObj);
echo $commentSection->create();
?>
</div>

<div class="suggestions">
<?php
$videoGrid = new VideoGrid($con, $usernameLoggedInObj);
echo $videoGrid->create(null, null, false);

?>

</div>

<?php 
require_once("other/footer.php");
?>










