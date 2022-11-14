<?php

require('banco.php');

session_start();

try {
    if ($banco_info["connected"]) {
        // Comando de inserção dos conteudos
        $sql = 'INSERT INTO tb04_conteudos VALUES (NULL, ?, ?, ?, ?, ?)';

        // Prepara e executa o comando
        $banco->prepare($sql)->execute(
            [
                $_POST["titulo"],
                $_POST["materia"],
                $_POST["serie"],
                $_POST["editordata"],
                $_SESSION['id']
            ]
        );
    } else {
        echo "Falha ao inserir";
    }
} catch (PDOException $ex) {
    echo "Não foi possível conectar D:";
    echo $ex;
    die();
}

// Volta para a tela de upload
header("Location: ../?page=upload");
