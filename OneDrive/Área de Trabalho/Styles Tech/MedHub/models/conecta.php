<?php
try {
    $conexao = new PDO('mysql:host=localhost;port=3306;dbname=medhub', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro:' . $e->getMessage();
}
?>
