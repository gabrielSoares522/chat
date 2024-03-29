<?php
define("ROOT", "http://localhost/chat");

const DATA_LAYER_CONFIG = [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "chat",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];

date_default_timezone_set("America/Sao_Paulo");

/**
 * @param string $path
 * @return string
 */
function url(string $path): string
{
    if ($path) {
        return ROOT . "{$path}";
    }
    return ROOT;
}

/**
 * @param string $message
 * @param string $type
 * @return string
 */
function message(string $message, string $type): string
{
    return "<div class=\"message {$type}\">{$message}</div>";
}