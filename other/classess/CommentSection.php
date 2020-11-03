<?php
class CommentSection{
    private $con, $video, $usernameLoggedInObj;
    public function __construct($con, $video, $usernameLoggedInObj){
        $this->con = $con;
        $this->video = $video;
        $this->usernameLoggedInObj = $usernameLoggedInObj;
    }
    public function create(){
        return $this->createCommentSection();
    }
    public function createCommentSection(){
        $numComments = $this->video->getNumberOfComments();
        $postedBy = $this->usernameLoggedInObj->getUsername();
        $videoId = $this->video->getId();

        $profileButton = ButtonProvider::createUserProfileButton($this->con, $postedBy);
        $commentAction = "postComment(this, \"$postedBy\", $videoId, null, \"comments\")";
        $commentButton = ButtonProvider::createButton("COMMENT", null, $commentAction, "postComment");
    
    //get the comments
    $comments = $this->video->getComments();
    $commentItems = "";
    foreach($comments as $comment){
        $commentItems .= $comment->create();
    }

    return "<div class='commentSection'>
                <div class='header'>
                    <span class='commentsCount'>$numComments Comments</span>
                    <div class='commentForm' style='display:flex'>
                        $profileButton
                    <textarea class='commentBodyClass' placeholder='Add comments'></textarea>
                        $commentButton
                    </div>
                </div>
                    <div class='comments'>
                    $commentItems
                    </div>
            </div>";
    }
}

?>