    <div class="well">
        <ul class="nav nav-list">
            <li class="nav-header">Material de <?php echo $serie_nome; ?></li>
            <li>
                <?php echo $this->Html->link('Novo Material','/anime/novo/'.$serie_id,array('tabindex'=>'-1')); ?>
            </li>
            
            <?php foreach($menu_da_serie as $anime){ ?>
                        <li class="dropdown-submenu">
                            <a class="dropdown-toggle"><?php echo $anime['anime'] ?></a>
                            <ul class="dropdown-menu pull-right" role="submenu">
                              <li><?php echo $this->Html->link('Editar','/anime/edit/'.$anime['id'],array('tabindex'=>'-1')); ?></li>
                              <li><?php echo $this->Html->link('Adicionar '.$anime['nome_unidade'],'/capitulo/novo/'.$anime['id'],array('tabindex'=>'-1')); ?></li>
                              <li><?php echo $this->Html->link('Deletar','/animes/delete/'.$anime['id'],array('tabindex'=>'-1')); ?></li>
                            </ul>
                        </li>
            <? } ?>
    </div>