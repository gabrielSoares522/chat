<?php $v->layout("_theme", []); ?>

<div class="formulario">
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
        <img id = "mostraFoto" src="#" alt=""/>
        <p class="erro"></p>
        <input type="submit" id="btnCadastrar" name="btnCadastrar" value="Cadastrar">
    </form>
    <input type="hidden" name="linkLogin" id="linkLogin" value = "<?= $router->route("Controller.login"); ?>">
</div>

<?php $v->start("js"); ?>
<script>
    $(function(){
        var txtFtPerfil = $("#fotoPerfil");
        var mostraFoto = $("#mostraFoto");
        var form = $("#fmCadastro");
        var txtLogin = $("#txtLogin");
        var txtEmail = $("#txtEmail");
        var txtSenha = $("#txtSenha");
        var txtRepSenha = $("#txtRepSenha");
        var blob;

        function teste() {
            txtLogin.val("solange");
            txtEmail.val("solange@gmail.com");
            txtSenha.val("1234");
            txtRepSenha.val("1234");
        }
        
        txtFtPerfil.change(function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    mostraFoto.attr('src', e.target.result);
                    blob = e.target.result;
                    console.log(e.target);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });

        form.submit(function (e){
            teste();

            var erro = $(".erro");
                        
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

            var dados = {
                txtLogin: txtLogin.val(),
                txtEmail: txtEmail.val(),
                txtSenha: txtSenha.val(),
                fotoPerfil: blob,
                fotoNome:"aaa.png"
            };

            console.log(dados);
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