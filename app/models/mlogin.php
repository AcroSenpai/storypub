<?php


namespace X\App\Models;

use X\Sys\Model;

Class mLogin extends Model
{

        public function __construct()
        {
                parent::__construct();

        }
        
        /**
        *
        *   get_user: funcion que comprueba si un usuario existe.
        *
        */

        public function get_user($user,$pass)
        {
            $sql='Select * From users Where username="'.$user.'" AND password="'.$pass.'"';
            $this->query($sql);
            $this->execute();
            $res=$this->execute();
            $result="";
            if($res){
                $result=$this->resultset();
            }
            return $result;
        }
}            