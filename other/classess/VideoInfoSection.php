<?php
require_once("other/classess/VideoinfoControls.php");
class VideoInfoSection{
    private $con, $video, $usernameLoggedInObj;
    public function __construct($con, $video, $usernameLoggedInObj){
        $this->con = $con;
        $this->video = $video;
        $this->usernameLoggedInObj = $usernameLoggedInObj;
    }
    public function create(){
        return $this->createPrimaryInfo() . $this->createSecondaryInfo();
    }
    private function createPrimaryInfo(){
        $title = $this->video->getTitle();
        $views = $this->video->getViews();

        $videoInfoControls = new VideoinfoControls($this->video, $this->usernameLoggedInObj);
        $controls = $videoInfoControls->create();

        return "<div class='videoInfo'>
        <h1>$title</h1>
        
        <div class='bottomSection'>
        <span class='viewCount'>$views views</span>
        $controls
        </div>
        </div>";
    }
    private function createSecondaryInfo(){
        $description = $this->video->getDescription();
        $uploadDate = $this->video->getUploadDate();
        $uploadedBy = $this->video->getUploadedBy();
        $profileButton = ButtonProvider::createUserProfileButton($this->con, $uploadedBy);

        if($uploadedBy == $this->usernameLoggedInObj->getUsername()){
            $actionButton = ButtonProvider::createEditVideoButton($this->video->getId());


        }
        else{
            $userToObject = new User($this->con, $uploadedBy);
            $actionButton = ButtonProvider::createSubscriberButton($this->con, $userToObject, $this->usernameLoggedInObj);

        }

        return "<div class='secondaryInfo'>
                    <div class='topRow'>
                        $profileButton

                        <div class='uploadInfo'>
                            <span class='owner'>
                                 <a href='profile.php?username=$uploadedBy'>
                                    $uploadedBy
                                </a>
                            </span>
                            <span class='date'>Published on $uploadDate</span>
                        </div>
                        $actionButton
                    </div>
                        <div class='descriptionContainer'> 
                            $description
                        </div>
        
                    </div>
                    ";
    }
}

?>