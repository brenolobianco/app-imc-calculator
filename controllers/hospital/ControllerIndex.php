<div class="container">
  <div class="row align-items-start">
    <?php
    $select = "SELECT * from estagio e LEFT JOIN hospital h ON h.id_hosp = e.hosp_id_est";  
    try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<div class="zoom item features-image сol-12 col-md-6 col-lg-4">
    <div class="item-wrapper" style="border-radius: 20px 20px;">
        <div class="item-img">
            <a href="home.php?acao=hospital&id_est=<?= $mostra->id_est;?>">
            <img src="upload/<?= $mostra->img_hosp;?>" alt="<?= $mostra->nome_hosp;?>" style="border-radius: 20px 20px 0px 0px;" title="<?= $mostra->nome_hosp;?>">
            </a>
        </div>
        <div class="item-content">
            <a href="home.php?acao=hospital&id_est=<?= $mostra->id_est;?>">
            <h5 class="item-title mbr-fonts-style display-7" style="color: #000;"><?= $mostra->nome_hosp;?></h5>
            <center>
            <p style="color: #000;"><?= $mostra->nome_est;?></p>
            </center>
            </a>   
        </div>
    </div>
</div>
 <?php
}
}else{
    echo '<div class="alert alert-info">
        <button type="button" class="close" data-dismiss="warning"></button>
        <strong> Nada Cadastrado!!!</strong> 
        </div>';
}
}catch(PDOException $e){
    echo $e;
}
?> 
 </div>
</div>