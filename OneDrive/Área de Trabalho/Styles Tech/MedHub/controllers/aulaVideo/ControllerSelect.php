<?php

if(!isset($_GET['id_vid'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_vid = $_GET['id_vid'];
        $select = "SELECT * from aula_vid v JOIN aula a ON a.id_aula = v.aula_id_vid WHERE id_vid=:id_vid";

    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_vid', $id_vid, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
              $id_vid    = $mostra->id_vid;
              $aula_id_vid = $mostra->aula_id_vid;
              $nome_vid    = $mostra->nome_vid;
              $arq_vid     = $mostra->arq_vid;
              $id_aula     = $mostra->id_aula;
              $nome_aula   = $mostra->nome_aula;
              $curso_id_aula = $mostra->curso_id_aula;
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