let currentPlaylist = [];
let audioElement;

function Music() {
    this.currentlyPlaying;
    this.audio = document.createElement('audio');

    this.setTrack = function(src) {
        this.audio.src = src;
    }

    this.play = function() {
        this.audio.play();
    }

    this.pause = function() {
        this.audio.pause();
    }
}


