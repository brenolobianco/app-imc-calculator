<?php

    if(isset($_POST['cadastrar'])){
        $id_vid_aula   = trim(strip_tags($_POST["id_vid_aula"])); 
        $pergunta  = $_POST["pergunta"];
        $alternativa_a  = $_POST["alternativa_a"];
        $alternativa_b  = (isset($_POST["alternativa_b"])) ?  $_POST["alternativa_b"]: null;
        $alternativa_c  = (isset($_POST["alternativa_c"])) ?  $_POST["alternativa_c"]: null;
        $alternativa_d  = (isset($_POST["alternativa_d"])) ?  $_POST["alternativa_d"]: null;
        $alternativa_e  = (isset($_POST["alternativa_e"])) ?  $_POST["alternativa_e"]: null;
        $correta  = $_POST["alternativa_correta"];              

        $insert = "INSERT INTO treinamento_pre_teste 
        (id_vid_aula, pergunta, alternativa_a, alternativa_b, alternativa_c, alternativa_d, alternativa_e, alternativa_correta) 
        VALUES ( :id_vid_aula, :pergunta, :alternativa_a, :alternativa_b, :alternativa_c, :alternativa_d, :alternativa_e, :alternativa_correta)";
        try{
            $result = $conexao->prepare($insert);
            $result ->bindParam(':id_vid_aula',$id_vid_aula, PDO::PARAM_INT);
            $result ->bindParam(':pergunta',$pergunta, PDO::PARAM_STR);
            $result ->bindParam(':alternativa_a',$alternativa_a, PDO::PARAM_STR);
            $result ->bindParam(':alternativa_b',$alternativa_b, PDO::PARAM_STR);
            $result ->bindParam(':alternativa_c',$alternativa_c, PDO::PARAM_STR);
            $result ->bindParam(':alternativa_d',$alternativa_d, PDO::PARAM_STR);
            $result ->bindParam(':alternativa_e',$alternativa_e, PDO::PARAM_STR);
            $result ->bindParam(':alternativa_correta',$correta, PDO::PARAM_STR);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Inserido com Sucesso!</strong> 
                </div>'; 
            // header("Refresh: 1, home.php?acao=novo-quiz");
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