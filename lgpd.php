<?php

  	try{
		$conexao = new PDO('mysql:host=localhost;dbname=u883305113_medhub', 'u883305113_hub', 'Me34we1*90wsd', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
		$conexao ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo 'Error:' . $e->getMessage();
	}

    if(isset($_POST['cadastrar'])){
        $ip_lgpd   = trim(strip_tags($_POST["ip_lgpd"])); 
        $nav_lgpd  = trim(strip_tags($_POST["nav_lgpd"])); 
        $maq_lgpd  = $_POST["maq_lgpd"]; 
        $data_lgpd = trim(strip_tags($_POST["data_lgpd"])); 

        $insert = "INSERT into lgpd ( ip_lgpd, nav_lgpd, maq_lgpd, data_lgpd ) 
        VALUES ( :ip_lgpd, :nav_lgpd, :maq_lgpd, :data_lgpd )";  

        try{
            $result = $conexao->prepare($insert);
            $result ->bindParam(':ip_lgpd',$ip_lgpd, PDO::PARAM_STR);
            $result ->bindParam(':nav_lgpd',$nav_lgpd, PDO::PARAM_STR);
            $result ->bindParam(':maq_lgpd',$maq_lgpd, PDO::PARAM_STR);
            $result ->bindParam(':data_lgpd',$data_lgpd, PDO::PARAM_STR);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo ''; 
 
        }else{
            echo '<br />
            <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Não foi possível registrar seu OK!</strong> 
            </div>';
        }
        
        }catch(PDOException $e){
            echo $e;
        }                           

    }

$ip = filter_input(INPUT_SERVER, REMOTE_ADDR, FILTER_VALIDATE_IP);
$nav = filter_input(INPUT_SERVER, HTTP_USER_AGENT, FILTER_DEFAULT);

if(strpos($nav, 'OPR')):
$nav2 = 'Opera';
elseif(strpos($nav, 'Firefox')):
$nav2 = 'Firefox';
elseif(strpos($nav, 'MSIE') || strpos($nav, 'trident/')):
$nav2 = 'Explore';
elseif(strpos($nav, 'Chrome')):
$nav2 = 'Chrome';
elseif(strpos($nav, 'Safari')):
$nav2 = 'Safari';
else:
    $nav2 = 'não indentificado';
endif;

$data =  date('Y-m-d H:i:s');

$select = "SELECT * from lgpd WHERE ip_lgpd = '$ip'";  
try{
$result = $conexao->prepare($select);
$result ->execute();
$contar = $result->rowCount();

if($contar>0){
while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>

<?php
}
}else{?>
<div class="lgpd">
    <div class="lgpd--left">
        Utilizamos cookies do próprio navegador para melhorar sua experiência 
        de navegação, para carregamento de imagens entre outros. <br />
        Para conferir detalhes sobre os cookies que utilizamos leia os 
        termos clicando neste link 
        <a href='https://medhub.app.br/termos-lgpd.php' target="_blank">TERMOS LGPD</a>.
    </div>
    <div class="lgpd--right">
        <form action="#" method="POST">
            <input type="hidden" name="ip_lgpd" value="<?= $ip?>">
            <input type="hidden" name="nav_lgpd" value="<?= $nav2?>">
            <input type="hidden" name="maq_lgpd" value="<?= $nav?>">
            <input type="hidden" name="data_lgpd" value="<?= $data?>">
            <button type="submit" name="cadastrar">OK</button>
        </form>
    </div>
</div>
<link rel="stylesheet" href="lgpd.css">
<?php
}
}catch(PDOException $e){
    echo $e;
    
}
?>