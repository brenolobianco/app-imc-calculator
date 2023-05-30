<br /><?php
    //session_start();

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    
    //include 'controllers/pagamento/ControllerSelect.php';
?>
<div class="container">
    <div class="row">
        <a class="nav-link link btn btn-default mb-4 display-2" style="margin-left: -60px; margin-top: 30px;" href="home.php?acao=perfil&id_acad=<?=$idLog;?>" style="width: 150px;">
            <img src="assets/images/voltar-light.png" style="width: 100px;">
        </a>
    </div>
</div>  
<section class="header14 cid-tbjtGztFjX" id="header14-q" style="margin-top: -50px;">
    
<div class="container-fluid"style="margin-top: -100px;">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-5 image-wrapper">
            <img src="assets/images/img-boxhipocratis-800x560.png" alt="MedHub - pesquisa">
        </div>
        <div class="col-12 col-md">
            <div class="text-wrapper">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">
                    <strong>PARABÉNS</strong></h1>
                    <p class="mbr-text mbr-fonts-style display-7"><strong>
                       <?= $nomeLog;?>, você já pode acessar sua inscrição!!!</strong><br><br>
                    </p>
                    <a class="btn btn-white display-4" href="home.php?acao=perfil-inscricoes&id_acad=<?=$idLog;?>"  style="width: 200px;">Minhas Inscrições</a>
                <div class="mbr-section-btn mt-3">
                </div>
            </div>
        </div>
    </div>
</div>
</section>