<?php include 'controllers/pagamento/ControllerSelect.php'; ?>
<section class="form3 cid-tc0bT9FsJh" id="form3-3r" style="margin-top: 100px;">

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12">
            <center>
                <h3 style="color: #fff;">Efetuar o Pagamento</h3><br>
                <p style="color: #fff;">Pagando pelo PIX o desconto é maior, o valor fica <strong style="font-size: 30px; color: #4ee44e;"><?= $val_pix_est;?></strong> <br><br>
                <span style="color: yellow;">CHAVE PIX (E-mail): <span style="font-size: 23px;">contato@medhub.app.br</span></span></p>
                <p style="color: #fff;"><br><br>
                
                </p>
            </center>

        </div>
        
        <div class="col-lg-5" style="margin-top: 50px;">
                <div class="card mb-3">
                  <img class="card-img-top" src="assets/images/valores.jpg" alt="Hospital" style="border-radius: 25px 25px 0px 0px">
                  <div class="card-body" style="border-radius: 0px 0px 25px 25px; background-color: #8B0000;">
                    <h5 style="text-align: center; margin-top: 10px; color: #fff; line-height: 1.3;">Após a compra, você deverá realizar o upload dos documentos no seu perfil.</h5>
                  </div>
                </div>
            </div>
  
        <div class="col-lg-5 offset-lg-1 mbr-form" data-form-type="formoid" style="margin-top: 40px;">

            <form action="" method="POST" class="mbr-form form-with-styler">
                <center>
                <div class="dragArea row">
                    <div class="col-sm-12">
                        <img class="w-100" style="float: left;" src="assets/images/logo-seguro.png" alt="Mercado Pago">
                         <br>
                        
                    </div>
                   
                    <div class="col-sm-12" style="color: #fff;">
                        <h4>DE <s style="color: red;"><?= $valor_est;?></s></h4>
                        <h2>POR <span style="color: green;"><?= $valor_desc_est;?></span></h2>
                        
                    </div>
                    
                    <div class="col-sm-12" style="color: #fff;">
                        <br />
                        <a href="<?= $link_valor_est;?>" target="_blank" class="btn btn-white display-4"> PAGAR </a>
                    </div>
                    
                   
                 </div>
                 </center>
            </form>
        </div>
        <div style="width: 100%; height:30px;"></div>
        <p style="color: #fff;"><span style="color: orange;">IMPORTANTE:</span> Se o valor não for compensado em até 24h, o acesso será revogado.</p>
       
        <div style="width: 100%; height:250px;"></div>
        <div class="offset-lg-1"></div>
    </div>
</div>
</section>