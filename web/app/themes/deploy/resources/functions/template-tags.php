<?php

/**
 * Template tags
 */


if ( ! function_exists( 'deploy_template_ss_related_posts' ) ) {
	function deploy_template_ss_related_posts() {
        $post_type     = get_post_type();
        $classed       = $post_type == 'work' ? 'work' : 'blog';
        $post_per_page =  $post_type == 'work' ? '1' : '3';

        $args = array(
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'posts_per_page' => $post_per_page,
            'order'   => 'ASC',
		);

        
        ob_start();
        ?>
        <section class="wk-ss wk-ss-related-posts wk-<?php echo $classed ?>"> 
            <div class="container"> 

            <?php if ($post_type == 'work'): ?>
                <?php 
                    $postNext   = get_next_post();
                    $id_related = '';
                    if (empty($postNext)) {
                        $args['orderby'] = 'menu_order';
                        $args['order'] = 'DESC';
                        $the_query = new WP_Query($args);
                        if($the_query->have_posts()){
                            while ($the_query->have_posts()) {
                                $the_query->the_post();

                                $id_related = get_the_ID();
                            }
                        }
                    } else {
                       $id_related = $postNext->ID;
                    }
                    
                    $image_url  = get_the_post_thumbnail_url($id_related);
                    $post_url   = get_permalink($id_related);   
                    $clients    = get_the_terms( $id_related, 'client' ); 
                    $post_title = get_the_title($id_related);
                ?>
                <div class="related-posts-grid">
                    <h2 class="related-posts-grid___title"> Next </h2>
                    <div class="related-posts-grid__item row"> 
                        <div class="related-posts-grid__item-thumbanail col-lg-6 col-md-6 col-sm-12"> 
                            <div class="__thumbnail">  <a href="<?php echo $post_url ?>"> <img src="<?php echo $image_url ?>" /> </a> </div>
                        </div>

                        <div class="related-posts-grid__item-detail col-lg-6 col-md-6 col-sm-12"> 

                            <?php if ( !empty($clients) ): ?>
                                <div class="related-posts-grid__item-detail-client"> 
                                    <?php foreach ($clients as $key => $clients) { ?>
                                        <h3 class="__client-name"> <?php echo $clients->name ?> </h3>
                                    <?php } ?>
                                </div>
                            <?php endif; ?>

                            <h2 class="related-posts-grid__item-detail-title <?php echo $id_related ?>"> 
                                <a href="<?php echo $post_url ?>"> <?php echo $post_title ?> 
                                    <img loading="lazy" width="13" height="24" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iMTMiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAxMyAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEuNTU3MzUgMjIuNjEyOEMxLjc2Mjk3IDIyLjI5NjcgMi4wMDQ1NSAyMS45OTgxIDIuMjc4NjkgMjEuNzIxMkMyLjc2ODc3IDIxLjE2MzYgMy40ODY2MyAyMC4zNjE5IDQuMzgzOTcgMTkuMzc3NEw3LjM3Nzg1IDE1LjUyMjJMMTAuMDQ4NyAxMS44MjYxQzEwLjA0ODcgMTEuODI2MSA1LjcyNjU0IDUuOTcwODcgMy44NzY2NCAzLjk3NTU4QzIuOTQxMzQgMi45NzkzOSAyLjE5MjQxIDIuMTY2MTkgMS42ODE2MiAxLjYwMjc1QzEuMzk2NyAxLjMyMTE2IDEuMTQzNjUgMS4wMTc3OSAwLjkyNTc4MSAwLjY5NjU5NEMxLjI1MTMgMC45NDQyMDUgMS41NTA0IDEuMjE1MzIgMS44MTk2NiAxLjUwNjg4QzIuMzc1MzIgMi4wNDQxOSAzLjE2MjIyIDIuODI4MzcgNC4xMjg1OCAzLjgwNDI0QzYuMDYxMzEgNS43NTMwNiA4LjcwNTAzIDguNDY1NzMgMTEuNjA3NiAxMS40NzQ2TDExLjk1MjcgMTEuODI2MUw3Ljg4MDE1IDE2LjE0MTlMNC42MjkwMiAxOS41NDU4QzMuNzAwNjIgMjAuNTA3MSAyLjk0MTM0IDIxLjI4ODQgMi40MDk4NCAyMS44MTQxQzIuMTUzNTkgMjIuMTAwNSAxLjg2ODM1IDIyLjM2NzggMS41NTczNSAyMi42MTI4WiIgZmlsbD0iI0RGQjg1MyIgc3Ryb2tlPSIjREZCODUzIi8+Cjwvc3ZnPgo="> 
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>    
                
            <?php else: ?>    

                <?php $the_query = new WP_Query($args); ?>
                <?php if ($the_query->have_posts()): ?>
                    <div class="related-posts-grid row"> 
                        <?php while ($the_query->have_posts()) {
                            $the_query->the_post();
                            ?>
                            <div class="related-posts-grid__item col-lg-4 col-md-6 col-sm-12"> 
                                <div class="related-posts-grid__item-thumbanail"> 
                                    <?php  if ( has_post_thumbnail() ) { ?>
                                        <a href="<?php the_permalink() ?>">
                                            <?php the_post_thumbnail() ?>
                                        </a>    
                                    <?php }  ?>
                                </div>

                                <div class="related-posts-grid__item-detail"> 
                                    <h2 class="related-posts-grid__item-detail-title"> 
                                        <a href="<?php the_permalink() ?>"> 
                                            <?php if ($post_type == 'post'): ?>
                                                <?php __check_date_post(); ?>
                                            <?php endif; ?> 
                                            <span> <?php the_title() ?> <img loading="lazy" width="13" height="24" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iMTMiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAxMyAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEuNTU3MzUgMjIuNjEyOEMxLjc2Mjk3IDIyLjI5NjcgMi4wMDQ1NSAyMS45OTgxIDIuMjc4NjkgMjEuNzIxMkMyLjc2ODc3IDIxLjE2MzYgMy40ODY2MyAyMC4zNjE5IDQuMzgzOTcgMTkuMzc3NEw3LjM3Nzg1IDE1LjUyMjJMMTAuMDQ4NyAxMS44MjYxQzEwLjA0ODcgMTEuODI2MSA1LjcyNjU0IDUuOTcwODcgMy44NzY2NCAzLjk3NTU4QzIuOTQxMzQgMi45NzkzOSAyLjE5MjQxIDIuMTY2MTkgMS42ODE2MiAxLjYwMjc1QzEuMzk2NyAxLjMyMTE2IDEuMTQzNjUgMS4wMTc3OSAwLjkyNTc4MSAwLjY5NjU5NEMxLjI1MTMgMC45NDQyMDUgMS41NTA0IDEuMjE1MzIgMS44MTk2NiAxLjUwNjg4QzIuMzc1MzIgMi4wNDQxOSAzLjE2MjIyIDIuODI4MzcgNC4xMjg1OCAzLjgwNDI0QzYuMDYxMzEgNS43NTMwNiA4LjcwNTAzIDguNDY1NzMgMTEuNjA3NiAxMS40NzQ2TDExLjk1MjcgMTEuODI2MUw3Ljg4MDE1IDE2LjE0MTlMNC42MjkwMiAxOS41NDU4QzMuNzAwNjIgMjAuNTA3MSAyLjk0MTM0IDIxLjI4ODQgMi40MDk4NCAyMS44MTQxQzIuMTUzNTkgMjIuMTAwNSAxLjg2ODM1IDIyLjM2NzggMS41NTczNSAyMi42MTI4WiIgZmlsbD0iI0RGQjg1MyIgc3Ryb2tlPSIjREZCODUzIi8+Cjwvc3ZnPgo="> </span>
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        <?php } ?>   
                    </div>
                <?php endif; ?>  

            <?php endif; ?>      

            </div>
        </section>
        <?php
        return ob_get_clean();
    }
}


if ( ! function_exists( 'deploy_template_news_hero_header' ) ) {
	function deploy_template_news_hero_header() {
        $post_type = get_post_type();
        $classed   = $post_type == 'work' ? 'col-md-12' : 'col-md-10'; 
		ob_start(); 
        ?>

        <section class="wk-ss wk-ss-hero wk-hero-single-post wk-<?php echo $post_type ?>"> 
            <div class="container"> 
                <div class="wk-hero-single-post__content row"> 
                    <div class="col-md-12"> 

                        <?php if ( is_single() && 'post' == $post_type ): ?>
                           <?php __check_date_post() ?>
                        <?php endif; ?>

                        <h1 class="wk-post-title"> <?php the_title(); ?> </h1>       
                    
                    </div>                  
                </div>

                <?php if ( is_single() && 'work' == $post_type ): ?>
                    <?php 
                        $id      = get_the_ID();
                        $clients = get_the_terms( $id, 'client' );
                        $tags    = get_the_terms( $id, 'post_tag' );; 
                    ?>
                    <div class="wk-hero-single-post__meta row"> 
                        <div class="col-md-12">

                            <?php if ( !empty($clients) ): ?>
                                <div class="wk-hero-single-post__meta__clients"> 
                                    <?php foreach ($clients as $key => $clients) { ?>
                                        <h3 class="__client-name"> <?php echo $clients->name ?> </h3>
                                    <?php } ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ( !empty($tags) ): ?>
                                <div class="wk-hero-single-post__meta__tags"> 
                                    <?php foreach ($tags as $key => $tag) { ?>
                                        <p class="__tag-name"> <?php echo $tag->name ?> </p>
                                    <?php } ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endif; ?> 

                <div class="wk-post-thumbnail"> <?php the_post_thumbnail(); ?> </div>
            </div>
        </section>
		<?php
		return ob_get_clean();
	}
}

//get the month on which the post was written.
if ( ! function_exists( '__check_date_post' ) ) {
	function __check_date_post() {
        $id = get_the_ID();
        $montheNumber = get_the_date('m');
        $montheText   = get_the_date('M');
        $years        = get_the_date('Y');
        ?>
        <div class="wk-post-date"> 
            <div class="wk-post-date__icon"> 
                <img src="<?php echo get_template_directory_uri().'/resources/assets/images/blog/icon-month-'.$montheNumber.'.svg' ?>" alt="month" />
            </div>
            <div class="wk-post-date__inner">
                <span class="__month"> <?php echo $montheText ?> </span>  
                <span class="__year">  <?php echo $years ?> </span> 
            </div>
        </div>
        <?php
    }
}