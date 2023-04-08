
<?php
    $select = "SELECT * from matricula m 
    JOIN estagio e ON e.id_est = m.est_id_mat
    JOIN hospital h ON h.id_hosp = m.hosp_id_mat
    JOIN academico a ON a.id_acad = m.acad_id_mat
    JOIN curso c ON c.id_curso = m.curso_id_mat 
    WHERE acad_id_mat = $idLog";  
    try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<section class="features16 cid-tbuHh87P44" id="features17-1c">

<div class="container-fluid">
    <div class="content-wrapper">
        <div class="row align-items-center">
            <div class="col-12 col-lg-5">
                <div class="image-wrapper">
                    <div style='position:relative; top:0px; left:0px;'>
                        <img src="assets/images/background_verdeclaro.png">
                    </div>
                    <div class="img_insc">
                        <img src="upload/<?= $mostra->img_hosp;?>" alt="<?= $mostra->nome_hosp;?>">
                    </div>
                </div>
            </div>
            
            <div class="mar-per col-12 col-lg">
                <div class="text-wrapper">
                    <h6 class="card-title mbr-fonts-style display-5">
                        <strong><?= $mostra->nome_est;?></strong></h6>
                    <p class="mbr-text mbr-fonts-style mb-4 display-4">
                    <?= $mostra->desc_est;?>
                    </p>
                    <p class="mbr-text mbr-fonts-style mb-4 display-4">
                    <span class="mobi-mbri mobi-mbri-map-pin mbr-iconfont" style="color: rgb(136, 228, 80);">
                    </span> 
                    Unidade Hospitalar: <?= $mostra->nome_hosp;?>&nbsp;&nbsp;<br>
                    Endereço: <?= $mostra->rua_hosp;?>, <?= $mostra->num_hosp;?>, <?= $mostra->cidade_hosp;?> - <?= $mostra->uf_hosp;?>&nbsp;&nbsp;
                    <span class="mobi-mbri mobi-mbri-phone mbr-iconfont" style="color: rgb(136, 228, 80);">
                    </span>
                    <br><?= $mostra->fone_hosp;?>
                    </p>
                    <div class="mbr-section-btn mt-3">
                        <?php if($mostra->pag_mat !='Conferir'){?>
                    <a class="btn btn-white display-4" href="home.php?acao=hospital&id_est=<?= $mostra->id_est;?>">Acessar</a>
                    <?php }else{?>
                    <a class="btn btn-black display-4" disabled>Aguardando Confirmação</a>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<?php
}
}else{
    echo '<div class="alert alert-info">
        <strong> Você não tem inscrições ativas!!!</strong> 
        </div>';
}
}catch(PDOException $e){
    echo $e;
}
?> 