<?php
include("includes/header.php");

if(isset($_GET['id'])) {
    $albumId = $_GET['id'];
} else {
    header("Location: index.php");
}

$album = new Album($con, $albumId);
$artist = $album->getArtist();

if($album->getNumberOfSongs() > 1) {
    $songs = 'songs';
} else {$songs = 'song';}
?>

<div class="entityInfo">
    <div class="leftSection">
        <img src="<?php echo $album->getArtworkPath(); ?>" alt="Artwork">
    </div>
    <div class="rightSection">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p><?php echo $artist->getName(); ?></p>
        <p><?php echo $album->getNumberOfSongs() . " " . $songs; ?></p>
    </div>
</div>

<div class="trackListContainer">
    <ul class="trackList">

        <?php
        $songsIdArray = $album->getSongsIds();

        $i = 1;
        foreach($songsIdArray as $songId) {

            $albumSong = new Song($con, $songId);
            $albumArtist = $albumSong->getArtist();

            echo "<li class='trackListRow'>
                    <div class='trackCount'>
                        <i class=\"icon ion-md-play\"></i>
                        <span class='trackNumber'>$i</span>   
                    </div>
                    
                    <div class='trackInfo'>
                        <span class='trackName'>" . $albumSong->getTitle() . "</span>
                        <span class='artistName'>" . $albumArtist->getName() . "</span>                    
                    </div>     
                    
                    <div class='trackOption'>
                        <i class=\"icon ion-md-more\"></i>
                    </div>  
                    
                    <div class='trackDuration'>
                        <span class='duration'>". $albumSong->getDuration() ."</span>
                    </div>             
                </li>";
            $i++;

        }
        ?>

    </ul>
</div>

<?php include("includes/footer.php"); ?>
