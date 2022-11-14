<?php

include_once "banco.php";

try {
    if ($banco_info["connected"]) {
        $command = 'INSERT INTO tb05_mensagem VALUES(?, ?, NULL, ?)';
        session_start();
        
        $remetente = $_SESSION['id'];
        $destinatario = $_GET['destinatario'];

        // Se o nome tiver livre, insere o cadastro no banco
        $banco->prepare($command)->execute(
            [
                $remetente,
                $destinatario,
                $_POST['mensagem']
            ]
        );
    }
} catch (PDOException $ex) {
    echo "Não foi possível conectar D:";
    echo $ex;
    die();
}

// Volta para a tela de cadastro
if ($destinatario == ""){
    header("Location: ../?page=chat");
    $_SESSION['semContato'] = true;
}
else
    header("Location: ../?page=chat&contato=" . $destinatario);
