<?php


include_once __DIR__ . '/../../../../area-restrita/models/conecta.php';

include_once __DIR__ . '/../../../controllers/avaliacao/Fiscallize.php';

session_start();
// help
if(!isset($_SESSION['usuariowva']) && (!isset($_SESSION['senhawva']))){
    header("Location: index.php?acao=negado");exit;
}


$selecionaLogado = "SELECT * from login WHERE usuario=:usuarioLogado AND senha=:senhaLogado";

try{
    $result = $conexao->prepare($selecionaLogado); 
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
            global $conexao;
            $this->db = $conexao;
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

        protected function getNomeAula($id) {
            $sql = "SELECT nome_aula FROM aula WHERE id_aula = :id LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            
            $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
            if($fetch['nome_aula'] && $fetch['nome_aula'] != '') {
                return $fetch['nome_aula'];
            };

            return "Aula excluida ou não encontrada";
        }

        protected function getPerguntaPreTeste($idPreTeste) {
            $sql = "SELECT resposta FROM aula WHERE id_aula = :id LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $idPreTeste);
            $stmt->execute();
            
            $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        protected function getAlternativaPreTeste($idPreTeste) {

        }

}



class Individual extends Dados {
    /**
     * 
     * @author antonio antoniocesar16794@gmail.com
     * 
     * Dados para academicos
     * 
     * Academicos
     * 
     */
    public function __construct() {
        parent::__construct();
    }

    public function preTeste() {

        $idUsuario = $this->id_user;


        $sql = "SELECT * FROM progresso_usuario_pre_teste WHERE id_usuario = :id_usuario ORDER BY data DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_usuario', $idUsuario);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    private function tentativasQuiz() {
        $idUsuario = $this->id_user;

        $sql = "SELECT DISTINCT id_pre_teste, MAX(data_tentativa) as data_tentativa, resposta, aprovado FROM quiz_treinamento_tentivas WHERE id_usuario = :id_usuario GROUP BY id_pre_teste ORDER BY data_tentativa ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_usuario', $idUsuario);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function tentativasQuizUsuario($idUsuario) {
        /**
         * 
         * 
         */
        $sql = "SELECT DISTINCT id_pre_teste, MAX(data_tentativa) as data_tentativa, id_vid_aula, id FROM quiz_treinamento_tentivas WHERE id_usuario = :id_usuario GROUP BY id_pre_teste ORDER BY data_tentativa ASC";
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

    private function quantidadePerguntasQuiz($id) {
        /**
         * Quantidade de perguntas no pré-teste
         * 
         * 
         * @return int
         */

        $sql = "SELECT * FROM quiz_treinamento WHERE id_vid_aula = :id_vid_aula";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_vid_aula', $id);
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

    private function getAulaByQuiz($idPreTeste) {
        /**
         * 
         * @return int
         */
        $sql = "SELECT id_vid_aula FROM quiz_treinamento WHERE id_quiz = :id_pre_teste";
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


        return $stmt->rowCount() ? $stmt->rowCount() : 0;
    }

    public function quantidadeAcertosQuiz($id, $idUser) {
        /**
         * 
         * @return int
         */
        $sql = "SELECT * FROM quiz_treinamento_tentivas WHERE id_vid_aula = :id AND aprovado = 1 AND id_usuario = :id_usuario ORDER BY data_tentativa ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':id_usuario', $idUser);
        $stmt->execute();
        $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(empty($fetch)) {
            return 0;
        }
        $rowCount = $stmt->rowCount() ? $stmt->rowCount() : 0;
        return $rowCount;
    }

    public function acertouQuiz($idQuiz, $idUser = null) {
        if($idUser == null) {
            $idUser = $this->id_user;
        }

        if($idUser == false) {
            throw new Exception("Não foi possível identificar o usuário");
        }

        $sql = "SELECT * FROM quiz_treinamento_tentivas WHERE id = :id AND aprovado >= 1 AND id_usuario = :id_usuario  ORDER BY data_tentativa ASC";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bindValue(':id', $idQuiz);
        $stmt->bindValue(':id_usuario', $idUser);
        $stmt->execute();
        $rowCount =  $stmt->rowCount();
        if($rowCount > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function quantidadeAcertosQuizDistIntc($idVid, $idUser) {
        /**
         * 
         * 
         * Quantidade de acertos por aula e usuário
         * 
         * 
         */
        $sql = "SELECT DISTINCT(id_pre_teste) FROM quiz_treinamento_tentivas WHERE id_vid_aula = :id AND aprovado = 1 AND id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $idVid);
        $stmt->bindValue(':id_usuario', $idUser);
        $stmt->execute();
        $rowCount =  $stmt->rowCount();
        return $rowCount ? $rowCount : 0;
    }

    public function quantidadeAcertosQuizByAula($idVidAula) {
        /**
         * 
         * @return int
         * 
         * 
         */
        $sql = "SELECT * FROM quiz_treinamento_tentivas WHERE id_vid_aula = :id_vid_aula AND aprovado = 1 ORDER BY data_tentativa ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_vid_aula', $idVidAula);
        $stmt->execute();

        return $stmt->rowCount() ? $stmt->rowCount() : 0;
    }



    public function getDados() {
        /**
         * 
         * DADOS
         * 
         */

        $pontuacao = $this->notaTodosPreTestes();
        $preTeste = ["pontuacao" => $pontuacao, "media" => $this->mediaPreTeste(), "maior_nota" => $this->maiorNotaPreTeste(), "menor_nota" => $this->menorNotaPreTeste()];

        $pontos = $this->notaTodosQuiz();
        $quiz = ["pontuacao" => $pontos, "media" => $this->mediaQuiz(), "maior_nota" => $this->maiorNotaQuiz(), "menor_nota" => $this->menorNotaQuiz(), "ranking_geral" => $this->rankingGeralQuiz(), "ranking_aula" => $this->rankingAula()];
        global $fiscallize;
        $avaliacao = $fiscallize->rankingHospital(17); //

        $res = [
            "resultado" => [
                "pre_teste" => $preTeste, // array
                "quiz" => $quiz,
                "avaliacao" => $avaliacao,
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


    public function notaQuiz($aulaId) 
    {
        /**
         * 
         * Nota do usuário no quiz.
         * 
         */
        // $idVidAula = $this->getAulaByQuiz($idQuiz);
        //$quantidadeAcertos = $this->quantidadeAcertosQuiz($aulaId);
        //return $quantidadeAcertos;
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
    }

    
    private function porcentagemAcertoPreTeste($preTesteId):string {
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
        $notas = [];

        foreach($todasTentativas as $preTeste) {
            $nota = $this->quantidadeAcertosPreTeste($preTeste['id_pre_teste']);
            $idAula = $this->getAulaByPreTeste($preTeste['id_pre_teste']);
            $nomeAula = $this->getNomeAula($idAula);

            $arr = array("id_pre_teste" => $preTeste['id_pre_teste'], "id_aula" => $idAula, "nome_aula" => $nomeAula,  "nota" => $nota, "data" => $preTeste['data_tentativa']);
            $notas[] = $arr;

        }

        return $notas;
    }

    
    private function notaTodosQuiz() {
        $todasTentativas = $this->tentativasQuiz();
        $notas = [];
        $pontuacaoTotal = 0;
        foreach($todasTentativas as $tentativa) {
            // $nota = $this->quantidadeAcertosQuiz($tentativa['id_vid_aula']);
            $id = $tentativa['id_pre_teste'];
            $aulaId =$this->getAulaByQuiz($id);
            $respostaPreTeste = $tentativa['resposta'];
            $nota = $tentativa['aprovado'];
            $pontuacaoTotal += $nota;
            $arr = array("id_quiz" => $tentativa['id_pre_teste'], "id_aula" => $aulaId, "resposta_usuario" =>  $respostaPreTeste, "nota" => $nota, "nome_aula" => $this->getNomeAula($aulaId), "data" => $tentativa['data_tentativa']);
            //$nota = $this->notaQuiz($tentativa['id_quiz']);
            $notas[] = $arr;
        }

        $notas = array("pontuacao_total" => $pontuacaoTotal, "notas" => $notas);
        return $notas;
    }


    private function notaTodosQuizUsuario($id) {
        /**
         * Nota do usuário no quiz.
         * 
         */
        $todasTentativas = $this->tentativasQuizUsuario($id);
        $notas = [];

        foreach($todasTentativas as $tentativa) {
            $nota = $this->quantidadeAcertosQuizByAula($tentativa['id_vid_aula']);
            $arra = array("id_quiz" => $tentativa['id_pre_teste'], "id_aula" => $this->getAulaByQuiz($tentativa['id_pre_teste']), "nota" => $nota, "data" => $tentativa['data_tentativa']);
            $nota = $this->notaQuiz($this->getAulaByQuiz($tentativa['id_pre_teste']));
            // print_r($nota);
            $notas[] = $arra;
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


    
    public function qualQuestaoErrouQuiz($idAula) {
        /**
         * 
         * Qual questão errou no QUIZ
         * 
         * Aqui é só quando o usuário finalizar a aula.
         * 
         */
        $sql = "SELECT DISTINCT t.id FROM quiz_treinamento_tentivas t INNER JOIN quiz_treinamento q ON q.id_vid_aula = t.id_vid_aula WHERE t.resposta != q.alternativa_correta AND t.id_vid_aula = :id_aula and t.id_usuario = :id_usuario";
        $sql = $this->db->prepare($sql);
        $idUsuario = $this->id_user;
        $sql->bindValue(":id_aula", $idAula);
        $sql->bindValue(":id_usuario", $idUsuario);
        $sql->execute();
        $questoes = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        return $questoes;
    }

    private function __rankingAula($idAula) {
        $academicos = $this->listarAcademicos();
        $acertos = 0;
        foreach($academicos as $academico) {
            $idUser = $academico['id_acad'];
            $acertos = $this->quantidadeAcertosQuizDistIntc($idAula, $idUser);
            $ranking[] = ["id_usuario" => $academico['id_acad'], "acertos" => $acertos, "nota" => $acertos, "nome" => $academico['nome_acad']];
        }

        // Ordena pela maior nota
        usort($ranking, function($a, $b) {
            if($a['acertos'] == $b['acertos']){
                return 0;
            }

            return ($a['acertos'] > $b['acertos']) ? -1 : 1;
        });


        $ranking["id_aula"] = $idAula;

        return $ranking;
    }

    public function rankingAula() {

        $idsAulas = $this->idsTentivasQuizAulas();
        foreach($idsAulas as $idAula) {
            $idAula = $idAula['id_vid_aula'];
            $ranking[] = $this->__rankingAula($idAula);
        }


        for($i = 0; $i < count($ranking); $i++) {
            $aulas = count($ranking[$i]);

            for($j = 0; $j < $aulas; $j++) {
                $ranking[$i][$j]["pos"] = $j + 1;
                $ranking[$i][$j]["total"] = count($ranking[$i]);
            }
        }


        return $ranking;
    } 


    public function rankingGeralQuiz() {
        /**
         * Ranking de todos os usuários no Quiz.
         * 
         * 
         */
        $todosUsuarioHospital = $this->listarAcademicos();
        $rankingAula = []; // ranking em cada aula
        $notaAula = []; // nota em cada aula
        $total = 0;
        $pos = 1;

        foreach($todosUsuarioHospital as $usuario) {
            $arrayTentativa = []; // array de tentativas do usuario
            $idUser = $usuario['id_acad'];

            $todasTentativas = $this->tentativasQuizUsuario($idUser);
            $nota = 0;
            $acertou = false;
            
            $idsAulasTentativas = $this->idsTentivasQuizAulas($idUser);
            foreach ($idsAulasTentativas as $idAula) {
                $idAula = $idAula['id_vid_aula'];
                $nota += $this->quantidadeAcertosQuizDistIntc($idAula, $idUser);
                $notaDetalhes =  $this->quantidadeAcertosQuizDistIntc($idAula, $idUser);
                $notaAula[] = ["id_aula" => $idAula, "nota" => $notaDetalhes, "nome" => $usuario['nome_acad']];
            }

            foreach($todasTentativas as $tentativa) {
                $idTentativa = $tentativa['id']; // id da tentativa
                $idAula = $tentativa['id_vid_aula']; // id da aula
                $acertou = $this->acertouQuiz($idTentativa, $idUser);
                $arrayTentativa[] = ["id_quiz" => $tentativa['id_pre_teste'], "id_aula" => $tentativa['id_vid_aula'],  "acertou" => $acertou, "data" => $tentativa['data_tentativa']];
            }


            $ranking[] = ["nota" => $nota, "nota_aula" => $notaAula, "id_usuario" => $idUser, "tentativa" => $arrayTentativa];
        }


        // Ordena pela maior nota
        usort($ranking, function($a, $b) {
            $notaA = $a['nota'];
            $notaB = $b['nota'];
            if($notaA == $notaB){
                return 0;
            }

            return ($notaA > $notaB) ? -1 : 1;
        });

        // posição do usuario na lista
        foreach($ranking as $rank) {
            $total++;

            if($rank['id_usuario'] == $this->id_user) {
                $pos = $total;
            }

        }
        

        return ["posicao" => $pos, "total" => $total, "lista" => $ranking, "aulas" => $rankingAula];
    }

    private function idsTentivasQuizAulas($idUsuario =  null) {
        /**
         * ids das aulas que o usuario participou 
         * 
         * 
         */
        if($idUsuario == null) {
            $idUsuario = $this->id_user;
        }

        $sql = "SELECT DISTINCT id_vid_aula FROM quiz_treinamento_tentivas WHERE id_usuario = :id_usuario GROUP BY id_vid_aula ORDER BY data_tentativa ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_usuario', $idUsuario);
        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function maiorNotaQuiz() {
        /**
         * 
         * Maior nota do quiz
         * 
         * 
         */
        $notas = $this->notaTodosQuiz();
        return max($notas);
    }


    public function menorNotaQuiz() {
        $notas = $this->notaTodosQuiz();
        return min($notas);
    }

    public function mediaQuiz() {
        $nota = $this->notaTodosQuiz();

        if(empty($nota)) {
            return 0;
        }

        $notas = [];
        foreach($nota as $n) {
            $notas[] = $n['nota'];
        }

        $media = array_sum($notas) / count($notas);

        return round($media, 1);
    }

    public function mediaQuizUsuario($id) {
        $nota = $this->notaTodosQuizUsuario($id); // pontuacao, ou seja, se tem 8 questoes e acertou 4, a pontuacao é 4 

        $notas = [];
        foreach($nota as $n) {
            $notas[] = $n['nota'];
        }

        if(empty($notas)) {
            return 0;
        }

        $media = array_sum($notas) / count($notas);
        return round($media, 2);
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

        $sql = "SELECT a.*, m.* FROM matricula m JOIN estagio e ON e.id_est = m.est_id_mat JOIN hospital h ON h.id_hosp = m.hosp_id_mat && insc_mat != 'Desistente' INNER JOIN academico a ON m.acad_id_mat = a.id_acad WHERE m.nota_mat >= e.nota_med_est AND m.class_mat = 'sim' AND h.id_hosp = :hosp_id_mat";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':hosp_id_mat', $this->id_hosp);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    private function listarTodosAcademicos() {
        $sql = "SELECT * FROM matricula m JOIN estagio e ON e.id_est = m.est_id_mat JOIN hospital h ON h.id_hosp = m.hosp_id_mat && insc_mat != 'Desistente' INNER JOIN academico a ON m.acad_id_mat = a.id_acad WHERE m.nota_mat >= e.nota_med_est OR m.class_mat = 'sim'";
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


function eAdmin2($email) {
    $emails = ['admin@admin.com']; // manual
    if(in_array($email, $emails)) {
        return true;
    }

    return false;
}


if(isset($_GET['acao'])) {
    $acao = $_GET['acao'];
    $eAdmin = eAdmin2($usuarioLogado);
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