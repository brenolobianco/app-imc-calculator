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
            $id_prof   = $mostra->id_prof;
            $nome_prof = $mostra->nome_prof;
            $whats_prof = $mostra->whats_prof;
            $email_prof = $mostra->email_prof;
            $link_cv_lates_prof = $mostra->link_cv_lates_prof;
            $desc_prof = $mostra->desc_prof;
            
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
?>