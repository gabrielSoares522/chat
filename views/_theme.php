<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHAT</title>

    <link rel="stylesheet" href="<?= url("/views/assets/css/style.css"); ?>">
</head>
<body>
    <main class="content">
        <?= $this->section("content"); ?>
    </main>

    <script src="<?= url("/views/assets/jquery.js"); ?>"></script>

    <?= $this->section("js"); ?>
</body>
</html>