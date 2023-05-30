<?php 

include_once 'controllers/cadastrar/ControllerUpdate.php';

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
<section class="content11 cid-tbuTtlCPxf" id="content11-1h">
    
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="mbr-section-btn align-center">
                <a class="btn btn-white display-4" href="home.php?acao=perfil-estagios&id_acad=<?= $id_acad;?>" style="width: 200px;">Meu Estágio</a> 
				<a class="btn btn-white display-4" href="home.php?acao=perfil-inscricoes&id_acad=<?= $id_acad;?>"  style="width: 200px;">Minhas Inscrições</a>
                <a class="btn btn-black display-4" href="home.php?acao=perfil-meus-dados&id_acad=<?= $id_acad;?>"  style="width: 200px;">Meus Dados</a>
				</div>
            </div>
        </div>
    </div>
</section>
<br>
<section class="features16 cid-tbuZATmCi7" id="features17-1i">
    <div class="container">
        <div class="content-wrapper">
            <div class="row align-items-center">
                <div class="col-12 col-lg-7">
                    <div class="text-wrapper">
                        <h6 class="card-title mbr-fonts-style display-5">
                            <strong>Meus Dados</strong>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="form4 cid-tbWTIo9B9k mbr-fullscreen" id="form4-32">

    <div class="container">
	    <div class="row justify-content-center align-items-center">
            <div class="col-md-3 image-wrapper">
              <div class="form-row">
                <?php if($img_acad == null){
                    $perfil = "assets/images/user.png";
                }else{
                    $perfil = "upload/$img_acad";
                }?>
                <img class="w-100" src="<?= $perfil;?>" alt="<?= $nome_acad;?>" style="height: 220px; border-radius: 20px 20px 0px 0px;">
                <input type="file" class="place_form form-control" name="img[]" style="border-radius: 0px 0px 20px 20px;">
              </div>
            </div>
            <div class="col-md-5">
            <form action="#" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label style="color: #fff;">Nome</label>
                <input type="text" class="place_form form-control" name="nome_acad" value="<?= $nome_acad;?>" style="border-radius: 25px;">
              </div>
              <div class="form-group">
                <label style="color: #fff;">E-mail</label>
                <input type="text" class="place_form form-control" name="email_acad" value="<?= $email_acad;?>" style="border-radius: 25px;">
              </div>
              <div class="form-group">
                <label style="color: #fff;">Data de Nascimento</label>
                <input type="text" class="place_form form-control" name="data_nasc_acad" value="<?= $data_nasc_acad;?>" style="border-radius: 25px;">
              </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="form-group col-sm">
                  <label style="color: #fff;">CPF</label>
                  <input type="text" class="place_form  form-control" name="cpf_acad" value="<?= $cpf_acad;?>" style="border-radius: 25px;">
                </div>
                    <div class="form-group col-sm">
                    <label style="color: #fff;">Alterar senha</label>
                      <input type="password" class="place_form  form-control" name="senha_acad" value="<?= $senha_acad;?>" style="border-radius: 25px;">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="form-group col-sm">
                      <label style="color: #fff;">Universidade</label>
                      <input type="text" class="place_form  form-control" name="univ_imp_acad" value="<?= $univ_imp_acad;?>" style="border-radius: 25px;">
                    </div>
                    <div class="form-group col-sm">
                    <label style="color: #fff;">Período</label>
                        <select type="text" class="place_form form-control" name="periodo_acad">
                            <option value="<?= $periodo_acad;?>"><b style="color: #fff;">Período atual é o <?= $periodo_acad;?></b></option>
                            <option value="Primeiro">Primeiro</option>
                            <option value="Segundo">Segundo</option>
                            <option value="Terceiro">Terceiro</option>
                            <option value="Quarto">Quarto</option>
                            <option value="Quinto">Quinto</option>
                            <option value="Sexto">Sexto</option>
                            <option value="Sétimo">Sétimo</option>
                            <option value="Oitavo">Oitavo</option>
                            <option value="Nono">Nono</option>
                            <option value="Décimo">Décimo</option>
                            <option value="Décimo primeiro">Décimo primeiro</option>
                            <option value="Décimo segundo">Décimo segundo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="form-group col-sm">
                      <label style="color: #fff;">Interesse 1</label>
                      <input type="text" class="place_form form-control" name="interesse_acad" value="<?= $interesse_acad;?>" style="border-radius: 25px;">
                    </div>
                    <div class="form-group col-sm">
                    <label style="color: #fff;">Interesse 2</label>
                      <input type="text" class="place_form form-control" name="outro_inter_acad" value="<?= $outro_inter_acad;?>" style="border-radius: 25px;">
                    </div>
                </div>
            </div>
            
            
            <div class="col-md-8">
              <button type="submit" name="atualizar" class="btn btn-white display-4">
                  &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Salvar Alterações
                  &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
              </button>
            </div>
              <br><br><br>
            </form> 
                
            </div>
        </div>
    </div>
</section>
<?php } ?>



