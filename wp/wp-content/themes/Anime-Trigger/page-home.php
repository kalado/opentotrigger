<?php get_header(); ?>
            
            
            <!-- corpo -->
            <div class="row-fluid corpo">
                    <?php if(have_posts()){ ?>
                        <?php while(have_posts()){ ?>
                            <?php the_post(); ?>
                            <div class="span12">
                                <h1><?php the_title(); ?></h1>
                            </div>
                        <?php } ?>
                    <?php } ?>
            </div>
            <!-- end. -->
            
            
            
<?php get_footer(); ?>
    