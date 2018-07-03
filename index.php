<?php
include("includes/config.php");

//session_destroy();  // LOGOUT

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome to Spotify-Clone!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/ionicons@4.2.0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>L̥

<div id="mainContainer">

    <div id="topContainer">

        <?php include("includes/navBarContainer.php");?>

    </div>

    <?php include("includes/nowPlayingBar.php"); ?>
</div>


</body>
</html>