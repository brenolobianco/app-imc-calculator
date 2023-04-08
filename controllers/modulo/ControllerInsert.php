<?php

    if(isset($_POST['cadastrar'])){
        $nome_mod  = trim(strip_tags($_POST["nome_mod"])); 
        $desc_mod  = $_POST["desc_mod"];  

            $insert = "INSERT into modulo ( nome_mod, desc_mod ) 
            VALUES ( :nome_mod, :desc_mod )";  
        try{
            $result = $conexao->prepare($insert);
            $result ->bindParam(':nome_mod',$nome_mod, PDO::PARAM_STR);
            $result ->bindParam(':desc_mod',$desc_mod, PDO::PARAM_STR);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Inserido com Sucesso!</strong> 
                </div>';
                header("Refresh: 1, home.php?acao=modulos"); 
        }else{
            echo '<div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> O Conteúdo não foi inserido de forma correta!</strong> 
                </div>';
        }
        
        }catch(PDOException $e){
            echo $e;
        }                           

    }
    
?>