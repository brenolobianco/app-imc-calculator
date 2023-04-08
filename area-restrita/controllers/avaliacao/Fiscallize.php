
<?php

// help
function objectToArray($d) {
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }

    return $d;
}

interface FiscallizeInterface {
    public function criarEstundate($name, $email, $password, $enrollmentNumber, $idAvaliacao);

}


/**
 *
 * 
 * @copyright      MedHub - https://medhub.com.br
 * @author         antonio antoniocesar16794@gmail.com
 * @license        https://medhub.com.br/license
 * @link           https://medhub.com.br
 * @since          1.0.0
 * @package        MedHub
 * 
 * 
 * @note           Este arquivo é parte do pacote MedHub
 */
class FiscallizeSQL {
    
    private $conexao;


    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function adicionarUsuario($id_usuario, $uuid_fiscallize) {
        /**
         * Adiciona um usuario
         * 
         * 
         * @param string $id_usuario - id do usuario
         * 
         * @return bool - `true` se o usuario foi adicionado com sucesso
         */

         $select = "INSERT INTO usuarios_fiscallize(id_usuario, uuid_fiscallize) VALUES (:id_usuario, :uuid_fiscallize)";
         $result = $this->conexao->prepare($select);
         $result->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
         $result->bindParam(':uuid_fiscallize', $uuid_fiscallize, PDO::PARAM_STR);
         
         $result ->execute();
         $count = $result->rowCount();
         return $count;
    }


    protected function usuarios() {
        /**
         * Retorna todos os usuarios
         * 
         * @return array
         */
        $sql = "SELECT * FROM usuarios_fiscallize";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function usuario($id) {
        /**
         * Retorna um usuario
         * 
         * @param string $id - id do usuario
         * 
         * @return array
         */
        $sql = "SELECT * FROM usuarios_fiscallize WHERE id = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function usuarioExamesDisponivel($cpf) {
        /**
         * Retorna todos os exames disponiveis para o usuario
         * 
         * 
         * @param string $idLog - id do usuario
         * 
         * @return array
         */

        // retorna o id do usuario
        $idLog = getIdByCPF($this->conexao, $cpf); // pelo do BD com pontos e traço
        
        // pego o estágio do usuário
        $est = getAcademicoEst($this->conexao, $idLog); // filtro pelo estágio do usuário
        
        $sql = "SELECT * FROM avaliacoes INNER JOIN estagio ON avaliacoes.id_est = estagio.id_est WHERE avaliacoes.id_est = :est";
        $result = $this->conexao->prepare($sql);
        $result->bindParam(':est', $est, PDO::PARAM_INT);
        $result->execute();

        $avaliacoes = $result->fetchAll();
        return $avaliacoes;
    }
}


/**
 * 
 * @copyright      MedHub - https://medhub.com.br
 * @author         Antônio - antoniocesar16794@gmail.com
 * 
 * 
 * @link           https://medhub.com.br
 * @since          1.0.0
 * @package        MedHub
 * 
*/
class Fiscallize extends FiscallizeSQL implements FiscallizeInterface {
    private $conexao;
    private $url = "https://remote.fiscallize.com.br/api/v2";

    private $token = ""; 

    public function __construct($conexao, $token) {
        parent::__construct($conexao);
        $this->conexao = $conexao;
        $this->token = $token;
    }

    public function criarEstundate($name, $email, $password, $enrollmentNumber, $idAvaliacao = null) {
        /**
         * Criara um estudante
         * 
         * @param string $name - nome do estudante
         * @param string $email - email do estudante
         * @param string $senha - senha do estudante
         * @param string $enrollmentNumber - matricula do estudante, pode ser utilizado o ID na plataforma
         * 
         * @return array
         */

        $uri = "/students/";
        
        $payload = json_encode(array(
            "name" => $name,
            "email" => $email,
            "enrollment_number" => $password
        ));
        
        $headers = array(
            'Content-Type: application/json'
        );

        try {
            $result = json_decode($this->requestPost($uri, $payload, $headers), true);
            $this->inserirEstudanteEmUmaClasse($result["id"], $idAvaliacao);

            $this->adicionarUsuario($enrollmentNumber, $result["id"]);
            return $result;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function inserirEstudanteEmUmaClasse($idEstudante, $idClasse) {
        /**
         * Insere um estudante em uma classe
         * 
         * @param string $idEstudante - id do estudante UUID
         * @param string $idClasse - id da classe
         * 
         * @return array
         */

        $uri = "/students/$idEstudante/set_classes/";

        $headers = array(
            'Content-Type: application/json'
        );

        $payload = json_encode(array(
            "school_classes" => array(
                $idClasse
            )
        ));

        try {
            $req = $this->requestPost($uri, $payload, $headers);
            $result = json_decode($req, true);
            return $result;
        } catch (\Throwable $th) {
            return false;
        }
    }


    public function resultados() {
        /**
         * 
         * @param string $usuario_id - id do usuario
         * 
         * 
         * @return array - retorna o ranking do estudante
         */
        $uri = "/application-students-results/";

        $headers = array(
            'Content-Type: application/json'
        );


        $res = $this->requestGet($uri, $headers);
        return json_decode($res)->results;        
    }


    public function rankingGeral() {
        /**
         * 
         * @param string $usuario_id - id do usuario
         * 
         * 
         * @return array - retorna o ranking do estudante
         */

        $resultados = $this->resultados();
        $ranking = array();
        
        usort($resultados, function($a, $b) {
            return $b->grade - $a->grade;
        });


        foreach($resultados as $index=>$resultado) {
            $ranking[] = $resultado;
        }


        return $ranking;
    }


    public function rankingProva($id) {
        /**
         * 
         * @param string $id - id da prova
         * 
         * @return array - retorna os resultados organizados por ranking
         * 
         */
        $ranking = array();
        $resultados = $this->resultados();
        foreach($resultados as $resultado) {
            if($resultado->exam_id == $id) {
                array_push($ranking, $resultado);
            }
        }

        $resultado = array_map("objectToArray", $ranking);

        usort($ranking, function($a, $b) {
            return $b->grade - $a->grade;
        });

        
        return $ranking;
    }


    public function classeProva($id) {
        /**
         * 
         * @param string $id - id do estudante
         * 
         * 
         * @return int - retorna a classe do estudante
         */
        $uri = "/students/" . $id;

    }

    public function provas() {
        /**
         * 
         * Pegar provas na Fiscallize
         * 
         */
        $uri = "/exams/";
        $headers = array(
            'Content-Type: application/json'
        );
        $res = $this->requestGet($uri, $headers);
        return json_decode($res)->results;
    }


    public function prova($id) {
        /**
         * 
         * Pegar a prova na Fiscallize
         * 
         */
        $uri = "/exams/" . $id;
        $headers = array(
            'Content-Type: application/json'
        );


        $res = $this->requestGet($uri, $headers);
        return json_decode($res);
    }


    public function classes() {
        /**
         * 
         * Pegar classes na Fiscallize
         * 
         */
        $uri = "/classes/";
        $headers = array(
            'Content-Type: application/json'
        );
        $res = $this->requestGet($uri, $headers);

        return json_decode($res)->results;
    }


    public function rankingPorTurmasEstagioUsuario($idLog) {
        /**
         * 
         * @param string $idLog - id do estudante
         * 
         * 
         * @return array - retorna o ranking por turmas do estágio do usuário
         * 
         **/
        // avaliacoes do usuario
        $avaliacoesMedHub = $this->usuarioExamesDisponivel($idLog); // passo o CPF com pontos e traço
        $resRanking = array();

        foreach ($avaliacoesMedHub as $index => $avaliacao) {
            $idExameMedHub = $avaliacao['avaliacao_id_fiscallize'];
            $res = $this->rankingProva($idExameMedHub);
            $resRanking[] = $res;
        }

        if(!isset($resRanking[0])) {
            return array();
        }

        $resultado = $resRanking[0];
        $resultado = array_map("objectToArray", $resultado);

        usort($resultado, function($a, $b) {
            if($a['grade'] == $b['grade']){
                return 0;
            }

            return ($a['grade'] > $b['grade']) ? -1 : 1;
        });


        return $resultado;
    }

    public function numeroRankingEstagio($idLog) {
        /**
         * 
         * @return string - 2º de 10
         * 
         */
        

        // ranking do estágio geral dele
        $ranking = $this->rankingPorTurmasEstagioUsuario($idLog); // cpf com pontos e tracos 
        $posicao = 0;
        $total = 0;


        $idLog = preg_replace('/[^0-9]/', '', $idLog); // cpf sem pontos e traços
        foreach($ranking as $index => $rank) {
            if($rank['enrollment'] == $idLog) {  // cpf
                $posicao = $index + 1;
            }

            $total++;   
        }


        if($total == 0) {
            return "Não classificado";
        } else if($total == 1) {
            return "1º de 1";
        } else {
            return abs($posicao) . "º de " . $total;
        }
    }

    public function numeroRankingProva($idLog, $idAvaliacao) {
        /**
         * 
         * @return string - exemplo: 2º de 10
         * 
         */
        $resultado = $this->rankingProva($idAvaliacao); 
        $posicao = 0;
        $total = 0;


        $resultado = array_map("objectToArray", $resultado);
        usort($resultado, function($a, $b) {
	    if($a['grade'] == $b['grade']){
                return 0;
            }

            return ($a['grade'] > $b['grade']) ? -1 : 1;
        });

        $idLog =  preg_replace("/[^0-9]/", "", $idLog);
        foreach($resultado as $index => $rank) {
            if($rank["enrollment"] == $idLog) {
                $posicao = $index + 1;

            }

            $total++;   
        }


        if($total == 0) {
            return "Não classificado";
        } else if($total == 1) {
            return "1º de 1";
        } else {
            return abs($posicao) . "º de " . $total;
        }
    }


    public function nota($idAvaliacao) {
        $resultados = $this->resultados();
        $nota = 0;
        foreach($resultados as $resultado) {
            if($resultado->exam_id == $idAvaliacao) {
                $nota = $resultado->grade;
            }
        }
        return $nota;
    }


    public function aplicacoes() {
        /**
         * 
         * Pegar as aplicações na Fiscallize
         * 
         */
        $uri = "/applications/";
        $headers = array(
            'Content-Type: application/json'
        );
        $res = $this->requestGet($uri, $headers);

        return json_decode($res, true)->results;
    }



    private function requestPost($uri, $payload, $headers) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url . $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        $headers[] = 'Authorization: Token ' . $this->token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);
        return $result;
    }


    private function requestGet($uri, $headers = []) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url . $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers[] = 'Authorization: Token ' . $this->token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);
        return $result;       
    }
}

$token = "92946cc4c756b450f9d168d260526bf040946262";
$fiscallize = new Fiscallize($conexao, $token);
