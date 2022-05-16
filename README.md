# Chat
======================
Um chat simples criado com PHP, mysql e javascript.

## Requisitos
- xampp 8.0.18 ou superior instalado
- Composer instalado
- git instalado

## Iniciando
----------------------
1. clone o repositorio no diretorio htdocs.
```console
git clone https://github.com/gabrielSoares522/chat.git
```

2. Execute o comando abaixo para instalar as dependências.
```console
composer install
```

3. no arquivo config.php definir a raiz do projeto.
```php
define("ROOT", "http://localhost/chat");
```

4. no arquivo config.php configurar a constante DATA_LAYER_CONFIG para fazer a conexão com o banco de dados.
```php
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
```