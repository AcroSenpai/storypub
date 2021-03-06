<?php

namespace X\App\Controllers;

use X\Sys\Controller;
use X\Sys\Session;

/**
 * Description of Users
 *   Pagina que se encarga de mostrar los usuarios de la pagina para que el admin pueda administrarlos
 *
 * @author aitor
 */

class Users extends Controller{
    
    public function __construct($params)
    {    
        parent::__construct($params);
        $this->addData(array(
           'page'=>'login'));
        $this->model=new \X\App\Models\mUsers();
        $this->view =new \X\App\Views\vUsers($this->dataView,$this->dataTable);    
    }

    /**
    *
    * home: funcion que se carga al entrar al dasboard y recibe todos los usuarios y se las envia a la vista.
    *
    */

    function home()
   {
      $data['users']=$this->model->get_users();
      $this->addData($data);

            $this->view->__construct($this->dataView,$this->dataTable);
         $this->view->show();
   }

   /**
    *
    * roles: funcion que recoge el rol y el usuario y le modifica el rol.
    *
    */
   
   function roles()
   {
      $rol= $this->params['rol'];
      $id= $this->params['id'];
      $this->model->set_rol($id, $rol); 
   }

   /**
    *
    * delete: funcion que elimina al usuario seleccionado.
    *
    */

   function delete()
   {
      $id= $this->params['id'];
      $this->model->delete_user($id); 
   }
}