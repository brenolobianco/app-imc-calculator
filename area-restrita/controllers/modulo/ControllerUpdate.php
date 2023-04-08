<?php

if(!isset($_GET['id_mod'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_mod = $_GET['id_mod'];
   
        $select = "SELECT * from modulo m JOIN estagio e ON e.id_est = m.est_id_mod
        WHERE id_mod=:id_mod";
        try{
          $result = $conexao->prepare($select);
          $result ->bindParam(':id_mod', $id_mod, PDO::PARAM_INT);
          $result ->execute();
          $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_mod    = $mostra->id_mod;
            $nome_mod  = $mostra->nome_mod;
            $desc_mod  = $mostra->desc_mod;
            $id_est  = $mostra->id_est;
            $nome_est  = $mostra->nome_est;
            $id_curso  = $mostra->id_curso;
            $nome_curso  = $mostra->nome_curso;
            $treinamento = $mostra->treinamento;

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
        $nome_mod  = trim(strip_tags($_POST["nome_mod"]));
        $est_id_mod = trim(strip_tags($_POST["est_id_mod"])); 
        $curso_id_mod  = trim(strip_tags($_POST["curso_id_mod"])); 
        $desc_mod  = $_POST["desc_mod"];
        
        $est_id_mod_treinamento  = $_POST["est_id_mod_treinamento"];
        $treinamento = null;
        if($est_id_mod_treinamento) {
            $est_id_mod = $est_id_mod_treinamento;
            $treinamento = "sim";
        }

            $update = "UPDATE modulo SET nome_mod=:nome_mod, treinamento=:treinamento, est_id_mod=:est_id_mod, curso_id_mod=:curso_id_mod, desc_mod=:desc_mod WHERE id_mod=:id_mod"; 
            if($treinamento == "sim") {
              $update = "UPDATE modulo SET nome_mod=:nome_mod, treinamento=:treinamento, est_id_mod=:est_id_mod, desc_mod=:desc_mod WHERE id_mod=:id_mod";   
            }
            try{
                $result = $conexao->prepare($update);
                $result ->bindParam(':id_mod',$id_mod, PDO::PARAM_INT);
                $result ->bindParam(':nome_mod',$nome_mod, PDO::PARAM_STR);
                $result ->bindParam(':est_id_mod',$est_id_mod, PDO::PARAM_INT);
                if($treinamento != "sim") {
                  $result ->bindParam(':curso_id_mod',$curso_id_mod, PDO::PARAM_INT);
                }
                $result ->bindParam(':desc_mod',$desc_mod, PDO::PARAM_STR);
                $result ->bindParam(':treinamento', $treinamento, PDO::PARAM_STR);
                $result ->execute();
                $contar = $result->rowCount();

            if($contar>0){
                echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> Atualizado com Sucesso!</strong> 
                    </div>'; 
                  header("Refresh: 1, home.php?acao=modulos");
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