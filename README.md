#Chat
======================
Um chat simples criado com PHP, mysql e javascript.

##Prerequisitos
----------------------
composer instalado.

##Iniciando
----------------------
1. clone o repositorio

```sh
git clone https://github.com/gabrielSoares522/chat.git
```

2. instalar as dependências

```sh
php composer install
```

3. [baixar jquery](https://code.jquery.com/jquery-3.5.1.min.js) e salvar em views/assets/js.

```sh
jquery.js
```

4. no arquivo config.php definir a raiz do projeto.

```sh
define("ROOT", "http://localhost/chat");
```

5. no arquivo config.php configurar a conexão.

```sh
define("DATA_LAYER_CONFIG", [
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
]);
```