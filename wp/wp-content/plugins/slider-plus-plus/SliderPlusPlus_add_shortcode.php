<?php
/*
 * 
 *      SHORT CODE
 * 
 */
add_shortcode('slider', 'SliderPlusPlus_slider');


function SliderPlusPlus_slider($atts, $content=null){
    $calss = (isset($atts['class']))?$class = $atts['class']:"bxslider";
    $atributos = SliderPlusPlus_tratar_variaveis_shortcode($atts);
    if(empty($content)){
        $slides = SliderPlusPlus_get_slides($atributos['slug']);
    }else{
        //se não implementar a função que faz os Slides na hora
    }
    //Adiciona o CSS basico
    SliderPlusPlus_carregar_scripts_basicos();
    //adiciona a Skin
    SliderPlusPlus_css_skin_add($atributos['skin']);    
    unset($atributos['skin']);
    
    $retorno = '';
    if(isset($slides)){
        if($slides->have_posts()){
            //gera um id unico para o slider
            $id = "slider".rand(0, 1000);
            $retorno .= SliderPlusPlus_criarSlider($id, $slides , $calss);
            $retorno .= SliderPlusPlus_criarJs($id, SliderPlusPlus_filtrar_options($atributos));
        }else{
            $retorno .= '';
        }    
    }else{
        // Implamentar Slider no corpo do shortcode
        $retorno .= '';
    }
    return $retorno;
}



/*
 * Carrega Scripts basicos
 */
function SliderPlusPlus_carregar_scripts_basicos(){
//    add_action('wp_print_scripts', 'SliderPlusPlus_load_js');
    SliderPlusPlus_load_js();
    SliderPlusPlus_load_my_css();
}



/*
 * Trata as variaveis do short code
 */
function SliderPlusPlus_tratar_variaveis_shortcode($variaveis){
    
    $variaveis['maxslides'] = intval($variaveis['maxslides']);
    $variaveis['minslides'] = intval($variaveis['maxslides']);
    $variaveis['pause'] = intval($variaveis['pause']);
    $variaveis['slidewidth'] = intval($variaveis['slidewidth']);
    $variaveis['moveslides'] = intval($variaveis['moveslides']);
    
    //Coloca as opções basicas no mesmo array de opções customizadas
    $variaveis = array_merge(SliderPlusPlus_get_options(),$variaveis);
    // Valida as opções selecionadas
    $variaveis = SliderPlusPlus_validar($variaveis);
    //Limpa o array, retirando as opções default do JS
    if(!isset($atributos['id'])){
        $atributos['id'] = "Slider".rand(0, 1000);
    }
    
    return $variaveis;
}


/*
 * Cria uma queri e adiciona os slides
 */
function SliderPlusPlus_get_slides($slug){
    if(!empty($slug)){
        $tax_query = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'slider-plus-plus-taxonomy',
                'field' => 'slug',
                'terms' => array($slug),
                'include_children' => true,
                'operator' => 'IN')
        );
    }else{
        $tax_query = array();
    }
    $slide = new WP_Query(
                    array(
                        'post_type' => array('slider_plus_plus'),
                        'orderby' => 'menu_order',
                        'tax_query' => $tax_query
                    )
    );
    
    return $slide;
}


/*
 * Adiciona o CSS da skin selecionada
 */
function SliderPlusPlus_css_skin_add($skin){
    //verifica se tem a skin disponivel
    if(in_array($skin, SliderPlusPlus_get_skins())){
        //carrega o CSS do skin
        wp_register_style(
                $skin, SliderPlusPlus_url_folder().'/skins/'.$skin.'.css');
        wp_enqueue_style($skin);
    }
}


/*
 * Cria o JS para fazer o Slider funcionar
 */
function SliderPlusPlus_criarJs($id, $options){
    
    return "<script>
                    jQuery(document).ready(function(){
                        jQuery('#".$id."').bxSlider({".SliderPlusPlus_getJsOptions($options)."});
                    });
            </script>
            ";
    
    
//    return "<script> jQuery(document).ready(function() {jQuery('#slider').bxSlider();}); </script>";
}

/*
 * Cria as opçoes do JS
 */
function SliderPlusPlus_getJsOptions($options){
    $options = SliderPlusPlus_filtrar_options($options);    
    
    $options = SliderPlusPlus_padroniza_nomes_js($options);
    
    unset($options['easing']);
    
    
    $new_options = array();
    foreach ($options as $propriedade => $valor) {
        $new_options[] = $propriedade.":".$valor;
    }
    $options = $new_options;
    
    
    
    return implode(' , ', $options);
}


function SliderPlusPlus_criarSlider($id, $slides , $class=""){
    $retorno = '<div class="'.$class.'" id="'.$id.'">';
        while($slides->have_posts()){$slides->the_post();
            $retorno .= '<div class="slider-container">'.get_the_content().'</div>';
        }
    $retorno .= '</div>';
    return $retorno;
}

?>