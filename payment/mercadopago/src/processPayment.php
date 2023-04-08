<?php
include("../../../models/conecta.php");

$id_acad = $_POST['academicoId'];
$select = "SELECT * from academico WHERE id_acad=:id_acad";

try{
    $resultAcademico = $conexao->prepare($select);
    $resultAcademico->bindParam(':id_acad', $id_acad, PDO::PARAM_INT);
    $resultAcademico->execute();
    $contar = $resultAcademico->rowCount();

    if($contar>0){
        while($mostra = $resultAcademico->FETCH(PDO::FETCH_OBJ)){
            $id_acad    = $mostra->id_acad;
            $nome_acad  = $mostra->nome_acad;
            $cpf_acad   = $mostra->cpf_acad;
            $rg_acad    = $mostra->rg_acad;
            $univ_imp_acad = $mostra->univ_imp_acad;
            $data_nasc_acad = $mostra->data_nasc_acad;
            $link_cv_lates_acad = $mostra->link_cv_lates_acad;
            $email_acad = $mostra->email_acad;
            $whats_acad = $mostra->whats_acad;
            $cep_acad   = $mostra->cep_acad;
            $uf_acad    = $mostra->uf_acad;
            $cidade_acad = $mostra->cidade_acad;
            $bairro_acad = $mostra->bairro_acad;
            $rua_acad    = $mostra->rua_acad;
            $num_acad    = $mostra->num_acad;
            $img_acad    = $mostra->img_acad;
        }
    }else{
        echo json_encode(array('status'=>-1,'msg'=>'Registro não encontrado'));
        exit;
    }
}catch(PDOException $e){
    echo json_encode(array('status'=>-1,'msg'=>'Registro não encontrado'));
    exit;
}

$date = new DateTime();
$date->setTimezone(new DateTimeZone('America/Sao_Paulo'));
$dataTime = $date->format('Y-m-d H:i:s');

//echo json_encode(array('id'=>'', 'status'=>-1, 'msg'=>'Registro não encontrado'));
//echo json_encode(array('id'=>'', 'status'=>-1, 'msg'=>$_POST));
//exit;
//$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
require_once '../vendor/autoload.php';
//MercadoPago\SDK::setAccessToken("TEST-480299382678206-082814-f1960e11180cad3308351dbfe239556b-79914435");
MercadoPago\SDK::setAccessToken("APP_USR-4879677191931954-101415-36e4df45b739a0972bc05246038e1915-1163641136");

$payment = new MercadoPago\Payment();

$payment->transaction_amount = $_POST['transactionAmount'];
$payment->token = $_POST['token'];
$payment->installments = $_POST['installments'];
$payment->payment_method_id = $_POST['paymentMethodId'];
$payment->issuer_id = $_POST['issuerId'];

$payment->description = $_POST['produtoDescription'];//descrição do produto
$payment->external_reference = $_POST['produtoId'];//id produto

$payer = new MercadoPago\Payer();
//$payer->name = $nome_acad;
$payer->first_name = $nome_acad;
$payer->email = $_POST['email'];
$payer->identification = array(
    "type" => $_POST['identificationType'],
    "number" => $_POST['identificationNumber']
);

$payer->address = array(
    "neighborhood" => $bairro_acad,
    "city" => $cidade_acad,
    "federal_unit" => $uf_acad,
    "street_name" => $rua_acad,
    "street_number" => $num_acad,
    "zip_code" => $cep_acad
);

$payment->payer = $payer;

$result = $payment->save();
//echo json_encode(array('id'=>array(
//    'id' => $payment->id,
//    'status' => $payment->status,
//    'detail' => $payment->status_detail
//), 'status'=>-1, 'msg'=>$result));
//exit;

if ($result) {

    $insertPayment = "INSERT into payment ( academicoId, matriculaId, cursoId, name, document, price, paymentType, token, api, paymentId, paymentDetail, status, createdAt, updatedAt ) 
VALUES ( :academicoId, :matriculaId, :cursoId, :name, :document, :price, :paymentType, :token, :api, :paymentId, :paymentDetail, :status, :createdAt, :updatedAt )";

    $academicoId = $_POST['academicoId'];
    $matriculaId = $_POST['matriculaId'];
    $produtoId = $_POST['produtoId'];
    $name = $_POST['name'];
    $document = $_POST['identificationNumber'];
    $price = $_POST['transactionAmount'];
    $paymentType = '1';
    $token = $_POST['token'];
    $api = 'MercadoPago';
    $status = 1;
    $insc_mat = 'Liberado';

        $resultPayment = $conexao->prepare($insertPayment);
        $resultPayment->bindParam(':academicoId', $academicoId, PDO::PARAM_INT);
        $resultPayment->bindParam(':matriculaId', $matriculaId, PDO::PARAM_INT);
        $resultPayment->bindParam(':cursoId', $produtoId, PDO::PARAM_INT);
        $resultPayment->bindParam(':name', $name, PDO::PARAM_STR);
        $resultPayment->bindParam(':document', $document, PDO::PARAM_STR);
        $resultPayment->bindParam(':price', $price, PDO::PARAM_STR);
        $resultPayment->bindParam(':paymentType', $paymentType, PDO::PARAM_STR);
        $resultPayment->bindParam(':token', $token, PDO::PARAM_STR);
        $resultPayment->bindParam(':api', $api, PDO::PARAM_STR);
        $resultPayment->bindParam(':paymentId', $payment->id, PDO::PARAM_STR);
        $resultPayment->bindParam(':paymentDetail', $payment->status_detail, PDO::PARAM_STR);
        $resultPayment->bindParam(':status', $payment->status, PDO::PARAM_STR);
        $resultPayment->bindParam(':createdAt', $dataTime, PDO::PARAM_STR);
        $resultPayment->bindParam(':updatedAt', $dataTime, PDO::PARAM_STR);
        $resultPayment->execute();

if ($payment->status==='approved') {
        $updateMatricula ="UPDATE matricula SET insc_mat=:insc_mat, pag_mat=:pag_mat WHERE id_mat=:id_mat";
        $resultMatricula = $conexao->prepare($updateMatricula);
        $resultMatricula->bindParam(':id_mat',$_POST['matriculaId'], PDO::PARAM_INT);
        $resultMatricula->bindParam(':insc_mat',$insc_mat, PDO::PARAM_STR);
        $resultMatricula->bindParam(':pag_mat',$api, PDO::PARAM_STR);
        $resultMatricula->execute();
}

    $response_fields = array(
        'id' => $payment->id,
        'status' => $payment->status,
        'detail' => $payment->status_detail
    );

} else {
    $response_fields = array('id'=>$payment->id, 'status'=>$payment->status, 'detail'=>$payment->status_detail);
}

$response_body = json_encode($response_fields);

echo $response_body;