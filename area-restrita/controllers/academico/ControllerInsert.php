<?php

    if(isset($_POST['cadastrar'])){
        $nome_acad   = trim(strip_tags($_POST["nome_acad"])); 
        $email_acad   = trim(strip_tags($_POST["email_acad"]));
        $senha_acad   = trim(strip_tags($_POST["senha_acad"]));              


            $insert = "INSERT into academico ( nome_acad, email_acad, senha_acad ) 
            VALUES ( :nome_acad, :email_acad, :senha_acad )";  
        try{
            $result = $conexao->prepare($insert);
            $result ->bindParam(':nome_acad',$nome_acad, PDO::PARAM_STR);
            $result ->bindParam(':email_acad',$email_acad, PDO::PARAM_STR);
            $result ->bindParam(':senha_acad',$senha_acad, PDO::PARAM_STR);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Inserido com Sucesso!</strong> 
                </div>'; 
                header("Refresh: 1, home.php?acao=academicos");
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