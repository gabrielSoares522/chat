<?php
use CoffeeCode\Router\Router;

require __DIR__ . "/vendor/autoload.php";

$router = new Router(ROOT);

$router->namespace("Source\Controllers");

$router->group(null);
$router->get("/", "Controller:chat","Controller.chat");
$router->get("/login", "Controller:login","Controller.login");
$router->get("/cadastro", "Controller:cadastro","Controller.cadastro");
//router->post("/enviar", "Controller:enviar");
//$router->get("/receber", "Controller:receber");
//$router->post("/addContato", "Controller:addContato");


$router->dispatch();

if ($router->error()) {
    var_dump($router->error());
}