<?php

include_once 'php/banco.php';

// Faz o select retornando apenas o usuario que tiver o login e a senha iguais aos inseridos
$cmd = 'SELECT tb01_nome, tb01_Id_Tipos FROM  tb01_usuario where `tb01_Id_Usuario` = ?';
// Executa o comando
$stmt = $banco->prepare($cmd);
$stmt->execute([$_SESSION['id']]);
// Coloca os valores retornados pelo banco na variavel "rows"
$perfil = $stmt->fetchAll();

?>

<?php
if (!$_SESSION["logged"]) {
    echo "<h1>Não é possível Acessar esta página!</h1>";
    die();
}
?>

<head>
    <title>NYC - <?php echo $perfil[0]['tb01_nome']; ?></title>
    <link href="css/perfil.css" rel="stylesheet">
</head>

<div class="container" style="text-align: justify;">
    <div class="row">
        <div class="col-sm-12 col-md-auto">
            <img class="pfpIcon" src="img/user/icon.png" style="filter: none; background: var(--secundary-bgcolor);">
            <div class="row">
                <div class="col-auto">
                    <a id="linkEditPerfil">Editar perfil</a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <label id="lblNomeAluno"><?php echo $perfil[0]['tb01_nome']; ?></label>
            <div class="row">
                <!--<label id="lblRNA">RNA</label>-->
            </div>
        </div>

        <div class="col-sm-12 col-md-4">
            <div class="row"><br><br><br></div>

            <div class="row">
                <div class="col">
                    <a id="sair" href="php/logout.php" alt="Deslogar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                            <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z" />
                        </svg> Sair
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                    </svg>
                    <label>Configurações</label>
                </div>
            </div>

        </div>
    </div>

</div>