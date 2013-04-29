<?php
/**
 * 
 * Criando tela de options no admin
 * 
 **/

/*
 * Hook para iserir botão no admin
 */
add_action('admin_menu', 'SliderPlusPlus_munu_admin'); 
function SliderPlusPlus_munu_admin() 
{
    include (plugin_dir_url(__FILE__) . 'include/options.php');
    add_options_page('Configurações dos sliders','Slider  Plus Plus', 'manage_options', 'slider-plus-plus-config', 'SliderPlusPlus_admin_page');
}

function SliderPlusPlus_gerar_array_numerico($min = 250, $max = 3000,$jump=250){
    $min  =  intval($min);
    $max = intval($max);
    $jump = intval($jump);
    
    $valores = array();
    for($atual = $min ; $atual <= $max ; $atual+= $jump){
        $valores[] = $atual;
    }
    
    return $valores;
}

function SliderPlusPlus_admin_page()
{
    
    if(!empty($_POST)){
        
        SliderPlusPlus_autualizar_array_default($_POST);
    }
    
    $skins = SliderPlusPlus_get_skins();
    $skins = array_combine($skins, array_map("ucfirst",$skins));
    
    $valores_tempo_transicao = SliderPlusPlus_gerar_array_numerico();
    $valores_tempo_transicao = array_combine($valores_tempo_transicao,$valores_tempo_transicao);
    
    $valores_tempo_de_espera = SliderPlusPlus_gerar_array_numerico(2000,12000,500);
    $valores_tempo_de_espera = array_combine($valores_tempo_de_espera,$valores_tempo_de_espera);
    
    $valores_distancia = SliderPlusPlus_gerar_array_numerico(0,300,5);
    $valores_distancia = array_combine($valores_distancia,$valores_distancia);
    
    
    $numero_de_slides_por_slider = SliderPlusPlus_gerar_array_numerico(1,20,1);
    $numero_de_slides_por_slider = array_combine($numero_de_slides_por_slider,$numero_de_slides_por_slider);

    //$numero_de_slides_por_slider = SliderPlusPlus_gerar_array_numerico(100,900,20);
    //$numero_de_slides_por_slider = array_combine($numero_de_slides_por_slider,$numero_de_slides_por_slider);

    
    $ativado_desativado = array("true" => "Ativado","false"=>"Desativado");
    $videos_option = array("true" => "contem video","false"=>"não contem video");
    $true_false = array("true" => "True","false"=>"False");
    
    $easing = array('linear','swing','easeInQuad','easeInOutQuad','easeInCubic','easeOutCubic','easeInOutCubic','easeInQuart','easeOutQuart','easeInOutQuart','easeInQuint','easeOutQuint','easeInOutQuint','easeInExpo','easeOutExpo','easeInOutExpo','easeInSine','easeOutSine','easeInOutSine','easeInCirc','easeOutCirc','easeInOutCirc','easeInElastic','easeOutElastic','easeInOutElastic','easeInBack','easeOutBack','easeInOutBack','easeInBounce','easeOutBounce','easeInOutBounce');
    $easing = array_combine($easing,$easing);
    
    $campos['Aparencia'] =    array(
                        'skin' => array('label'=>'Skin' , 'type'=>"select" , 'valores'=>$skins),
                        'slidemargin' => array('label'=>'Distancia entre os slides' , 'type'=>"select" , 'valores'=>$valores_distancia ),
                        'captions' => array('label'=>'Ativar caption' , 'type'=>"select" , 'valores'=>$ativado_desativado ),
                        'adaptiveheight' => array('label'=>'Altura adaptável' , 'type'=>"select" , 'valores'=>$ativado_desativado ),
                        'slidewidth' => array('label'=>'Largura de cada slide' , 'type'=>"select" , 'valores'=>$ativado_desativado ),
                        );
    
    //http://gsgd.co.uk/sandbox/jquery/easing/ EAsing
    $campos['Transição'] =    array(
                        'mode' => array('label'=>'Tipo de transição entre os Slides' , 'type'=>"select" , 'valores'=>array('horizontal'=>'horizontal', 'vertical'=>'vertical', 'fade'=>'fade')),
                        'easing' => array('label'=>'Efeitos de velocidade' , 'type'=>"select" , 'valores'=>$easing ),
                        'speed' => array('label'=>'Duração da transação de slides' , 'type'=>"select" , 'valores'=>$valores_tempo_transicao ),
                        );
    
    $campos['Configurações'] =    array(
                        'startslide' => array('label'=>'Primeiro Slide' , 'type'=>"select" , 'valores'=>SliderPlusPlus_gerar_array_numerico(0,5,1)),
                        'randomstart' => array('label'=>'Primeiro Slider randomicamente' , 'type'=>"select" , 'valores'=>$ativado_desativado ),
                        'infiniteloop' => array('label'=>'Loop infinito de Slides' , 'type'=>"select" , 'valores'=>$ativado_desativado ),
                        'minslides' => array('label'=>'Número minimo de slides aparecendo' , 'type'=>"select" , 'valores'=>$numero_de_slides_por_slider ),
                        'maxslides' => array('label'=>'Número máximo de slides aparecendo' , 'type'=>"select" , 'valores'=>$numero_de_slides_por_slider ),
                        'moveslides' => array('label'=>'Número de slides por pagina do slider' , 'type'=>"select" , 'valores'=>  array_merge(array(0=>"página completa"),$numero_de_slides_por_slider) ),
                        );
    
    $campos['Controles'] =    array(
                        'hidecontrolonend' => array('label'=>'Esconder setas' , 'type'=>"select" , 'valores'=>$ativado_desativado ),
                        'pager' => array('label'=>'Gerar botoes de controle do Slider' , 'type'=>"select" , 'valores' => $ativado_desativado ),
                        'controls' => array('label'=>'Gerar setas de controle do Slider' , 'type'=>"select" , 'valores' => $ativado_desativado ),
                        'nexttext' => array('label'=>'Texto para seta de controle nex' , 'type'=>"text" ),
                        'prevtext' => array('label'=>'Texto para seta de controle prev' , 'type'=>"text"),
                        'autocontrols' => array('label'=>'Passar slide automaticamente' , 'type'=>"select" , 'valores' => $ativado_desativado ),
                        'autocontrolscombine' => array('label'=>'Combinar botão de controle' , 'type'=>"select" , 'valores' => $ativado_desativado ),
                        );
    
    $campos['Auto Play'] =    array(
                        'auto' => array('label'=>'Ativar transição automatica' , 'type'=>"select" , 'valores'=>$ativado_desativado ),
                        'autostart' => array('label'=>'Ativar Auto-Play' , 'type'=>"select" , 'valores'=>$ativado_desativado ),
                        'pause' => array('label'=>'Tempo entre as transições' , 'type'=>"select" , 'valores' => $valores_tempo_de_espera ),
                        'video' => array('label'=>'Ativar se esse slider conter algum video' , 'type'=>"select" , 'valores' => $videos_option),
                        );
    
    
    
    
    
    $form ='<form name="SliderPlusPlus_options_form" id="SliderPlusPlus_options_form" action="" method="POST">'; 
        foreach ($campos as $key => $value) {
            $form .= SliderPlusPlus_conteiner_maior($key, '', SliderPlusPlus_conteiner_menor($value));
        }
        $form .= '<input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Salvar" accesskey="p">';
    $form.='</form>';
    
    
    echo SliderPlusPlus_construir_tela_admin('Configurações Slider Plus Plus', $form);
}


function SliderPlusPlus_construir_tela_admin($titulo,$conteudo){
    return "<h1>".$titulo."</h1>".$conteudo;
}

?>