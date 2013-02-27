<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    /*
     * Sempre deixar em ordem alfabetica, ajuda na organização do codigo.
     */
    var $uses = array(
                        'Anime',
                        'Autor',
                        'Fansub',
                        'Idioma',
                        'Multimidia',
                        'Qualidade',
                        'Serie',
                        'Servidor',
                        'Status',
                        'UsuarioTipo',
                     );
    
    var $components = array(
                        // nativos do cake
                        'Session',
                        'RequestHandler',
                        'Email',
                        'Paginator',
                        );


    var $helpers = array(
                        
                        // nativos do cake
                        'Js',
                        'Session',
        
                        // Twitter
                        'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
                        'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
                        'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
        
                        //Utilitarios
                        'Utilitarios.FormGen', // Plugin criado por Bruno Motta
                        'Utilitarios.PaginatorGen', // Plugin criado por Bruno Motta
                        
                    );
    
    var $page_title = '';
    
    /**
     * 
     * Funções a serem herdadas:
     * 
     * Nesse caso subistitua, apenas as funções que desejar personalizar
     * 
     */
    function beforeFilter() {
        $this->beforeBasicos();
    }
    
    function beforeRender(){
        $this->set(
                array(
                    'page_title' => $this->page_title
                )
        );
    }
    
    

    function beforeAdmin(){
        $this->layout = 'admin';
        
                                            // legenda
                                            // controller | nome
        $this->set( 'all_pages_menus' , array(
                                                'Series',
                                                'serie'=>'Series',
            
                                                'Dados Tecnicos',
                                                'autor'=>'Autores',
                                                'fansub'=>'Fansubs',
            
                                                'Configurações',
                                                'servidor' => 'Servidores',
                                                'status' => 'Status',
                                                'multimidia'=>'Multimidias',
                                                'idioma'=>'Idiomas',
                                                'qualidade'=>'Qualidades',
                                            ));
        $this->set( 'current_page' , $this->request->params['controller']);
                
    }
    
    
    /**
     * 
     * Funções básicas:
     * Funções que podem ser usadas em todos os conrollers, ajuda na refatoração de código.
     * 
     */
    
    /**
     * Carrega todos elementos comuns do before beforeFilter
     */
    function beforeBasicos(){
        $this->gerarPermissoes();
        
    }
    
    
    /**
     * Verifica se o usuário logado tem apermissão mínima.
     */
    function verificarPermissao($permissaoMinima){
        if($permissaoMinima >= $this->getPermissaoUsuarioLogado()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function redirecionaSeNaoTiverPermissao($permissaoMinima){
        if($this->verificarPermissao($permissaoMinima)){
            //não redireciona
        }else{
            //redireciona
        }
    }

    




    /**
     * 
     * Functions Private:
     * Funções que são não podem ser sobre-escritas e são usadas por todos os controllers
     * 
     */
    function getPaginate($model,$ordem,$campos = array(),$numero = 20){
        $this->Paginator->settings = array(
                                            $model => array(
                                                'limit' => $numero,
                                                'fields' => $campos,
                                                'order' => $ordem,
                                            ),
                                        );
        
        return $this->paginate();
    }


    
    
    
    
    /**
     * Gera as constantes de permissão
     */
    private function gerarPermissoes(){
        
    }
    
    private function getPermissaoUsuarioLogado(){
        
    }
    
    
}
