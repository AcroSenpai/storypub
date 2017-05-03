<?php

namespace X\App\Controllers;

use X\Sys\Controller;
use X\Sys\Session;

/**
 * Description of Storyview
 *  PAgina donde podremos visualizar la hisotria, valorarla y ver sus tags.
 *
 * @author aitor
 */

class Storyview extends Controller{
    
    public function __construct($params)
    {       
        parent::__construct($params);
        $this->addData(array(
           'page'=>'login'));
        $this->model=new \X\App\Models\mStoryview();
        $this->view =new \X\App\Views\vStoryview($this->dataView,$this->dataTable);    

    }

    /**
    *
    * home: funcion que se carga al entrar al Storyview.
    *
    */

    function home()
    {   
        $this->view->show();
    }

    /**
    *
    * load: funcion donde recogemos los datos de la historia, del propietario, la valoracion del usuario que ha entrado y los tags de la historia y se los pasamos a la vista..
    *
    */

    function load()
    {
       $id= $this->params['id'];
       $data['story']=$this->model->get_story($id); 
       $data['user']=$this->model->get_user($data['story'][0]['users']); 
       $data['assess']=$this->model->get_assess($_SESSION['iduser'],$data['story'][0]['idstories']); 
       $data['tags']=$this->model->get_tags($data['story'][0]['idstories']); 


       $this->addData($data);
            $this->view->__construct($this->dataView,$this->dataTable);
        $this->view->show();
    }

    /**
    *
    * assess: funcion que se encarga de recoger la valoracion, de quien es y a que hisotria y la añade.
    *
    */

    function assess()
    {
        $story= $this->params['story'];
        $user= $this->params['user'];
        $val= $this->params['val'];

        $this->model->set_assess($story, $user, $val); 

        header("Location:/storypub/storyview/load/id/$story");
    }

    /**
    *
    * deletetag: funcion que se encarga de borrar el tag seleccionado.
    *
    */

    function deletetag()
    {
        $tag= $this->params['tag'];
        $this->model->del_tag($tag);

    }
}