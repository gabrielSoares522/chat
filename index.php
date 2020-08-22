<?php
use CoffeeCode\Router\Router;

require __DIR__ . "/vendor/autoload.php";

$router = new Router(ROOT);

$router->namespace("Source\Controllers");

$router->group(null);
$router->get("/", "Controller:chat","Controller.chat");
$router->get("/login", "Controller:login","Controller.login");
$router->get("/cadastro", "Controller:cadastro","Controller.cadastro");
$router->post("/criarConta", "Controller:criarConta","Controller.criarConta");
$router->post("/entrar", "Controller:entrar","Controller.entrar");
$router->post("/addContato", "Controller:addContato","Controller.addContato");
$router->post("/enviarMsg", "Controller:enviarMsg","Controller.enviarMsg");
$router->post("/buscarConversa", "Controller:buscarConversa","Controller.buscarConversa");
$router->post("/atualizarMensagem", "Controller:atualizarMensagem","Controller.atualizarMensagem");


$router->dispatch();

if ($router->error()) {
    var_dump($router->error());
}