<?php
require_once("other/header.php");
require_once("other/classess/VideoPlayer.php");
require_once("other/classess/VideoDetailsFormProvider.php");
require_once("other/classess/VideoUploadData.php");
require_once("other/classess/SelectThumbnail.php");

if(!User::isLoggedIn()){
    header("Location: signIn.php");
}
if(!isset($_GET["videoId"])){
    echo "NO video selected";
    exit();
}

$video = new Video($con, $_GET["videoId"], $usernameLoggedInObj);
if($video->getUploadedBy() != $usernameLoggedInObj->getUsername()){
    echo "Not your video";
    exit();
}
$detailsMessage = "";
if(isset($_POST["saveButton"])){
    $videoData = new VideoUploadData(
        null,
        $_POST["TitleInput"],
        $_POST["DescriptionInput"],
        $_POST["privacyInput"],
        $_POST["categoryInput"],
        $usernameLoggedInObj->getUsername()
    );
    if($videoData->updateDetails($con, $video->getId())){
        $detailsMessage = "<div class='alert alert-success'>
                            <strong>SUCCESS!</strong>Details updated successfully
                            </div>";
        $video = new Video($con, $_GET["videoId"], $usernameLoggedInObj);
        }
        else{
            $detailsMessage = "<div class='alert alert-danger'>
            <strong>ERROR!</strong>Something went wrong
            </div>";
        }
    }

?>

<script src="jss/editVideoActions.js">

</script>
<div class="editVideoContainer column">
<div class="message">
<?php
echo $detailsMessage ?>
</div>
    <div class="topSection">
        <?php
        $videoPlayer = new VideoPlayer($video);
        echo $videoPlayer->create(false);

        $selectThumbnail = new SelectThumbnail($con, $video);
        echo $selectThumbnail->create();
        ?>
    </div>
        <div class="bottomSection">
        <?php
        $formProvider = new VideoDetailsFormProvider($con);
        echo $formProvider->createEditDetailsForm($video);
        ?>
        </div>
</div>