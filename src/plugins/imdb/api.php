<?php
include_once 'imdbapi.class.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$gettitle = filter_var($_GET['title'], FILTER_UNSAFE_RAW);
if (!empty($gettitle)){
	$imdb = new IMDB($gettitle);
	if($imdb->isReady){
		$imdb_api = array();
		if (!empty($_GET['show']) && $_GET['show'] == 'all'){
			$imdb_api = $imdb->getAll(); 
		} else {
			$imdb_api['imdbID'] = $imdb->getImdbID();
			$imdb_api['imdbURL'] = $imdb->getUrl();
			$imdb_api['poster'] = $imdb->getPoster();
			$imdb_api['poster_thumbnails'] = $imdb->getPosterThumbnails();
			$imdb_api['rating'] = $imdb->getRating();
			$imdb_api['mpaa'] = $imdb->getMpaa();
			$imdb_api['runtime'] = $imdb->getRuntime();
			$imdb_api['runtime_formatted'] = $imdb->getRuntimeSeconds();
			$imdb_api['num_votes'] = $imdb->getNumVotes();
			$imdb_api['title'] = $imdb->getTitle();
			$imdb_api['tagline'] = $imdb->getTagline();
			$imdb_api['countryStringCommas'] = $imdb->getCountryStringCommas();
			$imdb_api['genreStringCommas'] = $imdb->getGenreStringCommas();
			$imdb_api['castNameStringCommas'] = $imdb->getCastNameStringCommas();
			$imdb_api['castDirectorStringCommas'] = $imdb->getDirectorNameStringCommas();
			$imdb_api['trailer_id'] = $imdb->getTrailer();
			$imdb_api['trailer_link'] = $imdb->getTrailerFull();
			$imdb_api['isTV'] = $imdb->isTvShow();
			$imdb_api['type'] = $imdb->getType();
			$imdb_api['year'] = $imdb->getYear();
			$imdb_api['description'] = $imdb->getDescription();
			$imdb_api['plot'] = $imdb->getPlot();
		}
		$data = [ 
			'result' => $imdb_api,
			'status' => 'success',
			'message' => 'success to retrieve data',
			'execution_time' => microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"],
			'generate_time' => date('Y-m-d h:i:s a', time()),
			'basepath' => $imdb->getBasePath(),
			'hostname' => $imdb->getHostname(),
			'version' => $imdb->getVersion()
		];
	}else{
		$data = [ 
			'status' => 'failed',
			'message' => $imdb->status,
			'execution_time' => microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"],
			'generate_time' => date('Y-m-d h:i:s a', time()),
			'basepath' => $imdb->getBasePath(),
			'hostname' => $imdb->getHostname(),
			'version' => $imdb->getVersion()
		];
	}
} else {
	$data = [
		'status' => 'error',
		'message' => 'wrong api parameter',
		'execution_time' => microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"],
		'generate_time' => date('Y-m-d h:i:s a', time()),
		'basepath' => $imdb->getBasePath(),
		'hostname' => $imdb->getHostname(),
		'version' => $imdb->getVersion()
	];
}
//Output
header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
?>