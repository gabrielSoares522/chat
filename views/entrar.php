<?php

if($entrou == true){
    session_start();

    $_SESSION['login'] = $login;
    header("location: ".$router->route("Controller.chat"));
}
else{
    header("location: ".$router->route("Controller.login"));
}