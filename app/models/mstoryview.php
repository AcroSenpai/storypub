<?php 

namespace X\App\Models;

use X\Sys\Model;

Class mStoryview extends Model
{

		public function __construct()
		{
			parent::__construct();
			
		}

        /**
        *
        *   get_story: funcion que devuelve los datos de la historia.
        *
        */

		function get_story($id)
		{
			$sql='Select * From stories Where idstories='.$id;
            $this->query($sql);
            $this->execute();
            $res=$this->execute();
            $result="";
            if($res){
                $result=$this->resultset();
            }
            return $result;
		}

        /**
        *
        *   set_assess: funcion que establece la valoraccion del usuario.
        *
        */

		function set_assess($story, $user, $val)
		{
			$sql='CALL sp_new_valoration("'.$user.'","'.$story.'","'.$val.'")';
            $this->query($sql);
            $this->execute();
		}

        /**
        *
        *   get_user: funcion que devuelve el nombre del usuario.
        *
        */

		function get_user($id)
        {
            $sql='Select username From users where iduser ='.$id;
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
        *   get_assess: funcion devuelve la valoracion del usuario.
        *
        */

        function get_assess($user, $story)
        {
            $sql='Select value From valorations where users ='.$user.' AND stories ='.$story;
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
        *   get_tags: funcion devuelve los tags.
        *
        */

        function get_tags($story)
        {
            $sql="SELECT nom, idtags
                    FROM tags inner join stories_has_tags on idtags = tags
                    inner join stories on stories = idstories
                    where idstories = ".$story;
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
        *   del_tag: funcion que elimina un tag.
        *
        */


        function del_tag($tags)
        {
            $sql="DELETE FROM stories_has_tags where tags =".$tags;
            $this->query($sql);
            $this->execute();
        }
}

