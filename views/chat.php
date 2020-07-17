<?php $v->layout("_theme", []); ?>

<div>
    <a href = "<?= $router->route("Controller.login"); ?>">Sair</a>
</div>

<?php $v->start("js"); ?>
<script>

</script>
<?php $v->end(); ?>