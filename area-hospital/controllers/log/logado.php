<?php
ob_start();
session_start();
if(!isset($_SESSION['emailHosp']) && (!isset($_SESSION['senhaHosp']))){
    header("Location: index.php?acao=negado");exit;
}
    include("models/conecta.php");
    include("controllers/log/logout.php");
    
    $emailLog = $_SESSION['emailHosp'];
    $senhaLog = $_SESSION['senhaHosp'];
    
// seleciona a usuario logado
        $selecionaLogado = "SELECT * from hospital WHERE email_hosp=:emailLog AND senha_hosp=:senhaLog";
        try{
            $result = $conexao->prepare($selecionaLogado);  
            $result->bindParam('emailLog',$emailLog, PDO::PARAM_STR);     
            $result->bindParam('senhaLog',$senhaLog, PDO::PARAM_STR);     
            $result->execute();
            $contar = $result->rowCount();  
            
            if($contar =1){
                $loop = $result->fetchAll();
                foreach ($loop as $show){
                    $idLog = $show['id_hosp'];
                    $nomeLog = $show['nome_hosp'];
                    $emailLog = $show['email_hosp'];
                    $senhaLog = $show['senha_hosp'];
                    $imgLog = $show['img_hosp'];
                    
                }
            }
            
            }catch (PDOException $erro){ echo $erro;}
    
?>