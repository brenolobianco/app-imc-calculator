<?php

if(!isset($_GET['id_aula'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_aula = $_GET['id_aula'];
        
        $select = "SELECT * from aula a 
        JOIN modulo m ON m.id_mod = a.mod_id_aula 
        JOIN curso s ON s.id_curso = a.curso_id_aula
        JOIN estagio e ON e.id_est = a.est_id_aula
        JOIN professor p ON p.id_prof = a.prof_id_aula 
        WHERE id_aula=:id_aula";

        try{
          $result = $conexao->prepare($select);
          $result ->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
          $result ->execute();
          $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_aula    = $mostra->id_aula;
            $nome_aula  = $mostra->nome_aula;
            $curso_id_aula = $mostra->curso_id_aula;
            $prof_id_aula = $mostra->prof_id_aula;
            $mod_id_aula = $mostra->mod_id_aula;
            $est_id_aula = $mostra->est_id_aula;
            $desc_aula  = $mostra->desc_aula;
            $nome_prof = $mostra->nome_prof;
            $nome_curso = $mostra->nome_curso;
            $nome_mod = $mostra->nome_mod;
            $nome_est = $mostra->nome_est;


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
      $nome_aula   = trim(strip_tags($_POST["nome_aula"]));
      $desc_aula   = trim(strip_tags($_POST["desc_aula"])); 
      $curso_id_aula  = trim(strip_tags($_POST["curso_id_aula"]));   
      $mod_id_aula  = trim(strip_tags($_POST["mod_id_aula"]));  
      $est_id_aula  = trim(strip_tags($_POST["est_id_aula"]));
      $prof_id_aula  = trim(strip_tags($_POST["prof_id_aula"]));
              
            $update ="UPDATE aula SET nome_aula=:nome_aula, curso_id_aula=:curso_id_aula, 
            mod_id_aula=:mod_id_aula, est_id_aula=:est_id_aula, prof_id_aula=:prof_id_aula,
            desc_aula=:desc_aula WHERE id_aula=:id_aula"; 
            try{
                $result = $conexao->prepare($update);
                $result ->bindParam(':id_aula',$id_aula, PDO::PARAM_INT);
                $result ->bindParam(':nome_aula',$nome_aula, PDO::PARAM_STR);
                $result ->bindParam(':desc_aula',$desc_aula, PDO::PARAM_STR);
                $result ->bindParam(':curso_id_aula',$curso_id_aula, PDO::PARAM_INT);
                $result ->bindParam(':mod_id_aula',$mod_id_aula, PDO::PARAM_INT);
                $result ->bindParam(':est_id_aula',$est_id_aula, PDO::PARAM_INT);
                $result ->bindParam(':prof_id_aula',$prof_id_aula, PDO::PARAM_INT);  
                $result ->execute();
                $contar = $result->rowCount();

            if($contar>0){
                echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> Atualizado com Sucesso!</strong> 
                    </div>'; 
                    header("Refresh: 1, home.php?acao=aulas");
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