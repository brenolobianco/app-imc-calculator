<?php

if(!isset($_GET['id_mat'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_mat = $_GET['id_mat'];

        $select = "SELECT * from matricula m 
        JOIN estagio e ON e.id_est = m.est_id_mat
        JOIN curso c ON c.id_curso = m.curso_id_mat
        JOIN academico a ON a.id_acad = m.acad_id_mat
        WHERE id_mat=:id_mat";

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
            $motivo_mat = $mostra->motivo_mat;
            $acad_id_mat = $mostra->acad_id_mat;
            $nome_acad  = $mostra->nome_acad;
            $cpf_acad   = $mostra->cpf_acad;
            $rg_acad    = $mostra->rg_acad;
            $data_nasc_acad = $mostra->data_nasc_acad;
            $link_cv_lates_acad = $mostra->link_cv_lates_acad;
            $email_acad = $mostra->email_acad;
            $whats_acad = $mostra->whats_acad;
            $cep_acad   = $mostra->cep_acad;
            $uf_acad    = $mostra->uf_acad;
            $cidade_acad = $mostra->cidade_acad;
            $bairro_acad = $mostra->bairro_acad;
            $rua_acad    = $mostra->rua_acad;
            $num_acad    = $mostra->num_acad;
            $img_acad    = $mostra->img_acad;
            $id_est  = $mostra->id_est;
            $nome_est  = $mostra->nome_est;
            $id_curso  = $mostra->id_curso;
            $nome_curso  = $mostra->nome_curso;
            $valor_desc_est = $mostra->valor_desc_est;
            $val_pix_est = $mostra->val_pix_est;


        }
        }else{
          echo '<div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong>Ops!!!</strong> Nada adicionado.
          </div>'; exit;
        }
    }catch(PDOException $e){
        echo $e;
    }
?>