<?php include_once 'includes/headerIndex.php';?>

<section class="mbr-section form1 cid-spUgZxAgL2" id="form1-5">
	<div class="container">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-8">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2" style="color: #88E450;"> 
                    <strong>Fale com a MedHub</strong>
                </h3>
            </div>
        </div>
    </div>
            <div class="container">
	   <div class="contact-main">
	   	    <div class="contact-bottom">
		   	   <div class="contact-right">
		   	     <form action="processaForm.php" method="post">
		   	       <input name="nome" type="text" placeholder="Nome Completo" required/>
					  <input name="email" type="text" placeholder="Seu Email" required/>
					  <input name="fone" type="text" placeholder="DDD/Telefone" required/>
					  <textarea name="mensagem" placeholder="Mensagem" required/></textarea>
					 
		   	    	<input type="submit" value="ENVIAR">
		   	    
		   	     <br>
				</form>
		   	   </div>
	   	    <div class"clearfix"> </div>
	   	  </div>
    </div>
</section>

<section class="footer4 cid-taGwCS6P5S" once="footers" id="footer4-5">
<?php include_once 'includes/footerIndex.php';?>