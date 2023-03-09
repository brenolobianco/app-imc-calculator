<?php

    if(isset($_POST['cadastrar'])){
        $nome_aula   = trim(strip_tags($_POST["nome_aula"]));
        $desc_aula   = trim(strip_tags($_POST["desc_aula"])); 
        $curso_id_aula  = trim(strip_tags($_POST["curso_id_aula"]));   
        $mod_id_aula  = trim(strip_tags($_POST["mod_id_aula"]));  
        $est_id_aula  = trim(strip_tags($_POST["est_id_aula"]));
        $prof_id_aula  = trim(strip_tags($_POST["prof_id_aula"]));
        $cronograma_semanas = trim(strip_tags($_POST["cronograma_semanas"]));;
        
        $est_id_aula_treinamento  = $_POST["est_id_aula_treinamento"];
        $treinamento = null;
        if($est_id_aula_treinamento) {
            $est_id_aula = $est_id_aula_treinamento;
            $treinamento = "sim";
        }

        $insert = "INSERT into aula ( nome_aula, desc_aula, curso_id_aula, mod_id_aula, est_id_aula, prof_id_aula ) 
        VALUES ( :nome_aula, :desc_aula, :curso_id_aula, :mod_id_aula, :est_id_aula, :prof_id_aula)";  
        if($treinamento == "sim") {
            $insert = "INSERT INTO aula (nome_aula, desc_aula, mod_id_aula, est_id_aula, prof_id_aula, treinamento, cronograma_semanas) 
            VALUES ( :nome_aula, :desc_aula, :mod_id_aula, :est_id_aula, :prof_id_aula, :treinamento, :cronograma_semanas)";
        }
            try{
                $result = $conexao->prepare($insert);
                $result ->bindParam(':nome_aula',$nome_aula, PDO::PARAM_STR);
                $result ->bindParam(':desc_aula',$desc_aula, PDO::PARAM_STR);
                if($treinamento != "sim") {
                    $result->bindParam(':curso_id_aula',$curso_id_aula, PDO::PARAM_INT);
                }
                $result->bindParam(':cronograma_semanas', $cronograma_semanas, PDO::PARAM_INT);
                
                $result ->bindParam(':mod_id_aula',$mod_id_aula, PDO::PARAM_INT);
                $result ->bindParam(':est_id_aula',$est_id_aula, PDO::PARAM_INT);
                $result ->bindParam(':prof_id_aula',$prof_id_aula, PDO::PARAM_INT);  
                $result ->bindParam(':treinamento',$treinamento, PDO::PARAM_STR);  
                
                $result ->execute();
                $contar = $result->rowCount();

            if($contar>0){
                echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> Inserido com Sucesso!</strong> 
                    </div>'; 
                    header("Refresh: 1, home.php?acao=welcome");
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