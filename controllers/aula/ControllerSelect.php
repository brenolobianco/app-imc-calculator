<?php

if(!isset($_GET['est_id_aula'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $est_id_aula = $_GET['est_id_aula'];
        $select = "SELECT * from aula a 
        JOIN professor p ON p.id_prof = a.prof_id_aula
        JOIN curso c ON c.id_curso = a.curso_id_aula
        JOIN modulo m ON m.id_mod = a.mod_id_aula
        JOIN estagio e ON e.id_est = a.est_id_aula
        WHERE est_id_aula=:est_id_aula";

    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':est_id_aula', $est_id_aula, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
              $id_aula    = $mostra->id_aula;
              $nome_aula  = $mostra->nome_aula;
              $curso_id_aula  = $mostra->curso_id_aula;
              $est_id_aula  = $mostra->est_id_aula;
              $mod_id_aula  = $mostra->mod_id_aula;
              $prof_id_aula  = $mostra->prof_id_aula;
              $desc_aula  = $mostra->desc_aula;
              $nome_prof  = $mostra->nome_prof;
              $nome_curso = $mostra->nome_curso;
              $nome_mod   = $mostra->nome_mod;
              $nome_est   = $mostra->nome_est;
              

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