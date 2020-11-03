<?php
class LikedVideosProvider{
    private $con, $usernameLoggedInObj;

    public function __construct($con, $usernameLoggedInObj){
        $this->con = $con;
        $this->usernameLoggedInObj = $usernameLoggedInObj;
    }
    public function getVideos(){
        $videos = array();

        $query = $this->con->prepare("SELECT videoId FROM likes WHERE username=:username AND commentId=0 
                                        ORDER BY id DESC");
        $query->bindParam(":username", $username);
        $username = $this->usernameLoggedInObj->getUsername();
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $videos[] = new Video($this->con, $row["videoId"], $this->usernameLoggedInObj);    
        }
        return $videos;
    }
}
?>