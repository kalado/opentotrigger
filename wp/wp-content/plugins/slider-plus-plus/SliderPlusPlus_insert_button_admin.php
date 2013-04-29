<?php
/*
 * 
 * Inserir botão de Shortcode no admin
 * 
 */


/*
 * Inserir botão no topo do editor
 */
//add_action('media_buttons', 'add_slider_button'); //para inserir antes do botão de midia
add_action('media_buttons_context', 'add_slider_button'); //para inserir depois do botão de midia

/*
 * Cria o Modal para adicionar o shortcode
 */
add_action('admin_footer', 'SliderPlusPlus_add_button_in_editor');


/*
 * 
 * 
 * Funções Para adicionar o Shortcode
 * 
 * 
 */

/*
 * Cria Botão
 */
function add_slider_button(){
    if(!is_CRUD_page())
        return;

    $imagem_bnt = SliderPlusPlus_url_folder()."/icone-botao.png";
    
    //print_r($imagem_bnt);
    //exit;
    
    
    $css =
            '<style>.SliderPlusPlus_media_icon{
            background:url(\''.$imagem_bnt.'\') no-repeat top left;
            display: inline-block;
            height: 16px;
            margin: 0 2px 0 0;
            vertical-align: text-top;
            width: 16px;
            }
            .wp-core-ui a.gform_media_link{
             padding-left: 0.4em;
            }
        </style>';
    
    $bnt =
            '<button class="button" id="add_SliderPlusPlus_bnt" title="'.__("Add Slider", 'SliderPlusPlus').'">
                <span class="SliderPlusPlus_media_icon" style="width: 30px;"></span> '.__("Add Slider", "SliderPlusPlus").
            '</button>';
    echo $css.$bnt;
}






/*
 * Cria a div do modal
 */
function SliderPlusPlus_add_button_in_editor(){
    if(!is_CRUD_page()){
        return;
    }
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-dialog', array('jquery'));

    wp_register_style( "jquery-ui-dialog-css", "http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" );
    wp_enqueue_style("jquery-ui-dialog-css");
    
    
    /*
     * 
     * Essa é a parte onde são criados os campos
     * 
     * 
     */
    $ativado_desativado = array('true'=>'Ativado','false'=>'Desativado');
    $ativado_desativado_video = array('true'=>'Com videos','false'=>'Sem videos');
    $numero_de_slides_por_slider = SliderPlusPlus_gerar_array_numerico(1,20,1);
    $numero_de_slides_por_slider = array_combine($numero_de_slides_por_slider,$numero_de_slides_por_slider);  
    
    $valores_distancia = SliderPlusPlus_gerar_array_numerico(0,300,5);
    $valores_distancia = array_combine($valores_distancia,$valores_distancia);
    
    $passar_sliders = SliderPlusPlus_gerar_array_numerico(0,20,1);
    $passar_sliders = array_combine($passar_sliders,$passar_sliders);        
    $passar_sliders[0] = "PAssar uma página";
            
    foreach(SliderPlusPlus_get_skins() as $skin){
        $skins[$skin]=ucfirst($skin);
    }
    $slides[" "]="Todos os slides";
    foreach(get_terms('slider-plus-plus-taxonomy') as $taxonomy){
        $slides[$taxonomy->slug]="$taxonomy->name";
    }
    
    $campos[0] = 
        array(
            'skin' => array('label'=>'Selecione a skin do slider' ,'id'=>"add_skin", 'type'=>"select" , 'valores'=>$skins ),
            'slug' => array('label'=>'Selecione os Slides' ,'id'=>'add_slug' ,'type'=>"select" , 'valores'=>$slides ),
            'slidewidth' =>  array('label'=>'Largura do Slider' ,'id'=>'add_slidewidth' ,'type'=>"text" , 'value'=> '' ),
            'minslides' => array('label'=>'Número minimo de slides' ,'id'=>"add_minslides", 'type'=>"select" , 'valores'=>$numero_de_slides_por_slider ),
            'maxslides' => array('label'=>'Número máximo de slides' ,'id'=>"add_maxslides", 'type'=>"select" , 'valores'=>$numero_de_slides_por_slider ),
            'moveslides' =>  array('label'=>'Sliders por página' ,'id'=>'add_moveslides' ,'type'=>"select" , 'valores'=> $passar_sliders ),
        );
    $form = SliderPlusPlus_conteiner_maior('Configurações Básicas', 'Essas duas opções servem para selecionar o minimo, necessário',  SliderPlusPlus_conteiner_menor($campos[0]));
    
    $campos[1] = array(
                    'mode' => array('label'=>'Direção dos Slides', 'id'=>'add_mode' , 'type'=>"select" , 'valores'=>array('horizontal'=>'horizontal', 'vertical'=>'vertical', 'fade'=>'fade') ),
                    'controls' => array('label'=>'Exibir as setas de controle' ,'id'=>'add_controls', 'type'=>"select", 'valores'=>$ativado_desativado),
                    'pager' => array('label'=>'Exibir o pager' , 'type'=>"select",'id'=>'add_pager', 'valores'=>$ativado_desativado),
                    'slidemargin' => array('label'=>'Distancia entre os slides' , 'type'=>"select" , 'valores'=>$valores_distancia ),
                    'auto' => array('label'=>'Auto play' ,'id'=>'add_auto', 'type'=>"select" , 'valores'=>$ativado_desativado),
                    'pause' => array('label'=>'Tempo em cada slide (em ms)' ,'id'=>'add_pause', 'type'=>"text"),
                    'video' => array('label'=>'Auto play' , 'id'=>'add_video','type'=>"select", 'valores'=>$ativado_desativado_video),
                   );
    
    $form .= SliderPlusPlus_conteiner_maior('Funcionalidades', 'Essas funcionalidades são especificas para esse Slider, se desejar usar as configurações padrão não altere nada.',  SliderPlusPlus_conteiner_menor($campos[1]));
    
    ?>
<script type="text/javascript" charset="utf-8">
        jQuery(document).ready(function(){
            
            function escreverNoEditor(texto){
                window.send_to_editor(texto);
            }
            
            
            jQuery( "#add_SliderPlusPlus_bnt" ).click(function() {
                  jQuery( "#add_SliderPlusPlus_hidden_div" ).dialog( "open" );
                  return false;
            });
            
            jQuery( "#add_SliderPlusPlus_hidden_div" ).dialog({
                autoOpen: false,
                height: 575,
                width: 900,
                modal: true,
                draggable:false,
                resizable : false,
                buttons: {
                  "Adicionar Slider": function(){
                      adicionar_Slider  = "";
                      adicionar_Slider += "[slider ";
                      if(jQuery( "#add_slug" ).val()!="" && jQuery( "#add_slug" ).val()!=" "){
                        adicionar_Slider += "slug=\""+jQuery( "#add_slug" ).val()+"\" ";
                      }
                      adicionar_Slider += "skin=\""+jQuery( "#add_skin" ).val()+"\" ";
                      adicionar_Slider += "mode=\""+jQuery( "#add_mode" ).val()+"\" ";
                      if(jQuery( "#add_slidewidth" ).val() != "" && jQuery( "#add_slidewidth" ).val()>0){
                        adicionar_Slider += "slidewidth=\""+jQuery( "#add_slidewidth" ).val()+"\" ";
                      }
                      adicionar_Slider += "controls=\""+jQuery( "#add_controls" ).val()+"\" ";
                      adicionar_Slider += "pager=\""+jQuery( "#add_pager" ).val()+"\" ";
                      adicionar_Slider += "minslides=\""+jQuery( "#add_minslides" ).val()+"\" ";
                      adicionar_Slider += "maxslides=\""+jQuery( "#add_maxslides" ).val()+"\" ";
                      adicionar_Slider += "moveslides=\""+jQuery( "#add_moveslides" ).val()+"\" ";
                      adicionar_Slider += "pager=\""+jQuery( "#add_pager" ).val()+"\" ";
                      adicionar_Slider += "pause=\""+jQuery( "#add_pause" ).val()+"\" ";
                      adicionar_Slider += "video=\""+jQuery( "#add_video" ).val()+"\" ";
                      adicionar_Slider += "]";
                      escreverNoEditor(adicionar_Slider);
                      
                      //alert(jQuery( "#add_minslides" ).val());
                      //alert(jQuery( "#add_maxslides" ).val());
                      
                      jQuery( this ).dialog( "close" );
                  },
                 Cancel: function() {
                    jQuery( this ).dialog( "close" );
                  }
                },
                close: function() {
                  jQuery("#reset-form-slider").click();
                }
              });
            
        });
    </script>
    <div id="add_SliderPlusPlus_hidden_div" title="Adicionar Slider">
        <form>
            <?php echo $form; ?>
            <input id="reset-form-slider" type="reset" style="display: none"/>
        </form>
        
    </div>    
    <?php
}





?>