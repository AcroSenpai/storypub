<?php

namespace X\App\Controllers;

use X\Sys\Controller;
use X\Sys\Session;

/**
 * Description of Editstory
 *  Pagina donde podremos modificar el contenido de las historias
 *
 * @author aitor
 */

class Editstory extends Controller{
    
    public function __construct($params)
    {       
        parent::__construct($params);
        $this->addData(array(
           'page'=>'login'));
        $this->model=new \X\App\Models\mEditstory();
        $this->view =new \X\App\Views\vEditstory($this->dataView,$this->dataTable);    

    }

    /**
    *
    * home: funcion que se carga al entrar editstory.
    *
    */

    function home()
    {   
        $this->view->show();
    }

    /**
    *
    * load: funcion para cargar la historia que queremos modificar. Le pasamos a la vista lod datos de la historia y los datos del usuario que la ha creado.
    *
    */

    function load()
    {
       $id= $this->params['id'];
       $data['story']=$this->model->get_story($id); 
       $data['user'] =$this->model->get_user($id);
       $this->addData($data);
            $this->view->__construct($this->dataView,$this->dataTable);
        $this->view->show();
    }

    /**
    *
    * update_story: funcion que se encarga de recibir los datos modificados y hacer los cambios.
    *
    */
    function update_story()
    {
        //Recogmeos los datos y el id de la hisotria
        $id= $this->params['id'];
        $titulo=filter_input(INPUT_POST, 'titulo');
        $sinopsis=filter_input(INPUT_POST, 'sinopsis');
        $historia=filter_input(INPUT_POST, 'historia');

        //Sacamos los datos del usuario que creo la historia por el id de la historia. (Ya que puede ser modificadas por el usuario o por el admin, no puedo usar las variables de session)
        $user =$this->model->get_user($id);

        //modifico la hisotria
        $this->model->update_story($user[0]['iduser'],$titulo,$sinopsis);

        //Recojo el path de esa hisotria.
        $story = $data=$this->model->get_path_story($id);

        //Abro el fichero con ese path, dentro de la carpeta del usuario.
        $file = fopen(DATA.$user[0]['username'].DS.$story[0]['path'].'.txt', "w");

        fwrite($file, $historia);

        fclose($file);
        //Redirijo a la vista de la historia.
        header('Location: /storypub/storyview/load/id/'.$id);

    }
}