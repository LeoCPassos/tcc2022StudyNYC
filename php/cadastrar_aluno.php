<?php

include_once("banco.php");
session_start();

try {
    if ($banco_info["connected"]) {
        // Prepara e executa o comando
        $cmd = 'SELECT * FROM tb01_usuario WHERE tb01_login = ?';
        // Executa o comando
        $stmt = $banco->prepare($cmd);
        $stmt->execute([$_POST['login']]);
        // Coloca os valores retornados pelo banco na variavel "rows"
        $perfil = $stmt->fetchAll();

        print_r($perfil);
        echo '<br>';
        print_r($_POST);
        echo '<br>';

        if ($_POST['senha'] == $_POST['confirmsenha']) {
            // Checa se a o username já foi utilizado
            if ($perfil == array()) {
                // Se o nome tiver livre, insere o cadastro no banco
                $banco->prepare('INSERT INTO tb01_usuario VALUES (NULL, 2, ?, ?, ?)')->execute(
                    [
                        $_POST["login"],
                        md5($_POST["senha"]),
                        $_POST["nome"]
                    ]
                );
                $_SESSION['cadastroSucesso'] = true;
                header("Location: ../?cadastro");
            } else {
                // Erro
                $_SESSION['cadastroErro'] = true;
                header("Location: ../?cadastro");
            };
        } else {
            $_SESSION['senhaErro'] = true;
            header("Location: ../?cadastro");
        }
    }
} catch (PDOException $ex) {
    echo "Não foi possível conectar D:";
    echo $ex;
    die();
}

// Volta para a tela de cadastro
// header("Location: ../");
