<?php

if(!isset($_GET['id_pdf'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_pdf = $_GET['id_pdf'];
        $select = "SELECT * from aula_pdf WHERE id_pdf=:id_pdf";

    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_pdf', $id_pdf, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
              $id_pdf    = $mostra->id_pdf;
              $nome_pdf  = $mostra->nome_pdf;
              $arq_pdf  = $mostra->arq_pdf;

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