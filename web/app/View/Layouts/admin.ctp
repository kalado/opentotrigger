<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if(!isset($title_for_layout))$title_for_layout = "Anime-Trigger - Administrativo";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array(
                //'cake.generic',
                'bootstrap',
                'bootstrap-responsive',
                'datepicker',
            )
        );
        echo $this->Html->script(array(
                'jQuery',
                'jQuery.ui',
                'jAdmin',
                'bootstrap',
                'bootstrap-datepicker',
            )
        );


        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>


        <div id="container" class="container-fluid">
            
            <div class="row-fluid">
                <div class="span12 header">
                    <div class="navbar">
                        <?php echo $this->element('Admin/menu-top'); ?>
                    </div>
                </div>
            </div>
            
            <div class="row-fluid">
                <div class="span2">
                    <?php echo $this->element('Admin/menu-esquerda'); ?>
                </div>


                <div class="span10">
                    <?php echo $this->fetch('content'); ?>
                </div>
            </div>
            
            <div class="row-fluid">
                <div id="footer" class="footer span12">
                </div>
            </div>

        </div>

        <?php // echo $this->element('sql_dump');  ?>
    </body>
</html>
