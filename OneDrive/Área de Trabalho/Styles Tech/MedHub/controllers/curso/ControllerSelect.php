<?php

if(!isset($_GET['id_curso'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_curso = $_GET['id_curso'];
        
   $select = "SELECT * FROM curso c JOIN estagio e ON e.id_est = est_id_curso WHERE id_curso=:id_curso";

    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_curso    = $mostra->id_curso;
            $nome_curso  = $mostra->nome_curso;
            $desc_curso  = $mostra->desc_curso;
            $img_curso   = $mostra->img_curso;
            $id_est    = $mostra->id_est;
            $nome_est    = $mostra->nome_est;
            $edital_est    = $mostra->edital_est;
            $link_prova_est = $mostra->link_prova_est;
            $nota_med_est    = $mostra->nota_med_est;
            $exc_est    = $mostra->exc_est;
     

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