<?php $v->layout("_theme", []); ?>

<div class ="banner_inicial">
</div>
<div class="form_login">
    <form method="post" action="<?= $router->route("Controller.chat"); ?>">
        <input type="text" name="txtLogin" id="txtLogin" placeholder="digite seu login"><br>
        <input type="password" name="txtSenha" id="txtSenha" placeholder="digite sua senha"><br>
        <input type="submit" name="btnEntrar" id="btnEntrar" value="Entrar">
    </form>
    <p>Não tem uma conta? <a href = "<?= $router->route("Controller.cadastro"); ?>">Cadastre-se</a></p>
</div>

<?php $v->start("js"); ?>
<script>

</script>
<?php $v->end(); ?>