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
        let newPlaylist = <?php echo $jsonArray; ?>;
        audioElement = new Music();
        setTrack(newPlaylist[0], newPlaylist, false);
        updateVolumeProgressBar(audioElement.audio);

        $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
            e.preventDefault();
        })

        $(".playbackBar .progressBar").mousedown(function () {
            mouseDown = true;
        });

        $(".playbackBar .progressBar").mousemove(function (e) {
            if(mouseDown) {
                // Set time of songs, depending on position on mouse
                timeFromOffset(e,this);
            }
        });

        $(".playbackBar .progressBar").mouseup(function (e) {
            timeFromOffset(e,this);
        });

        $(".volumeBar .progressBar").mousedown(function () {
            mouseDown = true;
        });

        $(".volumeBar .progressBar").mousemove(function (e) {
            if(mouseDown) {
                let percentage = e.offsetX / $(this).width();
                if(percentage >= 0 && percentage <= 1) {
                    audioElement.audio.volume = percentage;
                }
            }
        });

        $(".volumeBar .progressBar").mouseup(function (e) {
            let percentage = e.offsetX / $(this).width();
            if(percentage >= 0 && percentage <= 1) {
                audioElement.audio.volume = percentage;
            }
        });

        $(document).mouseup(function() {
            mouseDown = false;
        })

    });

    function timeFromOffset(mouse, progressBar) {
        let percentage = mouse.offsetX / $(progressBar).width() * 100;
        let seconds = audioElement.audio.duration * (percentage / 100);
        audioElement.setTime(seconds);
    }

    function prevSong() {
        if(audioElement.audio.currentTime >= 3 || currentIndex == 0) {
            audioElement.setTime(0);
        } else {
            currentIndex = currentIndex - 1;
            setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
        }
    }

    function nextSong() {
        if(repeat) {
            audioElement.setTime(0);
            playSong();
            return;
        }

        if(currentIndex === currentPlaylist.length - 1) {
            currentIndex = 0;
        } else {
            currentIndex++;
        }

        let trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
        setTrack(trackToPlay, currentPlaylist, true);
    }

    function setRepeat() {
        repeat = !repeat;
        let iconColor = repeat ? "#ef4c4c" : "#a0a0a0";
        $(".controlButton.repeat i").css("color", iconColor);
    }

    function setMute() {
        audioElement.audio.muted = !audioElement.audio.muted;
        let iconChange = audioElement.audio.muted ? "icon ion-md-volume-off" : "icon ion-md-volume-high";
        $("#nowPlayingRight i").attr("class", iconChange);
    }

    function setShuffle() {
        shuffle = !shuffle;
        let iconColor = shuffle ? "#ef4c4c" : "#a0a0a0";
        $(".controlButton.shuffle i").css("color", iconColor);

        if(shuffle) {
            // Random playlist
            shuffleArray(shufflePlaylist);
            currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
        } else {
            // shuffle has been deactivated
            // go back to regular playlist
            currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
        }
    }

    function shuffleArray(a) {
        var j, x, i;
        for (i = a.length - 1; i > 0; i--) {
            j = Math.floor(Math.random() * (i + 1));
            x = a[i];
            a[i] = a[j];
            a[j] = x;
        }
        return a;
    }

    function setTrack(trackId, newPlaylist, play) {

        if(newPlaylist != currentPlaylist) {
            currentPlaylist = newPlaylist;
            shufflePlaylist = currentPlaylist.slice();
            shuffleArray(shufflePlaylist);
        }

        if(shuffle) {
            currentIndex = shufflePlaylist.indexOf(trackId);
        } else {
            currentIndex = currentPlaylist.indexOf(trackId);
        }

        pauseSong();

        $.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data) {

            let track = JSON.parse(data);

            $(".trackName span").text(track.title);

            $.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist }, function(data) {
                let artist = JSON.parse(data);

                $(".artistName span").text(artist.name);
            });

            $.post("includes/handlers/ajax/getAlbumJson.php", { albumId: track.album }, function(data) {
                let album = JSON.parse(data);
                // console.log(album.artworkPath);
                $(".albumLink img").attr("src",album.artworkPath);
            });

            audioElement.setTrack(track);
            playSong();
        });

        if(play) {
            audioElement.play();
        }
    }

    function playSong() {
        if(audioElement.audio.currentTime == 0) {
            $.post("includes/handlers/ajax/updatePlays.php", { songId: audioElement.currentlyPlaying.id});
        }

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
                    <button class="controlButton shuffle" title="shuffle button" onclick="setShuffle()">
                        <i class="icon ion-md-shuffle"></i>
                    </button>
                    <button class="controlButton previous" title="previous button" onclick="prevSong()">
                        <i class="icon ion-md-skip-backward"></i>
                    </button>
                    <button class="controlButton play" title="play button" onclick="playSong()">
                        <i class="icon ion-md-play"></i>
                    </button>
                    <button class="controlButton pause" title="pause button" style="display: none" onclick="pauseSong()">
                        <i class="icon ion-md-pause"></i>
                    </button>
                    <button class="controlButton next" title="next button" onclick="nextSong()">
                        <i class="icon ion-md-skip-forward"></i>
                    </button>
                    <button class="controlButton repeat" title="repeat button" onclick="setRepeat()">
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
                <button class="controlButton volume" title="volume button" onclick="setMute()">
                    <i class="icon ion-md-volume-high"></i>
                </button>
<!--                <button class="controlButton mute" title="mute button" style="display: none">-->
<!--                    <i class="icon ion-md-volume-off"></i>-->
<!--                </button>-->
                <div class="progressBar">
                    <div class="progressBarBg">
                        <div class="progress"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>