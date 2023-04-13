<?php 
include_once 'controllers/perfil/ControllerSelect.php'; 
include_once 'area-restrita/controllers/avaliacao/Fiscallize.php';

$rankingEstagio = $fiscallize->numeroRankingEstagio($cpfLog);

function getAvaliacoes($conexao, $idLog) {
    $est = getAcademicoEst($conexao, $idLog); // filtro pelo estágio do usuário
    $sql = "SELECT * FROM avaliacoes INNER JOIN estagio ON avaliacoes.id_est = estagio.id_est WHERE avaliacoes.id_est = :est";
    $result = $conexao->prepare($sql);
    $result->bindParam(':est', $est, PDO::PARAM_INT);
    $result->execute();

    $avaliacoes = $result->fetchAll();
    return $avaliacoes;
}

$avaliacoes = getAvaliacoes($conexao, $idLog);

try {
    $select2 = "SELECT * from matricula m 
    JOIN estagio e ON e.id_est = m.est_id_mat 
    JOIN hospital h ON h.id_hosp = m.hosp_id_mat 
    WHERE acad_id_mat = $idLog && insc_mat != 'Desistente' 
    ORDER BY id_mat DESC LIMIT 1";  
    $result2 = $conexao->prepare($select2);
    $result2 ->execute();
    $contar2 = $result->rowCount();
    } catch (PDOException $e) {
        echo $e;
    }

if($idLog != $id_acad){
    
   echo "<br><br><br><br><br><br>
   <h1 style='margin-left: 50px; color: #fff;'>$nomeLog você não tem acesso a este usuário!!!</h1>
   <br><br><br><br><br>";
   
}else{
    
?>
<div class="container">
    <div class="row">
        <a class="set-volt nav-link link btn btn-default mb-4 display-2" href="home.php?acao=estagio">
            <img src="assets/images/voltar-light.png" style="width: 100px;">
        </a>
    </div>
</div>
<section class="header14 cid-tbp7qnWREW" id="header14-y" style="margin-top: -50px;">

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 image-wrapper">
                <?php if($img_acad == null){
                $perfil = "assets/images/user.png";
            }else{
                $perfil = "upload/$img_acad";
            }?>
                <div style='position:relative; top:0px; left:0px;'>
                    <img src="assets/images/background_verdeclaro.png">
                </div>
                <div class="img_perfil">
                    <img src="<?= $perfil;?>" alt="MedHub">
                </div>

            </div>
            <div class="col-12 col-md">
                <div class="text-wrapper">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                        <strong>Perfil</strong></h1>

                    <p class="mbr-text mbr-fonts-style display-7">
                        <?=$nome_acad;?>
                    </p>
                    <p class="mbr-text mbr-fonts-style display-7">
                        <?=$data_nasc_acad;?>
                    </p>
                    <p class="mbr-text mbr-fonts-style display-7">
                        <?=$univ_imp_acad;?>
                    </p>

                    <p class="mbr-text mbr-fonts-style display-7">

                        <a style="margin-left: -10;" class="btn btn-white display-4" style="padding: 20px;"
                            href="home.php?acao=meus-dados&id_acad=<?= $id_acad;?>">
                            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp; Meus Dados &ensp;&ensp;&ensp;&ensp;&ensp;
                        </a>


                        <br>
                        <a style="margin-left: -10;" class="btn btn-white display-4"
                            href="home.php?acao=endereco&id_acad=<?=$idLog;?>">&ensp;&ensp;&ensp;Atualizar
                            Endereço&ensp;&ensp;</a>
                        <br>
                        <a style="margin-left: -10;" class="btn btn-white display-4"
                            href="home.php?acao=etapa-1b">&ensp; Upload Documentos &ensp;</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!--- Avaliacoes --->
<section style="background-color: transparent;">
    <div class="wrap m-5 mt-5">
        <div class="row">
            
            <div class="col-md-3 col-sm-12"
                style="background-color:#4EC3DD; height: 20%; border-radius: 10px 10px 10px;">
                <button class="btn btn-dark" style="background-color: #4EC3DD; border: none; width: 90%;">
                    <div style="width: 30%;" style="background-color: black;">
                        <img src="/assets/images/add-user.png" alt=""
                            style="max-width: 100%;">
                    </div>
                </button>

                <div class="upload">
                    
                </div>
            </div>

            <div class="header-avaliacoes col-md-6">
                <div class="container col-sm-12" style="overflow: scroll;">


                    <div class="row nivelamento">
                        <div class="content d-flex flex-1 overflow-scroll">
                            <div class="box d-flex align-items-start">

                                <?php foreach ($avaliacoes as $avaliacao) : ?>
                                <div class="col col-sm-12">
                                    <div class="col info-nivelamento">
                                        <span><?php echo $avaliacao['nome_avaliacao'] ?></span>
                                    </div>
                                    <div class="col info-nivelamento">
                                        <span>Nota:
                                            <?php echo $fiscallize->nota($avaliacao['avaliacao_id_fiscallize']) ?></span>
                                    </div>
                                </div>
                                <?php endforeach; ?>

                            </div>
                        </div>

                    </div>


                </div>
            </div>

            <div class="col-sm-12 col-md-2 m-3 mt-4">
                
            </div>
        </div>
    </div>
</section>

<section class="content11 cid-tbuTtlCPxf" id="content12-1h">

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="mbr-section-btn align-center">

                    <a class="btn btn-black display-4" href="#" style="width: 200px;" disabled>Meu Estágio</a>
                    <a class="btn btn-white display-4" href="home.php?acao=perfil-inscricoes&id_acad=<?= $id_acad;?>"
                        style="width: 200px;">Minhas Inscrições</a>
                    <a class="btn btn-white display-4" href="home.php?acao=perfil-meus-dados&id_acad=<?= $id_acad;?>"
                        style="width: 200px;">Meus Dados</a>
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
                        <select name="nome_estagio" onchange="this.form.submit()"
                            class="place_form2 form-control form-control-sm">
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
WHERE acad_id_mat = $idLog && insc_mat != 'Desistente' 
ORDER BY id_mat DESC LIMIT 1";  

    try{
    $result2 = $conexao->prepare($select2);
    $result2 ->execute();
    $contar2 = $result->rowCount();

    if($contar2>0){
    while($mostra2 = $result2->FETCH(PDO::FETCH_OBJ)){
        
    $nota_med_est = $mostra2->nota_med_est;

    if($mostra2->nota_mat >= $nota_med_est && $mostra2->class_mat == 'sim' && $mostra2->cert_mat == 'confirmado') 
    {
    include_once 'menu/niveis/normal.php'; 
    }
    elseif($mostra2->nota_mat >= $nota_med_est && $mostra2->class_mat == 'sim' && $mostra2->cert_mat == 'sim') 
    {
    include_once 'menu/niveis/cracha.php';  
    }
    elseif($mostra2->nota_mat >= $nota_med_est && $mostra2->class_mat == 'sim') 
    { 
    include_once 'menu/niveis/class.php';     
    }
    elseif($mostra2->nota_mat >= $nota_med_est) 
    {
    include_once 'menu/niveis/aprov.php';     
    }
    elseif($mostra2->nota_mat < $nota_med_est && $mostra2->nota_mat != null) 
    {
    include_once 'menu/niveis/reprov.php';     
    }
    else
    {  
    include_once 'menu/niveis/espera.php';  
    }
    
    
    }
      }else
      {
      ?>
<section class="features1 cid-tbuO2OyHXT" id="features2-1f">
    <?php include_once 'menu/niveis/espera.php'; ?>
</section>
<?php }
    }catch(PDOException $e){
    echo $e;
  }
}
?>

<style>
    .header-avaliacoes {
        background-color: #231f20;
        border-radius: 10px 10px 10px;
        padding: 10px;
        margin: 10px;
    }

    .info-nivelamento {
        background-color: #fff;
        color: #231f20;
        border-radius: 10px 10px 10px;
        padding: 10px;
        margin: 10px;
    }

    .info-nivelamento span {
        font-weight: 600;
        color: #231f20;
    }




    .texto-modulo {
        font-size: 3vh;
        text-shadow:
            1px 1px 1px #eaeaea,
            1px 1px 0px #ccc,
            1px 1px 0px #777,
            1px 1px 0px #333;
    }

    .alinhar {
        justify-content: center;
        align-items: center;
    }

    @media only screen and (max-width: 600px) {
        .texto-modulo {
            font-size: 2vh;
        }

        .texto-mudulo-accordion {
            font-size: 1vh;
        }
    }

    .texto-mudulo-accordion {
        font-size: 3vh;
        font-weight: 600;
        text-transform: uppercase;
    }

    .texto-modulo-accordion-minusculo {
        font-size: 3vh;
        font-weight: 600;
    }

    .titulo-quiz {
        font-weight: 800;
    }

    .clique {
        cursor: pointer;
    }

    .radius-quiz {
        border-radius: "30px 30px 30px 30px";
    }

    .bg-third {
        background-color: #88E439;
        color: #fff;
    }

    .btn-iniciar {
        border: none;
        border-radius: 10px 10px 10px;
        width: 80%;
        height: 35px;
    }

    .modal-content {
        border-radius: 10px 10px 10px;
        height: auto;
    }

    .modal-body {
        height: 400px;
        overflow-y: auto;
    }

    .modal-content {
        overflow-y:auto;
    }
</style>
