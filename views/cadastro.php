<?php $v->layout("_theme", []); ?>

<div class="form_cadastro">
    <form id="fmCadastro" method="post" action="<?= $router->route("Controller.criarConta"); ?>" enctype="multipart/form-data">
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
        <p class="erro"></p>
        <input type="submit" id="btnCadastrar" name="btnCadastrar" value="Cadastrar">
    </form>
    <input type="hidden" name="linkLogin" id="linkLogin" value = "<?= $router->route("Controller.login"); ?>">
</div>

<?php $v->start("js"); ?>
<script>
    $(function(){
        var form = $("#fmCadastro");
        form.submit(function (e){
            var erro = $(".erro");
            var txtLogin = $("#txtLogin");
            var txtEmail = $("#txtEmail");
            var txtSenha = $("#txtSenha");
            var txtRepSenha = $("#txtRepSenha");
            var txtFtPerfil = $("#fotoPerfil");
            
            erro.text("");
            e.preventDefault();

            if(txtLogin.val() =="") {
                erro.text("preencha o campo login");
                return;
            }
            
            if(txtEmail.val() =="") {
                erro.text("preencha o campo email");
                return;
            }
            
            if(txtSenha.val() =="") {
                erro.text("preencha o campo senha");
                return;
            }
            if(txtRepSenha.val() =="") {
                erro.text("preencha o campo repetir senha");
                return;
            }

            if(txtSenha.val() != txtRepSenha.val()) {
                txtSenha.val("");
                txtRepSenha.val("");
                erro.text("senha digitada de forma incorreta");
                return;
            }

            $.ajax({
                url: form.attr("action"),
                data: new FormData(form[0]),
                type: "POST",
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function(callback){
                    console.log("recebido");
                    if(callback.erro){
                        erro.text(callback.erro);
                        console.log("erro");
                    }
                    if(callback.cadastrado){
                        console.log("cadastrado");
                        var telaLogin = $("#linkLogin").val();
                        $(location).attr('href',telaLogin);
                    }
                }
            });
        });
    });
</script>
<?php $v->end(); ?>