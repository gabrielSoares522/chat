<?php
session_start();

unset($_SESSION["login"]);

session_destroy();

header("location:".$router->route("Controller.login"));