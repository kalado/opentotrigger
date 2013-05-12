<?php get_header(); ?>
            
            <!-- corpo -->
            <div class="row-fluid corpo">
                <div class="span12">
                    <?php if(have_posts()){ ?>
                        <?php the_post(); ?>
                        <h1><?php the_title(); ?></h1>
                        <p><?php the_content(); ?></p>
                        <hr>
                    <?php } ?>
                </div>
                
                <?php
                    query_posts( 'post_type=series' );
                    
                    wp_reset_query();
                    
                    if(have_posts()){
                        while(have_posts()){
                            the_post();
                            ?>
                            <div class="span12">
                                <div class="row-fluid">
                                    <div class="span4 well text-center">
                                        <?php the_post_thumbnail('page-serie',array('class'=>'image-serie borda-arredondada')); ?>
                                    </div>
                                    <div class="span8 well fundo-amarelo">
                                        <h2><?php the_title(); ?></h2>
                                        <p>
                                            <?php the_excerpt(); ?>
                                        </p>
                                        <a class="link-explorar" href="<?php the_permalink(); ?>" >Explorar Serie</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                ?>
                
            </div>
            <!-- end. -->
            
            
            
<?php get_footer(); ?>
    