    <div class="well">
        <ul class="nav nav-list">
            <li class="nav-header"><?php echo ucfirst($menu_capitulos_nome); ?></li>
            <li class="nav-header"><?php echo ucfirst($menu_capitulos_nome_unidade); ?> de <?php echo $menu_capitulos_anime; ?></li>
            <li>
                <?php echo $this->Html->link('Novo '.strtolower($menu_capitulos_nome_unidade),'/capitulo/novo/'.$menu_capitulos_anime_id,array('tabindex'=>'-1')); ?>
            </li>
            <?php foreach($menu_capitulos as $capitulo){ ?>
                        <li class="dropdown-submenu">
                            <a class="dropdown-toggle"><?php echo str_pad((int)$capitulo['numero'],3,"0",STR_PAD_LEFT); ?></a>
                            <ul class="dropdown-menu pull-right" role="submenu">
                              <li><?php echo $this->Html->link('Editar','/capitulo/edit/'.$capitulo['id'],array('tabindex'=>'-1')); ?></li>
                              <li><?php echo $this->Html->link('Deletar','/capitulo/delete/'.$capitulo['id']."/".$menu_capitulos_anime_id,array('tabindex'=>'-1')); ?></li>
                            </ul>
                        </li>
            <? } ?>
    </div>