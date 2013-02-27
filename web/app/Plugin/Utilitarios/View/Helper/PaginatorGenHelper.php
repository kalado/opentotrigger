<?php

/**
 * Esse é um Helper para gerar formularios usando o Twitter Bootstrap
 *
 * @author Bruno Motta
 *
 */
class PaginatorGenHelper extends AppHelper{
    var $helpers = array(
                        // nativos do cake
                        'Session',
        
                        // Twitter
                        'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
                        'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
                        'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
                        
                        //Utilitários
                        'Utilitarios.TableGen', // Plugin criado por Bruno Motta
                    
                    );

    
    private function geraHeaderTabela($fields){
        foreach($fields as $label => $field){
            if($label=="DELETE"){
                $label="";
            }
            $header[] = $this->Paginator->sort($field, $label);
        }
        return $header;
    }

    private function tratarVirtualfields($data,$virtualFields){
        if(empty($virtualFields)){
            return $data;
        }
        $retorno = array();
        foreach($data as $dado){
            foreach ($virtualFields as $campo => $valores){
                $campo = explode(".", $campo);
                if(isset($dado[$campo[0]][$campo[1]])){
                    $dado[$campo[0]][$campo[1]] = $valores[$dado[$campo[0]][$campo[1]]];
                }
            }
            $retorno[] = $dado;
        }
        return $retorno;
    }

    private function geraBodyTabela($data,$fields){
        $linhas = array();
        $cont = $this->Paginator->counter('{:start}')+0;
        foreach($data as $dados){
            $linha = array();
            foreach($fields as $label => $campo){
                if($label=="DELETE")continue;
                if($label!="#"){
                    $campo = explode(".", $campo);
                    $linha[$label] = $dados[$campo[0]][$campo[1]];
                }else{
                    $campo = explode(".", $campo);
                    $linha[$label]=  $this->Html->link($cont, '/'.$campo[0].'/edit/'.$dados[$campo[0]][$campo[1]]);
                    $delete_link =  '<a href="'.$this->Html->url('/'.$campo[0].'/delete/'.$dados[$campo[0]][$campo[1]]).'" class="btn btn-danger" ><i class="icon-trash"></i></a>';
                }
            }
            $linha[] = $delete_link;
            $cont++;
            $linhas[]=$linha;
        }
        return array_values($linhas);
    }


    /*
     * Função para gerar uma listagem de dados do administrador
     * 
     * $fields => array(
     *                  Label => Model.Campo,
     *                  Label => Model.Campo,
     *                  Label => Model.Campo,
     *                );
     * $data => Dados do componet do paginaetor
     * 
     * $table_options => Dados que seram enviados ao TableGen, que será o responsavel por criar a listagem
     * 
     * $virtualFields =>  lista de valores nos campos a serem subistituidos
     *                                          array(
     *                                                  Model.Campo =>array(Valor=>LabelDoValor , Valor2=>LabelDeValor2)
     *                                                  Model.Campo =>array(Valor=>LabelDoValor , Valor2=>LabelDeValor2)
     *                                                  Model.Campo =>array(Valor=>LabelDoValor , Valor2=>LabelDeValor2)
     *                                                  Model.Campo =>array(Valor=>LabelDoValor , Valor2=>LabelDeValor2)
     *                                              );
     * 
     */
    public function listAdminGen($fields,$data,$table_options = array(),$virtualFields=array()){
        $table_options = array_merge(
                    array(
                        'bordered' => TRUE,
                        'striped' => TRUE,
                    )
                ,$table_options);
        $fields = array_merge(
                                array(
                                        '#' => FALSE,
                                )
                            ,$fields);
        $fields = array_merge(
                            $fields,
                            array(
                                'DELETE' => FALSE,
                            )
                            );
        $data = $this->tratarVirtualfields($data, $virtualFields);
        $header = $this->geraHeaderTabela($fields);
        $body = $this->geraBodyTabela($data,$fields);
        
        $paginacao = "";
        
        
        $paginacao .= $this->TableGen->generate($header , $body , $table_options);
        
        $paginacao .= $this->Paginator->numbers(array('before'=>'<div class="pagination pagination-centered"><ul>','first'=>"«" , 'last'=>'»' , 'after' => '</ul></div>') );
        
        $paginacao .= $this->Paginator->pager();
        
        
        
        return $paginacao;
    }

}
