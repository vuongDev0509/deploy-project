<?php
/**
 * The template for displaying the footer
 * Contains the closing of the #content div and all content after.
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package wonderkarma
 */

echo "</div><!--End site wrap-->";

/**
 * wonderkarma_hook_footer hook.
 * @see wonderkarma_footer_template - 20
 */
do_action( 'wonderkarma_hook_footer' );
?>
<?php
wp_footer();
?>

</body>
</html>
