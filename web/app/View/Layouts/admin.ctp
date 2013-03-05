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
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?>:
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css(array(
                //'cake.generic',
                'bootstrap',
                'bootstrap-responsive',
                'datepicker',
                'basicos',
                'default',
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
                        <div class="navbar-inner">
                            <a class="brand" href="#">Title</a>
                            <ul class="nav">
                                <li class="active"><a href="#">Home</a></li>
                                <li><a href="#">Link</a></li>
                                <li><a href="#">Link</a></li>
                            </ul>
                        </div>
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
