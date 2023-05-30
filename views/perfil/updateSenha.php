<?php 

include_once 'controllers/cadastrar/ControllerUpdateDadosLogin.php';

if($idLog != $id_acad){
    
   echo "<br><br><br><br><br><br>
   <h1 style='margin-left: 50px; color: #fff;'>$nomeLog você não tem acesso a este usuário!!!</h1>
   <br><br><br><br><br>";
   
}else{

?>
<div class="container">
    <div class="row">
        <a class="set-volt nav-link link btn btn-default mb-4 display-2" href="home.php?acao=perfil&id_acad=<?=$idLog;?>">
            <img src="assets/images/voltar-light.png" style="width: 100px;">
        </a>
    </div>
</div>  
<section class="content4 cid-tbWTAUdE5o" id="content4-2z" style="margin-top: -50px;">
      
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-8">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                  <strong>Dados de Login</strong>
                </h3>   
            </div>
        </div>
    </div>


    <div class="container">
	    <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
            <form action="#" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label style="color: #fff;">Email</label>
                <input type="text" class="place_form form-control" name="email_acad" value="<?= $email_acad;?>" style="border-radius: 25px;">
              </div>
              <div class="form-group">
                <label style="color: #fff;">Senha</label>
                <input type="password" class="place_form  form-control" name="senha_acad" value="<?= $senha_acad;?>"  style="border-radius: 25px;">
              </div>
            </div>

            <div class="col-md-8">
              <center>
                  <button type="submit" name="atualizar" class="btn btn-white display-4">
                      &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Atualizar
                      &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                  </button>
              </center>
            </div>
              <br><br><br>
            </form> 
                
            </div>
        </div>
    </div>
    <br><br><br>
    <br><br><br>
</section>
<?php } ?>
