

<?php

$banco_info = array(
    "user" => "root",
    "pass" => "usbw",
    "host" => "localhost",
    "dbname" => "tcc_studynyc",
    "connected" => false
);

try {
    // Conecta no banco
    $banco = new PDO(
        "mysql:host=" . $banco_info["host"] . "; dbname=" . $banco_info["dbname"],
        $banco_info["user"],
        $banco_info["pass"],
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );

    $banco_info["connected"] = true;
} catch (PDOException $ex) {
    echo "Não foi possível conectar <br>" . $ex;
    die();
}

?>