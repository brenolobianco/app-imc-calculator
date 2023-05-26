<?php

if(!isset($_GET['id_vid'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_vid = $_GET['id_vid'];
        
        $select = "SELECT * from aula_vid v JOIN aula a ON a.id_aula = v.aula_id_vid  WHERE id_vid=:id_vid";

        try{
          $result = $conexao->prepare($select);
          $result ->bindParam(':id_vid', $id_vid, PDO::PARAM_INT);
          $result ->execute();
          $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_vid    = $mostra->id_vid;
            $nome_vid  = $mostra->nome_vid;
            $aula_id_vid = $mostra->aula_id_vid;
            $nome_aula  = $mostra->nome_aula;
        }
        }else{
          echo '<div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong>Opz!!!</strong> Nada adicionado.
          </div>'; exit;
        }
        }catch(PDOException $e){
          echo $e;
        }

    if(isset($_POST['atualizar'])){
      $nome_vid   = trim(strip_tags($_POST["nome_vid"]));
      $aula_id_vid  = trim(strip_tags($_POST["aula_id_vid"]));   

              
            $update ="UPDATE aula_vid SET nome_vid=:nome_vid, aula_id_vid=:aula_id_vid WHERE id_vid=:id_vid"; 
            try{
                $result = $conexao->prepare($update);
                $result ->bindParam(':id_vid',$id_vid, PDO::PARAM_INT);
                $result ->bindParam(':nome_vid',$nome_vid, PDO::PARAM_STR);
                $result ->bindParam(':aula_id_vid',$aula_id_vid, PDO::PARAM_INT);
      
                $result ->execute();
                $contar = $result->rowCount();

            if($contar>0){
                echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> Atualizado com Sucesso!</strong> 
                    </div>'; 
                    header("Refresh: 1, home.php?acao=aulas-videos");
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