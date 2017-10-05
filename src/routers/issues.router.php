<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

    // POST api to create new issue
    $app->post('/issues/new/', function (Request $request, Response $response) {
        $issues = new classes\tube\Issues($this->db);
        $datapost = $request->getParsedBody();
        $issues->postid = $datapost['PostID'];
        $issues->fullname = $datapost['Fullname'];
        $issues->email = $datapost['Email'];
        $issues->issue = $datapost['Issue'];
        $body = $response->getBody();
        $body->write($issues->addIssue());
        return classes\Cors::modify($response,$body,200);
    })->add(new \classes\middleware\ApiKey(filter_var((empty($_GET['apikey'])?'':$_GET['apikey']),FILTER_SANITIZE_STRING)));

    // POST api to update issue
    $app->post('/issues/update', function (Request $request, Response $response) {
        $issues = new classes\tube\Issues($this->db);
        $datapost = $request->getParsedBody();    
        $issues->username = $datapost['Username'];
        $issues->token = $datapost['Token'];
        $issues->reportid = $datapost['ReportID'];
        $issues->statusid = $datapost['StatusID'];
        $body = $response->getBody();
        $body->write($issues->updateIssue());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete issue
    $app->post('/issues/delete', function (Request $request, Response $response) {
        $issues = new classes\tube\Issues($this->db);
        $datapost = $request->getParsedBody();    
        $issues->reportid = $datapost['ReportID'];
        $issues->username = $datapost['Username'];
        $issues->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($issues->deleteIssue());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data status issue
    $app->get('/issues/status/{token}', function (Request $request, Response $response) {
        $issues = new classes\tube\Issues($this->db);
        $issues->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($issues->showOptionIssue());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data issue pagination
    $app->get('/issues/data/search/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $issues = new classes\tube\Issues($this->db);
        $issues->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $issues->username = $request->getAttribute('username');
        $issues->token = $request->getAttribute('token');
        $issues->page = $request->getAttribute('page');
        $issues->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($issues->searchIssuesAsPagination());
        return classes\Cors::modify($response,$body,200);
    });