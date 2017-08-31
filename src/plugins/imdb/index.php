<?php
include_once 'imdbapi.class.php';
header('Content-Type: application/json');
//put in Name of movie or IMDB ID (tt0499549)
$imdb = new IMDB('tt0499549');
if($imdb->isReady){
    $data = [ 
        'status' => $imdb->status,
        'message' => 'imdb api is ready to use',
        'execution_time' => microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"],
        'generate_time' => date('Y-m-d h:i:s a', time()),
        'basepath' => $imdb->getBasePath(),
        'hostname' => $imdb->getHostname(),
        'version' => $imdb->getVersion()
    ];
}else{
    $data = [ 
        'status' => 'ERROR',
        'message' => $imdb->status,
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