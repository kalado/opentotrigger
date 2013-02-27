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
    <div class="well">
        <ul class="nav nav-list">
            <li class="nav-header">Material de <?php echo $serie_nome; ?></li>
            <li>
                <?php echo $this->Html->link('Novo Material','/anime/add/'.$serie_id,array('tabindex'=>'-1')); ?>
            </li>
            <?php foreach($menu_da_serie as $anime){ ?>
                        <li class="dropdown-submenu">
                            <a class="dropdown-toggle"><?php echo $anime ?></a>
                            <ul class="dropdown-menu pull-right" role="submenu">
                              <li><?php echo $this->Html->link('Editar','/anime/edit/'.$anime['id'],array('tabindex'=>'-1')); ?></li>
                              <li><?php echo $this->Html->link('Adicionar '.$anime['nome_unidade'],'/captulos/add_epsodio/'.$anime['id'],array('tabindex'=>'-1')); ?></li>
                              <li><?php echo $this->Html->link('Deletar','/animes/delete/'.$anime['id'],array('tabindex'=>'-1')); ?></li>
                            </ul>
                        </li>
            <? } ?>
    </div>
<? } ?>

