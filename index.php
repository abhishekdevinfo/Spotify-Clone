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
<body>

<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">

        <div id="nowPlayingLeft">
            <div class="content">
                <span class="albumLink">
                    <img class="albumArtwork" src="https://lh3.googleusercontent.com/dB3Dvgf3VIglusoGJAfpNUAANhTXW8K9mvIsiIPkhJUAbAKGKJcEMPTf0mkSexzLM5o=w300" alt="">
                </span>
                <div class="trackInfo">
                    <span class="trackName">
                        <span>In to the end</span>
                    </span>
                    <span class="artistName">
                        <span>Eminum</span>
                    </span>
                </div>
            </div>
        </div>

        <div id="nowPlayingCenter">
            <div class="content playerControls">
                <div class="buttons">
                    <button class="controlButton shuffle" title="shuffle button">
                        <i class="icon ion-md-shuffle"></i>
                    </button>
                    <button class="controlButton previous" title="previous button">
                        <i class="icon ion-md-skip-backward"></i>
                    </button>
                    <button class="controlButton play" title="play button">
                        <i class="icon ion-md-play"></i>
                    </button>
                    <button class="controlButton pause" title="pause button" style="display: none">
                        <i class="icon ion-md-pause"></i>
                    </button>
                    <button class="controlButton next" title="next button">
                        <i class="icon ion-md-skip-forward"></i>
                    </button>
                    <button class="controlButton repeat" title="repeat button">
                        <i class="icon ion-md-repeat"></i>
                    </button>
                </div>

                <div class="playbackBar">
                    <span class="progressTime current">0.00</span>
                    <div class="progressBar">
                        <div class="progressBarBg">
                            <div class="progress"></div>
                        </div>
                    </div>
                    <span class="progressTime remaining">0.00</span>
                </div>

            </div>
        </div>

        <div id="nowPlayingRight">
            <div class="volumeBar">
                <button class="controlButton volume" title="volume button">
                    <i class="icon ion-md-volume-high"></i>
                </button>
                <button class="controlButton mute" title="mute button" style="display: none">
                    <i class="icon ion-md-volume-off"></i>
                </button>
                <div class="progressBar">
                    <div class="progressBarBg">
                        <div class="progress"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>