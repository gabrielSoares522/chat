<?php $v->layout("_theme", []); ?>

<div class="form_cadastro">
    <form method="get" action="<?= $router->route("Controller.login"); ?>">
        <label for="txtLogin">Login</label>
        <input type="text" name="txtLogin" id="txtLogin">
        <label for="txtEmail">Email</label>
        <input type="email" name="txtEmail" id="txtEmail">
        <label for="txtSenha">Senha</label>
        <input type="password" name="txtSenha" id="txtSenha">
        <label for="txtRepSenha">Repetir Senha</label>
        <input type="password" name="txtRepSenha" id="txtRepSenha">
        <label>Foto de perfil</label>
        <input type="file" name="fotoPerfil" id="fotoPerfil" accept="image/*">
        <input type="submit" id="btnCadastrar" name="btnCadastrar" value="Cadastrar">
    </form>
</div>

<?php $v->start("js"); ?>
<script>

</script>
<?php $v->end(); ?>