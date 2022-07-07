<?php
function deploy_post_item() {
	?>
    <div class="item-inner">
        <a href="<?= get_the_permalink(); ?>" class="img-wrap"
           title="<?= get_the_title(); ?>"
           style="background-image: url('<?= has_post_thumbnail() ? get_the_post_thumbnail_url() : ''; ?>')">
        </a>
        <div class="item-content">
            <div class="date-time"><?= get_the_date(); ?></div>
            <h3 class="title">
                <a href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?></a>
            </h3>
            <div class="excerpt"><?= wp_trim_words( get_the_excerpt(), 10, '...' ); ?></div>
            <a class="btn-more" href="<?= get_the_permalink() ?>">Read more</a>
        </div>
    </div>
	<?php
}

function deploy_news_related_post( $ID ) { ?>
    <div class="related-single">
        <div class="container">
            <?php
            $query = new WP_Query( array(
	            'post_type'      => 'post',
	            'post_status'    => 'publish',
	            'posts_per_page' => 3,
	            'category__in'   => wp_get_post_categories( $ID ),
	            'post__not_in'   => array( $ID )
            ) );
            ?>
            <h3 class="related-title"><?= __( 'RECENT ARTICLES' ); ?></h3>
            <div class="row">
                <?php
                if ( $query->have_posts() ) {
	                $i = 1;
	                while ( $query->have_posts() ) {
		                $query->the_post();
		                $anm = 'data-aos="fade-up" data-aos-duration="' . ( $i * 400 ) . '"';
		                ?>
                        <div class="col-lg-4 item" <?= $anm; ?>>
                            <div class="item-inner">
                                <a href="<?= get_the_permalink(); ?>" class="img-wrap"
                                   title="<?= get_the_title(); ?>"
                                   style="background-image: url('<?= has_post_thumbnail() ? get_the_post_thumbnail_url() : ''; ?>')">
                                </a>
                                <div class="item-content">
                                    <div class="date-time"><?= get_the_date(); ?></div>
                                    <h3 class="title">
                                        <a href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?></a>
                                    </h3>
                                </div>
                                <a class="btn-more" href="<?= get_the_permalink() ?>">Read more</a>
                            </div>
                        </div>
		                <?php
		                $i ++;
	                }
                }

                /* Restore original Post Data */
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
	<?php
}
