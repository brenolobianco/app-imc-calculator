<?php
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<div class="container">
<section class="content4 cid-tc0htyQ19O" id="content4-41">
    <div class="row">
        <div class="col-sm-12">
        <a href="home.php?acao=upload-comprovante-de-residencia" class="nav-link link btn btn-default mb-4 display-2" style="float: left; margin-left: 0px; margin-top: -20px;">
            <img src="assets/images/voltar-light.png" style="width: 100px;">
        </a>
        </div>
        <div class="col-sm-12">
            <center>
            <img src="assets/images/step-4.png" style="width: 300px; margin-top: -20px">
            <br>
            </center>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-10">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                    <strong>Upload Plano de Aula</strong></h3>
            </div>
        </div>
    </div>
</section>
<br>
<style>
    #picture__input {
  display: none;
}

.picture {
  width: 200px;
  height: 180px;
  aspect-ratio: 16/9;
  background: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #aaa;
  border-radius: 25px;
  cursor: pointer;
  font-family: sans-serif;
  transition: color 300ms ease-in-out, background 300ms ease-in-out;
  outline: none;
  overflow: hidden;
}

.picture:hover {
  color: #777;
  background: #ccc;
}

.picture:active {
  border-color: turquoise;
  color: turquoise;
  background: #eee;
}

.picture:focus {
  color: #777;
  background: #ccc;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.picture__img {
  max-width: 100%;
}

</style>

<section class="content7 cid-tc0htznwpo" id="content7-42">
    <div class="container">
        <div class="row justify-content-center">

               

                  <div class="col-sm-12">
                    <form method="post" action="controllers/up/ControllerInsertPa.php" class="form-horizontal" role="form" enctype="multipart/form-data">
                     <center>
                      <div class="form-group">
                        <input type="hidden" name="nome_pa" value="Plano de Aula">
                        <input type="hidden" name="acad_id_pa" value="<?= $idLog;?>">
                        <label class="picture" for="picture__input" tabIndex="0">
                          <span class="picture__image"></span>
                        </label>
                        
                        <input type="file" name="arq_pa" id="picture__input">
                             <p style="font-size: 10px; color: #fff;">Click na imagem para fazer o upload<br>da foto do comprovante</p>         
                        <br>
                        <div class="form-group">
                        <input name="SendCadImg" type="submit" class="btn btn-white display-4" style="width: 200px;" value="Prosseguir"/>
                        </div>
                      </center>
                      </div>
                      
                    </form>
                  </div>
           
            
         </div>
         <div class="col-sm-12" style="height: 100px;">

         </div>
    </div>
</div>
</section>
<script>
    const inputFile = document.querySelector("#picture__input");
const pictureImage = document.querySelector(".picture__image");
const pictureImageTxt = "<img src='assets/images/plano-de-aula.png'>";
pictureImage.innerHTML = pictureImageTxt;

inputFile.addEventListener("change", function (e) {
  const inputTarget = e.target;
  const file = inputTarget.files[0];

  if (file) {
    const reader = new FileReader();

    reader.addEventListener("load", function (e) {
      const readerTarget = e.target;

      const img = document.createElement("img");
      img.src = readerTarget.result;
      img.classList.add("picture__img");

      pictureImage.innerHTML = "";
      pictureImage.appendChild(img);
    });

    reader.readAsDataURL(file);
  } else {
    pictureImage.innerHTML = pictureImageTxt;
  }
});

</script>