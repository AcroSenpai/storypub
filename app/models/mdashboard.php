<?php

namespace X\App\Models;

use X\Sys\Model;

Class mDashboard extends Model
{

        public function __construct()
        {
                parent::__construct();

        }
        /**
        *
        *   get_all_stories: funcion que devuelve todas las historias.
        *
        */
        function get_all_stories(){

        	$sql='Select * From stories';
            $this->query($sql);
            $res=$this->execute();
            $result="";
            if($res){
                $result=$this->resultset();
            }
            return $result;


        }

        /**
        *
        *   get_my_stories: funcion que devuelve las historias del usuario registrado.
        *
        */

        function get_my_stories($user){

            $sql='Select * From stories where users =:user';
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
        *   del_story: funcion que primero borra las valoraciones, tags relacionados a la historia y luego borra la historia. 
        *
        */

        function del_story($id)
        {
            $sql='DELETE FROM valorations where stories =:id';
            $this->query($sql);
            $this->bind(":id", $id);
            $this->execute();

            $sql='DELETE FROM stories_has_tags where stories =:id';
            $this->query($sql);
            $this->bind(":id", $id);
            $this->execute();

            $sql='DELETE FROM stories where idstories =:id';
            $this->query($sql);
            $this->bind(":id", $id);
            $this->execute();
        }

}