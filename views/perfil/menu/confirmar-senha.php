<?php

include_once 'controllers/matricula/ControllerSelect.php';

if($_POST){
    
    if(isset($_POST['sen'])){
        
        $s =$_POST['senha'];
        if($s == $senhaLog){
            echo '<br><div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Senha Confirmada com Sucesso, Redirecionando...</strong> 
                </div>'; 
                header("Refresh: 1, home.php?acao=motivo-da-desistencia-rEdr458w323&id_mat=$id_mat");
        }else{
            echo '<br><div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Opss está senha não está correta!</strong> 
                </div>';
        }
    }
}

?><div class="container">
    <div class="row">
        <a class="nav-link link btn btn-default mb-4 display-2" style="margin-left: -60px; margin-top: 30px;" href="home.php?acao=perfil&id_acad=<?=$idLog;?>" style="width: 150px;">
            <img src="assets/images/voltar-light.png" style="width: 100px;">
        </a>
    </div>
</div>  
<section class="content4 cid-tc0htyQ19O" id="content4-41">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-10">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                    <strong>Por gentileza, confirme sua senha.</strong></h3>
            </div>
        </div>
    </div>
</section>

<section class="content7 cid-tc0htznwpo" id="content7-42">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-4">
                <form method="POST">
                  <div class="form-group"> 
                    <input type="password" class="place_form form-control" name="senha" autocomplete="off" placeholder="Sua senha">
                  </div>
                  <br><br><br>
                  <center>
                  <button type="submit" name="sen" class="btn btn-white display-4" style="width: 300px;">Confirmar Cancelamento</button>
                  </center>
                  </p>
                  <br><br>
                  <br><br>
                </form>
            </div>
        </div>
    </div>
</section>