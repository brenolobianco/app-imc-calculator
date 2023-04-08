<?php

 if(!isset($_GET['id_hora'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
    $id_hora = $_GET['id_hora'];

        $select = "SELECT * FROM horarios h LEFT JOIN academico a ON a.id_acad = h.acad_id_hora WHERE id_hora=:id_hora";

        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id_hora', $id_hora, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $id_hora   = $mostra->id_hora;
                $dia_hora  = $mostra->dia_hora;
                $in_hora   = $mostra->in_hora;
                $out_hora  = $mostra->out_hora;
                $est_id_hora  = $mostra->est_id_hora;
                $acad_id_hora = $mostra->acad_id_hora;
                $id_acad     = $mostra->id_acad;
                $nome_acad   = $mostra->nome_acad;
        

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
            $dia_hora = trim(strip_tags($_POST["dia_hora"])); 
            $in_hora  = trim(strip_tags($_POST["in_hora"]));
            $out_hora = trim(strip_tags($_POST["out_hora"]));
            $acad_id_hora = trim(strip_tags($_POST["acad_id_hora"]));

                  
                $update ="UPDATE horarios SET dia_hora=:dia_hora, in_hora=:in_hora, out_hora=:out_hora, acad_id_hora=:acad_id_hora WHERE id_hora=:id_hora"; 
                try{
                    $result = $conexao->prepare($update);
                    $result ->bindParam(':id_hora',$id_hora, PDO::PARAM_INT);
                    $result ->bindParam(':dia_hora',$dia_hora, PDO::PARAM_STR);
                    $result ->bindParam(':in_hora',$in_hora, PDO::PARAM_STR);
                    $result ->bindParam(':out_hora',$out_hora, PDO::PARAM_STR);
                    $result ->bindParam(':acad_id_hora',$acad_id_hora, PDO::PARAM_STR);
                 
                    $result ->execute();
                    $contar = $result->rowCount();
    
                if($contar>0){
                    echo '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong> Atualizado com Sucesso!</strong> 
                        </div>'; 
                    header("Refresh: 1, home.php?acao=horarios&id_est=$est_id_hora");
                }else{
                    echo '<div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong> O Conteúdo não foi atualizado de forma correta!</strong> 
                        </div>';
                }
            }catch(PDOException $e){
                echo $e;
            }
                                        
        }    
    
    ?>