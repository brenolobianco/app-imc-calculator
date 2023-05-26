<?php

if (($conheceuLog == null && $outroLog == null) && !isset($_SESSION['isMed'])) {

  include_once 'controllers/cadastrar/ControllerPesquisa-1.php';

?>
  <style>
    .leftside {
      margin-top: -100px;
      margin-left: 50px;
    }

    .labelexpanded {
      font-size: 15px;
    }

    .labelexpanded>input {
      display: none;
    }

    .labelexpanded input:checked+.radio-btns {
      background-color: #253c6a;
      color: #fff;
    }

    .radio-btns {
      width: 237px;
      height: 59px;
      border-radius: 15px;
      position: relative;
      text-align: center;
      padding: 15px 20px;
      box-shadow: 0 1px #c3c3c3;
      cursor: pointer;
      background-color: #eaeaea;
      float: left;
      margin-right: 15px;
    }
  </style>

  <section class="content4 cid-tbWTAUdE5o" id="content4-2z">

    <div class="container-fluid">
      <div class="row">

      </div>
      <div class="row justify-content-center">
        <div class="title col-md-12 col-lg-8">
          <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
            <strong>Pesquisa</strong>
          </h3>
          <center>
            <h4 style="color: #fff;">Como nos conheceu?</h4>
          </center>
        </div>
      </div>
    </div>
  </section>

  <div style="width: 100%; height: 140px;"></div>

  <form action="" method="POST">
    <div class="container">
      <div class="leftside">
        <label class="labelexpanded">
          <input type="radio" name="conheceu_imp_acad" value="Professor">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Professor </p>
          </div>
        </label>

        <label class="labelexpanded">
          <input type="radio" name="conheceu_imp_acad" value="Instagram">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Instagram </p>
          </div>
        </label>

        <label class="labelexpanded">
          <input type="radio" name="conheceu_imp_acad" value="Linkedin">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Linkedin </p>
          </div>
        </label>

        <label class="labelexpanded">
          <input type="radio" name="conheceu_imp_acad" value="Estagio">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Estágio </p>
          </div>
        </label>



        <label class="labelexpanded">
          <input type="radio" name="conheceu_imp_acad" value="Faculdade">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Faculdade </p>
          </div>
        </label>

        <label class="labelexpanded">
          <input type="radio" name="conheceu_imp_acad" value="Amigos">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Amigos </p>
          </div>
        </label>

        <label class="labelexpanded">
          <input type="radio" name="conheceu_imp_acad" value="Anúncios">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Anúncios</p>
          </div>
        </label>

        <label class="labelexpanded">
          <input type="radio" name="conheceu_imp_acad" value="Liga Acadêmica">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Liga Acadêmica </p>
          </div>
        </label>
        <center>
          <div class="col-md-4">
            <input class="form-control" style="border-radius: 25px;" type="text" name="outro_conhe_acad" placeholder="Qual? Outro?">
          </div>
        </center>
        <br />
        <center>
          <button type="submit" name="atualizar" class="btn btn-white display-4">
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Prosseguir
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
          </button>
        </center>
      </div>
    </div>
  </form>
  <div style="width: 100%; height: 200px;"></div>
  </section>

<?php } elseif (($interLog == null && $OutroInterLog == null) && !isset($_SESSION['isMed'])) {

  include_once 'controllers/cadastrar/ControllerPesquisa-2.php';

?>
  <style>
    .leftside {
      margin-top: -100px;
      margin-left: 50px;
    }

    .labelexpanded {
      font-size: 15px;
    }

    .labelexpanded>input {
      display: none;
    }

    .labelexpanded input:checked+.radio-btns {
      background-color: #253c6a;
      color: #fff;
    }

    .radio-btns {
      width: 237px;
      height: 59px;
      border-radius: 15px;
      position: relative;
      text-align: center;
      padding: 15px 20px;
      box-shadow: 0 1px #c3c3c3;
      cursor: pointer;
      background-color: #eaeaea;
      float: left;
      margin-right: 15px;
    }
  </style>
  <section class="content4 cid-tbWTAUdE5o" id="content4-2z">

    <div class="container-fluid">
      <div class="row">
        <?php include_once 'controllers/cadastrar/ControllerInsert.php'; ?>
      </div>
      <div class="row justify-content-center">
        <div class="title col-md-12 col-lg-8">
          <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
            <strong>Pesquisa</strong>
          </h3>
          <center>
            <h4 style="color: #fff;">O que busca?</h4>
          </center>
        </div>
      </div>
    </div>
  </section>

  <div style="width: 100%; height: 140px;"></div>
  <form action="" method="POST">
    <div class="container">
      <div class="leftside">
        <label class="labelexpanded">
          <input type="radio" name="interesse_acad" value="Network">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Network </p>
          </div>
        </label>

        <label class="labelexpanded">
          <input type="radio" name="interesse_acad" value="Remuneração">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Remuneração </p>
          </div>
        </label>

        <label class="labelexpanded">
          <input type="radio" name="interesse_acad" value="Estágio">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Estágio </p>
          </div>
        </label>

        <label class="labelexpanded">
          <input type="radio" name="interesse_acad" value="Prática médica">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Prática médica </p>
          </div>
        </label>

        <label class="labelexpanded">
          <input type="radio" name="interesse_acad" value="Postura médica">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Postura médica </p>
          </div>
        </label>

        <label class="labelexpanded">
          <input type="radio" name="interesse_acad" value="Pesquisa">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Pesquisa </p>
          </div>
        </label>

        <label class="labelexpanded">
          <input type="radio" name="interesse_acad" value="Aprendizado teórico">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Aprendizado teórico </p>
          </div>
        </label>
        <label class="labelexpanded">
          <input type="radio" name="interesse_acad" value="Realização">
          <div class="radio-btns">
            <p style="margin-top: 8px;"> Realização </p>
          </div>
        </label>

        <center>
          <div class="col-md-4">
            <input class="form-control" style="border-radius: 25px;" type="text" name="outro_inter_acad" placeholder="Algo mais?">
          </div>
          <br />
          <button type="submit" name="atualizar" class="btn btn-white display-4">
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Prosseguir
            &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
          </button>
        </center>
      </div>
    </div>
  </form>
  <div style="width: 100%; height: 200px;"></div>
  </section>
<?php } else { ?>
  <div class="container">
    <div class="row">
      <div class="nav-right">
        <p style="color: #fff; margin-top: 50px;">Olá, <?= $nomeLog; ?>.</p>
      </div>
    </div>
  </div>
  <section class="image5 cid-tbwY5oMn3o" id="image5-1v">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-7">
          <div class="row">
            <div class="col-sm-6">
              <center>
                <h3><a href="home.php?acao=estagio">Estágio</a></h3>
              </center>
              <br />
              <a href="home.php?acao=estagio">
                <img src="assets/images/estagio-518x518.jpg" style="border-radius: 20px 20px 20px 20px;" alt="Estágio">
              </a>
              <br />
              <center>
                <a href="home.php?acao=estagio" class="btn btn-white display-4">
                  &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Acesso
                  &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                </a>
              </center>
              <br><br>
            </div>


            <div class="col-sm-6">
              <center>
                <h3><a href="home.php?acao=pesquisa">Pesquisa</h3>
              </center>
              <br />
              <a href="home.php?acao=pesquisa">
                <img src="assets/images/pesquisa-518x518.jpg" style="border-radius: 20px 20px 20px 20px;" alt="Pesquisa">
              </a>
              <br />
              <center>
                <a href="home.php?acao=pesquisa" class="btn btn-black display-4">
                  &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Em Breve
                  &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                </a>
              </center>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="footer4 cid-taGwCS6P5S" once="footers" id="footer4-5">
  <?php } ?>