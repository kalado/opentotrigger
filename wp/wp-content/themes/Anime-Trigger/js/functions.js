jQuery(window).resize(function(){

    jQuery('.bg-mascara').attr({'style':"min-width: "+jQuery('#container').width()+"px!important;"});

});
jQuery(document).ready(function(){
    /***********************************************
     * Adicionar CSS básico
     ***********************************************/
    jQuery(window).resize();
    jQuery('body').addClass('bg-rosa');
    /***********************************************
     * END. Adicionar CSS básico
     ***********************************************/

    
    
    /***********************************************
     * Atalhos de CSS
     ***********************************************/
    /*
     * Atalhos
     */
    jQuery('.warp').addClass('offset1 span10');
    
    jQuery('.header').addClass('margin-top-40');
    
    jQuery('.link-menu-top').addClass('fonte-preto');
    
    



    /*
     * Sprites
     */
    jQuery('.logo').addClass('sprite');
    jQuery('.bnt-youtube').addClass('bnt-social');
    jQuery('.bnt-twitter').addClass('bnt-social');
    jQuery('.bnt-facebook').addClass('bnt-social');
    jQuery('.bnt-social').addClass('sprite');
    jQuery('.seta').addClass('sprite');
    
    
    
    
    /*
     * Densidades
     */
    jQuery('.sprite').addClass('inline-block');    
    /***********************************************
     * END. Atalhos de CSS
     ***********************************************/
    
    

    
});