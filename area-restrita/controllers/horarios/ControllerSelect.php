<?php

if(!isset($_GET['id_hora'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_hora = $_GET['id_hora'];
   
    $select = "SELECT * from horarios";

    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_hora', $id_hora, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_hora    = $mostra->id_hora;
            $dia_hora   = $mostra->dia_hora;
            $in_hora    = $mostra->in_hora;
            $out_hora   = $mostra->out_hora;
    

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