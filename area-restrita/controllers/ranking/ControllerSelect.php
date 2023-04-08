<<<<<<< HEAD
<?php

if(!isset($_GET['id_est'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_est = $_GET['id_est'];
        
   $select = "SELECT * from estagio WHERE id_est=:id_est";

    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_est', $id_est, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_est   = $mostra->id_est;
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
=======
<?php

if(!isset($_GET['id_est'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_est = $_GET['id_est'];
        
   $select = "SELECT * from estagio WHERE id_est=:id_est";

    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_est', $id_est, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_est   = $mostra->id_est;
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
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
?>