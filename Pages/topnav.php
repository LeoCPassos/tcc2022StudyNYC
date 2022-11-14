<head>
    <script type="text/javascript" src="js/responsive_topnav.js"></script>
</head>

<div class="topnav" id="topnav">
    <div class="hMenu btnMenu" onclick="menuAnimate(this);setResponsive();">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>
    <a id="icon" href="?page=inicio"><img src="img/NYC_Logo.jpg" alt="Inicio"></a>
    <a id="navbarHome" class="<?php echo ($_GET['page'] == 'inicio' ? 'active' : ''); ?>" href="?page=inicio">Inicio</a>
    <a id="navbarPerfil" class="<?php echo ($_GET['page'] == 'perfil' ? 'active' : ''); ?>" href="?page=perfil"">Perfil</a>
    <a id="navbarConteudo" class="<?php echo ($_GET['page'] == 'conteudo' ? 'active' : ''); ?>" href="?page=conteudo">Conteúdo</a>
    <a id="navbarChat" class="<?php echo ($_GET['page'] == 'chat' ? 'active' : ''); ?>" href="?page=chat">Chat</a>

    <?php
    $uploadActive = $_GET["page"] == "upload" ? "active" : "";
    // Mostrar o botão de upload apenas para professores/administradores
    if ($_SESSION['type'] == 1)
        echo '<a id="navbarUpload" class="' . $uploadActive . '" href="?page=upload">Upload</a>';

    ?>
    <a id="search"><input id="seachbar" type="search" class="input-search"></a>
</div>