<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model{
    
    var $ligacoes;
    
    private function removerLigacoes(){
        $this->ligacoes['hasMany'] = $this->hasMany;
        $this->ligacoes['hasAndBelongsToMany'] = $this->hasAndBelongsToMany;
        $this->ligacoes['belongsTo'] = $this->belongsTo;
        $this->hasMany = array();
        $this->hasAndBelongsToMany = array();
        $this->belongsTo = array();
    }
    
    private function voltarLigacoes(){
        $this->hasMany = $this->ligacoes['hasMany'];
        $this->hasAndBelongsToMany = $this->ligacoes['hasAndBelongsToMany'];
        $this->belongsTo = $this->ligacoes['belongsTo'];
    }

        
    /**
     * Essa função tem como objetivo ser uma forma facil de recuperar o valoe de um unico campo de um registro.
     *  Lembrando que o uso desse metodo não é recomendado ser for usado várias vezes, principalmente por models diferentes
     * @param type $id o id do registro que se deseja recuperar o campo
     * @param type $field o campo que se deseja recuperar
     */
    function getField($id,$field){
        $this->removerLigacoes();
        $resposta = $this->find('first',array('conditions' => array($this->name.'.id' => $id) , 'fields' => array($field)));
        $this->voltarLigacoes();
        return $resposta[$this->name][$field];
    }
    
    
    /**
     * Essa função gera um array para ser mandado como option dos selects(formhelper) no formato
     * 
     *  array(
     *          $id => $label
     *      )
     * @param $label é o campo que será o label
     * @param $in 
     * @param $id é o nome do campo que será o indice
     * 
     * @return retorna um array contendo os registros, esse array está formatado de forma simples e limpa. e está ordenado pelo $label
     * 
     */
    function getArraySimples($label, $in = array(), $indice = 'id'){
        $resutado = array();
        if(empty($in)){
            $this->removerLigacoes();
            $resource = $this->find( 'all',array('joins'=>array() ,'fields' => array($this->name.'.'.$indice,$this->name.'.'.$label) , 'order' => array($this->name.'.'.$label)) );
            $this->voltarLigacoes();
        }else{
        }
        foreach($resource as $value){
                $resutado[$value[$this->name][$indice]] = $value[$this->name][$label];
            }
        return $resutado;
    }
    
    
}