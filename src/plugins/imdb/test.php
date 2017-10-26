<?php
include_once 'imdbapi.class.php';
header('Access-Control-Allow-Origin: *');
//tt0089469 >> 2
//tt2294473 >> 1
$imdb = new IMDB('tt0089469');
echo $imdb->getCountry();
?>