<?php 
require_once("other/header.php");
require_once("other/classess/VideoUploadData.php");
require_once("other/classess/VideoProcessor.php");

if(!isset($_POST["uploadButton"])){
    echo "no file is sent to this page.";
    exit();
}
    //1) create file upload data
    $videoUploadData = new VideoUploadData($_FILES["fileInput"], 
                                            $_POST["TitleInput"],
                                            $_POST["DescriptionInput"],
                                            $_POST["privacyInput"],
                                            $_POST["categoryInput"],
                                            $usernameLoggedInObj->getUsername()
                                        );

    //2)process video data(upload)
    $videoProcessor = new VideoProcessor($con);
    $wasSuccessful = $videoProcessor->upload($videoUploadData);

    //3)check if upload was successfull
    if($wasSuccessful){
        echo "Upload Successfull";
    }
    

 ?>