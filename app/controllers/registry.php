<?php


namespace X\App\Controllers;

use X\Sys\Controller;
/**
 * Description of Registry
 *  Pagina donde los usuarios pueden registrarse.
 *
 * @author aitor
 */
class Registry extends Controller{
    
    public function __construct($params)
    {		
        parent::__construct($params);
        $this->addData(array(
           'page'=>'Registry'));
        $this->model=new \X\App\Models\mRegistry();
        $this->view =new \X\App\Views\vRegistry($this->dataView,$this->dataTable);    

    }

    function home(){

        $this->view->show();
    }
    
    /**
    *
    *   registry: funcion que recoge los datos del nuevo usuario, comprueba que no existan y si no hay coincidencias entonces pasamos ha insertar.
    *
    */
    function registry()
    {
        $user=filter_input(INPUT_POST, 'user');
        $pass=filter_input(INPUT_POST, 'pass');
        $email=filter_input(INPUT_POST, 'email');
        $latitud=filter_input(INPUT_POST, 'latitud');
        $altitud=filter_input(INPUT_POST, 'altitud');
        
        $data=$this->model->get_user($user,$pass);
        $data+=$this->model->check_email($email);
        $data+=$this->model->check_user($user);
        
        if(empty($data))
        {
            $this->model->insert_user($user,$pass,$email,$altitud,$latitud);
            echo 1;
        }   
        else
        {
            echo "Error de registro";
        }
    }
    
    /**
    *
    *   check_mail: funcion que comprueba si el mail existe.
    *
    */
    function check_email()
    {
        $email1=filter_input(INPUT_POST, 'email');
        $data=$this->model->check_email($email1);
        
        if(!empty($data))
        {
            die("Email en uso");
        }
        
    }
    /**
    *
    *   check_iser: funcion que comprueba si el user existe.
    *
    */
    function check_user()
    {
        $user=filter_input(INPUT_POST, 'user');
        $data=$this->model->check_user($user);
        
        if(!empty($data))
        {
            die("Usuario en uso");
        }
        
    }
}

