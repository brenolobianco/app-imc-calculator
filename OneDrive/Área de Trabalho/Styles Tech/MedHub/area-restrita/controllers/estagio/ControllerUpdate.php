<?php

 if(!isset($_GET['id_est'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
    $id_est = $_GET['id_est'];

        $select = "SELECT * FROM estagio e JOIN hospital h ON h.id_hosp = e.hosp_id_est WHERE id_est=:id_est";

        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id_est', $id_est, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $id_est    = $mostra->id_est;
                $nome_est  = $mostra->nome_est;
                $hosp_id_est = $mostra->hosp_id_est;
                $data_inicio_est = $mostra->data_inicio_est;
                $data_termino_est = $mostra->data_termino_est;
                $valor_est = $mostra->valor_est;
                $ativo_est = $mostra->ativo_est;
                $vagas_est = $mostra->vagas_est;
                $nota_med_est = $mostra->nota_med_est;
                $exc_est = $mostra->exc_est;
                $valor_desc_est = $mostra->valor_desc_est;
                $link_valor_est  = $mostra->link_valor_est;
                $val_pix_est = $mostra->val_pix_est;
                $chave_pix_est = $mostra->chave_pix_est;
                $link_huber_est  = $mostra->link_huber_est; 
                $link_prova_est = $mostra->link_prova_est;
                $desc_est = $mostra->desc_est;
                $edital_est = $mostra->edital_est;
                $id_hosp = $mostra->id_hosp;
                $nome_hosp = $mostra->nome_hosp;
                $treinamento = $mostra->treinamento;
                $id_turma_fiscallize = $mostra->id_turma_fiscallize;
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
            $nome_est   = trim(strip_tags($_POST["nome_est"])); 
            $valor_est  = trim(strip_tags($_POST["valor_est"]));
            $valor_desc_est = trim(strip_tags($_POST["valor_desc_est"])); 
            $hosp_id_est = trim(strip_tags($_POST["hosp_id_est"]));
            $desc_est   = $_POST["desc_est"];
            $edital_est   = $_POST["edital_est"]; 
            $ativo_est   = trim(strip_tags($_POST["ativo_est"])); 
            $vagas_est   = trim(strip_tags($_POST["vagas_est"]));
            $nota_med_est = trim(strip_tags($_POST["nota_med_est"])); 
            $exc_est   = trim(strip_tags($_POST["exc_est"]));
            $link_valor_est  = $_POST["link_valor_est"]; 
            $val_pix_est   = trim(strip_tags($_POST["val_pix_est"]));
            $chave_pix_est  = $_POST["chave_pix_est"]; 
            $link_huber_est  = $_POST["link_huber_est"]; 
            $link_prova_est  = $_POST["link_prova_est"];             
            $data_inicio_est  = trim(strip_tags($_POST["data_inicio_est"])); 
            $data_termino_est  = trim(strip_tags($_POST["data_termino_est"]));
            $treinamento  = trim(strip_tags($_POST["treinamento"])); 
            $id_turma_fiscallize = trim(strip_tags($_POST["id_turma_fiscallize"]));

                $update ="UPDATE estagio SET nome_est=:nome_est, treinamento=:treinamento, valor_est=:valor_est, nota_med_est=:nota_med_est, exc_est=:exc_est, ativo_est=:ativo_est, vagas_est=:vagas_est, valor_desc_est=:valor_desc_est, hosp_id_est=:hosp_id_est,
                desc_est=:desc_est, edital_est=:edital_est, link_valor_est=:link_valor_est, val_pix_est=:val_pix_est, chave_pix_est=:chave_pix_est, link_huber_est=:link_huber_est, link_prova_est=:link_prova_est, data_inicio_est=:data_inicio_est, data_termino_est=:data_termino_est, id_turma_fiscallize=:id_turma_fiscallize WHERE id_est=:id_est"; 
                try{
                    $result = $conexao->prepare($update);
                    $result ->bindParam(':id_est',$id_est, PDO::PARAM_INT);
                    $result ->bindParam(':nome_est',$nome_est, PDO::PARAM_STR);
                    $result ->bindParam(':treinamento',$treinamento, PDO::PARAM_STR);
                    $result ->bindParam(':valor_est',$valor_est, PDO::PARAM_STR);
                    $result ->bindParam(':valor_desc_est',$valor_desc_est, PDO::PARAM_STR);
                    $result ->bindParam(':hosp_id_est',$hosp_id_est, PDO::PARAM_INT);
                    $result ->bindParam(':desc_est',$desc_est, PDO::PARAM_STR);
                    $result ->bindParam(':edital_est',$edital_est, PDO::PARAM_STR);
                    $result ->bindParam(':ativo_est',$ativo_est, PDO::PARAM_STR);
                    $result ->bindParam(':vagas_est',$vagas_est, PDO::PARAM_STR);
                    $result ->bindParam(':nota_med_est',$nota_med_est, PDO::PARAM_STR);
                    $result ->bindParam(':exc_est',$exc_est, PDO::PARAM_STR);
                    $result ->bindParam(':link_valor_est',$link_valor_est, PDO::PARAM_STR);
                    $result ->bindParam(':val_pix_est',$val_pix_est, PDO::PARAM_STR);
                    $result ->bindParam(':chave_pix_est',$chave_pix_est, PDO::PARAM_STR);
                    $result ->bindParam(':link_huber_est',$link_huber_est, PDO::PARAM_STR);
                    $result ->bindParam(':link_prova_est',$link_prova_est, PDO::PARAM_STR);
                    $result ->bindParam(':data_inicio_est',$data_inicio_est, PDO::PARAM_STR);
                    $result ->bindParam(':data_termino_est',$data_termino_est, PDO::PARAM_STR);
                    $result ->bindParam(':id_turma_fiscallize', $id_turma_fiscallize, PDO::PARAM_STR);
                   
                    $result ->execute();
                    $contar = $result->rowCount();
    
                if($contar>0){
                    echo '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong> Atualizado com Sucesso!</strong> 
                        </div>'; 
                    header("Refresh: 1, home.php?acao=estagios");
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