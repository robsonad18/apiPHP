<?php 

namespace Source\Models\App;

use Source\Models\Validations\Validate;
use Source\Models\App\User;

/**
 * RESPONSAVEL POR ACOES REFERENTES A API DE USUARIOS
 * @author Robson Lucas
 */
abstract class ApiUser 
{
    /**
     * REST POST
     * @return JSON
     */
    final public static function post ()
    {
        $errors = [];
        $data   = json_decode(file_get_contents('php://input'));
        $user   = new User();
        
        // VERIFICA SE EXISTE ALGUM DADO DE ENTRADA
        if (empty($data) or !$data) 
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(["response"=>"Nenhum dado foi encontrado"]);
            exit;
        }

        if (!Validate::string($data->first_name)) array_push($errors, "Nome");

        if (!Validate::string($data->last_name)) array_push($errors, "SobreNome");

        if (!Validate::email($data->mail)) array_push($errors, "E-mail");

        // MOSTRA ERROS AOS USUARIOS
        if (count($errors) > 0) 
        {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(["response" => "A campos invalidos no formulario","fields"=>$errors]);
            exit;
        }

        // CADASTRA USUARIO
        $user->first_name = $data->first_name;
        $user->last_name  = $data->last_name;
        $user->email      = $data->mail;
        $user->save();

        // ERRO AO CRIAR USUARIO
        if ($user->fail()) 
        {
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode(['response'=>$user->fail()->getMessage()]);
            exit;
        }

        header('HTTP/1.1 201 Created');
        echo json_encode(['response'=>'Usuario criado com sucesso!']);
 
        exit;
    } 





    /**
     * REST GET
     * @return JSON
     */
    final public static function get () 
    {
        header('HTTP/1.1 200 OK');
        
        $return = [];
        $users  = new User();

        if ($users->find()->Count() <= 0) 
        {
            echo json_encode(['response' => 'Nenhum usuario encontrado!']);
            exit;
        }

        foreach ($users->find()->fetch(true) as $user) array_push($return, $user->data());
    
        echo json_encode(['response' => $return]);

        exit;
    }





    /**
     * REST PUT
     * @return JSON
     */
    final public static function put ()
    {
        $userId = filter_input(INPUT_GET, "id");
        $data   = json_decode(file_get_contents('php://input'), false);
        $errors = [];
        
        // VALIDA ID DO USUARIO
        if (!Validate::integer($userId))
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['response'=>'id não informado']);
            exit;
        }

        // VALIDA SE EXISTE ALGUM DADO
        if (empty($data) or !$data) 
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(["response" => "Nenhum dado foi encontrado"]);
            exit;
        }

        if (!Validate::string($data->first_name)) array_push($errors, "Nome invalido");

        if (!Validate::string($data->last_name)) array_push($errors, "Sobrenome invalido");

        if (!Validate::email($data->mail)) array_push($errors, "E-mail invalido");

        // MOSTRA ERROS REFERENTES AOS DADOS ENVIADOS
        if (count($errors) > 0) 
        {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(["response"=>"A campos invalidos no formulario","fields"=>$errors]);
            exit;
        }

        // RETORNA O USUARIO CONFORME O ID
        $user = (new User())->findById($userId);

        // USUARIO NAO ENCONTRADO
        if (empty($user))
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['response'=>'Usuario não encontrado']);
            exit;
        }

        // ATUALIZA USUARIO
        $user->first_name = $data->first_name;
        $user->last_name  = $data->last_name;
        $user->email      = $data->mail;
        $user->save();

        // ERRO AO ATUALIZAR USUARIO
        if ($user->fail())
        {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['response' => $user->fail()->getMessage()]);
            exit;
        }

        header('HTTP/1.1 201 Created');
        echo json_encode(['response' => 'Atualizado com sucesso!']);

        exit;
    }   





    /**
     * REST DELETE
     * @return JSON
     */
    final public static function delete ()
    {
        header('HTTP/1.1 200 OK');

        $userId = filter_input(INPUT_GET, "id");

        // VALIDA ID USUARIO
        if (!Validate::integer($userId)) 
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['response'=>'ID não informado']);
            exit;
        }

        // RETORNA USUARIO CONFORME O ID PASSADO NA REQUISICAO
        $user = (new User())->findById($userId);

        if (empty($user))
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['response'=>'Usuario do ID '.$userId.' não foi encontrado']);
            exit;
        }

        $verify = $user->destroy();

        // SE NAO FOI EXCLUIDO O USUARIO POREM ENVIOU A REQUISICAO
        if (!$verify) 
        {
            header('HTTP/1.1 200 OK');
            echo json_encode(['response'=>'Usuario do ID '.$userId.' não foi encontrado']);
            exit;
        }

        // ERRO AO TENTAR EXCLUIR USUARIO
        if ($user->fail())
        {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['response'=>$user->fail()->getMessage()]);
            exit;
        }

        header('HTTP/1.1 200 ok');
        echo json_encode(['response'=>'Usuario removido com sucesso']);

        exit;
    }





    /**
     * RETORNO PADRAO CASO NAO SEJA PASSADO NENHUM METODO DO PADRAO REST
     * @return JSON
     */
    final public static function getDefault () 
    {
        header('HTTP/1.1 401 Unauthorized');
        echo json_encode(['response'=>'Metodo não previsto na API']);

         exit;
    }
}