<?php
/**************************************
 *  THEME SUPORT
 **************************************/

function add_suport_theme(){
    add_theme_support('menus');
    add_theme_support( 'post-thumbnails' );
}
add_action('after_setup_theme','add_suport_theme');



/**************************************
 *      TAMANHOS DE IMAGENS
 **************************************/
//add_image_size( 'image-contato', 221, 606 , true );



/**************************************
 * Carregar JS
 **************************************/
function load_my_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('functions',get_bloginfo('stylesheet_directory','raw').'/js/functions.js',array('jquery'));
}
add_action( 'wp_enqueue_scripts', 'load_my_scripts' );





/**************************************
 *      REGISTRO DE POST TYPE
 **************************************/
function add_post_types(){
    /***********************
     * Autores
     ***********************/
    $labels = array(
        'singular_name' =>  __('Autor'),
        'name' => __('Autores'),
        'new_item' => __('Autor'),
        
        
    );
    $args = array(
        'labels' => $labels,
        'description' => __('Esse post type, é para cadastrarmos todos autores'),
        'public' => true,
        'capability_type' => 'post',
        'supports' => array('title','editor','thumbnail'),
    ); 
    register_post_type('autores',$args);
    /************************
     * END! Autores
     ***********************/
    
    /***********************
     * Series / Franquia
     ***********************/
    $labels = array(
        'singular_name' =>  __('Serie'),
        'name' => __('Series'),
        
        
    );
    $args = array(
        'labels' => $labels,
        'description' => __('Esse post type, é para cadastrarmos todas as series'),
        'public' => true,
        'capability_type' => 'post',
        'supports' => array('title','editor','thumbnail'),
    ); 
    register_post_type('series',$args);
    /************************
     * END! Series / Franquia
     ***********************/
    
    /***********************
     * Material (Animes, Mangas...)
     ***********************/
    $labels = array(
        'singular_name' =>  __('Material'),
        'name' => __('Materiais'),
        
        
    );
    $args = array(
        'labels' => $labels,
        'description' => __('Esse post type, é para cadastrarmos os novos materiais das series'),
        'public' => true,
        'capability_type' => 'post',
        'supports' => array('title','editor'),
    ); 
    register_post_type('materiais',$args);
    /************************
     * END! Material
     ***********************/

    
    /***********************
     * Capitulos
     ***********************/
    $labels = array(
        'singular_name' =>  __('Ocorrência'),
        'name' => __('Ocorrências'),
        
        
    );
    $args = array(
        'labels' => $labels,
        'description' => __('Esse post type, é para cadastrarmos as ocorrências(capitulos,episodios,clips,videos,etc) de um material'),
        'public' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'supports' => array('title'),
    ); 
    register_post_type('ocorrencias',$args);
    /************************
     * END! Capitulos
     ***********************/
    
    
}
add_action( 'init', 'add_post_types' );
/**************************************
 *      END! REGISTRO DE POST TYPE
 **************************************/




/**************************************
 *      REGISTRO DE TAXONOMY
 **************************************/
function add_taxonomy(){
    /************************
     * Fansubs
     ***********************/
    $labels = array(
                    'name' => __( 'Fansubs' ),
                    'singular_name' => __( 'Fansub'),
                ); 

    register_taxonomy(
                'fansub',
                array('series','materiais'),
                array(
                    'labels' => $labels,
                    )
            );
    /************************
     * END! Fansubs
     ***********************/
    
    /************************
     * Multimidias
     ***********************/
    $labels = array(
                    'name' => __( 'Multimidias' ),
                    'singular_name' => __( 'Multimidia'),
                ); 

    register_taxonomy(
                'multimidias',
                array('materiais'),
                array(
                    'labels' => $labels,
                    )
            );
    /************************
     * END! Multimidias
     ***********************/
    
    /************************
     * Generos
     ***********************/
    $labels = array(
                    'name' => __( 'Generos' ),
                    'singular_name' => __( 'Genero'),
                ); 

    register_taxonomy(
                'generos',
                array('series','materiais'),
                array(
                    'labels' => $labels,
                    )
            );
    /************************
     * END! Generos
     ***********************/
    
    /************************
     * Temas
     ***********************/
    $labels = array(
                    'name' => __( 'Temas' ),
                    'singular_name' => __( 'Tema'),
                ); 

    register_taxonomy(
                'temas',
                array('series','materiais'),
                array(
                    'labels' => $labels,
                    )
            );
    /************************
     * END! Temas
     ***********************/
    
    /************************
     * Formatos
     ***********************/
    $labels = array(
                    'name' => __( 'Formatos' ),
                    'singular_name' => __( 'Formato'),
                ); 

    register_taxonomy(
                'formatos',
                array('ocorrencias'),
                array(
                    'labels' => $labels,
                    )
            );
    /************************
     * END! Temas
     ***********************/
    
    
}
add_action( 'init', 'add_taxonomy' );
/**************************************
 *      END! REGISTRO DE TAXONOMY
 **************************************/




/**************************************
 *      REGISTRO DE LIGAÇÕES POSTS 2 POSTS
 **************************************/
function my_connection_types() {
    /************************
     * Autor/Serie 
     ************************/
    p2p_register_connection_type(
                                array(
                                        'name' => 'autor_serie',
                                        'from' => 'autores',
                                        'to' => 'series',
                                        'title' => __('Autoria'),
                                    )
                                );
    /************************
     * END! Autor/Serie 
     ************************/

    /***********
     * Serie/Anime 
     ************************/
    p2p_register_connection_type(
                                array(
                                        'name' => 'serie_material',
                                        'from' => 'series',
                                        'to' => 'materiais',
                                        'title' => __('Materiais relacionados'),
                                        'cardinality' => 'one-to-many',
                                    )
                                );
    /************************
     * END! Serie/Anime 
     ************************/
    
    
    
    /************************
     * Anime/Episódio 
     ************************/
    p2p_register_connection_type(
                                array(
                                        'name' => 'material_ocorrencia',
                                        'from' => 'materiais',
                                        'to' => 'ocorrencias',
                                        'cardinality' => 'one-to-many',
                                        'fields' => array(
                                                    'numero' => array(
                                                            'title' => 'Número',
                                                            'type' => 'text',
                                                            ),
                                                    ),
                                    )
                                );
    /************************
     * END! Anime/Episódio 
     ************************/
    
    
    
    /************************
     * Anime/Episódio 
     ************************/
    p2p_register_connection_type(
                                array(
                                        'name' => 'material_ocorrencia',
                                        'from' => 'materiais',
                                        'to' => 'ocorrencias',
                                        'cardinality' => 'one-to-many',
                                        'fields' => array(
                                                    'numero' => array(
                                                            'title' => 'Número',
                                                            'type' => 'text',
                                                            ),
                                                    ),
                                    )
                                );
    /************************
     * END! Anime/Episódio 
     ************************/
    
    
    
    
    
        
        
        
}

add_action( 'p2p_init', 'my_connection_types' );
/**************************************
 *      END! REGISTRO DE LIGAÇÕES
 **************************************/




?>