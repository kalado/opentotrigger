<a class="span6 logo"><span class="hidden"><?php echo $titulo_do_site ?></span></a>

<div class="offset4 span2">
    <div class="mediasocial-menu row-fluid">
        <a class="media-social media-youtube span4" title="youtube"><span class="hidden">youtube</span></a>
        <a class="media-social media-facebook span4" title="facebook"><span class="hidden">facebook</span></a>
        <a class="media-social media-twitter span4" title="twitter"><span class="hidden">twitter</span></a>
    </div>
</div>
<div class="span12"></div>
<div class="menu span6">
    <ul class="row-fluid">
        <li class="span3">
            <a href="<?php echo $this->Html->url("/"); ?>" class="row-fluid">
                <p class="span8">Home</p>
                <i class="span3 seta-li seta-li-top"></i>
            </a>
        </li>
        <li class="span3">
            <a href="<?php echo $this->Html->url("/series"); ?>" class="row-fluid">
                <p class="span8">Séries</p>
                <i class="span3 seta-li seta-li-top"></i>
            </a>
        </li>
        <li class="span3">
            <a href="<?php echo $this->Html->url("/equipe"); ?>" class="row-fluid">
                <p class="span8">Equipe</p>
                <i class="span3 seta-li seta-li-top"></i>
            </a>
        </li>
        <li class="span3">
            <a href="<?php echo $this->Html->url("/contato"); ?>" class="row-fluid">
                <p class="span8">Contato</p>
                <i class="span3 seta-li seta-li-top"></i>
            </a>
        </li>
    </ul>
</div>