<?php
require_once("other/header.php");
require_once("other/classess/SearchResultProvider.php");

if(!isset($_GET["term"]) || $_GET["term"] == ""){
    echo "You must enter a search term";
    exit();
}
$term = $_GET["term"];
if(!isset($_GET["orderBy"]) || $_GET["orderBy"] == "views"){
    $orderBy = "views";
}
else{
    $orderBy = "uploadDate";
}

$searchResultProvider = new SearchResultProvider($con, $usernameLoggedInObj);
$videos = $searchResultProvider->getVideos($term, $orderBy);

$videoGrid = new VideoGrid($con, $usernameLoggedInObj);
?>
<div class="largeVideoGridContainer">
<?php
if(sizeof($videos) > 0){
    echo $videoGrid->createLarge($videos, sizeof($videos) . " results found", true);
}
else{
    echo "No results found";
}
?>

</div>







<?php
require_once("other/footer.php");
?>

