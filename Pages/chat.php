<head>
    <link rel="stylesheet" href="css/chat.css">
    <title>NYC - Chat</title>
</head>

<?php

include_once 'php/banco.php';
session_start();

// Seleciona os contatos
$cmd = 'SELECT tb01_nome, tb01_Id_Tipos, tb01_Id_Usuario
    FROM  tb01_usuario
    WHERE NOT `tb01_Id_Usuario` = ?
    ORDER BY tb01_nome
';
// Executa o comando
$stmt = $banco->prepare($cmd);
$stmt->execute([$_SESSION['id']]);
// Coloca os valores retornados pelo banco na variavel "rows"
$perfil = $stmt->fetchAll();

?>

<div class="container" style="text-align: center;">
    <div class="row">

    <!------------------------------------ Lista de contatos------------------------------------- -->
        <div class="col-sm-12 col-md-4">
            <input type="search" class="input-search-contatos">
            <div class="contatos-lista" style="height: 70vh;">
                <?php
                // Mostra na tela todos os contatos na lista
                foreach ($perfil as $k) {
                    // Checa se o perfil é um professor ou não
                    $prof = $k['tb01_Id_Tipos'] == 1 ? '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mortarboard-fill" viewBox="0 0 16 16"><path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/><path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/></svg>' : '';
                    
                    // Seleciona a última mensagem enviada ou recebida desse perfil
                    $p = $banco->prepare('SELECT * FROM tb05_mensagem 
                    WHERE
                    (tb05_remetente = ? AND tb05_destinatario = ?) OR
                    (tb05_destinatario = ? AND tb05_remetente = ?)
                    ORDER BY tb05_id_mensagem DESC LIMIT 1');
                    $p->execute(
                        [
                            $_SESSION['id'], $k['tb01_Id_Usuario'],
                            $_SESSION['id'], $k['tb01_Id_Usuario']
                        ]
                    );
                    $ultimaMensagem = $p->fetchAll()[0];
                    
                    // Adiciona o ícone de remetente caso a última mensagem seja do usuario logado
                    $a = $ultimaMensagem['tb05_remetente'] == $_SESSION['id'] ? '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16"><path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/></svg> ' : "";
                    
                    // Mostra na lista de contatos o perfil e a última mensagem
                    print('
                    <a class="contato-link" href="?page=chat&contato=' . $k['tb01_Id_Usuario'] . '">
                        <div class="contato">
                            <img src="img/user/icon.png" style="filter: none; background: var(--secundary-bgcolor);">
                            <div class="row text-truncate">
                                <label>' . $k['tb01_nome'] . " " . $prof . '</label>
                            </div>
                            <div class="row" class="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <label class="contato-mensagem">' . $a . $ultimaMensagem['tb05_mensagem'] . '</label>
                            </div>
                        </div>
                    </a>');
                }
                ?>

            </div>
        </div>

        <!------------------------------------------ Chat ---------------------------------------->
        <div class="col-8 ">
            <div id="chat" style="height: 70vh;" class="chat">
                <?php

                $remetente = $_SESSION['id'];
                $destinatario = $_GET["contato"];

                // Comando para pegar o nome do contato selecionado
                $cmd = 'SELECT tb01_nome FROM tb01_usuario where tb01_Id_Usuario = ?';
                // Prepara e executa o comando
                $stmt = $banco->prepare($cmd);
                $stmt->execute([$destinatario]);
                // Pega o valor retornado pelo comando
                $destinatarioNome = $stmt->fetchAll();

                // Checa se foi selecionado um contato
                if (!isset($_GET['contato']) || $_GET['contato'] == "" || $destinatarioNome[0]["tb01_nome"] == "") {
                    echo "<h1>Selecione um contato.</h1>";
                    if (isset($_SESSION['semContato']))
                    {
                        unset($_SESSION['semContato']);
                        echo '<div class="errorBox"';
                        echo '<p style="color: white;">Não há um contato selecionado.</p>';
                        echo '</div>';
                    }
                } else {
                    // Comando para selecionar as mensagens do contato selecionado
                    $cmd = 'SELECT *
                        FROM tb05_mensagem
                        WHERE 
                        tb05_remetente = ? AND tb05_destinatario = ? OR
                        tb05_remetente = ? AND tb05_destinatario = ?
                    ';
                    // Prepara e executa o comando
                    $stmt = $banco->prepare($cmd);
                    $stmt->execute([
                        $remetente, $destinatario,
                        $destinatario, $remetente
                    ]);
                    // Pega as mensagens retornadas pelo comando
                    $mensagens = $stmt->fetchAll();

                    if ($mensagens != array()) {
                        // Mostra o todas as mensagens enviadas e recebidas pelo contato selecionado
                        foreach ($mensagens as $k) {
                            // Checa se a mensagem é do destinatário
                            if ($k["tb05_destinatario"] == $destinatario) {
                                echo '
                            <div class="row">
                            <div class="col-12">
                            <div class="message sender">
                            <p>' . $k["tb05_mensagem"] . '</p>
                            </div>
                            </div>
                            </div>  
                            ';
                                // Checa se a mensagem é do remetente
                            } else {
                                echo '
                            <div class="row">
                            <div class="col-12">
                            <div class="message recipient">
                            <p>' . $k["tb05_mensagem"] . '</p>
                            </div>
                            </div>
                            </div>  
                            ';
                            }
                        }
                    } else {
                        echo "<h1>Nenhuma mensagem.</h1>";
                    }
                    // Comando para pegar o nome do contato selecionado
                    $cmd = 'SELECT tb01_nome, tb01_Id_Tipos FROM tb01_usuario where tb01_Id_Usuario = ?';
                    // Prepara e executa o comando
                    $stmt = $banco->prepare($cmd);
                    $stmt->execute([$destinatario]);
                    // Pega o valor retornado pelo comando
                    $destinatarioNome = $stmt->fetchAll()[0];
                    // Mostra na tela o nome do contato selecionado
                    $prof = $destinatarioNome['tb01_Id_Tipos'] == 1 ? '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mortarboard-fill" viewBox="0 0 16 16"><path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/><path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/></svg>' : '';
                    echo '<div class="contato-selecionado">' . $destinatarioNome["tb01_nome"] . " " . $prof . '</div>';
                }
                ?>
            </div>
            <div class="input-message-div">
                <form action="php/enviar_mensagem.php?destinatario=<?php echo $destinatario; ?>" method="post">
                    <input name="mensagem" id="input-message" type="text" class="input-text input-message noTag" autocomplete="off" required>
                    <!-- <input type="submit" class="send-message" value='>>'> -->
                    <button type="submit" class="send-message" style="width: 60px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>


    <script>
        // Da scroll para a mensagem mais recente ao abrir o chat
        try {
            var chat = document.getElementById("chat").childNodes;
            chat[chat.length - 4].scrollIntoView();
        } catch (ex) {

        }
    </script>
</div>