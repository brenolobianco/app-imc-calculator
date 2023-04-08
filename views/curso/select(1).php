<?php include_once 'controllers/curso/ControllerSelect.php';?>
<div class="container">
    <div class="row">
        <a class="set-volt nav-link link btn btn-default mb-4 display-2" href="home.php?acao=hospital&id_est=<?= $id_est;?>">
            <img src="assets/images/voltar-light.png" style="width: 100px;">
        </a>
    </div>
</div>  
<section class="header11 cid-tbTu6UKcUD" id="header11-2u" style="margin-top: -50px;">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="curso-per col-12 col-md-5 image-wrapper">
            <div style='position:relative; top:0px; left:0px;'>
                <img src="assets/images/background_verdeclaro.png">
            </div>
            <div class="img_hosp">
                <img class="w-100" src="upload/<?= $img_curso;?>" alt="<?= $nome_curso;?>">
            </div>
        </div>
        <div class="col-12 col-md">
            <div class="text-wrapper text-center" style="margin-right: 50px;">
                <h1 class="mar-per mbr-section-title mbr-fonts-style mb-3 display-2">
                    <strong>Meu Curso </strong>
                </h1>
                <p class="mbr-text mbr-fonts-style display-7">
                 Aqui você encontra o preparatório exclusivo para os aprovados no Programa de Estágio do Hospital escolhido. 
                 As aulas são ministradas por professores das melhores Universidades e Instituições de Saúde do país, com a chancela do Selo MedHub.
                </p>
                <div class="mbr-section-btn mt-3">
                    <a class="btn btn-white display-7" href="home.php?acao=area-da-prova&id_curso=<?= $id_curso;?>">Área de Prova</a>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<?php
$select = "SELECT * from modulo WHERE curso_id_mod = $id_curso";  
try{
$result = $conexao->prepare($select);
$result ->execute();
$contar = $result->rowCount();

if($contar>0){
while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
    
    $valor = $mostra->id_mod;
    if($valor % 2 == 0){
        $cor = "cid-tbT4KPG3WJ";
    } else {
        $cor = "cid-tbZHsooQ0S";
    }
    
?>
<section class="features16 <?= $cor;?>" id="features17-2r">
<div class="container">
    <div class="content-wrapper">
        <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
        <strong><?= $mostra->nome_mod;?></strong></h3>
        <?php
        $select2 = "SELECT * from aula a JOIN professor f ON f.id_prof = a.prof_id_aula
        LEFT JOIN aula_pdf p ON p.aula_id_pdf = a.id_aula  
        LEFT JOIN aula_vid v ON v.aula_id_vid = a.id_aula 
        WHERE mod_id_aula = $mostra->id_mod";  
        try{
        $result2 = $conexao->prepare($select2);
        $result2 ->execute();
        $contar2 = $result->rowCount();

        if($contar2>0){
        while($mostra2 = $result2->FETCH(PDO::FETCH_OBJ)){
        ?>       
        <div class="row align-items-center">
            <div class="col-12 col-lg-5">
                <div class="video-wrapper">
                   <?php
                        $select3 = "SELECT * from matricula WHERE curso_id_mat = $id_curso";  
                        try{
                        $result3 = $conexao->prepare($select3);
                        $result3 ->execute();
                        $contar3 = $result->rowCount();
                    
                        if($contar3>0){
                        while($mostra3 = $result3->FETCH(PDO::FETCH_OBJ)){
                            
                        if($nota_med_est <= $mostra3->nota_mat){
                        $nnn = 0;
                        }else{
                        $nnn = 1;   
                        }
                        
                        if($exc_est != null || $nnn != 1){
                    ?>
                    <video style="width: 100%;" controls>
                      <source src="videos/<?= $mostra2->id_vid;?>/<?= $mostra2->arq_vid;?>" type="video/mp4">
                      <source src="videos/<?= $mostra2->id_vid;?>/<?= $mostra2->arq_vid;?>" type="video/ogg">
                    </video>
               
                    <?php }else{?>
                    <img src='assets/images/aula-exclusiva.jpg' width='420'>

                    <?php
                    }
                    }
                    }else{
                        echo '<div class="mbr-section-btn mt-3"><a class="btn btn-white display-7" href="#content4-3s">Comprar</a></div>';
                    }
                    }catch(PDOException $e){
                        echo $e;
                    }
                    ?> 
                </div>
                </div>
                <div class="col-12 col-lg">
                    <div class="text-wrapper">
                      <p class="mbr-text mb-3 mbr-fonts-style display-7">
                        Aula: <?= $mostra2->nome_aula;?><br />
                        <i style="color: #efe; font-size: 16px;"><?= $mostra2->nome_vid;?></i><br />
                        <?= $mostra2->desc_aula;?><br><br>
                        Professor(a): <?= $mostra2->nome_prof;?> <br />
                        <i style="color: #efe; font-size: 13px;"><?= $mostra2->desc_prof;?></i>
                      </p>
                      <br />
                    <?php if($exc_est != null || $nnn != 1){?>
                    <div class="mbr-section-btn">
                    <?php if($mostra2->nome_pdf != null){?>
                    <a class="btn btn-white display-4" href="pdfs/<?= $mostra2->id_pdf;?>/<?= $mostra2->arq_pdf;?>" download>Baixar <?= $mostra2->nome_pdf;?>
                    </a>
                    <?php }?>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
        <br />
        <?php
        }
        }else{
        echo 'Nenhuma aula cadastrada';
        }
        }catch(PDOException $e){
        echo $e;
        }
        ?> 
    </div>
</div>
</section>
<?php
}
}else{
echo 'Nenhum módulo cadastrado';
}
}catch(PDOException $e){
echo $e;
}
?> 
<section class="footer4 cid-taGwCS6P5S" once="footers" id="footer4-5">


