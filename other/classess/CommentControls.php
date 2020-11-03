<?php
require_once("ButtonProvider.php");
class CommentControls{
    private $con, $comment, $usernameLoggedInObj;
    public function __construct($con, $comment, $usernameLoggedInObj){
       
        $this->con = $con;
        $this->comment = $comment;
        $this->usernameLoggedInObj = $usernameLoggedInObj;
    }
    public function create(){
        $replyButton = $this->createReplyButton();
        $likesCount = $this->createLikesCount();
        $likeButton = $this->createLikeButton();
        $dislikeButton = $this->createDislikeButton();
        $replySection = $this->createReplySection();

        return "<div class='controls' style='margin-left:64px'>
        $replyButton
        $likesCount
        $likeButton
        $dislikeButton
        </div>
        $replySection";
    }
    private function createReplyButton(){
        $text = "REPLY";
        $action = "toggleReply(this)";
        
        return ButtonProvider::createButton($text, null, $action, null);
    }
    private function createLikesCount(){
        $text = $this->comment->getLikes();
        if($text == 0) $text = "";
        return "<span class='likesCount'>$text</span>";
    }
    private function createReplySection(){
        $postedBy = $this->usernameLoggedInObj->getUsername();
        $videoId = $this->comment->getVideoId();
        $commentId = $this->comment->getId();

        $profileButton = ButtonProvider::createUserProfileButton($this->con, $postedBy);

        $cancelButtonAction = "toggleReply(this)";
        $cancelButton = ButtonProvider::createButton("Cancel", null, $cancelButtonAction, "cancelComment");
    
        $postButtonAction = "postComment(this, \"$postedBy\", $videoId, $commentId, \"repliesSection\")";
        $postButton = ButtonProvider::createButton("Reply", null, $postButtonAction, "postComment");
    
    //get the comments
            return " <div class='commentForm hidden'  style='display:flex'>
                        $profileButton
                         <textarea class='commentBodyClass' placeholder='Add comments'></textarea>
                         $cancelButton
                         $postButton
                    </div>";
    }

    private function createLikeButton(){
        $commentId = $this->comment->getId();
        $videoId = $this->comment->getVideoId();
        $action = "likeComment($commentId,this, $videoId)";
        $class = "likeButton";
        $imgSrc = "images/thumb-up.png";

        //change button image if video is already liked
        if($this->comment->wasLikedBy()){
            $imgSrc = "images/thumb-up-active.png";
        }

        return ButtonProvider::createButton("", $imgSrc, $action, $class);
    }
    private function createDislikeButton(){
        $commentId = $this->comment->getId();
        $videoId = $this->comment->getVideoId();
        $action = "dislikeComment($commentId, this, $videoId)";
        $class = "dislikeButton";
        $imgSrc = "images/thumb-down.png";

        //change button image if video is already liked
        if($this->comment->wasDislikedBy()){
            $imgSrc = "images/thumb-down-active.png";
        }


        return ButtonProvider::createButton("", $imgSrc, $action, $class);
    }
}

?>