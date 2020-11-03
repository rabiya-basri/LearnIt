<?php

require_once("other/config.php");
require_once("other/classess/ButtonProvider.php");
require_once("other/classess/User.php");
require_once("other/classess/Video.php");
require_once("other/classess/VideoGrid.php");
require_once("other/classess/VideoGridItem.php");
require_once("other/classess/SubscriptionsProvider.php");
require_once("other/classess/NavigationMenuProvider.php");



$usenameLoggedIn = User::isLoggedIn() ? $_SESSION["userLoggedIn"] : "";
$usernameLoggedInObj = new User($con, $usenameLoggedIn);

?>
<!DOCTYPE html>
<html>
<head><title>golearn</title>
<meta charset=utf-8>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="assest/style.css">
<link rel="stylesheet" type="text/css" href="assest/style1.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="jss/commandaction.js"></script>
<script src="jss/userActions.js"></script>
</head>
<body>
<div id="pageContainer">
    <div id="mastHeadContainer">
    <button class="navShowHide">
    <img src="images/menu.png">
    </button>

    <a class="logoContainer" href="index.php">
        <img src="images/logo3.png" title="logo" alt="site logo">
    </a>

    <div class="searchBarContainer">
        <form action="search.php" method="GET">
        <input type="text" class="searchBar" name="term" placeholder="SEARCH">
        <button class="searchButton">
        <img src="images/search.png">  
        </button>
    </form>
    </div>

    <div class="rightIcons">
        <a href="upload.php">
        <img class="upload" title="Upload" src="images/upload.png">   
        </a>
        <?php echo ButtonProvider::createUserProfileNavigationButton($con, $usernameLoggedInObj->getUsername()); ?>
    </div>

    </div>
    <div id="sideNavContainer" style="display:none;">
    <?php
    $navigationProvider = new NavigationMenuProvider($con, $usernameLoggedInObj);
    echo $navigationProvider->create();
    ?>
    </div>
        <div id="mainSectionContainer" class="leftpadding">
            <div id="mainContentContainer">