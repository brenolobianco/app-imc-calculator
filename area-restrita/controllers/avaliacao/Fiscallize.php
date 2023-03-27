
<?php


interface FiscallizeInterface {
    public function criarEstundate($email, $senha);
    public function rankingGeral($id);

    public function infoLinkAula($link);

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

    public function adicionarUsuario($id_usuario) {
        /**
         * Adiciona um usuario
         * 
         * adicione a extensão uuid no php.ini ou instale a extensão `sudo apt get install php-uuid`
         * 
         * @param string $id_usuario - id do usuario
         * 
         * @return bool - `true` se o usuario foi adicionado com sucesso
         */
        if(!function_exists('uuid_create')) {
            throw new Exception("A extensão uuid não foi encontrada");
        }

        $uuid = uuid_create();
        $sql = "INSERT INTO usuarios_fiscallize (id_usuario, uuid_fiscallize) VALUES (:id_usuario, uuid_fiscallize)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(":id_usuario", $id_usuario);
        $stmt->bindParam(":uuid_fiscallize", $uuid);
        $stmt->execute();
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

}


/**
 * 
 * @copyright      MedHub - https://medhub.com.br
 * @author         Antonio - antoniocesar16794@gmail.com
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
        $this->conexao = $conexao;
        $this->token = $token;
    }

    public function criarEstundate($email, $senha) {
        /**
         * Criara um estudante
         * 
         * @param string $email - email do estudante
         * @param string $senha - senha do estudante
         * 
         * 
         * @return array
         */

        $uri = "/students/";
        
        $payload = json_encode(array(
            "email" => $email,
            "password" => $senha
        ));
        
        $headers = array(
            'Content-Type: application/json'
        );

        $result = $this->requestPost($uri, $payload, $headers);

        return json_decode($result);    
    
    }

    public function resultadosProvas() {
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


    public function rankingGeral($usuario_id) {
        /**
         * 
         * @param string $usuario_id - id do usuario
         * 
         * 
         * @return array - retorna o ranking do estudante
         */
        $resultados = $this->resultadosProvas();
        $ranking = array();
        foreach($resultados as $resultado) {
            if($resultado->student->id == $usuario_id) {
                $ranking[] = $resultado;
            }
        }   

        return $ranking;
    }


    public function rankingUsuario($usuario_id, $prova) {
        /**
         * 
         * @param string $usuario_id - id do usuario
         * @param string $prova - id da prova
         * 
         * 
         * @return array - retorna o ranking do estudante
         */
        $resultados = $this->resultadosProvas();
        $ranking = array();
        foreach($resultados as $resultado) {
            if($resultado->student->id == $usuario_id && $resultado->exam->id == $prova) {
                $ranking[] = $resultado;
            }
        }

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

$fiscallize = new Fiscallize($conexao, "92946cc4c756b450f9d168d260526bf040946262");