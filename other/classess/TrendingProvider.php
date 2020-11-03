<?php
class TrendingProvider{
    private $con, $usernameLoggedInObj;

    public function __construct($con, $usernameLoggedInObj){
        $this->con = $con;
        $this->usernameLoggedInObj = $usernameLoggedInObj;
    }
    public function getVideos(){
        $videos = array();

        $query = $this->con->prepare("SELECT * FROM videos WHERE uploadDate >= now() - INTERVAL 7 DAY ORDER BY 
                                        views DESC LIMIT 15");
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $video = new Video($this->con, $row, $this->usernameLoggedInObj);
            array_push($videos, $video);
        }
        return $videos;
    }
}

?>