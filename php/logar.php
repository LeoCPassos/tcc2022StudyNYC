<?php

require('banco.php');

session_start();

try {

    if ($banco_info["connected"]) {
        $_POST['senha'] = md5($_POST['senha']);
        // Faz o select retornando apenas o usuario que tiver o login e a senha iguais aos inseridos
        $command = 'SELECT * FROM  tb01_usuario WHERE `tb01_login` = ? and `tb01_senha` = ?';
        // Prepara e depois executa o comando
        $stmt = $banco->prepare($command);
        $stmt->execute([$_POST['login'], $_POST['senha']]);
        // Coloca os valores retornados pelo banco na variavel "rows"
        $rows = $stmt->fetchAll();

        // Checa se for retornado algo
        if (isset($rows[0])) {   // Mostra na tela que o login foi realizado com sucesso
            echo '<script>alert("Login realizado com sucesso!")</script>';
            //header("Location: index.php");
            $_SESSION["logged"] = true;
            $_SESSION["id"] = $rows[0]["tb01_Id_Usuario"];
            $_SESSION['type'] = $rows[0]["tb01_Id_Tipos"];

            // exit();
        } else {
            // Mostra na tela que o login não foi possível
            $_SESSION['loginFalha'] = true;
        }
    }
} catch (PDOException $ex) {
    echo $ex;
}

// Volta para o index
header("Location: ../?page=inicio");
exit();
