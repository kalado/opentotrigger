<div class="navbar-inner">
    <?php echo $this->Html->link("Admin",'/admin',array('class' => 'brand')); ?>
    <ul class="nav">
        <?php if(isset($menu_top_serie_id)){ ?><li><?php echo $this->Html->link("Serie: ".$menu_top_serie_nome,'/serie/edit/'.$menu_top_serie_id); ?></li><?php } ?>
        <?php if(isset($menu_top_anime_id)){ ?><li><?php echo $this->Html->link("Anime: ".$menu_top_anime_nome,'/anime/edit/'.$menu_top_anime_id); ?></li><?php } ?>
        <?php if(isset($menu_top_capitulo_id)){ ?><li><?php echo $this->Html->link("Capitulo: ".$menu_top_capitulo_nome,'/capitulo/edit/'.$menu_top_capitulo_id); ?></li><?php } ?>
    </ul>
</div>