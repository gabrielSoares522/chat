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
        <?php
            for($i=0;$i<5;$i++):
                $v->insert("contato",["nome"=>"Nome","conversa"=>1]);
            endfor;
        ?>
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
            <input type="hidden" name="hdConversa" id="hdConversa">
            <input type="text" name="txtMsg" id="txtMsg">
            <button>Enviar</button>
        </form>
    </div>
</div>

<?php $v->start("js"); ?>
<script>
    $(function(){
        
    });
    function seleContato(btn){
        var chat = document.getElementById("chat");
        var conversa = document.getElementById("hdConversa");

        chat.style = "display: block";
        conversa.value = btn.value;
        var corpo = document.getElementById("corpo_chat");
        corpo.scrollTop = corpo.scrollHeight;
    }
</script>
<?php $v->end(); ?>