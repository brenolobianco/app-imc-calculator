<?php include_once 'controllers/perfil/ControllerSelect.php';?>
<div class="container">
    <div class="row">
        <a class="set-volt nav-link link btn btn-default mb-4 display-2" href="home.php?acao=perfil&id_acad=<?=$idLog;?>">
            <img src="assets/images/voltar-light.png" style="width: 100px;">
        </a>
    </div>
</div>  
<section class="content11 cid-tbuTtlCPxf" id="content11-1h">
    
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="mbr-section-btn align-center">
				<a class="btn btn-white display-4" href="home.php?acao=perfil-estagios&id_acad=<?= $id_acad;?>" style="width: 200px;">Meu Estágio</a> 
				<a class="btn btn-black display-4" href="home.php?acao=perfil-inscricoes&id_acad=<?= $id_acad;?>"  style="width: 200px;">Minhas Inscrições</a>
                <a class="btn btn-white display-4" href="home.php?acao=perfil-meus-dados&id_acad=<?= $id_acad;?>"  style="width: 200px;">Meus Dados</a>
				</div>
            </div>
        </div>
    </div>
</section>
<br><br><br>
<section class="features16 cid-tbuZATmCi7" id="features17-1i">
    <div class="container">
        <div class="content-wrapper">
            <div class="row align-items-center">
                <div class="col-12 col-lg-7">
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style display-5">
                            <strong>Minhas Inscrições</strong>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once 'controllers/matricula/ControllerIndex.php';?>



