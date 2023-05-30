<?php

ob_start();
session_start();
if(!isset($_SESSION['usuariowva']) && (!isset($_SESSION['senhawva']))){
    header("Location: index.php?acao=negado");exit;
}
    include("models/conecta.php");
    include("controllers/log/logout.php");
    
    $usuarioLogado = $_SESSION['usuariowva'];
    $senhaLogado = $_SESSION['senhawva'];
    
// seleciona a usuario logado
        $selecionaLogado = "SELECT * from login WHERE usuario=:usuarioLogado AND senha=:senhaLogado";
        try{
            $result = $conexao->prepare($selecionaLogado);  
            $result->bindParam('usuarioLogado',$usuarioLogado, PDO::PARAM_STR);     
            $result->bindParam('senhaLogado',$senhaLogado, PDO::PARAM_STR);     
            $result->execute();
            $contar = $result->rowCount();  
            
            if($contar =1){
                $loop = $result->fetchAll();
                foreach ($loop as $show){
                    $idLogado = $show['id'];
                    $nomeLogado = $show['nome'];
                    $userLogado = $show['usuario'];
                    $senhaLogado = $show['senha'];
                    //$nivelLogado = $show['nivel'];
                    $emailLogado = $show['email'];
                    $imgLogado = $show['img'];
                    
                }
            }
            
            }catch (PDOException $erro){ echo $erro;}
    
?>