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
 *  END! THEME SUPORT
 **************************************/




/**************************************
 *      REGISTRO DE MENUS
 **************************************/
register_nav_menu( 'main-menu', __('Main Menu') );
register_nav_menu( 'redes-sociais', __('Redes Sociais') );
/**************************************
 *      END! REGISTRO DE MENUS
 **************************************/



/**************************************
 *      TAMANHOS DE IMAGENS
 **************************************/
add_image_size( 'page-serie', 260 , 341 , true );
add_image_size( 'page-serie', null , 200 , true );



/**************************************
 * CARREGAR JS
 **************************************/
function load_my_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('functions',get_bloginfo('stylesheet_directory','raw').'/js/functions.js',array('jquery'));
    wp_enqueue_script('functions_global',get_bloginfo('stylesheet_directory','raw').'/js/global_functions.js',array('jquery'));
    wp_enqueue_script('bootstrap',get_bloginfo('stylesheet_directory','raw').'/js/bootstrap.js',array('jquery'));
}

add_action( 'wp_enqueue_scripts', 'load_my_scripts');

//JS no Admin
function load_my_scripts_admin() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('functions',get_bloginfo('stylesheet_directory','raw').'/js/admin_functions.js',array('jquery'));
    wp_enqueue_script('functions_global',get_bloginfo('stylesheet_directory','raw').'/js/global_functions.js',array('jquery'));
}
add_filter('admin_head', 'load_my_scripts_admin');
/**************************************
 * END! CARREGAR JS
 **************************************/


/**************************************
 * CARREGAR CSS
 **************************************/
function load_my_CSS() {
    wp_enqueue_style( 
            'bootstrap',
            get_template_directory_uri().'/css/bootstrap.css'
            );
    /*
    wp_enqueue_style( 
            'bootstrap-responsive',
            get_template_directory_uri().'/css/bootstrap-responsive.css',
            array('bootstrap')
            );
     */
}
add_action( 'wp_enqueue_scripts', 'load_my_CSS' );

//JS no Admin
function load_my_CSS_admin() {
}
add_filter('admin_head', 'load_my_CSS_admin');
/**************************************
 * END! CARREGAR JS
 **************************************/





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
        'add_new_item' => __('Adicionar novo Autor'),
        'edit_item' => __('Editar Autor'),
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
        'add_new_item' => __('Adicionar nova Serie'),
        'edit_item' => __('Editar Serie'),
    );
    $args = array(
        'labels' => $labels,
        'description' => __('Esse post type, é para cadastrarmos todas as series'),
        'public' => true,
        'capability_type' => 'post',
        'supports' => array('title','editor','thumbnail'),
        'show_in_nav_menus' => true,
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
        'add_new_item' => __('Adicionar novo Material'),
        'edit_item' => __('Editar Material'),
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
        'add_new_item' => __('Adicionar nova Ocorrência'),
        'edit_item' => __('Editar Ocorrência'),
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
    
    
    /************************
     * Servidores
     ***********************/
    $labels = array(
        'singular_name' =>  __('Servidor'),
        'name' => __('Servidores'),
        'add_new_item' => __('Adicionar novo Servidor'),
        'edit_item' => __('Editar Servidor'),
    );
    $args = array(
        'labels' => $labels,
        'description' => __('Esse post type, é para cadastrarmos as servidores onde estarão hospedados uma determinada ocorrência'),
        'public' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'supports' => array('title'),
    );
    register_post_type('servidores',$args);
    /************************
     * END! Servidores
     ***********************/
    
}
add_action( 'init', 'add_post_types' );
/**************************************
 *      END! REGISTRO DE POST TYPE
 **************************************/


/**************************************
 *      COLUNAS ADICIONAIS
 **************************************/
    function post_column_views($colunas){
        switch (get_post_type()){
            case 'materiais':
                $tmp = array_pop($colunas);
                $colunas['multimidia'] = __("Multimidia");
                $colunas['date'] = __('Date');
            break;
            case 'ocorrencias':
                $tmp = array_pop($colunas);
                $colunas['multimidia_ocorrencia'] = __("Multimidia");
                var_dump($colunas);
                $colunas['date'] = __('Date');
            break;
        }
        return $colunas;
    }
 
    //Function that Populates the 'Views' Column with the number of views count.
    function post_custom_column_views($coluna, $post_id){
        global $post;
        switch ($coluna){
            case 'multimidia':
                $multimidias = $terms = get_the_terms($post_id,'multimidias'); 
                foreach($multimidias as $multimidia){
                    $echo[] = $multimidia->name;
                }
                echo implode(', ', $echo);
            break;
            case 'multimidia_ocorrencia':
                $connected = p2p_type( 'material_ocorrencia' )->get_connected( $post );
                    while ( $connected->have_posts() ){
                        $connected->the_post();
                        $multimidias = get_the_terms($post->ID,'multimidias');
                        foreach($multimidias as $multimidia){
                            $echo[] = $multimidia->name;
                        }
                }
                echo implode(', ', $echo);
            break;
        }
    }
    add_filter('manage_posts_columns', 'post_column_views');
    add_action('manage_posts_custom_column', 'post_custom_column_views',10,2);
/**************************************
 *      END! COLUNAS ADICIONAIS
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
                    'all_items' => __('Todas Fansubs'),
                    'edit_item' => __('Editar Fansub'),
                    'add_new_item' => __('Adicionar nova Fansub'),
                    'separate_items_with_commas' => __('Separe as Fansubs com virgulas'),
                    'add_or_remove_items'=> __('Adicionar ou remover Fansubs'),
                    'menu_name' => __('Fansub'),
                    'choose_from_most_used' => __('Escolha as fansubs mais usadas'),
                    'not_found' => __('Fansub não encontrada'),
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
                    'hierarchical' => true
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
     * END! Formatos
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

    /************************
     * Serie/Anime 
     ************************/
    p2p_register_connection_type(
                                array(
                                        'name' => 'serie_material',
                                        'from' => 'series',
                                        'to' => 'materiais',
                                        'sortable' => 'from',
                                        'title' => __('Serie'),
                                        'cardinality' => 'one-to-many',                                    
                                        'admin_column' => 'to',
                                        'to_labels' => array(
                                                            'column_title' => 'Serie',
                                                          ),               
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
                                        'sortable' => 'numero',
                                        'fields' => array(
                                                    'numero' => array(
                                                            'title' => 'Número',
                                                            'type' => 'text',
                                                            ),
                                                    ),
                                        'admin_column' => 'to',
                                        'to_labels' => array(
                                                            'column_title' => 'Meterial',
                                                          ),               

                                    )
                                );
    /************************
     * END! Anime/Episódio 
     ************************/
    
    
    
    /************************
     * Episódio/Servidor 
     ************************/
    p2p_register_connection_type(
                                array(
                                        'name' => 'episodio_servidor',
                                        'title' => __('Links'),
                                        'from' => 'ocorrencias',
                                        'to' => 'servidores',
                                        'cardinality' => 'many-to-many',
                                        'admin_box' => 'from',
                                        'duplicate_connections' => true,
                                        'fields' => array(
                                                    'formato' => array(
                                                            'title' => 'Formato',
                                                            'type' => 'select',
                                                            'values' => get_formatos_suportados_ocorrencia(),
                                                            ),
                                                    'link' => array(
                                                            'title' => 'Link',
                                                            'type' => 'text',
                                                            ),
                                                    'online' => array(
                                                            'title' => 'On',
                                                            'type' => 'checkbox',
                                                            ),
                                                    ),
                                    )
                                );
    /************************
     * END! Episódio/Servidor
     ************************/       
}
add_action( 'p2p_init', 'my_connection_types' );
/**************************************
 *      END! REGISTRO DE LIGAÇÕES
 **************************************/




/**************************************
 *      FUNÇÕES AUXILIARES
 **************************************/

/*
 * Essa Função é para retornar a lista de formatos suportados de uma ocorrencia
 */
function get_formatos_suportados_ocorrencia($ocorrencia_id = NULL){
    if($ocorrencia_id==NULL){
        //Retorna todos os formatos
        $formatos = get_terms('formatos',array('hide_empty'=>FALSE));
        $termos = array();
        foreach ($formatos as $formato) {
            $termos[$formato->slug] = $formato->name; 
        }
        return $termos;
    }
}

/*
 * Leia mais ...
 */
function new_excerpt_more( $excerpt ) {
	return str_replace( '[...]', '...', $excerpt );
}
add_filter( 'wp_trim_excerpt', 'new_excerpt_more' );


/**************************************
 *      END! FUNÇÕES AUXILIARES
 **************************************/






/**************************************
 *      Usuarios Personalizados
 **************************************/


add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
 
function my_show_extra_profile_fields( $user ) { ?>
 
    <h3>Você nas redes sociais</h3>
 
    <table class="form-table">
 
        <tr>
            <th><label for="twitter">Twitter</label></th>
 
            <td>
                <input type="text" name="twitter" id="twitteruser" value="<?php echo esc_attr( get_the_author_meta( 'twitteruser', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">O seu nome de usuário do Twitter</span>
            </td>
        </tr>
 
        <tr>
            <th><label for="facebookuser">Facebook</label></th>
 
            <td>
                <input type="text" name="facebook" id="facebookuser" value="<?php echo esc_attr( get_the_author_meta( 'facebookuser', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">O seu perfil no Facebook (URL)</span>
            </td>
        </tr>    
 
    </table>
 
    <h3>Mais sobre si</h3>
 
    <table class="form-table">
 
        <tr>
            <th><label for="pais">País</label></th>
 
            <td>
                <input type="text" name="pais" id="pais" value="<?php echo esc_attr( get_the_author_meta( 'pais', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">O seu país</span>
            </td>
        </tr>
 
        <tr>
            <th><label for="cidade">Cidade</label></th>
 
            <td>
                <input type="text" name="cidade" id="cidade" value="<?php echo esc_attr( get_the_author_meta( 'cidade', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Cidade onde se encontra</span>
            </td>
        </tr>    
 
    </table>
<?php }

//Salvando os dados
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' ); 
function my_save_extra_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    update_usermeta( $user_id, 'twitteruser', $_POST['twitter'] );
    update_usermeta( $user_id, 'facebookuser', $_POST['facebook'] );
    update_usermeta( $user_id, 'cidade', $_POST['cidade'] );
    update_usermeta( $user_id, 'pais', $_POST['pais'] );
}

/*
 COMO USAR OS CAMPOS
<?php if ( $curauth->facebookuser ) { ?>
<a href="http://www.facebook.com/<?php echo $curauth->facebookuser; ?>" target="_blank"><div class="facebookb">facebook</div></a>
<?php } ?>
<?php if ( $curauth->twitteruser ) { ?>
<a href="http://www.twitter.com/<?php echo $curauth->twitteruser; ?>" target="_blank"><div class="twitterb">twitter</div></a>
<?php } ?>
 */



/**************************************
 *      END! Usuarios Personalizados
 **************************************/




?>