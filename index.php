<?php include 'includes/headerIndex.php';
include 'models/conecta.php';
?>
<div>
  <?php  
  include 'controllers/log/login.php'; 
  $select = "SELECT * from m"; // manutenção
  try{
  	
  $result = $conexao->prepare($select);
  $result ->execute();
  $contar = $result->rowCount();
  if($contar>0){
  while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
    
    if($mostra->m_m != '1'){
      echo 'MANUTENÇÃO';
    }else{
  ?>

<section class="header14 cid-taKoHrR8gd" id="header14-b">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 image-wrapper">
	<div id="wowslider-container1">
        	<div class="ws_images">
        	    <ul>
        	    <?php
        	    $select = "SELECT * from hospital";  
                  try{
                  $result = $conexao->prepare($select);
                  $result ->execute();
                  $contar = $result->rowCount();
                
                  if($contar>0){
                  while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                ?>
        		<li><img src="upload/<?=$mostra->img_hosp;?>" alt="<?=$mostra->nome_hosp;?>" title="<?=$mostra->nome_hosp;?>" id="wows1_0"/></li>
        		<?php
                }
                }else{
                  echo '<div class="alert alert-info">
                      <button type="button" class="close" data-dismiss="warning"></button>
                      <strong> Nada Cadastrado!!!</strong> 
                      </div>';
                }
                }catch(PDOException $e){
                  echo $e;
                }
                ?> 
        	</ul>
    	</div>
	</div>	
	<script type="text/javascript" src="engine1/wowslider.js"></script>
	<script type="text/javascript" src="engine1/script.js"></script>
            </div>
            <div class="col-12 col-md">
                <div class="text-wrapper">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2" style="color:#fff; font-weight: 800">A <span style="color:#88E450; font-weight: 800">Med</span> agora<br>tem um <span style="color:#88E450; font-weight: 800">Hub</span></h1>
                    <p class="mbr-text mbr-fonts-style display-7">A MedHub vai conectar você ao seu estágio de Medicina por meio de um processo seletivo e uma preparação qualificada dentro da nossa plataforma. Tudo isso 100% online.</p>
                    
                    <h3 class="mbr-section-title mbr-fonts-style mb-3 display-5">
                    <strong>Cadastre-se gratuitamente abaixo!</strong>
                    </h3>
                    <div class="mbr-section-btn mt-3">
					<a class="btn btn-white display-4" href="entrar.php" style="width: 250px;">Entrar na Plataforma</a><br>
                    <a class="btn btn-white display-4" href="cadastrar.php" style="width: 250px;">Me Cadastrar</a></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content4 cid-tbiLYSmukm" id="content4-c">
    
    <div class="contaiern">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-8">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                    <strong>A Plataforma</strong></h3>
                <h4 class="mbr-section-subtitle align-center mbr-fonts-style mb-4 display-7"><strong>A MedHub é uma plataforma que funciona como um centro de estudos 100% online, o qual tem por objetivo proporcionar estágios e projetos de pesquisa (em breve) para acadêmicos de Medicina de todo o Brasil.</strong></h4>
                
            </div>
        </div>
    </div>

</section>
<section class="image1 cid-tbiM5EhFcm" id="image1-d">

    <div>
        <div class="row align-items-center">
            <div class="col-12 col-lg-5">
                <div class="image-wrapper">
                    <img src="assets/images/img-box1index-800x560.png" alt="MedHub">
                    
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="text-wrapper">
                    <h3 class="mbr-section-title mbr-fonts-style mb-3 display-5"><strong>Crie sua conta</strong></h3>
                    <p class="mbr-text mbr-fonts-style display-7"><strong>
                        Com o seu perfil MedHub, você fica por dentro dos melhores estágios de Medicina por todo o Rio de Janeiro.
                        Toda informação que você precisa e o acesso facilitado estão aqui!</strong></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="image2 cid-tbiM78DTt8" id="image2-e">
    

    

    <div>
        <div class="row align-items-center">
            <div class="col-12 col-lg-5">
                <div class="image-wrapper">
                    <img src="assets/images/img-box2index-800x560.png" alt="MedHub">
                    
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="text-wrapper">
                    <h3 class="mbr-section-title mbr-fonts-style mb-3 display-5">
                        <strong>Faça sua prova na plataforma MedHub</strong></h3>
                    <p class="mbr-text mbr-fonts-style display-7"><strong>
                        Realize o processo seletivo do seu computador, sem sair de casa. Assim que for aprovado(a), 
                        você garante o seu selo MedHub de qualidade e está apto(a) para realizar o nosso curso preparatório.</strong></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="image1 cid-tbiM5EhFcm" id="image1-d">  
    <div>
        <div class="row align-items-center">
            <div class="col-12 col-lg-5">
                <div class="image-wrapper">
                    <img src="assets/images/img-box3index-800x560.png" alt="MedHub">   
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="text-wrapper">
                    <h3 class="mbr-section-title mbr-fonts-style mb-3 display-5"><strong>Se prepare para o seu Estágio</strong></h3>
                    <p class="mbr-text mbr-fonts-style display-7"><strong>
                        Após a sua aprovação, a MedHub te oferecerá o nosso Curso de Aprimoramento (preparatório), visando a sua qualificação para o Estágio. Depois disso, 
                        é só aguardar a classificação e aproveitar o melhor de nossos hospitais conveniados.</strong></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="team2 cid-tbiNHsitrg" xmlns="http://www.w3.org/1999/html" id="team2-h">
    <div class="container">
        <div class="card">
            <div class="card-wrapper">
                <div class="row align-items-center">
                    <div class="col-12 col-md-5">
                        <h5 class="card-title mbr-fonts-style m-0 display-2">
                                <strong>Garanta o seu</strong></h5>
                        <div class="image-wrapper">
                            <img src="assets/images/selo-medhub-506x506.png" alt="MedHub">
                        </div>
                    </div>
                    <div class="col-md-7">
              
                            <p class="mbr-text" style=" margin-left: 20px; font-size: 24px;"><strong>
                                Após a sua aprovação, o selo MedHub mostra para o hospital escolhido que 
                                você está apto para fazer parte daquele corpo clínico. São poucos que o possuem, 
                                então aproveite essa oportunidade e não esqueça de assistir o nosso curso que te 
                                capacitará para o estágio!</strong></p>
                  
                    </div>
                </div>
            </div>
        </div>    
    </div>
</section>
<!--<section class="clients cid-tbCoPjGIC8" id="clients-0">
	<div class="container mb-5">
            <div class="media-container-row">
                <div class="col-12 align-center">
                    <h2 class="mbr-section-title pb-3 mbr-fonts-style display-2" style="color:#fff;"><strong>
                        Nossos Convênios</strong></h2>
                </div>
            </div>
    </div>
	<div class="container">
        <div class="carousel slide" data-ride="carousel" role="listbox">
            <div class="carousel-inner" data-visible="5">
                <div class="carousel-item ">
                    <div class="media-container-row">
                        <div class="col-md-12">
                            <div class="wrap-img ">
                                <img src="assets/images/logo-clientes-1.png" class="img-responsive clients-img" alt="" title="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item ">
                    <div class="media-container-row">
                        <div class="col-md-12">
                            <div class="wrap-img ">
                                <img src="assets/images/logo-clientes-1.png" class="img-responsive clients-img" alt="" title="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item ">
                    <div class="media-container-row">
                        <div class="col-md-12">
                            <div class="wrap-img ">
                                <img src="assets/images/logo-clientes-1.png" class="img-responsive clients-img" alt="" title="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item ">
                    <div class="media-container-row">
                        <div class="col-md-12">
                            <div class="wrap-img ">
                                <img src="assets/images/logo-clientes-1.png" class="img-responsive clients-img" alt="" title="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item ">
                    <div class="media-container-row">
                        <div class="col-md-12">
                            <div class="wrap-img ">
                                <img src="assets/images/logo-clientes-1.png" class="img-responsive clients-img" alt="" title="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item ">
                    <div class="media-container-row">
                        <div class="col-md-12">
                            <div class="wrap-img ">
                                <img src="assets/images/logo-clientes-1.png" class="img-responsive clients-img" alt="" title="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item ">
                    <div class="media-container-row">
                        <div class="col-md-12">
                            <div class="wrap-img ">
                                <img src="assets/images/logo-clientes-1.png" class="img-responsive clients-img" alt="" title="">
                            </div>
                        </div>
                    </div>
                </div>
			</div>
        </div>
    </div>
</section>-->
<section class="content4 cid-tbY4eYdENF" id="content4-35">
   <div class="container">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-8">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                    <br><strong>#MeuSangueVerde</strong>
				</h3>
                <h4 class="mbr-section-subtitle align-center mbr-fonts-style mb-4 display-7">
                    <strong>Em breve na Apple Store e Google Play</strong>
                </h4>
            </div>
        </div>
    </div>
</section>

<?php 

include 'includes/footerIndex.php';
}
}
}else{
  echo '<div class="alert alert-info">
      <button type="button" class="close" data-dismiss="warning"></button>
      <strong> Nada Cadastrado!!!</strong> 
      </div>';
}
}catch(PDOException $e){
  echo $e;
}
?> 
