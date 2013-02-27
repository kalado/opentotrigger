<?php

/**
 * Esse é um Helper para gerar formularios usando o Twitter Bootstrap
 *
 * @author Bruno Motta
 *
 */
class TableGenHelper extends AppHelper{
    var $helpers = array(
                        // nativos do cake
                        'Session',
        
                        // Twitter
                        'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
                        'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
                    );
    
    private function metaDado($table_options){
        $table_options = array_merge(
                    array(
                        'bordered' => FALSE,
                        'striped' => FALSE,
                        'class' => "table",
                    )
                ,$table_options);
        if($table_options['bordered'])$table_options['class'] .=" table-bordered";
        if($table_options['striped'])$table_options['class'] .=" table-striped";
        
        
        $meta = 'class="'.$table_options['class'].'"';
        
        return $meta;
    }




    public function generate($header , $body , $table_options){
        $table = "";
        $table .= "<table ".$this->metaDado($table_options).">";
            $table .= "<thead>";
                $table .= $this->Html->tableHeaders($header);
            $table .= "</thead>";
            $table .= "<tbody>";
                $table .=  $this->Html->tableCells($body);
            $table .= "</tbody>";
        $table .= "</table>";
        return $table;
    }


    
}
