<?php
ob_start();
session_start();
if (!isset($_SESSION['emailAcad']) && (!isset($_SESSION['senhaAcad']))) {
    header("Location: index.php?acao=negado");
    exit;
}
include("models/conecta.php");
include("controllers/log/logout.php");

$emailLog = $_SESSION['emailAcad'];
$senhaLog = $_SESSION['senhaAcad'];
$isLogMed = isset($_SESSION['isMed']) ? true : false;

if ($isLogMed) {
    $selecionaLogadoMed = "SELECT * from medico WHERE email_med=:emailLog AND senha_med=:senhaLog";

    try {
        $resultMed = $conexao->prepare($selecionaLogadoMed);
        $resultMed->bindParam('emailLog', $emailLog, PDO::PARAM_STR);
        $resultMed->bindParam('senhaLog', $senhaLog, PDO::PARAM_STR);
        $resultMed->execute();
        $contar = $resultMed->rowCount();

        if ($contar = 1) {
            $loop = $resultMed->fetchAll();
            foreach ($loop as $show) {
                $idLog = $show['id_med'];
                $nomeLog = $show['nome_med'];
                $senhaLog = $show['senha_med'];
                $senhaLog = $show['senha_med'];
                $cpfLog = $show['cpf_med'];
                $imgLog = null;
                $interLog = null;
                $conheceuLog = null;
                $outroLog = null;
                $OutroInterLog = null;
            }
        }
    } catch (PDOException $erro) {
        echo  $erro;
    }

    return;
}

$selecionaLogado = "SELECT * from academico WHERE email_acad=:emailLog AND senha_acad=:senhaLog";

try {
    $result = $conexao->prepare($selecionaLogado);
    $result->bindParam('emailLog', $emailLog, PDO::PARAM_STR);
    $result->bindParam('senhaLog', $senhaLog, PDO::PARAM_STR);
    $result->execute();
    $contar = $result->rowCount();

    if ($contar = 1) {
        $loop = $result->fetchAll();
        foreach ($loop as $show) {
            $idLog = $show['id_acad'];
            $nomeLog = $show['nome_acad'];
            $emailLog = $show['email_acad'];
            $senhaLog = $show['senha_acad'];
            $senhaLog = $show['senha_acad'];
            $cpfLog = $show['cpf_acad'];
            $imgLog = $show['img_acad'];
            $interLog = $show['interesse_acad'];
            $conheceuLog = $show['conheceu_imp_acad'];
            $outroLog = $show['outro_conhe_acad'];
            $OutroInterLog = $show['outro_inter_acad'];
        }
    }
} catch (PDOException $erro) {
    echo $erro;
}

