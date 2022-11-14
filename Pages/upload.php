<head>
    <!-- include summernote css/js -->
    <link href="css/upload.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="summernote/summernote-bs4.css" rel="stylesheet">
    <script src="summernote/summernote-bs4.min.js"></script>
    <script src="summernote/lang/summernote-pt-BR.min.js"></script>
    <title>NYC - Upload</title>
</head>


<body>

    <?php
    include_once("php/banco.php");

    // Seleciona o conteúdo
    $sql = 'SELECT * FROM tb04_conteudos WHERE tb04_Id_Conteudo = ?';

    // Checa se é um professor logando, se não for mostra o erro 404
    if ($_SESSION["type"] == 2) {
        // echo "<h1>Acesso negado!</h1>";
        include_once("pages/manutencao.html");
        include_once("pages/topnav.php");
        die();
    }

    // Seleciona todas as matérias do banco
    $p = $banco->prepare("SELECT * FROM tb06_disciplinas");
    $p->execute();
    $materias = $p->fetchAll();

    // Seleciona todas as séries do banco
    $p = $banco->prepare("SELECT * FROM tb07_series");
    $p->execute();
    $series = $p->fetchAll();

    ?>
    <div class="container">
        <?php
        $p = $banco->prepare($sql);
        $p->execute([$_GET['id']]);
        $post = $p->fetchAll()[0];

        // Verifica se o usuario quer editar um post existente ou quer fazer um novo post
        if ($post == array())
            echo '<form id="postForm" action="PHP/postar.php" method="post">';
        else {
            echo '<form id="postForm" action="PHP/editar_post.php?id=' . $_GET['id'] . '" method="post">';
        }
        ?>

        <div style="text-align: center;">
            <?php
            if ($post == array())
                echo '<h1>Upload</h1>';
            else
                echo '<h1>Editar</h1>';
            ?>
            <div class="row">
                <div class="col-12">
                    <label class="input-span" style="width: 80px;">Título:</label>
                    <input id="titulo" name="titulo" class="input-text" type="text" required <?php echo 'value="' . $post['tb04_titulo'] . '"'; ?> placeholder="Escreva o título do post." style="width: calc(100% - 90px);">
                </div>
                <br><br><br>
            </div>
            <div class="row">
                <!------------------------- Materias ------------------------->
                <div class="col-md-6 col-sm-12">
                    <label class="input-span" style="width: 80px;" for="materia">Matéria:</label>
                    <select id="materia" name="materia" class="input-text" style="width: calc(100% - 90px);" required>
                        <option value="" disabled selected>Escolha a matéria</option>
                        <!--Placeholder-->
                        <?php
                        // Mostra todos as matérias cadastradas como opções
                        foreach ($materias as $materia) {
                            $selected = $post['tb04_materia'] == $materia['tb06_id_disciplina'] ? 'selected' : '';
                            echo '<option value=' . $materia['tb06_id_disciplina'] . " " . $selected . '>';
                            echo $materia['tb06_nome_disciplina'];
                            echo '</option>';
                        }
                        ?>
                    </select>
                </div>

                <br><br><br>
                <!------------------------------ Série ------------------------>
                <div class="col-md-6 col-sm-12">
                    <label class="input-span" style="width: 80px;" for='serie'>Série:</label>
                    <select id="serie" name="serie" class="input-text" style="width: calc(100% - 90px);" required>
                        <option value="" disabled selected>Escolha a série</option>
                        <!--Placeholder-->
                        <?php
                        // Mostra todos séries cadastradas como opções
                        foreach ($series as $serie) {
                            $selected = $post['tb04_serie'] == $serie['tb07_id_serie'] ? 'selected' : '';
                            echo '<option value=' . $serie['tb07_id_serie'] . " " . $selected . '>';
                            echo $serie['tb07_nome_serie'];
                            echo '</option>';
                        }
                        ?>
                    </select>
                </div>
                <br><br><br>
            </div>
        </div>
        <div class="row">
            <!----------------------------------- Campo do corpo do post --------------------------------->
            <div class="col-12">
                <textarea id="summernote" name="editordata" required><?php echo $post['tb04_descricao']; ?></textarea>
            </div>
        </div><br>

        <div class="row">
            <div class="col-sm-12 <?php echo $post == array() ? 'col-md-12' : 'col-md-6'; ?>" style="text-align: center;">
                <button type="submit">
                    <?php echo $post == array() ?
                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16"><path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/></svg> Postar' :
                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg> Editar';
                    ?>
                </button>
            </div>

            <!-- Mostar botão de 'voltar' apenas se tiver no modo de edição de post -->
            <div class="col-sm-12 col-md-6" style="text-align: center;<?php echo $post != array() ? '' : 'display: none;'; ?>">
                <a href="?page=conteudo&post=<?php echo $_GET['id']; ?>">
                    <button type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        Voltar
                    </button>
                </a>
            </div>
        </div>
        </form>
    </div>

    <script>
        // Carrega o summernote
        $(document).ready(function() {
            $('#summernote').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['fontname', ['fontname']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                lang: 'pt-BR',
                height: 400,
                minHeight: 400,
                maxHeight: 1000,
                focus: true
            });
            $('.dropdown-toggle').dropdown();
        });
    </script>
</body>