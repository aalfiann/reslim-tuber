<?php
include_once 'imdbapi.class.php';
header('Access-Control-Allow-Origin: *');

$imdb = new IMDB('tt2294473');
echo '<PRE>';
print_r($imdb->get_data($imdb->getAPIURL("title/tt2294473/maindetails?")));
echo '</PRE>';
?>