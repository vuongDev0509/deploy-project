<?php
/**
 * The template for displaying 404 pages (not found)
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * @package wonderkarma
 */

get_header();
?>
    <main id="primary" class="site-main container">
		<section class="error-404 not-found row">
            <div class="col-md-10 offset-md-1">
                <div class="page-content">
                    <div class="stars">
                        <div class="central-body">
                            <div class="central-inner">
                                <h1><?= __( 'OH NO!' ); ?></h1>
                                <div class="des text-uppercase"><?= __( 'WE CAN’T SEEM TO FIND THE PAGE YOU ARE LOOKING FOR.' ) ?></div>
                                <p><?= __( 'It might not exist or may have been moved. Let’s find a better place for you to go.' ) ?></p>
                                <p>Try going <a href="<?= home_url() ?>"><?= __( 'home' ); ?></a> the top navigation bar.</p>
                            </div>
                        </div>
                    </div>
                </div><!-- .page-content -->
            </div>
		</section><!-- .error-404 -->
	</main><!-- #main -->
<?php
get_footer();
