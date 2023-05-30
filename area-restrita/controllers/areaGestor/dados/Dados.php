<?php


include_once __DIR__ . '/../../../../area-restrita/models/conexao.php';

session_start();
// help
if(!isset($_SESSION['usuariowva']) && (!isset($_SESSION['senhawva']))){
    header("Location: index.php?acao=negado");exit;
}


$selecionaLogado = "SELECT * from login WHERE usuario=:usuarioLogado AND senha=:senhaLogado";

try{
    $result = $conn->prepare($selecionaLogado); 
    $usuarioLogado = $_SESSION['usuariowva'];
    $senhaLogado = $_SESSION['senhawva'];
    $result->bindParam('usuarioLogado',$usuarioLogado, PDO::PARAM_STR);     
    $result->bindParam('senhaLogado',$senhaLogado, PDO::PARAM_STR);     
    $result->execute();
    $contar = $result->rowCount();  
    if($contar =1){
        $loop = $result->fetchAll();
        foreach ($loop as $show){
            $idLogado = $show['id'];
            $idLog = $show['id'];
            $nomeLogado = $show['nome'];
            $userLogado = $show['usuario'];
            $senhaLogado = $show['senha'];
            //$nivelLogado = $show['nivel'];
            $emailLogado = $show['usuario'];
            $imgLogado = $show['img'];
            
        }
    }
    
}catch (PDOException $erro){ echo $erro;}


abstract class Dados {
    
        protected $id_user;
        protected $id_hosp;
        protected $db;


        public function __construct() {
            global $conn;
            $this->db = $conn;
        }

        public function setIdUser($id_user) {
            $this->id_user = $id_user;
        }

        public function getIdUser() {
            return $this->id_user;
        }

    
        public function setIdHosp($id_hosp) {
            $this->id_hosp = $id_hosp;
        }

        public function getIdHosp() {
            return $this->id_hosp;
        }

        public function log($msg) {
            $datetime = date("Y-m-d H:i:s");
            echo "\n--------------------".$datetime."------------------------";
            echo "\n" . $msg . "\n";
            echo "---------------------------------------------------------------\n";
        }

}

class Individual extends Dados {
    public function __construct() {
        parent::__construct();
    }

    public function preTeste() {
        $idUsuario = $this->id_user;
        $idHosp = $this->id_hosp;


        $sql = "SELECT * FROM progresso_usuario_pre_teste WHERE id_usuario = :id_usuario ORDER BY data DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_usuario', $idUsuario);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    private function tentativasQuiz() {
        $idUsuario = $this->id_user;
        $idHosp = $this->id_hosp;

        $sql = "SELECT DISTINCT id_quiz FROM quiz_treinamento_tentativas WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_usuario', $idUsuario);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function tentativasPreTeste() {
        /**
         * 
         * @return array
         */
        $idUsuario = $this->id_user;
        $idHosp = $this->id_hosp;

        $sql = "SELECT DISTINCT id_pre_teste, MAX(data_tentativa) as data_tentativa FROM quiz_treinamento_pre_teste_tentivas WHERE id_usuario = :id_usuario GROUP BY id_pre_teste ORDER BY data_tentativa ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_usuario', $idUsuario);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function quaisQuestaoErrouPreTeste($idPreTeste) {
        /**
         * 
         * @return array
         */
        $idUsuario = $this->id_user;
        $idHosp = $this->id_hosp;

        $sql = "SELECT * FROM quiz_treinamento_pre_teste_tentivas WHERE id_usuario = :id_usuario AND id_pre_teste = :id_pre_teste AND aprovado = 0 OR num_erros > 0";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_usuario', $idUsuario);
        $stmt->bindValue(':id_pre_teste', $idPreTeste);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function quantidadePerguntasPreTeste($idPreTeste) {
        /**
         * Quantidade de perguntas no pré-teste
         * 
         * 
         * @return int
         */
        $idVidAula = $this->getAulaByPreTeste($idPreTeste);

        $sql = "SELECT * FROM treinamento_pre_teste WHERE id_vid_aula = :id_vid_aula";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_vid_aula', $idVidAula);
        $stmt->execute();

        return $stmt->rowCount();
    }

    private function getAulaByPreTeste($idPreTeste) {
        /**
         * 
         * @return int
         */
        $sql = "SELECT id_vid_aula FROM treinamento_pre_teste WHERE id_pre_teste = :id_pre_teste";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_pre_teste', $idPreTeste);
        $stmt->execute();

        $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(isset($fetch[0])) {
            return $fetch[0]['id_vid_aula'];
        } else {
            return 0;
        }
    }



    public function quantidadeAcertosPreTeste($idPreTeste) {
        /**
         * 
         * @return int
         */
        $sql = "SELECT * FROM quiz_treinamento_pre_teste_tentivas WHERE id_pre_teste = :id_quiz AND aprovado = 1 ORDER BY data_tentativa ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_quiz', $idPreTeste);
        $stmt->execute();


        return $stmt->rowCount();
    }


    public function getDados() {
        
        $preTeste = array_values($this->preTeste());
        $pontuacao = $this->notaTodosPreTestes();
        $PreTeste = ["pontuacao" => $pontuacao, "media" => $this->mediaPreTeste(), "maior_nota" => $this->maiorNotaPreTeste(), "menor_nota" => $this->menorNotaPreTeste()];

        $res = [
            "resultado" => [
                "pre_teste" => $PreTeste, // array
                ]
        ];
        

        return $res;
    }


    public function notaPreTeste($preTesteId) {
        /**
         * 
         * Nota do pré teste
         * 
         * 
         * @return float
         */
        $quantidadePerguntas = $this->quantidadePerguntasPreTeste($preTesteId);
        $quantidadeAcertos = $this->quantidadeAcertosPreTeste($preTesteId);
        
        if($quantidadeAcertos > $quantidadePerguntas) {
            $quantidadeAcertos = $quantidadePerguntas;
        }

        $nota = $quantidadeAcertos;
        return $nota;
    }


    public function mediaPorcentagemAcertoPreTeste() {
        $todos = $this->tentativasPreTeste();
        $total = 0;
        $count = 0;
        foreach($todos as $tentativa) {
            $total += $this->porcentagemAcertoPreTeste($tentativa['id_pre_teste']);
            $count++;
        }
        $media = round(($total / $count), 2);

        $this->log("Média de acerto do pré-teste(porcentagem): " . $media . "%");
    }

    
    private function porcentagemAcertoPreTeste($preTesteId) {
        /**
         * 
         * Porcentagem de acerto do pré teste
         * 
         * 
         * @return float
         */
        $quantidadePerguntas = $this->quantidadePerguntasPreTeste($preTesteId);
        $quantidadeAcertos = $this->quantidadeAcertosPreTeste($preTesteId);
        if($quantidadeAcertos > $quantidadePerguntas) {
            $quantidadeAcertos = $quantidadePerguntas;
        }

        $porcentagem = ($quantidadeAcertos / $quantidadePerguntas) * 100;
        $log = "Porcentagem de acerto do pré-teste: " . $porcentagem . "% - Quantidade de acertos: " . $quantidadeAcertos . " - Quantidade de perguntas: " . $quantidadePerguntas;
        $this->log($log);
        return $porcentagem;
    }



    public function notaTodosPreTestes() {
        /**
         * 
         * Nota de todos os pré testes
         * 
         * 
         * @return array string
         */

        $todasTentativas = $this->tentativasPreTeste();

        foreach($todasTentativas as $preTeste) {
            $nota = $this->quantidadeAcertosPreTeste($preTeste['id_pre_teste']);
            $arra = array("id_pre_teste" => $preTeste['id_pre_teste'], "id_aula" => $preTeste['id_vid_aula'], "nota" => $nota, "data" => $preTeste['data_tentativa']);
            $notas[] = $arra;

        }

        return $notas;
    }

    public function notaTodosQuiz() {
        $todasTentativas = $this->tentativasQuiz();
        $notas = [];

        foreach($todasTentativas as $preTeste) {
            $nota = $this->notaPreTeste($preTeste['id_pre_teste']);
            $notas[] = $nota;
        }

        return $notas;
    }

    public function mediaPreTeste() {
        /**
        * 
        * Média do pré teste
        * 
        * 
        */
        $nota = $this->notaTodosPreTestes();
        
        if(empty($nota)) {
            return 0;
        }

        $notas = [];
        foreach($nota as $n) {
            $notas[] = $n['nota'];
        }

        $media = array_sum($notas) / count($notas);

        return round($media, 2);
    }

    public function maiorNotaQuiz() {
        /**
         * 
         * Maior nota do quiz
         * 
         * 
         */
        $notas = $this->notaTodosPreTestes();
        return max($notas);
    }

    public function maiorNotaPreTeste() {
        /**
         * 
         * Maior nota do pré teste
         * 
         * 
         */
        $nota = $this->notaTodosPreTestes();
        $notas = [];
        foreach($nota as $n) {
            $notas[] = $n['nota'];
        }

        if(empty($notas)) {
            return 0;
        }

        return max($notas);
    }

    public function menorNotaPreTeste() {
        /**
         * 
         * Menor nota do pré teste
         * 
         * 
         */
        $nota = $this->notaTodosPreTestes();
        $notas = [];
        foreach($nota as $n) {
            $notas[] = $n['nota'];
        }
        
        if(empty($notas)) {
            return 0;
        }

        return min($notas);
    }

    public function listarAcademicos() {

        if($this->getIdHosp() == "all") {
            return $this->listarTodosAcademicos();
        }

        $sql = "SELECT DISTINCT acad_id_mat, hosp_id_mat, academico.nome_acad, academico.id_acad FROM matricula INNER JOIN academico ON academico.id_acad = matricula.acad_id_mat WHERE matricula.hosp_id_mat = :hosp_id_mat";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':hosp_id_mat', $this->id_hosp);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    private function listarTodosAcademicos() {
        $sql = "SELECT DISTINCT acad_id_mat, hosp_id_mat, academico.nome_acad, academico.id_acad FROM matricula INNER JOIN academico ON academico.id_acad = matricula.acad_id_mat";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

class Coletivo extends Dados {


    public function getDados() {
        $sql = "SELECT * FROM  WHERE id_hosp = :id_hosp";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_hosp', $this->id_hosp);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}


function eAdmin($email) {
    if($email == 'admin@admin.com') {
        return true;
    } 

    return false;
}

if(isset($_GET['acao'])) {
    $acao = $_GET['acao'];
    $eAdmin = eAdmin($emailLogado);
    $hospitalId = $idLog;
    if($eAdmin) {
        $idLog = $_GET['id'];
        $hospitalId = !empty($_GET['hospital']) ? $_GET['hospital'] : 'all';
    } else {
        $idLog = $idLogado;
    }


    if($acao == 'mostrar-dado-individual') {
        $academicoId = $_GET['academico'];

        $individual = new Individual();
        $individual->setIdHosp($hospitalId);
        $individual->setIdUser($academicoId);
        $dados = $individual->getDados();
        echo json_encode($dados);
    } else if($acao == 'listar-academicos-hospital') {
        $individual = new Individual();
        $individual->setIdHosp($hospitalId);
        $dados = $individual->listarAcademicos();
        echo json_encode($dados);
    } else if($acao == 'mostrar-dado-coletivo') {
        $coletivo = new Coletivo();
        
    }
}