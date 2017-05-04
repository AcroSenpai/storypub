<?php

namespace X\App\Models;

use X\Sys\Model;

Class mProfile extends Model
{

        public function __construct()
        {
                parent::__construct();

        }

        /**
        *
        *   get_user: funcion que devuelve lod datos del usuario.
        *
        */

        function get_user($user)
        {
        	$sql="SELECT * FROM users WHERE iduser=:user";
        	$this->query($sql);
            $this->bind(":user", $user);
            $res=$this->execute();
            $result="";
            if($res){
                $result=$this->resultset();
            }
            return $result;
        }

        /**
        *
        *   get_user_stories: funcion que devuelve las hisotrias del usuario.
        *
        */

        function get_user_stories($user)
        {
            $sql="SELECT * FROM stories WHERE users =:user";
            $this->query($sql);
            $this->bind(":user", $user);
            $res=$this->execute();
            $result="";
            if($res){
                $result=$this->resultset();
            }
            return $result;
        }
}