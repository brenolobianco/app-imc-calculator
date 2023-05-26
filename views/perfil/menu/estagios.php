<?php include_once 'controllers/perfil/ControllerSelect.php';?>
<div class="container">
    <div class="row">
        <a class="set-volt nav-link link btn btn-default mb-4 display-2" href="home.php?acao=perfil&id_acad=<?=$idLog;?>">
            <img src="assets/images/voltar-light.png" style="width: 100px;">
        </a>
    </div>
</div>  

<section class="content11 cid-tbuTtlCPxf" id="content12-1h">
    
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="mbr-section-btn align-center">
                
				<a class="btn btn-black display-4" href="home.php?acao=perfil-estagios&id_acad=<?= $idLog;?>" style="width: 200px;">Meu Estágio</a>
				<a class="btn btn-white display-4" href="home.php?acao=perfil-inscricoes&id_acad=<?= $idLog;?>" style="width: 200px;">Minhas Inscrições</a>
                <a class="btn btn-white display-4" href="home.php?acao=perfil-meus-dados&id_acad=<?= $idLog;?>" style="width: 200px;">Meus Dados</a>
				</div>
            </div>
        </div>
    </div>
</section>
<br><br>
<section class="features16 cid-tbuZATmCi7" id="features18-1i">
    <div class="container">
        <div class="content-wrapper">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style display-5">
                            <strong>Escolher Estágio:</strong>
                        </h6>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <?php
                    $recebeu = isset($_POST['nome_estagio']) ? $_POST['nome_estagio']:"";
                    if(empty($recebeu)){
                
                    }else{
                        header("Refresh: 0, home.php?acao=perfil-estagio&id_mat=$recebeu");
                    }
                    ?>
                    <form method="post">
                    <select name="nome_estagio" onchange="this.form.submit()" class="place_form2 form-control form-control-sm">
                        <option>Qual...</option>
                      <?php
                      
                        $select = "SELECT * from matricula m JOIN estagio e ON e.id_est = m.est_id_mat 
                        WHERE acad_id_mat = $idLog && insc_mat != 'Desistente' ORDER BY id_mat DESC";  

                        try{
                            $result = $conexao->prepare($select);
                            $result ->execute();
                            $contar = $result->rowCount();
            
                        if($contar>0){
                            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            
                      ?>
                      <option value="<?=$mostra->id_mat;?>"><?=$mostra->nome_est;?></option>
                   <?php
                      }
                      }else{
                        echo '<div class="alert alert-info">
            				 <strong>Nenhum Estágio</strong>
            				 </div>';
                      }
                      }catch(PDOException $e){
                      echo $e;
                      }
                    ?>	
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>
<?php

$select2 = "SELECT * from matricula m 
JOIN estagio e ON e.id_est = m.est_id_mat 
JOIN hospital h ON h.id_hosp = m.hosp_id_mat 
WHERE acad_id_mat = $idLog && insc_mat != 'Desistente' LIMIT 1";  

    try{
    $result2 = $conexao->prepare($select2);
    $result2 ->execute();
    $contar2 = $result->rowCount();

    if($contar2>0){
    while($mostra2 = $result2->FETCH(PDO::FETCH_OBJ)){
        
        $nota_med_est = $mostra2->nota_med_est;
  
    if($mostra2->nota_mat >= $nota_med_est && $mostra2->class_mat == 'sim' && $mostra2->cert_mat == 'confirmado') 
    {
    include_once 'niveis/normal.php'; 
    }
    elseif($mostra2->nota_mat >= $nota_med_est && $mostra2->class_mat == 'sim' && $mostra2->cert_mat == 'sim') 
    {
    include_once 'niveis/cracha.php';  
    }
    elseif($mostra2->nota_mat >= $nota_med_est && $mostra2->class_mat == 'sim') 
    { 
    include_once 'niveis/class.php';     
    }
    elseif($mostra2->nota_mat >= $nota_med_est) 
    {
    include_once 'niveis/aprov.php';     
    }
    elseif($mostra2->nota_mat < $nota_med_est && $mostra2->nota_mat != null)
    {  
    include_once 'niveis/reprov.php';  
    }
    else
    {
    include_once 'niveis/espera.php';  
    }
    
    }
      }else
      {?>
      <section class="features1 cid-tbuO2OyHXT" id="features2-1f">
      <?php include_once 'niveis/espera.php'; ?>
      </section>
      <?php }
    }catch(PDOException $e){
    echo $e;
  }

?>	





