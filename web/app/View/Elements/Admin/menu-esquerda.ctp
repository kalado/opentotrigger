<div class="well">
    <ul class="nav nav-list">
        <?php foreach($all_pages_menus as $controller => $label){ ?>
                <?php if(is_string($controller)){ ?>
                        <li class="<?php echo (($current_page == $controller)?'active':'' ); ?> dropdown-submenu">
                            <a class="dropdown-toggle"><?php echo $label ?></a>
                            <ul class="dropdown-menu pull-right" role="submenu">
                              <li><?php echo $this->Html->link('Novo','/'.$controller.'/novo',array('tabindex'=>'-1')); ?></li>
                              <li><?php echo $this->Html->link('Lista','/'.$controller.'/lista',array('tabindex'=>'-1')); ?></li>
                            </ul>
                        </li>
                <?php }else{ ?>
                        <li class="nav-header"><?php echo $label; ?></li>
                <?php }?>
        <? } ?>

        
</div>

<?php if(isset($menu_da_serie)){ ?>
    <?php echo $this->element("Admin/menu-serie"); ?>
<? } ?>

