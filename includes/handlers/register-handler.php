<?php

function sanitizeFormUsername($inputText) {
    $inputText = strip_tags($inputText);
    // strip_tags remove all the html elements that might be on string.
    $inputText = str_replace(" ", "", $inputText);
    // replace all the spaces with empty string.
    return $inputText;
}

function sanitizeFormString($inputText) {
    $inputText = strip_tags($inputText);
    // strip_tags remove all the html elements that might be on string.
    $inputText = str_replace(" ", "", $inputText);
    // replace all the spaces with empty string.
    $inputText = ucfirst(strtolower($inputText));
    // ucfirst - will uppercase first character. strtolower will lower case to all characters.
    return $inputText;
}

function sanitizeFormPassword($inputText) {
    $inputText = strip_tags($inputText);
    // strip_tags remove all the html elements that might be on string.
    return $inputText;
}

if(isset($_POST['registerButton'])) {
    //Register button was pressed
    $userName = sanitizeFormUsername($_POST['userName']);
    $firstName = sanitizeFormString($_POST['firstName']);
    $lastName = sanitizeFormString($_POST['lastName']);
    $email = sanitizeFormString($_POST['email']);
    $email2 = sanitizeFormString($_POST['email2']);
    $password = sanitizeFormPassword($_POST['password']);
    $password2 = sanitizeFormPassword($_POST['password2']);

    $wasSuccessful = $account->register($userName, $firstName, $lastName, $email, $email2, $password, $password2);

    if($wasSuccessful) {
        $_SESSION['userLoggedIn'] = $userName;
        header("Location: index.php");
    }
}
