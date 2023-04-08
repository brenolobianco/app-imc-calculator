<?php
	try{
		$conexao = new PDO('mysql:host=localhost;dbname=medhub', '', '');
		$conexao ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo 'Error:' . $e->getMessage();
	}

    if(!isset($_GET['id_mat'])){ header("home.php?acao=pagina-nao-existe"); exit;}
        $id_mat = $_GET['id_mat'];
          $select = "SELECT * from matricula WHERE id_mat=:id_mat";  
                
      try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_mat', $id_mat, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();

      if($contar>0){
        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_mat = $mostra->id_mat;
  

        }

    }else{
        echo '<div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Opz!!!</strong> Opss nada adicionado.
        </div>'; exit;
    }
    }catch(PDOException $e){
        echo $e;
	} 
	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	//$dompdf->set_paper('letter', 'landscape');//para configuração paisagem
	
	// Carrega seu HTML
	$dompdf->load_html("

    <style>
        #container {
        width: 100%;
        text-align: center;
        }
        
        #container2 {
        width: 100%;
        text-align: left;
        }
        #container3 {
        width: 100%;
        text-align: right;
        }
        
        .cab {
            float: left;
            width: 20%; height: 70px;
    
        }
        .cab2 {
            float: left;
            width: 59.2%; height: 70px;
    
        }
        .cab3 {
           
            width: 100%; height: 170px;
    
        }
        .cab4 {

            width: 100%; height: 220px;
    
        }
        .cab5 {
            width: 100%; height: 220px;
    
        }
        .cab6 {
  
            width: 100%; height: 70px;
    
        }
        .cab7 {
  
            width: 100%; height: 120px;
    
        }
        
        #cab-1 { 
        border-style: solid; 
        border-width: 1px 1px;
        border-color: #555; 
            
        }
        .logo{
            width:50px; 
            margin-top: 10px;
        }
    
        
        </style>

          
        <div id='container'>
            <div id='cab-1' class='cab'>
                <img class='logo' src='./img/maldivas_logo.png'>
            </div>
            <div id='cab-1' class='cab2'>
                <p style='margin-top: 25px;'>VOUCHER - MALDIVAS</p>
            </div>
            <div id='cab-1' class='cab'>
                <p style='color: #555; font-size: 14px; margin-top: 18px;'>Número<br /> 6021-$cod</p>
            </div>
        </div>
        <div id='container2'>
            <div id='cab-1' class='cab3'>
                <p style='margin-top: 70px; margin-left: 10px; font-size: 16px'>
                <br />
                SALA DE VENDA: ..........Escritório Ingleses<br />
     
   
                </p>
            </div>
        </div>
        <div id='container2'>
            <div id='cab-1' class='cab3'>
                <p style='margin-top: 10px; margin-left: 10px; font-size: 16px'>
                <br />
               
                </p>
            </div>
        </div>
        <div id='container2'>
            <div id='cab-1' class='cab3'>
                <p style='margin-top: 10px; margin-left: 10px; font-size: 16px'>
                <br />
                  
                </p>
            </div>
        </div>
         <div id='container2'>
            <div id='cab-1' class='cab3'>
                <p style='margin-top: 10px; margin-left: 10px; font-size: 16px'>
                <br />
              
                </p>
            </div>
        </div>
  
  
        <div id='container3'>
           
                <p style='font-size: 12px'>
                 IMPRESSÃO ".date('d/m/Y h:i:s')." - Maldivas Resort / SPA
      
        </div>




    

			
		");

	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"Voucher", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);
?>




