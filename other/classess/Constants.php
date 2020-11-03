<?php
class Constants{
    public static $firstNameCharacters = "Your First Name must be between 2 and 25 characters";
    public static $lastNameCharacters = "Your last Name must be between 2 and 25 characters";
    public static $usernameCharacters = "Your Username must be between 5 and 25 characters";
    public static $usernameTaken = "Username already exists";
    public static $emailsDoNotMatch = "Your Emails do not match";
    public static $emailsInvalid = "Please enter the valid email address";
    public static $emailTaken = "This email is already in use";
    public static $passwordsDoNotMatch = "Your passwords do not match";
    public static $passwordNotAlphanumeric ="Your password can contain only letters and numbers";
    public static $passwordLength = "Your password must be between 5 and 25 characters";

    public static $loginFailed = "Username or Password was incorrect";
    public static $passwordIncorrect = "Incorrect Password";
}
?>