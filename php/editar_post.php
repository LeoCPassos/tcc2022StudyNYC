<?php

require('banco.php');

try {
    if ($banco_info["connected"]) {
        // Comando de inserção dos conteudos
        $sql = 'UPDATE `tb04_conteudos` SET
        tb04_titulo = ?,
        tb04_materia = ?,
        tb04_serie = ?,
        tb04_descricao = ?
        WHERE tb04_Id_Conteudo = ?';

        // foreach ($_POST as $elemento) {
        //     print $elemento . "<br>";
        // }

        // Prepara e executa o comando
        $p = $banco->prepare($sql);
        $p->execute(
            [
                $_POST['titulo'],
                $_POST['materia'],
                $_POST['serie'],
                $_POST['editordata'],
                $_GET['id']
            ]
        );
        // echo mysqli_error();
    } else {
        echo "Falha ao inserir";
    }
} catch (PDOException $ex) {
    echo "Não foi possível conectar D:";
    echo $ex;
    die();
}

// Volta para a tela de upload
header("Location: ../?page=conteudo&post=" . $_GET['id']);
