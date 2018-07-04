<?php

    class Artist {

        private $con;
        private $id;

        public function __construct($con, $id) {
            $this->con = $con;
            $this->id = $id;
        }

        public function getName() {
            $Query = mysqli_query($this->con, "SELECT name FROM artists WHERE id ='$this->id'");
            $artist = mysqli_fetch_array($Query);
            return $artist['name'];
        }

    }