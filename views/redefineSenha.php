<?php $this->layout("_theme", []); ?>

<div class="formulario">
    <form id="fmNovaSenha" method="get" action="<?= $router->route("Controller.redefineSenha");?>">
        <label>Digite o e-mail da sua conta para enviar uma nova senha!</label>
        <input type="email" name="txtEmail" id="txtEmail" value="">
        <p class="erro"></p>
        <button type="submit">Enviar</button>
    </form>
</div>

<?php $this->start("js"); ?>
<script>
    $(function(){
        var form = $("#fmNovaSenha");
        form.submit(function (e){
            var email = $("#txtEmail");
            var erro = $(".erro");

            erro.text("");
            e.preventDefault();

            if(email.val()==""){
                erro.text("digite o e-mail!");
                e.preventDefault();
                return;
            }
        });
    });
</script>
<?php $this->end(); ?>