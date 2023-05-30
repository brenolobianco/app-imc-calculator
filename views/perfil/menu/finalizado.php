<?php
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<div class="container">
<section class="content4 cid-tc0htyQ19O" id="content4-41">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-10">
                <br><br><br><br>
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                    <strong>Tudo pronto!</strong>
                </h3>
                
                <center>
                 <h5 style="color: #fff;">Primeiro passo concluído, agora é só fica atendo as mensagem no seu pefil.</h5>  
                </center>
            </div>
        </div>
    </div>
</section>
<br>


<section class="content7 cid-tc0htznwpo" id="content7-42">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <center>
                    <a href="home.php?acao=perfil&id_acad=<?=$idLog;?>" class="btn btn-white display-4" style="width: 200px;">Voltar</a>
                </center>
            </div>
         </div>
         <div class="col-sm-12" style="height: 100px;">

         </div>
    </div>
</div>
<br><br><br>
<br><br><br>
</section>
