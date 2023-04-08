<<<<<<< HEAD
<?php
include 'includes/header.php';
include_once 'controllers/medico/pesquisa/ControllerInsert.php';
?>

<style>
  .content-questao {
    margin-bottom: 2rem;
  }

  .content-questao p {
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    line-height: 1.5rem;
  }

  .content-questao_input {
    width: 98%;
    height: 200px;
    border-radius: 25px;
    padding: 20px 20px;
    border-color: #757575;
    background: #dddddd;
  }

  .margin {
    margin-top: 2rem;
    margin-bottom: 2rem;
  }

  .margin-bottom {
    margin-bottom: 2rem;
  }

  .content-questao .alternativa p {
    font-size: 14px;
    font-weight: normal;
  }
</style>
<section class="content4 cid-tbWTAUdE5o" id="content4-2z">
  <?php if (isset($_GET['med_id'])) : ?>
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="title col-md-12 col-lg-8">
          <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
            <strong>Pesquisa</strong>
          </h3>
        </div>
        <div class="container">
          <div class="row align-items-start">
            <div class="col">
              <form method="post">
                <?= carregarQuestoes($conexao) ?>
                <div class="margin">
                  <button type="submit" name="cadastrar" class="btn btn-white display-4 ">
                    &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Finalizar
                    &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php else : ?>
    <div class="container">
      <div class="row justify-content-center">
        <div class="title col-md-12 col-lg-8">
          <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-4">
            <p>Obrigado pela sua resposta!</p>
          </h3>
        </div>
      </div>
    </div>
    <div class="container margin-bottom">
      <div class="row align-items-start">
        <div class="col">
          <center>
            <a href="index.php" class="btn btn-white display-4">
              &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Página Inicial
              &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
            </a>
          </center>
        </div>
      </div>
    </div>
  <?php endif; ?>

</section>
</section>


=======
<?php
include 'includes/header.php';
include_once 'controllers/medico/pesquisa/ControllerInsert.php';
?>

<style>
  .content-questao {
    margin-bottom: 2rem;
  }

  .content-questao p {
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    line-height: 1.5rem;
  }

  .content-questao_input {
    width: 98%;
    height: 200px;
    border-radius: 25px;
    padding: 20px 20px;
    border-color: #757575;
    background: #dddddd;
  }

  .margin {
    margin-top: 2rem;
    margin-bottom: 2rem;
  }

  .margin-bottom {
    margin-bottom: 2rem;
  }

  .content-questao .alternativa p {
    font-size: 14px;
    font-weight: normal;
  }
</style>
<section class="content4 cid-tbWTAUdE5o" id="content4-2z">
  <?php if (isset($_GET['med_id'])) : ?>
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="title col-md-12 col-lg-8">
          <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
            <strong>Pesquisa</strong>
          </h3>
        </div>
        <div class="container">
          <div class="row align-items-start">
            <div class="col">
              <form method="post">
                <?= carregarQuestoes($conexao) ?>
                <div class="margin">
                  <button type="submit" name="cadastrar" class="btn btn-white display-4 ">
                    &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Finalizar
                    &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php else : ?>
    <div class="container">
      <div class="row justify-content-center">
        <div class="title col-md-12 col-lg-8">
          <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-4">
            <p>Obrigado pela sua resposta!</p>
          </h3>
        </div>
      </div>
    </div>
    <div class="container margin-bottom">
      <div class="row align-items-start">
        <div class="col">
          <center>
            <a href="index.php" class="btn btn-white display-4">
              &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;Página Inicial
              &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
            </a>
          </center>
        </div>
      </div>
    </div>
  <?php endif; ?>

</section>
</section>


>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
<?php include 'includes/footerIndex.php'; ?>