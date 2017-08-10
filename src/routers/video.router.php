<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

    // POST api to create new post
    $app->post('/video/post/new', function (Request $request, Response $response) {
        $video = new classes\tube\Video($this->db);
        $datapost = $request->getParsedBody();
        $video->username = $datapost['Username'];
        $video->token = $datapost['Token'];
        $video->image = $datapost['Image'];
        $video->title = $datapost['Title'];
        $video->description = $datapost['Description'];
        $video->embed = $datapost['Embed'];
        $video->duration = $datapost['Duration'];
        $video->stars = $datapost['Stars'];
        $video->cast = $datapost['Cast'];
        $video->director = $datapost['Director'];
        $video->tags = $datapost['Tags'];
        $video->country = $datapost['Country'];
        $video->released = $datapost['Released'];
        $video->rating = $datapost['Rating'];
        $body = $response->getBody();
        $body->write($video->addPost());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update post
    $app->post('/video/post/update', function (Request $request, Response $response) {
        $video = new classes\tube\Video($this->db);
        $datapost = $request->getParsedBody();    
        $video->username = $datapost['Username'];
        $video->token = $datapost['Token'];
        $video->image = $datapost['Image'];
        $video->title = $datapost['Title'];
        $video->description = $datapost['Description'];
        $video->embed = $datapost['Embed'];
        $video->duration = $datapost['Duration'];
        $video->stars = $datapost['Stars'];
        $video->cast = $datapost['Cast'];
        $video->director = $datapost['Director'];
        $video->tags = $datapost['Tags'];
        $video->country = $datapost['Country'];
        $video->released = $datapost['Released'];
        $video->rating = $datapost['Rating'];
        $video->postid = $datapost['PostID'];
        $video->statusid = $datapost['StatusID'];
        $body = $response->getBody();
        $body->write($video->updatePost());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete post
    $app->post('/video/post/delete', function (Request $request, Response $response) {
        $video = new classes\tube\Video($this->db);
        $datapost = $request->getParsedBody();    
        $video->postid = $datapost['PostID'];
        $video->username = $datapost['Username'];
        $video->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($video->deletePost());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data post pagination registered user
    $app->get('/video/post/data/search/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $video = new classes\tube\Video($this->db);
        $video->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $video->username = $request->getAttribute('username');
        $video->token = $request->getAttribute('token');
        $video->page = $request->getAttribute('page');
        $video->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($video->searchPostAsPagination());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data post pagination public / guest
    $app->get('/video/post/data/public/search/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $video = new classes\tube\Video($this->db);
        $video->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $video->page = $request->getAttribute('page');
        $video->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($video->searchPostAsPaginationPublic());
        return classes\Cors::modify($response,$body,200);
    })->add(new \classes\middleware\ApiKey(filter_var((empty($_GET['apikey'])?'':$_GET['apikey']),FILTER_SANITIZE_STRING)));

    // GET api to show all data post random pagination public / guest
    $app->get('/video/post/data/public/search/random/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $video = new classes\tube\Video($this->db);
        $video->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $video->page = $request->getAttribute('page');
        $video->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($video->searchPostRandomAsPaginationPublic());
        return classes\Cors::modify($response,$body,200);
    })->add(new \classes\middleware\ApiKey(filter_var((empty($_GET['apikey'])?'':$_GET['apikey']),FILTER_SANITIZE_STRING)));

    // GET api to show all data post random by released year pagination public / guest
    $app->get('/video/post/data/public/search/random/{year}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $video = new classes\tube\Video($this->db);
        $video->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $video->released = $request->getAttribute('year');
        $video->page = $request->getAttribute('page');
        $video->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($video->searchPostRandomByYearAsPaginationPublic());
        return classes\Cors::modify($response,$body,200);
    })->add(new \classes\middleware\ApiKey(filter_var((empty($_GET['apikey'])?'':$_GET['apikey']),FILTER_SANITIZE_STRING)));

    // GET api to show all data status release
    $app->get('/video/data/status/{token}', function (Request $request, Response $response) {
        $video = new classes\tube\Video($this->db);
        $video->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($video->showOptionRelease());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show single data post
    $app->get('/video/post/data/read/{postid}/', function (Request $request, Response $response) {
        $video = new classes\tube\Video($this->db);
        $video->postid = $request->getAttribute('postid');
        $body = $response->getBody();
        $body->write($video->showSinglePost());
        return classes\Cors::modify($response,$body,200);
    })->add(new \classes\middleware\ApiKey(filter_var((empty($_GET['apikey'])?'':$_GET['apikey']),FILTER_SANITIZE_STRING)));

    // Get api to process liked
    $app->get('/video/post/data/liked/{postid}/', function (Request $request, Response $response) {
        $video = new classes\tube\Video($this->db);  
        $video->postid = $request->getAttribute('postid');  
        $body = $response->getBody();
        $body->write($video->addLike());
        return classes\Cors::modify($response,$body,200);
    })->add(new \classes\middleware\ApiKey(filter_var((empty($_GET['apikey'])?'':$_GET['apikey']),FILTER_SANITIZE_STRING)));

    // Get api to process disliked
    $app->get('/video/post/data/disliked/{postid}/', function (Request $request, Response $response) {
        $video = new classes\tube\Video($this->db);  
        $video->postid = $request->getAttribute('postid');  
        $body = $response->getBody();
        $body->write($video->addDislike());
        return classes\Cors::modify($response,$body,200);
    })->add(new \classes\middleware\ApiKey(filter_var((empty($_GET['apikey'])?'':$_GET['apikey']),FILTER_SANITIZE_STRING)));