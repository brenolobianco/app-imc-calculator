<<<<<<< HEAD
<?php

 if(!isset($_GET['id_pres'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
    $id_pres = $_GET['id_pres'];
    
        $select = "SELECT * from presenca WHERE id_pres=:id_pres";

        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id_pres', $id_pres, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $id_pres   = $mostra->id_pres;
                $sit_pres  = $mostra->sit_pres;
                $data_pres = $mostra->data_pres;

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

 if(!isset($_GET['id_pres'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
    $id_pres = $_GET['id_pres'];
    
        $select = "SELECT * from presenca WHERE id_pres=:id_pres";

        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id_pres', $id_pres, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $id_pres   = $mostra->id_pres;
                $sit_pres  = $mostra->sit_pres;
                $data_pres = $mostra->data_pres;

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