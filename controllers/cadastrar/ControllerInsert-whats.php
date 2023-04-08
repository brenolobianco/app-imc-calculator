<?php

    if(isset($_POST['cadastrar'])){
        $nome_acad  = trim(strip_tags($_POST["nome_acad"])); 
        $email_acad = trim(strip_tags($_POST["email_acad"]));
        $senha_acad = trim(strip_tags($_POST["senha_acad"]));              
        $cpf_acad   = trim(strip_tags($_POST["cpf_acad"]));
        $whats_acad   = trim(strip_tags($_POST["whats_acad"]));
        $data_nasc_acad = trim(strip_tags($_POST["data_nasc_acad"]));
        $data_cad_acad = trim(strip_tags($_POST["data_cad_acad"]));
        $periodo_acad   = trim(strip_tags($_POST["periodo_acad"]));
        $univ_imp_acad  = trim(strip_tags($_POST["univ_imp_acad"]));
        $link_cv_lates_acad = $_POST["link_cv_lates_acad"];
 

        $insert = "INSERT into academico ( nome_acad, email_acad, senha_acad, 
        cpf_acad, whats_acad, data_nasc_acad, data_cad_acad, periodo_acad, univ_imp_acad, link_cv_lates_acad
        /*,conheceu_imp_acad, outro_conhe_acad, busca_imp_acad, busca_mais_acad*/ ) 
        VALUES ( :nome_acad, :email_acad, :senha_acad,
        :cpf_acad, :whats_acad, :data_nasc_acad, :data_cad_acad, :periodo_acad, :univ_imp_acad, :link_cv_lates_acad
        /*,:conheceu_imp_acad, :outro_conhe_acad, :busca_imp_acad, :busca_mais_acad*/ )";  

        try{
            $result = $conexao->prepare($insert);
            $result ->bindParam(':nome_acad',$nome_acad, PDO::PARAM_STR);
            $result ->bindParam(':email_acad',$email_acad, PDO::PARAM_STR);
            $result ->bindParam(':senha_acad',$senha_acad, PDO::PARAM_STR);
            $result ->bindParam(':cpf_acad',$cpf_acad, PDO::PARAM_STR);
            $result ->bindParam(':whats_acad',$whats_acad, PDO::PARAM_STR);
            $result ->bindParam(':data_nasc_acad',$data_nasc_acad, PDO::PARAM_STR);
            $result ->bindParam(':data_cad_acad',$data_cad_acad, PDO::PARAM_STR);
            $result ->bindParam(':periodo_acad',$periodo_acad, PDO::PARAM_STR);
            $result ->bindParam(':univ_imp_acad',$univ_imp_acad, PDO::PARAM_STR);
            $result ->bindParam(':link_cv_lates_acad',$link_cv_lates_acad, PDO::PARAM_STR);
     

            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<br />
            <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong> Cadastrado com Sucesso!</strong> 
            </div>'; 
            header("Refresh: 1, saudacoes.php");
        }else{
            echo '<br />
            <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Não foi efetuado de forma correta!</strong> 
            </div>';
        }
        
        }catch(PDOException $e){
            echo '<br />
            <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Este CPF já está cadastrada!</strong> 
            </div>';
        }                           

    }
    
?>