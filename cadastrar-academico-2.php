<?php include 'includes/headerIndex.php';?>
<style>
		.leftside {
			margin-top: -100px;
			margin-left:50px;
		}
		
		.labelexpanded {
			font-size: 15px;
		}
		
		.labelexpanded > input {
			display:none;
		}
		
		.labelexpanded input:checked + .radio-btns {
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
			float:left;
			margin-right: 15px;
		}
		
		
	</style>
<section class="content4 cid-tbWTAUdE5o" id="content4-2z">
      
    <div class="container-fluid">
        <div class="row">
        <?php include_once 'controllers/cadastrar/ControllerInsert.php';?>
        </div>
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-8">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                  <strong>Cadastro</strong>  
                </h3> 
                <center>
                <h4 style="color: #fff;">Como nos conheceu?</h4>
                </center>    
            </div>
        </div>
    </div>
</section>

<div style="width: 100%; height: 140px;"></div>
  <div class="container">

   <div class="leftside">

		<label class="labelexpanded"> 
			<input type="radio" name="conheceu_imp_acad" value="Professor"> <div class="radio-btns"> 			
			<p style="margin-top: 8px;"> Professor </p> </div>
		</label>
		
		<label class="labelexpanded"> 
			<input type="radio" name="conheceu_imp_acad" value="Instagram"> <div class="radio-btns">  
      <p style="margin-top: 8px;"> Instagram </p> </div> 
		</label>
		
		<label class="labelexpanded">
			<input type="radio" name="conheceu_imp_acad" value="Linkedin"> <div class="radio-btns"> 
      <p style="margin-top: 8px;"> Linkedin </p> </div> 
		</label>
		
		<label class="labelexpanded"> 
			<input type="radio" name="conheceu_imp_acad" value="Estágio"> <div class="radio-btns"> 
      <p style="margin-top: 8px;"> Estágio </p> </div> 
		</label>

    <label class="labelexpanded"> 
			<input type="radio" name="conheceu_imp_acad" value="Faculdade"> <div class="radio-btns">  
      <p style="margin-top: 8px;"> Faculdade </p> </div> 
		</label>
		
		<label class="labelexpanded">
			<input type="radio" name="conheceu_imp_acad" value="Amigos"> <div class="radio-btns"> 
      <p style="margin-top: 8px;"> Amigos </p> </div> 
		</label>
		
		<label class="labelexpanded"> 
			<input type="radio" name="conheceu_imp_acad" value="Anúncios"> <div class="radio-btns"> 
      <p style="margin-top: 8px;"> Anúncios</p> </div> 
		</label>

    <label class="labelexpanded"> 
			<input type="radio" name="conheceu_imp_acad" value="Liga Acadêmica"> <div class="radio-btns"> 
      <p style="margin-top: 8px;"> Liga Acadêmica </p> </div> 
		</label>
    <center>
    <div class="col-md-4"> 
			<input class="form-control" style="border-radius: 25px;" type="text" name="conheceu_imp_acad" placeholder="Qual? Outro?">  
    </div>
    </center>
	</div>
 </div>
 <div style="width: 100%; height: 200px;"></div>
</section>

<?php include 'includes/footerIndex.php';?>
