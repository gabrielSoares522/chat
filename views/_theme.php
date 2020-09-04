<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>

    <link rel="stylesheet" href="<?= url("/views/assets/css/style.css"); ?>">
</head>
<body>
    <main class="content">
        <?= $v->section("content"); ?>
    </main>

    <script src="<?= url("/views/assets/js/jquery.js"); ?>"></script>

    <?= $v->section("js"); ?>
</body>
</html>