<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

    // POST api to create new company
    $app->post('/ads/company/new', function (Request $request, Response $response) {
        $ads = new classes\modules\Ads($this->db);
        $datapost = $request->getParsedBody();
        $ads->username = $datapost['Username'];
        $ads->token = $datapost['Token'];
        $ads->name = $datapost['Name'];
        $ads->address = $datapost['Address'];
        $ads->phone = $datapost['Phone'];
        $ads->email = $datapost['Email'];
        $ads->website = $datapost['Website'];
        $body = $response->getBody();
        $body->write($ads->addCompany());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update company
    $app->post('/ads/company/update', function (Request $request, Response $response) {
        $ads = new classes\modules\Ads($this->db);
        $datapost = $request->getParsedBody();    
        $ads->username = $datapost['Username'];
        $ads->token = $datapost['Token'];
        $ads->name = $datapost['Name'];
        $ads->address = $datapost['Address'];
        $ads->phone = $datapost['Phone'];
        $ads->email = $datapost['Email'];
        $ads->website = $datapost['Website'];
        $ads->companyid = $datapost['CompanyID'];
        $ads->statusid = $datapost['StatusID'];
        $body = $response->getBody();
        $body->write($ads->updateCompany());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete company
    $app->post('/ads/company/delete', function (Request $request, Response $response) {
        $ads = new classes\modules\Ads($this->db);
        $datapost = $request->getParsedBody();    
        $ads->postid = $datapost['CompanyID'];
        $ads->username = $datapost['Username'];
        $ads->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($ads->deleteCompany());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data company pagination registered user
    $app->get('/ads/company/data/search/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $ads = new classes\modules\Ads($this->db);
        $ads->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $ads->username = $request->getAttribute('username');
        $ads->token = $request->getAttribute('token');
        $ads->page = $request->getAttribute('page');
        $ads->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($ads->searchCompanyAsPagination());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data list company
    $app->get('/ads/company/list/{token}', function (Request $request, Response $response) {
        $ads = new classes\modules\Ads($this->db);
        $ads->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($ads->showListCompany());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to create new ads
    $app->post('/ads/data/new', function (Request $request, Response $response) {
        $ads = new classes\modules\Ads($this->db);
        $datapost = $request->getParsedBody();
        $ads->username = $datapost['Username'];
        $ads->token = $datapost['Token'];
        $ads->companyid = $datapost['CompanyID'];
        $ads->title = $datapost['Title'];
        $ads->embed = $datapost['Embed'];
        $ads->startdate = $datapost['StartDate'];
        $ads->enddate = $datapost['EndDate'];
        $ads->amount = $datapost['Amount'];
        $body = $response->getBody();
        $body->write($ads->addAds());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update ads
    $app->post('/ads/data/update', function (Request $request, Response $response) {
        $ads = new classes\modules\Ads($this->db);
        $datapost = $request->getParsedBody();    
        $ads->username = $datapost['Username'];
        $ads->token = $datapost['Token'];
        $ads->title = $datapost['Title'];
        $ads->embed = $datapost['Embed'];
        $ads->startdate = $datapost['StartDate'];
        $ads->enddate = $datapost['EndDate'];
        $ads->amount = $datapost['Amount'];
        $ads->companyid = $datapost['CompanyID'];
        $ads->statusid = $datapost['StatusID'];
        $ads->adsid = $datapost['AdsID'];
        $body = $response->getBody();
        $body->write($ads->updateAds());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete ads
    $app->post('/ads/data/delete', function (Request $request, Response $response) {
        $ads = new classes\modules\Ads($this->db);
        $datapost = $request->getParsedBody();    
        $ads->adsid = $datapost['AdsID'];
        $ads->username = $datapost['Username'];
        $ads->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($ads->deleteAds());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data ads pagination registered user
    $app->get('/ads/data/search/{username}/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $ads = new classes\modules\Ads($this->db);
        $ads->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $ads->username = $request->getAttribute('username');
        $ads->token = $request->getAttribute('token');
        $ads->page = $request->getAttribute('page');
        $ads->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($ads->searchAdsAsPagination());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show data ads public / guest
    $app->get('/ads/data/show/{layout}/', function (Request $request, Response $response) {
        $ads = new classes\modules\Ads($this->db);
        $body = $response->getBody();
        $body->write($ads->showAds($request->getAttribute('layout')));
        return classes\Cors::modify($response,$body,200);
    })->add(new \classes\middleware\ApiKey(filter_var((empty($_GET['apikey'])?'':$_GET['apikey']),FILTER_SANITIZE_STRING)));