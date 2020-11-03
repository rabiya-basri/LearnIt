<?php
require_once("other/header.php");
require_once("other/classess/Account.php");
require_once("other/classess/FormSanitizer.php");
require_once("other/classess/SettingsFormProvider.php");
require_once("other/classess/Constants.php");

if(!User::isLoggedIn()){
    header("Location: signIn.php");
}
$detailsMessage = "";
$passwordMessage = "";
$formProvider = new SettingsFormProvider();
if(isset($_POST["saveDetailsButton"])){
$account = new Account($con);

$firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
$lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
$email = FormSanitizer::sanitizeFormString($_POST["email"]);

if($account->updateDetails($firstName, $lastName, $email, $usernameLoggedInObj->getUsername())){
    $detailsMessage = "<div class='alert alert-success'>
                        <strong>SUCCESS!</strong>Details updated successfully
                        </div>";
    }
    else{
        $errorMessage = $account->getFirstError();

        if($errorMessage == "") $errorMessage = "Something Went Wrong";

        $detailsMessage = "<div class='alert alert-danger'>
        <strong>ERROR!</strong>$errorMessage
        </div>";
    }
}
if(isset($_POST["savePasswordButton"])){
    $account = new Account($con);

$oldPassword = FormSanitizer::sanitizeFormPassword($_POST["oldPassword"]);
$newPassword = FormSanitizer::sanitizeFormPassword($_POST["newPassword"]);
$newPassword2 = FormSanitizer::sanitizeFormPassword($_POST["newPassword2"]);


if($account->updatePassword($oldPassword, $newPassword, $newPassword2, $usernameLoggedInObj->getUsername())){
    $passwordMessage = "<div class='alert alert-success'>
                        <strong>SUCCESS!</strong>Password updated successfully
                        </div>";
    }
    else{
        $errorMessage = $account->getFirstError();

        if($errorMessage == "") $errorMessage = "Something Went Wrong";

        $passwordMessage = "<div class='alert alert-danger'>
        <strong>ERROR!</strong>$errorMessage
        </div>";
    }
}
?>
<div class="settingsContainer column">
    <div class="formSection">
        <div class="message">
            <?php echo $detailsMessage; ?>
        </div>
    <?php
    echo $formProvider->createUserDetailsForm(
        isset($_POST["firstName"]) ? $_POST["firstName"] : $usernameLoggedInObj->getFirstName(),
        isset($_POST["lastName"]) ? $_POST["lastName"] : $usernameLoggedInObj->getLastName(),
        isset($_POST["email"]) ? $_POST["email"] : $usernameLoggedInObj->getEmail()

    );
    ?>
    </div>
    <div class="formSection">
    <div class="message">
            <?php echo $passwordMessage ?>
        </div>
    <?php
    echo $formProvider->createPasswordForm();
    ?>
    </div>
</div>