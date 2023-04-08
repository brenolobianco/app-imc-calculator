<?php include 'includes/headerIndex.php';?>
<div>
<?php include_once 'controllers/cadastrar/ControllerInsert-whats.php';?>
</div>
<section class="content4 cid-tbWTAUdE5o" id="content4-2z">
      
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-8">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                  <strong>Cadastro</strong>
                </h3>  
                <center>
                   <img src="assets/images/etapas-2.png" style="width: 150px;"> 
                   <a class="btn btn-white display-4" href="cadastrar-medico.php" style="width: 225px;">Médico</a>
                   <a class="btn btn-black display-4" href="cadastrar-academico.php" style="width: 225px;">Sou Acadêmico</a>
                </center>
                <br /><br /><br />
            </div>
        </div>
    </div>
</section>
<section class="form4 cid-tbWTIo9B9k mbr-fullscreen" id="form4-32" style="margin-top: -120px;">

    <div class="container">
	    <div class="row justify-content-center align-items-center">

            <div class="col-md-6" style="margin-top: 43px;">
            <form action="#" method="post">
                  <div class="form-group">
                    <input type="hidden" name="data_cad_acad" value="<?= date("d/m/Y h:i");?>">
                    <input type="text" class="place_form form-control" name="nome_acad" placeholder="Nome Completo*" required>
                  </div>
                  <div class="form-group form_espaco">
                    <input type="email" class="place_form form-control" name="email_acad" placeholder="Email *" required>
                  </div>
                  <div class="form-group form_espaco">
                    <input type="text" class="place_form form-control" id="whatsApp" name="whats_acad" placeholder="WhatsApp *" required>
                  </div>
                  <div class="form-group form_espaco">
                    <input type="password" class="place_form form-control" name="senha_acad" placeholder="Senha *" required>
                  </div>
                  <div class="form-group form_espaco">
                    <input type="password" class="place_form form-control" name="senha2" placeholder="Confirmar Senha *" required>
                  </div>
                  <div class="form-group form_espaco">
                    <input type="text" class="place_form form-control" name="cpf_acad" id="cpf" placeholder="CPF *" required>
                   </div>
                   <div class="form-group form_espaco">
                    <input type="text" class="place_form form-control" name="data_nasc_acad" id="data" placeholder="Data de Nascimento *" required>
                   </div>
                <div class="form-row form_espaco">
                  <div class="form-group col-md-6">
                    <select type="text" class="place_form form-control" name="periodo_acad" required>
                        <option class=""><b style="color: #fff;">Período *</b></option>
                        <option class="Primeiro">Primeiro</option>
                        <option class="Segundo">Segundo</option>
                        <option class="Terceiro">Terceiro</option>
                        <option class="Quarto">Quarto</option>
                        <option class="Quinto">Quinto</option>
                        <option class="Sexto">Sexto</option>
                        <option class="Sétimo">Sétimo</option>
                        <option class="Oitavo">Oitavo</option>
                        <option class="Nono">Nono</option>
                        <option class="Décimo">Décimo</option>
                        <option class="Décimo primeiro">Décimo primeiro</option>
                        <option class="Décimo segundo">Décimo segundo</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="place_form form-control" name="univ_imp_acad" placeholder="Sigla da Universidade *" required>
                  </div>
                </div> 
                  <div class="form-group form_espaco">
                    <input type="text" class="place_form  form-control" name="link_cv_lates_acad" placeholder="Link CV Lattes ( Opcional )">
                  </div>
                  <div class="form-row">  
                    <div class="form-group col-md-7">
                      <input style="margin-left: 10px;" class="form-check-input" type="checkbox" id="gridCheck" required>
                      <label class="form-check-label" for="gridCheck" style="margin-left: 30px; color: #fff;">
                        Li e estou cientes dos termos* <a href="termos-de-uso.php" target="_blank"> VISUALIZAR</a>
                      </label>
                    </div>
               
              </div>
            </div>
            <div class="col-md-6 image-wrapper">
              <div class="form-row">
                  <div class="form-group">
                    <img class="w-100" src="assets/images/img_cadastromed.png" style=" border-radius: 20px 20px;" alt="">
                  </div>
              </div>
              <br />
              <center>
              <button type="submit" name="cadastrar" class="btn btn-white display-4">
                  &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Prosseguir
                  &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
              </button>
              </center>
            </div>
            </form> 
            <script>
                $("#data").mask("99/99/9999");
                $("#cpf").mask("999.999.999-99");
                $("#whatsApp").mask("(99) 9 9999-9999");
            </script>
                
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footerIndex.php';?>
