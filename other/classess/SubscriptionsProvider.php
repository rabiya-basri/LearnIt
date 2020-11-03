<?php
class SubscriptionsProvider{

    private $con, $usernameLoggedInObj;
    public function __construct($con, $usernameLoggedInObj){
        $this->con = $con;
        $this->usernameLoggedInObj = $usernameLoggedInObj;
    }

    public function getVideos(){
        $videos = array();
        $subscriptions = $this->usernameLoggedInObj->getSubscriptions();

        if(sizeof($subscriptions) > 0){

            $condition = "";
            $i = 0;
            while($i < sizeof($subscriptions)){
                if($i == 0){
                    $condition .= "WHERE uploadedBy=?";

                }
                else{
                    $condition .= " OR uploadedBy=?";
                }
                $i++;
            }
            $videoSql = "SELECT * FROM videos $condition ORDER BY uploadDate DESC";
            $videoQuery = $this->con->prepare($videoSql);
            $i=1;
          foreach($subscriptions as $sub){
            
              $subUsername = $sub->getUsername();
              $videoQuery->bindValue($i, $subUsername);
              $i++;
          }  
          $videoQuery->execute();
          while($row = $videoQuery->fetch(PDO::FETCH_ASSOC)){
              $video = new Video($this->con, $row, $this->usernameLoggedInObj);
              array_push($videos, $video);
          }

        }
        return $videos;
    }
}

?>