<?php

namespace Api\Model;

use Api\Lib\DB;
use Api\Lib\Response;

/**
 * Description of UserModel
 *
 * @author linux
 */
class UserModel {
    private $db;
    private $response;
    public function __construct() 
    {
        $this->db=DB::start();
        $this->response=new Response();
    }
    
    public function getAll()
    {
        try
        {
            $stmt=$this->db->prepare("SELECT * FROM users");
            $stmt->execute();
            $this->response->setResponse(true);
            $this->response->result=$stmt->fetchALL();
            
            return $this->response;
        }
        catch (Exception $ex)
        {
            $this->response->setResponse(true,$ex->getMessage());
            return $this->response;
        }
    }
}
