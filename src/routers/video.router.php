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
        $video->release = $datapost['Release'];
        $video->rating = $datapost['Rating'];
        $body = $response->getBody();
        $body->write($video->addPost());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update Author
    $app->post('/book/author/update', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->authorid = $datapost['AuthorID'];
        $book->detail = $datapost['Name'];
        $book->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($book->updateAuthor());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete Author
    $app->post('/book/author/delete', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->authorid = $datapost['AuthorID'];
        $book->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($book->deleteAuthor());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data Author
    $app->get('/book/author/data/{token}', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($book->showAuthor());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data Author pagination
    $app->get('/book/author/data/search/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $book->token = $request->getAttribute('token');
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($book->searchAuthorAsPagination());
        return classes\Cors::modify($response,$body,200);
    });