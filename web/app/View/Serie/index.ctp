<div class="span12 banner-home">
</div>


<?php foreach ($series as $serie) { ?>
    <div class="span12 animes-home">
        <div class="row-fluid">
            <div class="span5 imagem-anime borda-arredonda no-overflow">
                <?php echo $this->Html->image($serie['Serie']['imagem'],array('class'=>'borda-arredonda')); ?>
            </div>
            <div class="span7">
                <div class="row-fluid">
                    <div class="span12 well fundo-amarelo resumo-anime">
                        <div class="row-fluid">
                            <h2 class="offset1 span10"><?php echo $serie['Serie']['nome']; ?></h2>
                            <div class="offset1 span10 sinopse-anime no-overflow">
                                <?php echo $serie['Serie']['sinopse']; ?>
                            </div>
                            <a class="offset1 span10 continue" href="<?php echo $this->Html->url('/series/'.$serie['Serie']['id']); ?>">Leia mais <i class="icon-ok"></i></a>
                        </div>
                    </div>
                    <div class="span12 links-anime">
                        <ul class="row-fluid">
                        <?php foreach($serie['Multimidias'] as $multimidia){?>
                            <?php print_r($multimidia); ?>
                            <?php if($multimidia['nova']==FALSE){ ?>
                                <li class="span4 bg-dark no-overflow borda-arredonda multimidias">
                                    <a href="<?php echo $this->Html->url('series/'.$multimidia['id'].'/'.$serie['Serie']['id']); ?>"><?php echo $multimidia['nome']; ?></a>
                                </li>
                            <?php }else{ ?>
                                <li class="span4 btn btn-success no-overflow multimidias">
                                    <a href="<?php echo $this->Html->url('series/'.$multimidia['id'].'/'.$serie['Serie']['id']); ?>"><?php echo $multimidia['nome']; ?></a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>    
<?php } ?>




