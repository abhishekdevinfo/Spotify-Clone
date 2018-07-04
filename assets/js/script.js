let currentPlaylist = [];
let audioElement;

function formatTime(sec) {
    let time = Math.round(sec);
    let minutes = Math.floor(time / 60);
    let seconds = time - minutes * 60;

    let extraZero = (seconds < 10) ? "0" : "";

    return minutes + ":" + extraZero + seconds;
}

function Music() {
    this.currentlyPlaying;
    this.audio = document.createElement('audio');

    this.audio.addEventListener("canplay", function() {
        let duration = formatTime(this.duration);
        $(".progressTime.remaining").text(duration);
    });

    this.setTrack = function(track) {
        this.currentlyPlaying = track;
        this.audio.src = track.path;
    };

    this.play = function() {
        this.audio.play();
    };

    this.pause = function() {
        this.audio.pause();
    }
}


