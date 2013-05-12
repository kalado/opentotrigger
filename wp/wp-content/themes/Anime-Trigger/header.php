<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <title><?php wp_title(' | ', true, 'right'); bloginfo('name'); ?></title>
        <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />        
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        
        <!-- mascara -->
        <div class="bg-mascara">
            
            <!-- container -->
            <div id="container" class="container">

                <!-- row-container -->
                <div class="row-fluid">

                    <!-- full-grid -->
                    <div class="span12">
                        
                        <!-- header -->
                        <div class="row-fluid header">
                            <div class="span6">
                                <a class="logo" href="<?php echo home_url(); ?>"><span class="hidden">home</span></a>
                            </div>
                            
                            <!-- rede-social -->
                            <div class="offset4 span2">

                                
                                
                                <!-- exemplo de menu -->
<!--                                <div class="row-fluid">
                                    <div class="span4">
                                        <a class="bnt-youtube"></a>                                        
                                    </div>
                                    <div class="span4">
                                        <a class="bnt-facebook"></a>
                                    </div>
                                    <div class="span4">
                                        <a class="bnt-twitter"></a>
                                    </div>
                                </div>-->
                                <!-- end.exemplo de menu -->
                                
                                
                                <?php wp_nav_menu(array('menu'=>'redes-sociais','container'=>'','menu_class'=>'row-fluid' , 'link_before'=>'<span class="hidden">' ,'link_after'=>'</span>')); ?>
                            </div>
                            <!-- end.rede-social -->
                            
                            
                            <!-- menu-header -->
                            <div class="span9 margin-top-40">
                                <?php wp_nav_menu(array('menu'=>'main-menu','container'=>'','menu_class'=>'row-fluid' , 'link_before'=>'<span class="link-menu-top">' ,'link_after'=>'</span> <i class="seta"></i>')); ?>
                            </div>
                            <!-- end.menu-header -->
                            
                            
                        </div>
                        <!-- end.header -->

            
                        
