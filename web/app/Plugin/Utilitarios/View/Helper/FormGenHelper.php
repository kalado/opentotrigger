<?php

/**
 * Esse é um Helper para gerar formularios usando o Twitter Bootstrap
 *
 * @author Bruno Motta
 *
 */
class FormGenHelper extends AppHelper{
   
    
    var $error;
    
    
    
    var $helpers = array(
                        // nativos do cake
                        'Session',
        
                        // Twitter
                        'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
                        'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
                    );
    
    
    
    
    
    private function CKeditor($editor){
        switch($editor){
            case "max":
                return
                    "
                    ['Source','NewPage'],
                    ['Undo','Redo'],
                    ['Maximize'],
                    '/',
                    ['Cut','Copy','Paste','PasteText','PasteFromWord'],
                    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                    ['Find','Replace'],
                    ['SelectAll','RemoveFormat'],
                    ['Image','YouTube','Flash','Table','HorizontalRule','SpecialChar','PageBreak'],
                    '/',
                    ['Styles','Format'],
                    ['Bold','Italic','Underline','Strike'],
                    ['NumberedList','BulletedList'],
                    ['Outdent','Indent'],
                    ['Link','Unlink','Anchor'],
                    ['TextColor','BGColor'],
                ";
                break;
            case "min":
                return
                    "
                    ['Undo','Redo'],
                    ['Source','NewPage'],
                    ['Find','Replace','PasteText','PasteFromWord'],
                    ['Maximize'],
                    '/',
                    ['Styles','Format'],
                    ['Bold','Italic','Underline','Strike'],
                    ['NumberedList','BulletedList'],
                    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                    ['Image','YouTube','Flash','Table','HorizontalRule','SpecialChar','PageBreak'],
                ";
                break;
            default:
                break;
        }
    }
    
    private function setError($error){
        $this->error = $error;
    }
    private function hasErro(){
        return ($this->error!==FALSE);
    }
    private function getErros(){
        return $this->error;
    }
    
    private function form_options($options){
        $options = array_merge(
                                array(
                                    'class' => FALSE,
                                )
                            ,$options);
        
        //Colocar as classes corretas
        switch($options['class']){
            case FALSE:
                $options['class'] = "";
                break;
            case "horizontal":
                $options['class'] = "form-horizontal";
                break;
            case "inline":
                $options['class'] = "form-horizontal";
                break;
            case "search":
                $options['class'] = "form-search";
                break;
        }
        
        unset($options['format']);
        return $options;
        
    }
    
    
    private function CreateFilds($fields){
        $form = "";
        foreach($fields as $fildName => $options){
            $options = array_merge(
                        array(
                            'type' => 'text',
                            'label' => ucfirst($fildName),
                        )
                        ,$options
                    );
            
            //troca o model
            if(isset($options['model'])){
                $options['model'] = $this->Form->defaultModel;
                $this->Form->defaultModel = $options['model'];
            }
            
            //faz o campo
            switch($options['type']){
                case "text":
                    $form .= $this->Form->input($fildName,$options);
                    break;
                case "textarea":
                        $form .= $this->Form->input($fildName,$options);
                    break;
                case "textarea-editor":
                        $options['type']='textarea';
                        $form .= $this->Form->input($fildName,$options);
                        $options = array_merge(
                                array(
                                    'editor' => 'min',
                                )
                                ,$options
                            );
                        $form .=  $this->Html->script('/Utilitarios/js/ckeditor/ckeditor');
                        $form .= '<script type="text/javascript" >
                                       var editor = CKEDITOR.replace(\''.$this->Form->defaultModel.ucfirst($fildName).'\',{
                                                  toolbar :['.$this->CKeditor($options['editor']).']
                                       });
                                  </script>';
                    break;
                case "select":
                        $form .= $this->Form->input($fildName,$options);
                    break;
                case "select-multiple":
                        $options = array_merge(array(
                                                    'multiple' => 'multiple',
                                                ),$options);
                        $options['type'] = 'select';
                        $form .= $this->Form->input($fildName,$options);
                    break;
                case "checkbox":
                        $options['type'] = 'select';
                        $options = array_merge(array(
                                                    'multiple' => 'checkbox',
                                                ),$options);
                        $form .= $this->Form->input($fildName,$options);
                    break;
                case "checkbox-inline":
                        $options['type'] = 'select';
                        $options = array_merge(array(
                                                    'multiple' => 'checkbox inline',
                                                ),$options);
                        $form .= $this->Form->input($fildName,$options);
                    break;
                case "radio":
                    if(isset($options['attributes'])){
                        $form .= $this->Form->radio($fildName,$options['options'],$options['attributes']);
                    }else{
                        $form .= $this->Form->input($fildName,$options);
                    }
                    break;
                default :
                    $form .= $this->Form->input($fildName,$options);
                    break;
            }
            
            //destroca o model
            if(isset($options['model'])){
                $options['model'] = $this->Form->defaultModel;
                $this->Form->defaultModel = $options['model'];
            }
            
            
        }
        
        return $form;
    }




    private function Createfieldsets($fields){
        $form = "";
        foreach ($fields as $fildset => $campos){
            if(!empty($fildset)){
                $form .= '<fieldset>';
                $form .= '<legend>'.$fildset.'</legend>';
                $form .= $this->CreateFilds($campos);
                $form .= '</fieldset>';                
            }else{
                
            }
        }
        
        return $form;
    }


    
    
    /**
     *
     * @param type $model Model principal do formulário
     * @param type $form_options todas as options que podem ser enviadas para o formCreate do TwitterBotstraphelper
     *              com os seguintes ajustes
     *                  'format' => 'horizontal'(default)
     * @param type $fields os campos dos formulários
     *  deve-se passar sempre no seguinte formato
     * 
     *          array(
     *                  FIELDSET => array(
     *                                      CAMPO-01 => array(OPTIONS),
     *                                      CAMPO-02 => array(OPTIONS),
     *                                      CAMPO-03 => array(OPTIONS),
     *                                          .
     *                                          .
     *                                          .
     *                                      CAMPO-N => array(OPTIONS),
     *          )
     *          OPTIONS => toda option acita pelo TwitterBootstrap->input (ou corrspondentes para os outros tipos de campos)
     * 
     * 
     * @param type $bottom
     * 
     * @return type Html de um formulário completo, usando os padrões do TwitterBootstrap
     */
    function gerarFormulario($model, $form_options = array(), $fields, $bottom = array()){
        $this->setError(FALSE);
        //set defaults for $form_options
        $form_options = array_merge(
                array(
                    'format' => 'horizontal',
                )
                , $form_options);

        //set defaults for $bottom
        if(is_array($bottom)){
            $bottom = array_merge(array(
                'label' => 'Enviar',
                'name' => 'submit',
                    ), $bottom);
        }else{
            if($bottom !== FALSE){
                $this->setError('\$bottom deve ser um array com as opções para enviar ao Helper Form->end ou ser FALSE, verifique o valor de \$bottom');
            }
        }

        if(!is_array($fields)){
            $this->setError('\$fields deve ser um array com os campos do form');
        }

        if($this->hasErro()){
            return $this->getErros();
        }



        $form = "";
        $form .= $this->Form->create($model , $this->form_options($form_options));
                
        //criando os campos do formulario
        $form .= $this->Createfieldsets($fields);
        
        
        if($bottom!=FALSE){
            $form .= $this->Form->end($bottom);
        }else{
            $form .= $this->Form->end();
        }
        return $form;
    }

}
