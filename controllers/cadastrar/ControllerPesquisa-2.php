<?php

    $id_acad = $idLog;

        $select = "SELECT * FROM academico WHERE id_acad=:id_acad";

        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id_acad', $id_acad, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $id_acad    = $mostra->id_acad;
                $interesse_acad    = $mostra->interesse_acad;
                $outro_inter_acad    = $mostra->outro_inter_acad;

            }
        }else{
            echo '<div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Opz!!!</strong> Você ainda tem texto adicionado.
            </div>'; exit;
        }
        }catch(PDOException $e){
            echo $e;
        }

        if(isset($_POST['atualizar'])){
            $interesse_acad = trim(strip_tags($_POST["interesse_acad"])); 
            $outro_inter_acad  = trim(strip_tags($_POST["outro_inter_acad"]));

                  
                $update ="UPDATE academico SET interesse_acad=:interesse_acad, outro_inter_acad=:outro_inter_acad WHERE id_acad=:id_acad"; 
                try{
                    $result = $conexao->prepare($update);
                    $result ->bindParam(':id_acad',$id_acad, PDO::PARAM_INT);
                    $result ->bindParam(':interesse_acad',$interesse_acad, PDO::PARAM_STR);
                    $result ->bindParam(':outro_inter_acad',$outro_inter_acad, PDO::PARAM_STR);
                    $result ->execute();
                    $contar = $result->rowCount();
    
                if($contar>0){
                    echo '<br /><div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong> Obrigado pelo seu Feedback!</strong> 
                        </div>'; 
                    header("Refresh: 1, home.php?acao=welcome");
                }else{
                    echo '<br /><div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong> O Conteúdo não foi atualizado de forma correta!</strong> 
                        </div>';
                }
            }catch(PDOException $e){
                echo $e;
            }
                                        
        }    
    
    ?>