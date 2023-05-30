<?php

if(!isset($_GET['id_est'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_est = $_GET['id_est'];
   
    $select = "SELECT * from estagio e JOIN hospital h ON h.id_hosp = e.hosp_id_est WHERE id_est=:id_est";

    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_est', $id_est, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_est    = $mostra->id_est;
            $nome_est  = $mostra->nome_est;
            $valor_est  = $mostra->valor_est;
            $valor_desc_est  = $mostra->valor_desc_est;
            $desc_est  = $mostra->desc_est;
            $edital_est  = $mostra->edital_est;
            $link_valor_est  = $mostra->link_valor_est;
            $val_pix_est = $mostra->val_pix_est;
            $chave_pix_est = $mostra->chave_pix_est;
            $link_prova_est  = $mostra->link_prova_est;
            $data_inicio_est  = $mostra->data_inicio_est;
            $data_termino_est  = $mostra->data_termino_est;
            $vagas_est  = $mostra->vagas_est;
            $nome_hosp  = $mostra->nome_hosp;
            $nome_hosp  = $mostra->treinamento;

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