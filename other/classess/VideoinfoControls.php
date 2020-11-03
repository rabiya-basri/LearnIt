<?php
require_once("other/classess/ButtonProvider.php");
class VideoinfoControls{
    private $video, $usernameLoggedInObj;
    public function __construct($video, $usernameLoggedInObj){
       
        $this->video = $video;
        $this->usernameLoggedInObj = $usernameLoggedInObj;
    }
    public function create(){
        $likeButton = $this->createLikeButton();
        $dislikeButton = $this->createDislikeButton();

        return "<div class='controls'>
        $likeButton
        $dislikeButton
        </div>
        ";
    }
    private function createLikeButton(){
        $text = $this->video->getLikes();
        $videoId = $this->video->getId();
        $action = "likeVideo(this, $videoId)";
        $class = "likeButton";
        $imgSrc = "images/thumb-up.png";

        //change button image if video is already liked
        if($this->video->wasLikedBy()){
            $imgSrc = "images/thumb-up-active.png";
        }

        return ButtonProvider::createButton($text, $imgSrc, $action, $class);
    }
    private function createDislikeButton(){
        $text = $this->video->getDisLikes();
        $videoId = $this->video->getId();
        $action = "dislikeVideo(this, $videoId)";
        $class = "dislikeButton";
        $imgSrc = "images/thumb-down.png";

        //change button image if video is already liked
        if($this->video->wasDislikedBy()){
            $imgSrc = "images/thumb-down-active.png";
        }


        return ButtonProvider::createButton($text, $imgSrc, $action, $class);
    }
}

?>