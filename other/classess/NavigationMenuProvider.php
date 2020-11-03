<?php
class NavigationMenuProvider{
    private $con, $usernameLoggedInObj;

    public function __construct($con, $usernameLoggedInObj){
        $this->con = $con;
        $this->usernameLoggedInObj = $usernameLoggedInObj;
    }
    public function create(){
        $menuHtml = $this->createNavItem("HOME", "images/home.png", "index.php");
        $menuHtml .= $this->createNavItem("Trending", "images/icons/trending.png", "trending.php");
        $menuHtml .= $this->createNavItem("Subscriptions", "images/icons/subscriptions.png", "subscriptions.php");
        $menuHtml .= $this->createNavItem("Liked Videos", "images/thumb-up.png", "LikedVideos.php");
        
        if(User::isLoggedIn()){
            $menuHtml .= $this->createNavItem("Settings", "images/icons/settings.png", "Setting.php");
            $menuHtml .= $this->createNavItem("Log Out", "images/icons/logout.png", "logout.php");

            $menuHtml .= $this->createSubscriptionsSection();
        }
        return "<div class='navigationItems'>
                $menuHtml
                </div>";
    }
    private function createNavItem($text, $icon, $link){
        return "<div class='navigationItem'>
                <a href='$link'>
                <img src='$icon'>
                <span>$text</span>
                </a><br>
                </div>";

    }
    private function createSubscriptionsSection(){
        $subscriptions = $this->usernameLoggedInObj->getSubscriptions();
        $html = "<span class='header'>Subscriptions</span>";
        foreach($subscriptions as $sub){
            $subUsername = $sub->getUsername();
            $html .= $this->createNavItem($subUsername, $sub->getProfilePic(), "profile.php?username=$subUsername");

        }
        return $html;
    }
}
?>