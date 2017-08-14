<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

    // GET example api to show all data role
    $app->get('/', function (Request $request, Response $response) {
        $data = [
		    'status' => 'success',
			'code' => '200',
			'welcome' => 'Hello World, here is the default index',
            'how to use' => 'system is using authentication by token. So You have to register and login to get generated new token.'
		];
        $body = $response->getBody();
        $body->write(json_encode($data, JSON_PRETTY_PRINT));
        return classes\Cors::modify($response,$body,200);
    });