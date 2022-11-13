<?php

require('banco.php');

session_start();

try {
    if ($banco_info["connected"]) {
        if ($_SESSION['type'] == 1) {
            // Comando de inserção dos conteudos
            $sql = 'DELETE FROM tb04_conteudos WHERE tb04_Id_Conteudo = ?';

            // Prepara e executa o comando
            $p = $banco->prepare($sql);
            $p->execute([$_GET['id']]);
            // echo mysqli_error();
            
        } else {
            echo "Falha ao inserir";
        }
    }
} catch (PDOException $ex) {
    echo "Não foi possível conectar D:";
    echo $ex;
    die();
}

// Volta para a tela de upload
header("Location: ../?page=conteudo");
