<?php

if(!isset($_GET['id_mat'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_mat = $_GET['id_mat'];
        
        $select = "SELECT * from matricula m JOIN academico a ON a.id_acad = m.acad_id_mat WHERE id_mat=:id_mat";

        try{
          $result = $conexao->prepare($select);
          $result ->bindParam(':id_mat', $id_mat, PDO::PARAM_INT);
          $result ->execute();
          $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_mat    = $mostra->id_mat;
            $nota_mat  = $mostra->nota_mat;
            $insc_mat  = $mostra->insc_mat;
            $indicado_mat = $mostra->indicado_mat;
            $exp_msn_mat  = $mostra->exp_msn_mat;
            $msn_mat = $mostra->msn_mat;
            $whats_mat = $mostra->whats_mat;
            $motivo_mat = $mostra->motivo_mat;
            $nome_acad   = $mostra->nome_acad;
            $class_mat  = $mostra->class_mat;
            $cert_mat  = $mostra->cert_mat;
            $whats_mat  = $mostra->whats_mat;
            $pag_mat  = $mostra->pag_mat;

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
      $nota_mat  = trim(strip_tags($_POST["nota_mat"]));
      $insc_mat   = trim(strip_tags($_POST["insc_mat"]));
      $indicado_mat = trim(strip_tags($_POST["indicado_mat"]));
      $exp_msn_mat = trim(strip_tags($_POST["exp_msn_mat"]));
      $msn_mat   = trim(strip_tags($_POST["msn_mat"]));
      $whats_mat   = trim(strip_tags($_POST["whats_mat"]));
      $class_mat   = trim(strip_tags($_POST["class_mat"]));
      $cert_mat   = trim(strip_tags($_POST["cert_mat"]));
      $pag_mat   = trim(strip_tags($_POST["pag_mat"]));
              
      $update ="UPDATE matricula SET nota_mat=:nota_mat, 
          insc_mat=:insc_mat, indicado_mat=:indicado_mat, msn_mat=:msn_mat, whats_mat=:whats_mat,
          class_mat=:class_mat, cert_mat=:cert_mat, exp_msn_mat=:exp_msn_mat, pag_mat=:pag_mat WHERE id_mat=:id_mat"; 

            try{
                $result = $conexao->prepare($update);
                $result ->bindParam(':id_mat',$id_mat, PDO::PARAM_INT);
                $result ->bindParam(':nota_mat',$nota_mat, PDO::PARAM_STR);
                $result ->bindParam(':indicado_mat',$indicado_mat, PDO::PARAM_STR);
                $result ->bindParam(':insc_mat',$insc_mat, PDO::PARAM_STR);
                $result ->bindParam(':exp_msn_mat',$exp_msn_mat, PDO::PARAM_STR);
                $result ->bindParam(':msn_mat',$msn_mat, PDO::PARAM_STR);
                $result ->bindParam(':whats_mat',$whats_mat, PDO::PARAM_STR);
                $result ->bindParam(':class_mat',$class_mat, PDO::PARAM_STR);
                $result ->bindParam(':cert_mat',$cert_mat, PDO::PARAM_STR);
                $result ->bindParam(':pag_mat',$pag_mat, PDO::PARAM_STR);
                $result ->execute();
                $contar = $result->rowCount();

            if($contar>0){
                echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> Atualizado com Sucesso!</strong> 
                    </div>'; 
                    header("Refresh: 1, home.php?acao=matriculas");
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