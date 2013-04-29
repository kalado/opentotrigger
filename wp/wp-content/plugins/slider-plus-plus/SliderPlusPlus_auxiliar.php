<?php

/*
 * 
 * 
 * Funções de auxiliares
 * 
 * 
 */

function SliderPlusPlus_padroniza_nomes_js($options) {
    $equivalencia = array(
        "mode" => "mode",
        "speed"=>"speed",
        "startslide"=>"startSlide",
        "slidemargin"=>"slideMargin",
        "randomstart"=>"randomStart",
        "infiniteloop"=>"infiniteLoop",
        "hidecontrolonend"=>"hideControlOnEnd",
        "easing"=>"easing",
        "captions"=>"captions",
        "ticker"=>"ticker",
        "tickerhover"=>"tickerHover",
        "adaptiveheight"=>"adaptiveHeight",
        "adaptiveheightspeed"=>"adaptiveHeightSpeed",
        "video"=>"video",
        "usecss"=>"useCSS",
        "preloadimages"=>"preloadImages",
        "touchenabled"=>"touchEnabled",
        "swipethreshold"=>"swipethreshold",
        "onetoonetouch"=>"oneToOneTouch",
        "preventdefaultswipex"=>"preventDefaultSwipeX",
        "preventdefaultswipey"=>"preventDefaultSwipeY",
        "pager"=>"pager",
        "pagertype"=>"pagerType",
        "pagershortseparator"=>"pagerShortSeparator",
        "controls"=>"controls",
        "nexttext"=>"nextText",
        "prevtext"=>"prevText",
        "autocontrols"=>"autoControls",
        "starttext"=>"startText",
        "stoptext"=>"stopText",
        "autocontrolscombine"=>"autoControlsCombine",
        "auto"=>"auto",
        "pause"=>"pause",
        "autostart"=>"autoStart",
        "autodirection"=>"autoDirection",
        "autohover"=>"autoHover",
        "autodelay"=>"autoDelay",
        "minslides"=>"minSlides",
        "maxslides"=>"maxSlides",
        "moveslides"=>"moveSlides",
        "slidewidth"=>"slideWidth",
    );
    
    
    $kyes = array_keys($options);
    $novas_options = array();
    foreach ($kyes as $key){
        if(array_key_exists($key, $options)){
            $nova_key = $equivalencia[$key];
            $novas_options[$nova_key] = $options[$key];
        }  else {
            $novas_options[$key] = $options[$key];
        }
    }
    return $novas_options;
}




function SliderPlusPlus_validar($options) {
    
    $true_false = array("true","false");
    
    if (isset($options['skin'])) {
        $valores_validos = SliderPlusPlus_get_skins();
        if (array_search($options['skin'], $valores_validos) === FALSE) {
            $options['skin'] = $valores_validos[0];
        }
    }
    
    if (isset($options['mode'])) {
        $valores_validos = array('horizontal', 'vertical', 'fade');
        if (array_search($options['mode'], $valores_validos) === FALSE) {
            unset($options['mode']);
        }
    }

    if (isset($options['randomstart'])) {
        if (array_search($options['randomstart'], $true_false) === FALSE) {
            unset($options['randomstart']);
        }
    }

    if (isset($options['infiniteloop'])) {
        if (array_search($options['infiniteloop'], $true_false) === FALSE) {
            unset($options['infiniteloop']);
        }
    }

    if (isset($options['hidecontrolonend'])) {
        if (array_search($options['hidecontrolonend'], $true_false) === FALSE) {
            unset($options['hidecontrolonend']);
        }
    }

    if (isset($options['easing'])) {
        $valores_validos = array('linear','swing','easeInQuad','easeInOutQuad','easeInCubic','easeOutCubic','easeInOutCubic','easeInQuart','easeOutQuart','easeInOutQuart','easeInQuint','easeOutQuint','easeInOutQuint','easeInExpo','easeOutExpo','easeInOutExpo','easeInSine','easeOutSine','easeInOutSine','easeInCirc','easeOutCirc','easeInOutCirc','easeInElastic','easeOutElastic','easeInOutElastic','easeInBack','easeOutBack','easeInOutBack','easeInBounce','easeOutBounce','easeInOutBounce');
        if (array_search($options['easing'], $valores_validos) === FALSE) {
            unset($options['easing']);
        }
    }

    if (isset($options['captions'])) {
        if (array_search($options['captions'], $true_false) === FALSE) {
            unset($options['captions']);
        }
    }

    if (isset($options['ticker'])) {
        if (array_search($options['ticker'], $true_false) === FALSE) {
            unset($options['ticker']);
        }
    }

    if (isset($options['tickerhover'])) {
        if (array_search($options['tickerhover'], $true_false) === FALSE) {
            unset($options['tickerhover']);
        }
    }

    if (isset($options['adaptiveheight'])) {
        if (array_search($options['adaptiveheight'], $true_false) === FALSE) {
            unset($options['adaptiveheight']);
        }
    }

    if (isset($options['video'])) {
        if (array_search($options['video'], $true_false) === FALSE) {
            unset($options['video']);
        }
    }

    if (isset($options['usecss'])) {
        if (array_search($options['usecss'], $true_false) === FALSE) {
            unset($options['usecss']);
        }
    }

    if (isset($options['preloadimages'])) {
        if (array_search($options['preloadimages'], $true_false) === FALSE) {
            unset($options['preloadimages']);
        }
    }

    if (isset($options['touchenabled'])) {
        if (array_search($options['touchenabled'], $true_false) === FALSE) {
            unset($options['touchenabled']);
        }
    }

    if (isset($options['onetoonetouch'])) {
        if (array_search($options['onetoonetouch'], $true_false) === FALSE) {
            unset($options['onetoonetouch']);
        }
    }

    if (isset($options['preventdefaultswipex'])) {
        if (array_search($options['preventdefaultswipex'], $true_false) === FALSE) {
            unset($options['preventdefaultswipex']);
        }
    }

    if (isset($options['preventdefaultswipey'])) {
        if (array_search($options['preventdefaultswipey'], $true_false) === FALSE) {
            unset($options['preventdefaultswipey']);
        }
    }

    if (isset($options['pager'])) {
        if (array_search($options['pager'], $true_false) === FALSE) {
            unset($options['pager']);
        }
    }

    if (isset($options['pagertype'])) {
        $valores_validos = array('full', 'short');
        if (array_search($options['pagertype'], $valores_validos) === FALSE) {
            unset($options['pagertype']);
        }
    }

    if (isset($options['controls'])) {
        if (array_search($options['controls'], $true_false) === FALSE) {
            unset($options['controls']);
        }
    }

    if (isset($options['autocontrols'])) {
        if (array_search($options['autocontrols'], $true_false) === FALSE) {
            unset($options['autocontrols']);
        }
    }

    if (isset($options['autocontrolscombine'])) {
        if (array_search($options['autocontrolscombine'], $true_false) === FALSE) {
            unset($options['autocontrolscombine']);
        }
    }

    if (isset($options['auto'])) {
        if (array_search($options['auto'], $true_false) === FALSE) {
            unset($options['auto']);
        }
    }

    if (isset($options['autostart'])) {
        if (array_search($options['autostart'], $true_false) === FALSE) {
            unset($options['autostart']);
        }
    }

    if (isset($options['autodirection'])) {
        $valores_validos = array('next', 'prev');
        if (array_search($options['autodirection'], $valores_validos) === FALSE) {
            unset($options['autodirection']);
        }
    }

    if (isset($options['autohover'])) {
        if (array_search($options['autohover'], $true_false) === FALSE) {
            unset($options['autohover']);
        }
    }

    if (isset($options['speed'])) {
        if (is_int($options['speed']) === FALSE) {
            unset($options['speed']);
        }
    }

    if (isset($options['startslide'])) {
        if (is_int($options['startslide']) === FALSE) {
            unset($options['startslide']);
        }
    }

    if (isset($options['slidemargin'])) {
        if (is_int($options['slidemargin']) === FALSE) {
            unset($options['slidemargin']);
        }
    }

    if (isset($options['adaptiveheightspeed'])) {
        if (is_int($options['adaptiveheightspeed']) === FALSE) {
            unset($options['adaptiveheightspeed']);
        }
    }

    if (isset($options['swipethreshold'])) {
        if (is_int($options['swipethreshold']) === FALSE) {
            unset($options['swipethreshold']);
        }
    }

    if (isset($options['pause'])) {
        if (is_int($options['pause']) === FALSE) {
            unset($options['pause']);
        }
    }

    if (isset($options['autodelay'])) {
        if (is_int($options['autodelay']) === FALSE) {
            unset($options['autodelay']);
        }
    }

    if (isset($options['minslides'])) {
        if (is_int($options['minslides']) === FALSE) {
            unset($options['minslides']);
        }
    }

    if (isset($options['maxslides'])) {
        if (is_int($options['maxslides']) === FALSE) {
            unset($options['maxslides']);
        }
    }

    if (isset($options['moveslides'])) {
        if (is_int($options['moveslides']) === FALSE) {
            unset($options['moveslides']);
        }
    }

    if (isset($options['slidewidth'])) {
        if (is_int($options['slidewidth']) === FALSE) {
            unset($options['slidewidth']);
        }
    }
    
    return $options;
}

/*
 * Retorna um array com as opções padrão (as opção do page_options)
 */

function SliderPlusPlus_get_options() {
    $skin = SliderPlusPlus_get_skins();
    $skin = $skin[0];

    $default = array(
        "skin" => get_option("SliderPlusPlus_skin", $skin),
        "mode" => get_option("SliderPlusPlus_transicao", "horizontal"),
        "speed" => intval(get_option("SliderPlusPlus_transicao", 500)),
        "startslide" => intval(get_option("SliderPlusPlus_startslide", 0)),
        "slidemargin" => intval(get_option("SliderPlusPlus_slidemargin", 0)),
        "randomstart" => get_option("SliderPlusPlus_randomstart", "false"),
        "infiniteloop" => get_option("SliderPlusPlus_infiniteloop", "true"),
        "hidecontrolonend" => get_option("SliderPlusPlus_hidecontrolonend", "false"),
        "easing" => get_option("SliderPlusPlus_easing", "null"),
        "captions" => get_option("SliderPlusPlus_captions", "false"),
        "ticker" => get_option("SliderPlusPlus_ticker", "false"),
        "tickerhover" => get_option("SliderPlusPlus_tickerhover", "false"),
        "adaptiveheight" => get_option("SliderPlusPlus_adaptiveheight", "false"),
        "adaptiveheightspeed" => intval(get_option("SliderPlusPlus_adaptiveheightspeed", 500)),
        "video" => get_option("SliderPlusPlus_video", "false"),
        "usecss" => get_option("SliderPlusPlus_usecss", "true"),
        "preloadimages" => get_option("SliderPlusPlus_preloadimages", "visible"),
        "touchenabled" => get_option("SliderPlusPlus_touchenabled", "true"),
        "swipethreshold" => intval(get_option("SliderPlusPlus_swipethreshold", 50)),
        "onetoonetouch" => get_option("SliderPlusPlus_onetoonetouch", "true"),
        "preventdefaultswipex" => get_option("SliderPlusPlus_preventdefaultswipex", "true"),
        "preventdefaultswipey" => get_option("SliderPlusPlus_preventdefaultswipey", "false"),
        "pager" => get_option("SliderPlusPlus_pager", "true"),
        "pagertype" => get_option("SliderPlusPlus_pagertype", "full"),
        "pagershortseparator" => get_option("SliderPlusPlus_pagershortseparator", " / "),
        "controls" => get_option("SliderPlusPlus_controls", "true"),
        "nexttext" => get_option("SliderPlusPlus_nexttext", "next"),
        "prevtext" => get_option("SliderPlusPlus_prevtext", "prev"),
        "autocontrols" => get_option("SliderPlusPlus_autocontrols", "false"),
        "starttext" => get_option("SliderPlusPlus_starttext", "start"),
        "stoptext" => get_option("SliderPlusPlus_stoptext", "stop"),
        "autocontrolscombine" => get_option("SliderPlusPlus_autocontrolscombine", "false"),
        "auto" => get_option("SliderPlusPlus_auto", "false"),
        "pause" => intval(get_option("SliderPlusPlus_pause", 4000)),
        "autostart" => get_option("SliderPlusPlus_autostart", "true"),
        "autodirection" => get_option("SliderPlusPlus_autodirection", "next"),
        "autohover" => get_option("SliderPlusPlus_autohover", "false"),
        "autodelay" => intval(get_option("SliderPlusPlus_autodelay", 0)),
        "minslides" => intval(get_option("SliderPlusPlus_minslides", 1)),
        "maxslides" => intval(get_option("SliderPlusPlus_maxslides", 1)),
        "moveslides" => intval(get_option("SliderPlusPlus_moveslides", 0)),
        "slidewidth" => intval(get_option("SliderPlusPlus_slidewidth", 0)),
    );
    return $default;
}

function SliderPlusPlus_filtrar_options($options) {
    if (isset($options['slug'])) {
        unset($options['slug']);
    }
    
    if (isset($options['mode']) && ($options['mode'] == "horizontal")) {
        unset($options['mode']);
    }
    if (isset($options['speed']) && ($options['speed'] == 500)) {
        unset($options['speed']);
    }
    if (isset($options['startslide']) && ($options['startslide'] == 0)) {
        unset($options['startslide']);
    }
    if (isset($options['slidemargin']) && ($options['slidemargin'] == 0)) {
        unset($options['slidemargin']);
    }
    if (isset($options['randomstart']) && ($options['randomstart'] == "false")) {
        unset($options['randomstart']);
    }
    if (isset($options['infiniteloop']) && ($options['infiniteloop'] == "true")) {
        unset($options['infiniteloop']);
    }
    if (isset($options['hidecontrolonend']) && ($options['hidecontrolonend'] == "false")) {
        unset($options['hidecontrolonend']);
    }
    if (isset($options['easing']) && ($options['easing'] == "null")) {
        unset($options['easing']);
    }
    if (isset($options['captions']) && ($options['captions'] == "false")) {
        unset($options['captions']);
    }
    if (isset($options['ticker']) && ($options['ticker'] == "false")) {
        unset($options['ticker']);
    }
    if (isset($options['tickerhover']) && ($options['tickerhover'] == "false")) {
        unset($options['tickerhover']);
    }
    if (isset($options['adaptiveheight']) && ($options['adaptiveheight'] == "false")) {
        unset($options['adaptiveheight']);
    }
    if (isset($options['adaptiveheightspeed']) && ($options['adaptiveheightspeed'] == 500)) {
        unset($options['adaptiveheightspeed']);
    }
    if (isset($options['video']) && ($options['video'] == "false")) {
        unset($options['video']);
    }
    if (isset($options['usecss']) && ($options['usecss'] == "true")) {
        unset($options['usecss']);
    }
    if (isset($options['preloadimages']) && ($options['preloadimages'] == "visible")) {
        unset($options['preloadimages']);
    }
    if (isset($options['touchenabled']) && ($options['touchenabled'] == "true")) {
        unset($options['touchenabled']);
    }
    if (isset($options['swipethreshold']) && ($options['swipethreshold'] == 50)) {
        unset($options['swipethreshold']);
    }
    if (isset($options['onetoonetouch']) && ($options['onetoonetouch'] == "true")) {
        unset($options['onetoonetouch']);
    }
    if (isset($options['preventdefaultswipex']) && ($options['preventdefaultswipex'] == "true")) {
        unset($options['preventdefaultswipex']);
    }
    if (isset($options['preventdefaultswipey']) && ($options['preventdefaultswipey'] == "false")) {
        unset($options['preventdefaultswipey']);
    }
    if (isset($options['pager']) && ($options['pager'] == "true")) {
        unset($options['pager']);
    }
    if (isset($options['pagertype']) && ($options['pagertype'] == "full")) {
        unset($options['pagertype']);
    }
    if (isset($options['pagershortseparator']) && ($options['pagershortseparator'] == " / ")) {
        unset($options['pagershortseparator']);
    }
    if (isset($options['controls']) && ($options['controls'] == "true")) {
        unset($options['controls']);
    }
    if (isset($options['nexttext']) && ($options['nexttext'] == "next")) {
        unset($options['nexttext']);
    }
    if (isset($options['prevtext']) && ($options['prevtext'] == "prev")) {
        unset($options['prevtext']);
    }
    if (isset($options['autocontrols']) && ($options['autocontrols'] == "false")) {
        unset($options['autocontrols']);
    }
    if (isset($options['starttext']) && ($options['starttext'] == "start")) {
        unset($options['starttext']);
    }
    if (isset($options['stoptext']) && ($options['stoptext'] == "stop")) {
        unset($options['stoptext']);
    }
    if (isset($options['autocontrolscombine']) && ($options['autocontrolscombine'] == "false")) {
        unset($options['autocontrolscombine']);
    }
    if (isset($options['auto']) && ($options['auto'] == "false")) {
        unset($options['auto']);
    }
    if (isset($options['pause']) && ($options['pause'] == 4000)) {
        unset($options['pause']);
    }
    if (isset($options['autostart']) && ($options['autostart'] == "true")) {
        unset($options['autostart']);
    }
    if (isset($options['autodirection']) && ($options['autodirection'] == "next")) {
        unset($options['autodirection']);
    }
    if (isset($options['autohover']) && ($options['autohover'] == "false")) {
        unset($options['autohover']);
    }
    if (isset($options['autodelay']) && ($options['autodelay'] == 0)) {
        unset($options['autodelay']);
    }
    if (isset($options['minslides']) && ($options['minslides'] == 1)) {
        unset($options['minslides']);
    }
    if (isset($options['maxslides']) && ($options['maxslides'] == 1)) {
        unset($options['maxslides']);
    }
    if (isset($options['moveslides']) && ($options['moveslides'] == 0)) {
        unset($options['moveslides']);
    }
    if (isset($options['slidewidth']) && ($options['slidewidth'] == 0)) {
        unset($options['slidewidth']);
    }

    return $options;
}

/*
 * 
 * Exemplo de como deve ser o array campos
 * 
 *      array(
 *          'id_do_campo'=>array('label'=>'ESSE É O NOME DO CAMPO', 'type'=>'text/select', 'valores'=>array('valor'=>'Label') ou 'valores'=>'CASO SEJA TEXT' );
 *      )
 * 
 */

function SliderPlusPlus_conteiner_menor($campos) {
    $default = SliderPlusPlus_get_options();
    $retorno = '    
        <table id="newmeta">
            <thead>
                <tr>
                ';

    foreach ($campos as $campo => $meta_dados_campo) {
        if(!isset($meta_dados_campo['id'])){
            $meta_dados_campo['id'] = $campo;
        }
        $retorno .= '<th><label for="' . $meta_dados_campo['id'] . '">' . $meta_dados_campo['label'] . '</label></th>';
    }

    $retorno .= '
                </tr>
            </thead>
            <tbody>
            <tr>
        ';
    foreach ($campos as $campo => $meta_dados_campo) {
        if(!isset($meta_dados_campo['id'])){
            $meta_dados_campo['id'] = $campo;
        }
        
        if (!isset($meta_dados_campo['value'])) {
            $meta_dados_campo['value'] = "";
            if (isset($default[$campo])) {
                $meta_dados_campo['value'] = $default[$campo];
            }
        }

        if ($meta_dados_campo['type'] == "select") {
            $retorno .= '
                            <td>
                                <select id="' . $meta_dados_campo['id'] . '" name="' . $campo . '" class="SliderPlusPlus_add_field ' . $campo . '" >';
            foreach ($meta_dados_campo['valores'] as $valor => $label) {
                $retorno .= '<option value="' . $valor . '"  ' . (($meta_dados_campo['value'] == $valor) ? "selected" : "") . '   >' . $label . '</option>';
            }
            $retorno .= '</select>
                            </td>';
        } else if ($meta_dados_campo['type'] == "text") {
            $retorno .= '
                            <td>
                                <input type="text" id="' . $meta_dados_campo['id'] . '" name="' . $campo . '" class="SliderPlusPlus_add_field ' . $campo . '" value="' . $meta_dados_campo['value'] . '" >
                            </td>';
        }
    }
    $retorno .= '
                </tr>
            </tbody>
        </table>
        ';
    return $retorno;
}

/*
 * Cria o HTML do Administrativo
 */

function SliderPlusPlus_conteiner_maior($titulo, $observacao, $conteudo) {
    return '
            <div class="metabox-holder" style="padding-top: 20px;">
                <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                    <div id="postcustom" class="postbox ">
                        <h3 class="hndle" style="cursor: default"><span>' . $titulo . '</span></h3>
                        <div class="inside">
                            <div id="postcustomstuff">
                                <div id="ajax-response"></div>
                                <p><strong>' . $observacao . '</strong></p>
                                ' . $conteudo . '
                            </div>
                        </div>
                    </div>
                </div>                    
                <br class="clear">
            </div>
    ';
}

/*
 * Retorna todos os nomes de arquivos na pasta Skin (sem o .CSS)
 */

function SliderPlusPlus_get_skins(){
    $skins = SliderPlusPlus_get_archives_skin();
    $tmp = array();
    foreach ($skins as $skin) {
        $tmp[] = str_replace('.css', '', $skin);
    }
    return $tmp;
}

/*
 * Retorna o nome comleto de todos os arquivos da pasta Skins
 */

function SliderPlusPlus_get_archives_skin() {
    $arquivos = array();
    // abre o diretório de skins
    $dir = opendir(plugin_dir_path(__FILE__) . 'skins');
    // monta os vetores com os itens encontrados na pasta
    while ($nome_itens = readdir($dir)) {
        if ($nome_itens == '.' || $nome_itens == '..' || $nome_itens == '.DS_Store')
            continue;
        $arquivos[] = $nome_itens;
    }
    return $arquivos;
}

/*
 * Verifica se é uma página de editar ou adicionar
 */

function is_CRUD_page() {
    return in_array(basename($_SERVER['PHP_SELF']), array('post.php', 'post-new.php'));
}

/*
 * Atualiza os valores das opções padrão
 */

function SliderPlusPlus_autualizar_array_default($novos_valores){
    //$novos_valores = SliderPlusPlus_filtrar_options($novos_valores);
    foreach($novos_valores as $key => $valor){
        //echo $key;echo '<br><br><br><br>';
        $key = "SliderPlusPlus_".$key;
        if(get_option( $key, $valor )==FALSE){
            //Cria um novo
            add_option($key, $valor);
        }else{
            //Faz update
            update_option($key, $valor);
        }
    }
    
}

/*
 * Carrega JS do Slider
 */

function SliderPlusPlus_load_js() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script(
            'bxSlider', 'http://bxslider.com/lib/jquery.bxslider.js', array('jquery', 'jquery-ui-core')
    );
    wp_enqueue_script(
            'fitvids', 'https://raw.github.com/davatron5000/FitVids.js/master/jquery.fitvids.min.js', array('jquery', 'jquery-ui-core','bxSlider')
    );
}

/*
 * Carrega CSS do Slider
 */

function SliderPlusPlus_load_my_css() {
    wp_register_style(
            'SliderPlusPlus-base-css', 'http://bxslider.com/lib/jquery.bxslider.css');
    wp_enqueue_style('SliderPlusPlus-base-css');
}

?>