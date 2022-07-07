<?php

/**
 * Template part for displaying posts
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package deploy
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="single-resources-directory">
        <div class="header-hero-section">
            <div class="row">
                <div class="col-md-8">
                    <div class="ss-image" data-aos="fade-up" data-aos-duration="800">
                        <?php
                        $featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                        echo '<img src="' . $featured_img_url . '" alt="img">';

                        $txtCredit = __get_field( 'img_credit_here', get_the_ID() );
                        $urlCredit = __get_field( 'link_image_credit', get_the_ID() );

                        if ( ! empty( $txtCredit ) ) {
	                        echo '<div class="credit-text">';
	                        if ( ! empty( $urlCredit ) ) {
		                        echo '<a  href="' . $urlCredit . '" target="_blank">';
	                        }
	                        echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19" role="img" aria-hidden="true"><g fill="#ab3493"><path d="M9.216 0A9.21 9.21 0 000 9.216a9.21 9.21 0 009.216 9.216 9.21 9.21 0 009.216-9.216A9.21 9.21 0 009.216 0zm0 16.992A7.772 7.772 0 011.44 9.216 7.772 7.772 0 019.216 1.44a7.772 7.772 0 017.776 7.776 7.772 7.772 0 01-7.776 7.776z"></path> <path d="M9.216 7.716a.72.72 0 00-.72.72v4.637a.72.72 0 101.44 0V8.436a.72.72 0 00-.72-.72z"></path><circle cx="9.216" cy="5.862" r="1"></circle></g></svg>';
	                        echo $txtCredit;
	                        if ( ! empty( $urlCredit ) ) {
		                        echo '</a>';
	                        }
	                        echo '</div>';
                        }
                        ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="wrapper-resources-hero-text" data-aos="fade-up" data-aos-duration="400">
                        <?php
                        the_title( '<h1 class="title-resources">', '</h1>' );

                        $desc = __get_field( 'description', get_the_ID() );
                        if ( ! empty( $desc ) ) {
	                        echo '<p class="desc">' . $desc . '</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-content-resources">
            <div class="col-md-8">
                <?php
                the_content();
                ?>
            </div>
            <div class="col-md-4">
                <div id="site-banner-section"></div>
            </div>
        </div>

    </div>
</div>
