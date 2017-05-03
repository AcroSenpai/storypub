<?php 

namespace X\App\Models;

use X\Sys\Model;

Class mNewstory extends Model
{

		public function __construct()
		{
			parent::__construct();
			
		}

		/**
	    *
	    *   add_story: funcion que llama al procedimeinto para añadir una hisotria
	    *
	    */

		function add_story($usuario, $titulo, $sinopsis)
		{
			 $sql='CALL sp_new_story("'.$usuario.'","'.$titulo.'","'.$sinopsis.'")';
           	 $this->query($sql);
             $this->execute();
		}

		/**
	    *
	    *   get_last_story: funcion que llama al procedimeinto que devuelve el path y el id, de la ultima hidsotria añadida
	    *
	    */

		function get_last_story($usuario)
		{
			 $sql='Select idstories, path FROM stories where users ="'.$usuario.'" order by path DESC limit 1';
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
	    *   add_story: funcion que llama al procedimeinto para añadir un tag
	    *
	    */

		function add_tag($story, $tag)
		{
			$sql='CALL sp_new_tag("'.$story.'","'.$tag.'")';
           	$this->query($sql);
            $this->execute();
		}
}