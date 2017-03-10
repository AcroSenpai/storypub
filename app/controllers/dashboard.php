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
class Dashboard extends Controller{
    
    public function __construct($params)
    {		
        parent::__construct($params);
        $this->addData(array(
           'page'=>'login'));
        $this->model=new \X\App\Models\mDashboard();
        $this->view =new \X\App\Views\vDashboard($this->dataView,$this->dataTable);    

    }
    /**
    *
    * home: funcion que se carga al entrar al dasboard y recibe todas las historias y las historias del usuario y se las envia a la vista.
    *
    */
    function home(){
        $data['all_stories']=$this->model->get_all_stories();
        $data['my_stories']= $this->model->get_my_stories($_SESSION["iduser"]); 
        $this->addData($data);
            $this->view->__construct($this->dataView,$this->dataTable);
        $this->view->show();
    }

    /**
    *
    * logout: funcion para destruir la sesion utilizando la funcion destroy de la clase Session.
    *
    */
    function logout(){
        
        Session::destroy();
        header('Location: http://localhost/storypub/');
    } 
}


