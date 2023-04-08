<?php 
include_once 'controllers/estagio/ControllerSelect.php';
include_once 'controllers/cadastrar/ControllerUpdateEnderecoC.php';

if($id_acad != $idLog){
    echo '<br ?><div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Opss!!!</strong> acesso indevido, entre em contato co o suporte.
            </div>'; exit;
}else{

?>

<section class="content4 cid-tbWTAUdE5o" id="content4-2z" style="margin-top: -50px;">
      
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-8">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                  <strong>Confirmar Endereço</strong>
                </h3>  
                <br /><br />
            </div>
        </div>
    </div>
</section>
<section class="form4 cid-tbWTIo9B9k mbr-fullscreen" id="form4-32" style="margin-top: -120px;">

    <div class="container">
	    <div class="row justify-content-center align-items-center">

            
            <div class="col-md-6">
            <form action="#" method="post">
                <br><br>
                  <div class="form-group">
                    <input type="text" class="place_form form-control" name="cep_acad" placeholder="CEP*" value="<?=$cep_acad;?>">
                  </div>
                  <div class="form-group form_espaco">
                    <input type="text" class="place_form form-control" name="uf_acad" placeholder="UF somente sigla ex: RJ *" value="<?=$uf_acad;?>">
                  </div>
                  <div class="form-group form_espaco">
                    <input type="text" class="place_form form-control" name="cidade_acad" placeholder="Cidade*" value="<?=$cidade_acad;?>">
                  </div>
                  <div class="form-group form_espaco">
                    <input type="text" class="place_form form-control" name="bairro_acad" placeholder="Bairro*" value="<?=$bairro_acad;?>">
                  </div>
                  <div class="form-group form_espaco">
                    <input type="text" class="place_form form-control" name="rua_acad" placeholder="Rua*" value="<?=$rua_acad;?>">
                   </div>
                   <div class="form-group form_espaco">
                    <input type="text" class="place_form form-control" name="num_acad" placeholder="número*" value="<?=$num_acad;?>">
                  </div>
                  <div class="form-group form_espaco">
                    <input type="text" class="place_form form-control" name="comp_acad" placeholder="Complemento *" value="<?=$comp_acad;?>">
                   </div>
            </div>
            
            <div class="col-md-6 image-wrapper" style="margin-top: 80px;">
              <div class="form-row">
                  <div class="form-group">
                    <img class="w-100" src="assets/images/img_cadastromed.png" style=" border-radius: 20px 20px;" alt="">
                  </div>
              </div>
              <br />
              
            </div>
            <div class="col-md-4 image-wrapper" style="margin-top: 0px;">
              <div class="form-row">
                  <div class="form-group">
                  <center>
                  <button type="submit" name="atualizar" class="btn btn-white display-4">
                      &ensp;&ensp;&ensp;Continuar e Comprar
                      &ensp;&ensp;&ensp;
                  </button>
                  </center>
                  </div>
              </div>
            </div>
            </form> 
       
            </div>
        </div>
    </div>
</section>
<?php }?>
