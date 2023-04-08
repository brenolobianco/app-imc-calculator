<?php include 'includes/headerIndex.php';?>
<div>
  <?php 

  include 'controllers/log/login.php'; 

  $select = "SELECT * from m";  
  try{
  $result = $conexao->prepare($select);
  $result ->execute();
  $contar = $result->rowCount();

  if($contar>0){
  while($mostra = $result->FETCH(PDO::FETCH_OBJ)){

    if($mostra->m_m != '1'){
      echo 'MANUTENÇÃO';
    }else{
  ?>
</div>
<section class="content4 cid-tbWTAUdE5o" id="content4-2z">
<div class="container-fluid">
        <div class="row">
        <?php include_once 'controllers/cadastrar/ControllerInsert.php';?>
        </div>
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-8">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                  <strong>Entrar</strong>
                  <center>
                  <div style="width: 150px; margin-top: 20px;">
                    <img src="assets/images/medhub_principal-beta.png" alt="MedHub">  
                  </div>
                  </center>
                </h3> 
            </div>
        </div>
    </div>
</section>
<div class="container">
  <div class="row align-items-start">
    <div class="col">
        <center>
        
        <form action="#" method="post">
          <div class="form-group col-md-4">
            <input class="place_form form-control" type="email" id="username" name="email_acad" placeholder="Email" style="border-radius: 25px;">
          </div>
          <div class="form-group col-md-4">
              <input class="place_form form-control" type="password"  id="password" name="senha_acad" placeholder="Senha" style="border-radius: 25px;">
          </div>
 
          <p style="font-size: 12px; margin-left:-150px; margin-top: -10px;"><a href="recuperar-senha.php">Esqueci minha senha?</a></p>
            <br />
          <button class="btn btn-white display-4" type="submit" name="logar"> 
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Prosseguir
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
          </button>
            <div class="form-group col-md-4">
                <label class="form-check-label" for="gridCheck" style="font-size: 12px;  margin-top: 1px; color: #fff;">
                Você ainda não possui uma conta. <a href="cadastrar.php" style="color: yellow;">Cadastre-se!</a>
              </label>
              <!--<input style="font-size: 12px; margin-left: 5px; margin-top: 15px;" class="form-check-input" type="checkbox" id="gridCheck">
              <label class="form-check-label" for="gridCheck" style="font-size: 12px; margin-left: 25px; margin-top: 13px; color: #fff;">
                Salvar usuário e senha
              </label>-->
              <label class="form-check-label" for="gridCheck" style="font-size: 12px; margin-left: 0px; margin-top: 23px; color: #fff;">
                Versão 1.1.2 - Beta
              </label>
            </div>
        </form>
        </center>
    </div>
  </div>
</div>
<div>
<section class="content4 cid-tbWTAUdE5o" id="content4-2z">
</div>
<?php include 'includes/footerIndex.php';
}
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
