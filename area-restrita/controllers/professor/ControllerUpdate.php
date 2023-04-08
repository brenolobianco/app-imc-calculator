<?php

 if(!isset($_GET['id_prof'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
    $id_prof = $_GET['id_prof'];
        $select = "SELECT * from professor WHERE id_prof=:id_prof";

        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id_prof', $id_prof, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $id_prof    = $mostra->id_prof;
                $nome_prof  = $mostra->nome_prof;
                $whats_prof = $mostra->whats_prof;
                $email_prof = $mostra->email_prof;
                $link_cv_lates_prof = $mostra->link_cv_lates_prof;
                $desc_prof = $mostra->desc_prof;

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
            $nome_prof   = trim(strip_tags($_POST["nome_prof"])); 
            $email_prof  = trim(strip_tags($_POST["email_prof"]));
            $whats_prof  = trim(strip_tags($_POST["whats_prof"]));              
            $link_cv_lates_prof  = trim(strip_tags($_POST["link_cv_lates_prof"]));  
            $desc_prof  = trim(strip_tags($_POST["desc_prof"])); 
                  
                $update ="UPDATE professor SET nome_prof=:nome_prof, email_prof=:email_prof, whats_prof=:whats_prof, link_cv_lates_prof=:link_cv_lates_prof, desc_prof=:desc_prof WHERE id_prof=:id_prof"; 
                try{
                    $result = $conexao->prepare($update);
                    $result ->bindParam(':id_prof',$id_prof, PDO::PARAM_INT);
                    $result ->bindParam(':nome_prof',$nome_prof, PDO::PARAM_STR);
                    $result ->bindParam(':email_prof',$email_prof, PDO::PARAM_STR);
                    $result ->bindParam(':whats_prof',$whats_prof, PDO::PARAM_STR);
                    $result ->bindParam(':link_cv_lates_prof',$link_cv_lates_prof, PDO::PARAM_STR);
                    $result ->bindParam(':desc_prof',$desc_prof, PDO::PARAM_STR);
                    $result ->execute();
                    $contar = $result->rowCount();
    
                if($contar>0){
                    echo '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong> Atualizado com Sucesso!</strong> 
                        </div>'; 
                    header("Refresh: 1, home.php?acao=professores");
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