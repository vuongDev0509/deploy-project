<?php

/**
 * The template for displaying search results pages
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 * @package wonderkarma
 */

get_header();
?>
<main id="primary" class="site-main container">
	<h1 class="page-title">Search</h1>
	<div class="sdis-form-search">
		<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">

			<input type="hidden" class="category" id="category-slug" name="category_name" value="">
			<div class="wonderkarma-wrapper-form">
				<div class="search-fields">
					<input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search …', 'placeholder') ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label') ?>" />
				</div>
				<div class="select-theme-cate">
					<span class="datacat">Select theme or category</span>
					<ul id="blog-category" class="blog-category" style="display: none;">
					<li>Select theme or category</li>
						<?php

						?>
					</ul>
				</div>
				<div class="submit-button-search">
					<div class="btn-submit-search">
						<input type="image" class="image-submit" alt="Search" src="<?php echo get_template_directory_uri(); ?>/resources/assets/images/arrow-submit.svg" />
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="post-loop-container-search">
		<?php if (have_posts()) : ?>

			<?php
			/* Start the Loop */
			echo '<h2 class="title-total-result-search">' . count($posts) . ' results for “' . get_search_query() . '”</h2>';
			global $post;
			$index = 1;
			$duration = $index % 2 == 0 ? 400 : 800;


			while (have_posts()) :
				the_post();
				$postType = str_replace("-", " ", get_post_type($post->ID));
			?>
				<article <?php post_class('post-loop-item post-item-temp-defaults post-indexs-' . $index) ?> data-aos="fade-up" data-aos-duration="<?= $index == 1 ? 400 : $duration; ?>">
					<div class="item-inner">
						<h3 class="post-type"><?php echo $postType; ?></h3>
						<h4 class="post-title">
							<a href="<?php the_permalink() ?>" class=""><?php the_title() ?></a>
						</h4>
						<div class="post-desc">
							<?php the_excerpt() ?>
						</div>
					</div>
				</article>
			<?php
			endwhile;
		else :
			?>
			<section class="no-results not-found">
				<header class="page-header">
					<h3 class="page-titles"><?php esc_html_e('Nothing Found', 'wonderkarma'); ?></h3>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wonderkarma'); ?></p>

				</div><!-- .page-content -->
			</section><!-- .no-results -->
		<?php
		endif;
		?>
	</div>
</main><!-- #main -->
<?php
get_sidebar();
get_footer();
