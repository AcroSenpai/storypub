<?php

namespace X\App\Controllers;

use X\Sys\Controller;
use X\Sys\Session;
/**
 * Description of dashboard
 *  Menu principal de la aplicacion donde despues de pasar la identificacion dependiendo de nuetro nivel de usuario podremos acceder a diferentes acciones.
 *
 * @author aitor
 */
class Profile extends Controller{
    
    public function __construct($params)
    {		
        parent::__construct($params);
        $this->addData(array(
           'page'=>'login'));
        $this->model=new \X\App\Models\mProfile();
        $this->view =new \X\App\Views\vProfile($this->dataView,$this->dataTable);    

    }

    /**
    *
    * home: funcion que se carga al entrar al profile y recibe los datos del usaurio y sus hisotrias y se las envia a la vista.
    *
    */

    function home()
    {   
    	$data['user']=$this->model->get_user($_SESSION['iduser']);
    	$data['stories']=$this->model->get_user_stories($_SESSION['iduser']);
        $this->addData($data);
            $this->view->__construct($this->dataView,$this->dataTable);
        $this->view->show();
    }
}