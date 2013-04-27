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
                        'Capitulo',
                        'Fansub',
                        'Genero',
                        'Idioma',
                        'Informacao',
                        'Link',
                        'Multimidia',
                        'Qualidade',
                        'Serie',
                        'Servidor',
                        'Status',
                        'Topico',
                        'UsuarioTipo',
                        'Usuario',
                     );
    
    var $components = array(
                        'Arquivo',
                        // nativos do cake
                        'Session',
                        'RequestHandler',
                        'Email',
                        'Paginator',
                        'Menus',
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
    
    

    function beforeAdmin($permissao = 1){
        $this->layout = 'admin';
        
        //$this->redirecionaSeNaoTiverPermissao(1);
        
        $this->set( 'all_pages_menus' , $this->Menus->MenuEsquerdaADMIN());
        $this->set( 'current_page' , $this->subPages($this->request->params['controller']));
        
    }
    
    private function subPages($pagina){
        $pagina = strtolower($pagina);
        $subPaginas = array(
                            'anime'=>'serie',
                            'topico'=>'serie',
                            'informacao','serie'
                            );
        if(isset($subPaginas[$pagina])){
            return $subPaginas[$pagina];
        }
        return $pagina;
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
        
        
        
        $this->setBasicos();
        
    }
    
    private function setBasicos() {
        $this->set(
                    array(
                        'titulo_do_site' => 'Anime-Trigger'
                    )
                );
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
            $this->redirect(array('controller' => 'index', 'action' => 'login' ));   
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

    function isLogin() {
        return ($this->getPermissaoUsuarioLogado() >= 0);
    }
    
    
    
    
    /**
     * Gera as constantes de permissão
     */
    private function gerarPermissoes(){
        
    }
    
    private function getPermissaoUsuarioLogado(){
        return 10;
    }
    

    
    /**
     * 
     * Função de ajuda
     * 
     **/
    public function inverterdata($data){
        if(empty($data))
            return $data;
        if(!eregi(" ", $data)){
            if(eregi("-", $data)){
                $data = explode("-", $data);
                $data = $data[2]."/".$data[1]."/".$data[0];
            }else{
                $data = explode("/", $data);
                $data = $data[2]."-".$data[1]."-".$data[0];
            }
            return $data;
        }else{
            if(eregi(" - ", $data)){
                $caractere = " - ";
                $oposto = " ";
            }else{
                $caractere = " ";
                $oposto = " - ";
            }
            $data = explode($caractere, $data);
            return $this->inverterdata($data[0]).$oposto.$data[1];
        }
    }
    
    public function tratarData($data){
        return $this->inverterdata($data);
    }
    
}
