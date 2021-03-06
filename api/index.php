<?php


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
//autoload
require 'vendor/autoload.php';
//fichero con la configuracion de la base de datos
require 'config.slim.php';
//generamos un nuevo slimApp con los datos de configuracion de la db
$app = new \Slim\App(['settings'=>$config]);
//creamos un contenedor  de la aplicacion
$container = $app->getContainer();
//dentro del contenedor db creamos la conexion a la DB
$container['db']=function($c)
{
    $db=$c['settings']['db'];
    $pdo=new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'],$db['user'],$db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    return $pdo;

};

/**
 *
 * 
 * Mostrar el listado de usuarios 
 * Ruta: /user
 * 
 */

    
$app->get('/user', function(Request $req, Response $res){
    //Generamos una consulta simple
    $stmt=$this->db->prepare("SELECT * FROM users");
    //la ejecutamos
    $stmt->execute();
    //recojemos los resultado
    $result=$stmt->fetchAll();
    //los devolvemos en formato json
    return $this->response->withJson($result);
});

/**
 * 
 * Mostrar un usuario en concreto
 * Ruta: /user/id
 * 
 */

$app->get('/user/{id}',function(Request $req, Response $res, $args)
{
    //recogemos el argumento id
    $id=(int)$args['id'];
    //Generamos una consulta simple, filtrando por id
    $stmt=$this->db->prepare("SELECT * FROM users WHERE iduser=:id");
    //enlazamos el id
    $stmt->bindParam(':id',$id);
    //ejecutamos
    $stmt->execute();
    //recojemos el resultado
    $result=$stmt->fetchAll();
    //los devolvemos en formato jopn
    return $this->response->withJson($result);
});

/**
 * 
 * Añadir un usuario
 * Ruta: /user/add
 * 
 */

$app->post('/user/add', function(Request $req, Response $res)
{
    //Recogemos los datos pasados en el cuerpo del documento y se genera un array
    $data=$req->getParsedBody();
    if($data != null)
    {    
        //guardo el email
        $email=$data['email'];
        //guardo el usuario
        $username=$data['username'];
        //guardo la contraseña
        $password=$data['password'];
        //preparo la consulta para insertar
        $stmt=$this->db->prepare("INSERT INTO users(rols,email,password,username) VALUES(2,:email,:password,:username)");
        //enlazo los parametros
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':password',md5($password));
        $stmt->bindParam(':username',$username);
        //ejecuto
        $stmt->execute();
        //Recogemos el id del ultimo 
        $id = $this->db->lastInsertId();
            //Hacemos un consulta para comprobar que existe
            $stmt=$this->db->prepare("SELECT * FROM users WHERE iduser=:id");
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            $result=$stmt->fetchAll();
            
            //Preguntamos si el email del ultimo añadido es igual al insertado, si coincide devolvemos los datos si no un mensaje
            if($result[0][email]== $email)
            {
                //Funciona, deveolvemos los datos insertados
                return $this->response->withJson($data);
            }
            else
            {
                //Falla, devolvemos un mensaje avisando del problema
                return $this->response->withJson(array('msg' => 'Problema al intentar añadir el usuario.'));
            }
        }
    
    });

 /**
 * 
 * Actualizar un usuario
 * Ruta: /user/update/id
 *
 */
$app->put('/user/update/{id}',function(Request $req, Response $res, $args)
{
    //recogemos el argumento id
    $id=(int)$args['id'];
    //Recogemos los datos pasados en el cuerpo del documento y se genera un array
    $data=$req->getParsedBody();
    //guardo el email
    $email=$data['email'];
    //guardo el usuario
    $username=$data['username'];
    //guardo la contraseña
    $password=$data['password'];
    //preparo la consulta para actualizar
    $stmt=$this->db->prepare("UPDATE users SET email = :email, username = :username, password = :password WHERE iduser = :id");
    //enlazo los parametros
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':password',md5($password));
    $stmt->bindParam(':username',$username);
    $stmt->bindParam(':id',$id);
    //ejecuto
    $stmt->execute();
    //Dependiendo de si se ejecuta correctamente hacemos una accon u otra
    if($stmt->execute())
    {
         //Funciona, deveolvemos los datos insertados
        return $this->response->withJson($data);
    }
    else
    {
        //Falla, devolvemos un mensaje avisando del problema
        return $this->response->withJson(array('msg' => 'Problema al intentar acualizar el usuario.'));
    }
    
    });

 /**
 * 
 * Borrar un usuario
 * Ruta: /user/del/id
 * 
 */
 
$app->delete('/user/del/{id}', function(Request $req, Response $res, $args)
{
    //recogemos el argumento id
    $id=(int)$args['id'];
    //preparo la consulta para borrar
    $stmt=$this->db->prepare("DELETE FROM users WHERE iduser=:id");
    //enlazo el id
    $stmt->bindParam(':id',$id);
    //ejecuto
    $stmt->execute();
    
        //Hacemos una consulta para comprobar que ya no existe
        $stmt=$this->db->prepare("SELECT * FROM users WHERE iduser=:id");
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $result=$stmt->fetchAll();
    //Dependiendo de si el result esta vacio, siginifica que se ha borrado
    if(empty($result))
    {
        //Funciona, devolvemos un mensaje avisandolo
        return $this->response->withJson(array('msg' => 'Usuario borrado correctamente.'));
    }
    else
    {
        //Falla, devolvemos un mensaje avisando del problema
        return $this->response->withJson(array('msg' => 'Problemas al intentar borrar el usuario.'));
    }
});

$app->run();    
