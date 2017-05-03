<?php

namespace X\App\Controllers;

use X\Sys\Controller;
/**
 * Description of login
 *  Pagina donde los usuarios se podran logear para acceder al dashboard.
 *
 * @author aitor
 */
class login extends Controller{
    
    public function __construct($params)
    {		
        parent::__construct($params);
        $this->addData(array(
           'page'=>'login'));
        $this->model=new \X\App\Models\mLogin();
        $this->view =new \X\App\Views\vLogin($this->dataView,$this->dataTable);    

    }

    function home(){

        $this->view->show();
    }
    
    /**
    *
    *   funcion que recibe el usuario y la contraseña comprueba que esta registrado en la BBDD, y si existe accede al dasboard y guardamos diferentes campos en las variables de session. 
    *
    **/
    function login()
    {
        $user=filter_input(INPUT_POST, 'user');
        $pass=filter_input(INPUT_POST, 'pass');
        
             
        $data=$this->model->get_user($user,$pass);

        if(!empty($data))
        {
            $_SESSION["user"]=$data[0]['username'];
            $_SESSION["iduser"]=$data[0]['iduser'];
            $_SESSION["rol"]=$data[0]['rols'];
           
            echo 1;
        }
        else
        {
            echo "Error de login";
        }
    }
}
