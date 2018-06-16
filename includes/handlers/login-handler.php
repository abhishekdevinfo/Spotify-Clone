<?php
if(isset($_POST['loginButton'])) {
    //Login button was pressed
    $userName = $_POST['loginUserName'];
    $password = $_POST['loginPassword'];

    $result = $account->login($userName, $password);

    if($result == true) {
        $_SESSION['userLoggedIn'] = $userName;
        header("Location: index.php");
    }
}