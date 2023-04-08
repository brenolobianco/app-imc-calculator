<<<<<<< HEAD
<?php
include 'includes/headerIndex.php';
include_once 'controllers/medico/ControllerInsert.php';
?>
<section class="content4 cid-tbWTAUdE5o" id="content4-2z">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="title col-md-12 col-lg-8">
        <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
          <strong>Cadastro</strong>
        </h3>
        <center>
          <img src="assets/images/etapas-2.png" style="width: 150px;">
          <a class="btn btn-black display-4" href="cadastrar-medico.php" style="width: 225px;">Médico</a>
          <a class="btn btn-white display-4" href="cadastrar-academico.php" style="width: 225px;">Sou Acadêmico</a>
        </center>
        <br /><br /><br />
      </div>
    </div>
  </div>
</section>
<section class="form4 cid-tbWTIo9B9k mbr-fullscreen" id="form4-32" style="margin-top: -120px;">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-md-6" style="margin-top: 53px;">
        <form action="#" method="post">
          <div class="form-group">
            <input type="text" class="place_form form-control" name="nome_med" placeholder="Nome Completo *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="email" class="place_form form-control" name="email_med" placeholder="Email *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="password" class="place_form form-control" name="senha_med" placeholder="Senha *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="password" class="place_form form-control" name="senha2" placeholder="Confirmar Senha *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="text" class="place_form form-control" name="cpf_med" id="cpf" placeholder="CPF *">
          </div>
          <div class="form-group form_espaco">
            <input type="text" class="place_form form-control" name="data_nasc_med" id="data" placeholder="Data de Nascimento *">
          </div>
          <div class="form-group form_espaco">
            <input type="text" class="place_form form-control" name="ano_formacao_med" placeholder="Ano de Formação *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="text" class="place_form form-control" name="estado_atuacao_med" placeholder="Estado de atuação (Exemplo: RJ) *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="text" class="place_form form-control" name="numero_crm_med" placeholder="N° do CRM *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="text" class="place_form form-control" name="especialidade_med" placeholder="Especialidade *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="text" class="place_form  form-control" name="link_cv_lates_med" placeholder="Link CV Lattes (Opcional)">
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
            <img class="w-100" src="assets/images/img-cadastro001-518x518.png" style=" border-radius: 20px 20px;" alt="">
          </div>
        </div>
        <br />
        <center>
          <button type="submit" name="cadastrar" class="btn btn-white display-4">
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Prosseguir
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
          </button>
          <br />
        </center>
      </div>
      </form>
      <script>
        $("#data").mask("99/99/9999");
        $("#cpf").mask("999.999.999-99");
      </script>
    </div>
  </div>
</section>

=======
<?php
include 'includes/headerIndex.php';
include_once 'controllers/medico/ControllerInsert.php';
?>
<section class="content4 cid-tbWTAUdE5o" id="content4-2z">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="title col-md-12 col-lg-8">
        <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
          <strong>Cadastro</strong>
        </h3>
        <center>
          <img src="assets/images/etapas-2.png" style="width: 150px;">
          <a class="btn btn-black display-4" href="cadastrar-medico.php" style="width: 225px;">Médico</a>
          <a class="btn btn-white display-4" href="cadastrar-academico.php" style="width: 225px;">Sou Acadêmico</a>
        </center>
        <br /><br /><br />
      </div>
    </div>
  </div>
</section>
<section class="form4 cid-tbWTIo9B9k mbr-fullscreen" id="form4-32" style="margin-top: -120px;">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-md-6" style="margin-top: 53px;">
        <form action="#" method="post">
          <div class="form-group">
            <input type="text" class="place_form form-control" name="nome_med" placeholder="Nome Completo *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="email" class="place_form form-control" name="email_med" placeholder="Email *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="password" class="place_form form-control" name="senha_med" placeholder="Senha *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="password" class="place_form form-control" name="senha2" placeholder="Confirmar Senha *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="text" class="place_form form-control" name="cpf_med" id="cpf" placeholder="CPF *">
          </div>
          <div class="form-group form_espaco">
            <input type="text" class="place_form form-control" name="data_nasc_med" id="data" placeholder="Data de Nascimento *">
          </div>
          <div class="form-group form_espaco">
            <input type="text" class="place_form form-control" name="ano_formacao_med" placeholder="Ano de Formação *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="text" class="place_form form-control" name="estado_atuacao_med" placeholder="Estado de atuação (Exemplo: RJ) *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="text" class="place_form form-control" name="numero_crm_med" placeholder="N° do CRM *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="text" class="place_form form-control" name="especialidade_med" placeholder="Especialidade *" required>
          </div>
          <div class="form-group form_espaco">
            <input type="text" class="place_form  form-control" name="link_cv_lates_med" placeholder="Link CV Lattes (Opcional)">
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
            <img class="w-100" src="assets/images/img-cadastro001-518x518.png" style=" border-radius: 20px 20px;" alt="">
          </div>
        </div>
        <br />
        <center>
          <button type="submit" name="cadastrar" class="btn btn-white display-4">
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Prosseguir
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
          </button>
          <br />
        </center>
      </div>
      </form>
      <script>
        $("#data").mask("99/99/9999");
        $("#cpf").mask("999.999.999-99");
      </script>
    </div>
  </div>
</section>

>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
<?php include 'includes/footerIndex.php'; ?>