    <div class="well">
        <ul class="nav nav-list">
            <li class="nav-header">Noticias da série <?php echo $menu_noticiasSerie_nome; ?></li>
            <li>
                <?php echo $this->Html->link('Novo Tópico','/topico/novo/'.$meni_noticias_serie_id,array('tabindex'=>'-1')); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Nova Informação','/informacao/novo/'.$meni_noticias_serie_id,array('tabindex'=>'-1')); ?>
            </li>
            
            <?php foreach($menu_noticias as $topico){ ?>
                    <li class="nav-header"><?php echo $topico['nome']; ?></li>
                    <?php //print_r($topico); ?>
                    <?php foreach($topico['noticias'] as $informacao){ ?>
                        <li class="dropdown-submenu">
                            <a class="dropdown-toggle"><?php echo $informacao['titulo']; ?></a>
                            <ul class="dropdown-menu pull-right" role="submenu">
                              <li><?php echo $this->Html->link('Editar','/informacao/edit/'.$informacao['id'],array('tabindex'=>'-1')); ?></li>
                              <li><?php echo $this->Html->link('Deletar','/informacao/delete/'.$informacao['id'],array('tabindex'=>'-1')); ?></li>
                            </ul>
                        </li>
                    <?php } ?>
            <? } ?>
    </div>