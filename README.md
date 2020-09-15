Chat
======================
Um chat simples criado com PHP, mysql e javascript.

Iniciando
----------------------
1. clone o repositorio.

```sh
git clone https://github.com/gabrielSoares522/chat.git
```

2. instalar as dependências.

```sh
php composer install
```

3. baixar jquery.

```sh
npm install jquery
```

4. copiar arquivo jquery.
```sh
copy node_modules\jquery\dist\jquery.js views\assets\jquery.js
```

4. no arquivo config.php definir a raiz do projeto.

```sh
define("ROOT", "http://localhost/chat");
```

5. no arquivo config.php configurar a constante DATA_LAYER_CONFIG para fazer a conexão.