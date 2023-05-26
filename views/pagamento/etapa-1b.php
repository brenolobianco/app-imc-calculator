<br />
<?php

    session_start();
    
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    //include 'controllers/pagamento/ControllerSelect.php';
    
?>
<section class="form3 cid-tc0bT9FsJh" id="form3-3r" style="margin-top: 100px;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-12">
                <div class="card mb-3">
                  <img class="card-img-top" src="assets/images/valores.jpg" alt="Hospital" style="border-radius: 25px 25px 0px 0px">
                  <div class="card-body" style="border-radius: 0px 0px 25px 25px; background-color: #8B0000;">
                    <h5 style="text-align: center; margin-top: 10px; color: #fff;"><strong style="color: yellow;">IMPORTANTE</strong>
                    <br><br>Se você não fizer o upload agora,<br><br> porderá posteriormente fazer no seu<br><br> <span style="color: yellow;">PERFIL</span>!</h5>
                  </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <form method="post" action="controllers/pagamento/ControllerInsertCv.php" enctype="multipart/form-data">
                    <input type="hidden" name="acad_id_cv" value="<?=$idLog;?>">
                    <div class="col-lg-12 col-md col-sm-12 form-group">
                        <center>
                        <label style="color: #fff;"> 
                        <a href="https://wwws.cnpq.br/cvlattesweb/pkg_cv_estr.inicio" target="_blank">
                            <strong style="color: orange;">CLIQUE</strong> e saiba como fazer o seu! </a>
                        </label>
                        </center><br />
                        <label style="color: #fff;">Link CV Lates *</label>
                        <input type="text" name="nome_cv" placeholder="link" class="place_form form-control" style="padding-top: 13px; border-radius: 25px;"  required/>
                    </div>
                    <div class="col-lg-12 col-md col-sm-12 form-group">
                        <label style="color: #fff;"> CV Lattes  em PDF
                        </label>
                        <input type="file" name="arq_cv" class="place_form form-control" style="padding-top: 13px; border-radius: 25px;"/>
                    </div>
                    <div class="col-md-auto col-lg-12" style="margin-top: 30px;">
                        <input name="SendCadImg" type="submit" class="btn btn-white display-4" style="margin-left: 120px; width: 200px;" value="Prosseguir"/>
                    </div>
                </form>
            </div>
            <div style="width: 100%; height:250px;"></div>
            <div class="offset-lg-1"></div>
        </div>
    </div>
</section>