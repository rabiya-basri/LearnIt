<?php
ob_start(); //turns on output buffering
session_start();

date_default_timezone_set("Indian/Reunion");

try{
    $con = new PDO("mysql:dbname=learntube;host=localhost", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (PDOException $e){
    echo "connection failed" . $e->getMessage();
}
?>