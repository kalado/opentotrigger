<?php
/*
  Plugin Name: Slider Plus Plus
  Plugin URI: http://exemplo.org/o-meu-plugin
  Description: Esse plugin serve para criar um Slider de forma rápida e eficiente. Ele tem como objetivo tornar mais simples a criação de Sliders, tanto para desenvolvvedores quanto para usuarios
  Version: 1.0.0
  Author: Bruno Motta
  Author URI: http://www.facebook.com/bruno.motta.505
  License: GPLv2
 */



/*
 * Retorna o caminho fisico do plugin (usado para os includes)
 */
function SliderPlusPlus_folder(){
    return WP_PLUGIN_DIR . "/" . basename(dirname(__FILE__));
}

/*
 * Retorna o caminho virtual para os arquivos 
 */
function SliderPlusPlus_url_folder(){
    return WP_PLUGIN_URL."/".basename(dirname(__FILE__));
}




/*
 * 
 * Funções auxiliares
 * 
 */
require_once(SliderPlusPlus_folder().'/SliderPlusPlus_auxiliar.php');

/*
 * 
 * Registrar post type do Slider
 * 
 */
require_once(SliderPlusPlus_folder().'/SliderPlusPlus_registro_post_type.php');


/*
 * 
 * Adiciona o botão do para inserir Shortcode na tela do administrativo
 * 
 */
require_once( SliderPlusPlus_folder().'/SliderPlusPlus_insert_button_admin.php');

/*
 * 
 * Adicionar Tela de Configurações no Administrativo
 * 
 */
require_once( SliderPlusPlus_folder().'/SliderPlusPlus_admin_options.php');


/*
 * 
 * Adicionar o Short Code
 * 
 */
require_once(SliderPlusPlus_folder().'/SliderPlusPlus_add_shortcode.php');
?>