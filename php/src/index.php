<?php
include "CurlHttp.php";
include "Router.php";

define("ASP_CONTAINER", "aspnetcore");
$url = $_SERVER['REQUEST_URI'];
$request = json_decode(file_get_contents('php://input'), true);
$router = new Router($request);

$router->get('/notes', function ($request) {
    $curl = new CurlHttp(ASP_CONTAINER);
    return $curl->request('GET', 'notes');
});
$router->post('/notes', function ($request) {
    $curl = new CurlHttp(ASP_CONTAINER);
    $postData = [
        'title' => $request['title'],
        'text' => $request['text'],
    ];
    return $curl->request('POST', 'notes', $postData);
});

$router->resolve($url, $_SERVER['REQUEST_METHOD']);