<?php $v->layout("_theme", []); ?>

<div id="info_usuario">
    <div id="nome_usuario">
        <p>Nome</p>
        <div class="dropdown">
            <span>Menu</span>
            <div class="dropdown-content">
                <a href = "<?= $router->route("Controller.login"); ?>">Sair</a>
            </div>
        </div>
    </div>
    <div id="lista_contatos">
        <ul>
        <?php
            for($i=0;$i<5;$i++):
                $v->insert("contato",["nome"=>"Nome","conversa"=>1]);
            endfor;
        ?>
        </ul>
    </div>
</div>
<div id="chat">
    <div id="cabecalho_chat">
        <p>Contato</p>
    </div>
    <div id="corpo_chat">
        <ul>
        <?php
            for($i=0;$i<14;$i++):
                $tipo =($i%2)?"recebida":"enviada";
                $v->insert("mensagem",["tipo"=>$tipo,"texto"=>"teste"]);
            endfor;
        ?>
        </ul>
    </div>
    <div id="form_mensagem">
        <form method="post" action = "">
            <input type="text" name="txtMsg" id="txtMsg">
            <button>Enviar</button>
        </form>
    </div>
</div>

<?php $v->start("js"); ?>
<script>
    var objDiv = document.getElementById("corpo_chat");
    objDiv.scrollTop = objDiv.scrollHeight;
    $(function(){
        
    });
</script>
<?php $v->end(); ?>