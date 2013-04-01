<?php
class IndexController extends AppController{
    
    /**
     * Adiciona ou Edita um novo idioma
     */  
    public function index(){
        $this->beforeAdmin();
        
    }
    
    public function login(){
        $this->layout = 'login';
        $campos = array(
                ' ' => array(
                    'login' => array(),
                    'senha' => array('type'=>'password'),
                )
            );
        
        $this->set(array(
            'campos'=>$campos
        ));
    }
    
    
}

?>