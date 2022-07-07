<?php
/**
 * The template for displaying all single posts
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package deploy
 */

get_header();
?>
    <main id="primary" class="site-main">
        
        <!--Start section hero header-->
            <?= deploy_template_news_hero_header(); ?>
        <!--End section hero header-->

        <section class="wk-ss wk-ss-single-main"> 
            <div class="container">  
                <?php 
                while ( have_posts() ) :
                    the_post();
                    the_content();
                endwhile;
                ?>
            </div>
        </section>

        <!--Start section related posts-->
            <?= deploy_template_ss_related_posts(); ?>
        <!--End section related posts-->
        
	</main><!-- #main -->
<?php
get_footer();
