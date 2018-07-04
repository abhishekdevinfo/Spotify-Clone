<?php
$songsQuery = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");

$resultArray = array();

while($row = mysqli_fetch_array($songsQuery)) {
    array_push($resultArray, $row['id']);
}

$jsonArray = json_encode($resultArray);
?>

<script>
    $(document).ready(function() {
        currentPlaylist = <?php echo $jsonArray; ?>;
        audioElement = new Music();
        setTrack(currentPlaylist[0], currentPlaylist, false);
    });

    function setTrack(trackId, newPlaylist, play) {

        $.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data) {
            let track = JSON.parse(data);

            $(".trackName span").text(track.title);

            $.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist }, function(data) {
                let artist = JSON.parse(data);

                $(".artistName span").text(artist.name);
            });

            $.post("includes/handlers/ajax/getAlbumJson.php", { albumId: track.album }, function(data) {
                let album = JSON.parse(data);
                console.log(album.artworkPath);
                $(".albumLink img").attr("src",album.artworkPath);
            });

            audioElement.setTrack(track.path);
            audioElement.play();
        });

        if(play) {
            audioElement.play();
        }
    }

    function playSong() {
        $(".controlButton.play").hide();
        $(".controlButton.pause").show();
        audioElement.play();
    }

    function pauseSong() {
        $(".controlButton.pause").hide();
        $(".controlButton.play").show();
        audioElement.pause();
    }
</script>

<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">

        <div id="nowPlayingLeft">
            <div class="content">
                <span class="albumLink">
                    <img class="albumArtwork"
                         src=""
                         alt="">
                </span>
                <div class="trackInfo">
                    <span class="trackName">
                        <span></span>
                    </span>
                    <span class="artistName">
                        <span></span>
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
                    <button class="controlButton play" title="play button" onclick="playSong()">
                        <i class="icon ion-md-play"></i>
                    </button>
                    <button class="controlButton pause" title="pause button" style="display: none" onclick="pauseSong()">
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