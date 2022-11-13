<?php


include_once('php/banco.php');

$sql = 'SELECT *, tb06_nome_disciplina, tb07_nome_serie
FROM tb04_conteudos
INNER JOIN tb06_disciplinas ON  tb06_id_disciplina = tb04_materia 
INNER JOIN tb07_series ON tb04_serie = tb07_id_serie
WHERE tb04_Id_Conteudo = ?';
$p = $banco->prepare($sql);
$p->execute([$_GET['post']]);
$conteudo = $p->fetchAll()[0];

if ($_GET['post'] == '' || $conteudo == array()) {
    // echo '
    // <title>NYC</title>
    // <div class="container">
    //     <div class="row">
    //         <div class="col-12">
    //             <h1>Essa página não existe!</h1>
    //         </div>
    //     </div>
    // </div>
    // ';
    include_once('manutencao.html');
    include_once('topnav.php');
    die();
}


?>

<head>
    <title>NYC - <?php echo $conteudo['tb04_titulo']; ?></title>
</head>

<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="?page=conteudo#<?php echo $conteudo["tb06_nome_disciplina"]; ?>">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
                    </svg>
                    Voltar
                </button>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h1>
                <?php echo $conteudo['tb04_titulo']; ?>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-12">
        </div>
        <div class="col-md-4 col-sm-12">
            <h4>Matéria: <?php echo $conteudo['tb06_nome_disciplina']; ?></h4>
        </div>

        <div class="col-md-2 col-sm-12">
            <h4><?php echo $conteudo['tb07_nome_serie']; ?></h4>
        </div>
    </div>


    <?php
    if ($_SESSION['type'] == 1) {
        echo '<div class="row">';
        echo '<div class="col">';
        echo '<a href="?page=upload&id=' . $conteudo['tb04_Id_Conteudo'] . '"><button><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
    </svg> Editar</button></a>';
        echo '</div>';
        echo '<div class="col">';
        echo '<button data-toggle="modal" data-target="#modalExcluirPost"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
      </svg> Excluir</button>';
        echo '</div>';
        echo '</div>';
    }
    ?>

    <div class="row" style="margin-top: 20px;margin-bottom: 60px;">
        <div class="col-md-12 text-break">
            <div class='descricao'>
                <?php echo $conteudo['tb04_descricao']; ?>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalExcluirPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: black !important;">Deletar post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="color: black !important;">
                    Tem certeza que deseja excluir o post?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    <?php echo $_SESSION['type'] == 1 ? '<a href="php/deletar_post.php?id=' . $conteudo['tb04_Id_Conteudo'] . '">' : ""; ?>
                    <button type="button" class="btn btn-success">Sim</button>
                    <?php echo $_SESSION['type'] == 1 ? '</a>' : ""; ?>
                </div>
            </div>
        </div>
    </div>
</div>