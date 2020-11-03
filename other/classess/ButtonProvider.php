<?php
class ButtonProvider{

    public static $signInFunction = "notSignedIn()";

    public function createLink($link){
        return User::isLoggedIn() ? $link : ButtonProvider::$signInFunction;
    }
    public static function createButton($text, $imgSrc, $action, $class){

        $image = ($imgSrc == null) ? "" : "<img src='$imgSrc'>";

        //change action if needed
        $action  = ButtonProvider::createLink($action);
        
      return "<button class='$class' onclick='$action'>
       $image
       <span class='text'>$text</span>
       </button>";
    }
    public static function createHyperlinkButton($text, $imgSrc, $href, $class){

        $image = ($imgSrc == null) ? "" : "<img src='$imgSrc'>";
 
      return "<a href='$href'>
      <button class='$class'>
       $image
       <span class='text'>$text</span>
       </button></a>";
    }
    public static function createUserProfileButton($con, $username){
        $userObj = new User($con, $username);
        $profilePic = $userObj->getProfilePic();
        $link = "profile.php?username=$username";

        return "<a href='$link'>
        <img src='$profilePic' class='profilePicture'>
        </a>";

    }
    public static function createEditVideoButton($videoId){
        $href = "editVideo.php?videoId=$videoId";
        $button = ButtonProvider::createHyperlinkButton("EDIT VIDEO", null, $href, "edit button");

        return "<div class='editVideoButtonContainer'>
        
        $button
        </div>
        ";

    }
    public static function createSubscriberButton($con, $userToObj, $usernameLoggedInObj){
       $userTo = $userToObj->getUsername();
       $usenameLoggedIn =  $usernameLoggedInObj->getUsername();
       
        $isSubscribedTo = $usernameLoggedInObj->isSubscribedTo($userTo);
        $buttonText = $isSubscribedTo ? "SUBSCRIBED" : "SUBSCRIBE";
        $buttonText .= " " . $userToObj->getSubscriberCount($userTo);

        $buttonClass = $isSubscribedTo ? "unsubscribe button" : "subscribe button";
        $action = "subscribe(\"$userTo\", \"$usenameLoggedIn\",this)";

        $button = ButtonProvider::createButton($buttonText, null ,$action, $buttonClass);
        return "<div class ='subscribeButtonContainer'>
                    $button
                    </div>";
    }
    public static function createUserProfileNavigationButton($con, $username){
        if(User::isLoggedIn()){
            return ButtonProvider::createUserProfileButton($con, $username);
        }
        else{
            return "<a href='signIn.php'>
                    <span class='signInLink'>SIGN IN</span>
                    </a>";
        }
    }
}

?>