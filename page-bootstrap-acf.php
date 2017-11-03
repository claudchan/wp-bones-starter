<?php
/*
 Template Name: Bootstrap ACF
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/

$GLOBALS['fullwidth'] = false;
$fullwidth = $GLOBALS['fullwidth'];

global $fullwidth;

?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<?php do_action('bootstrap-acf'); ?>

				</div>

			</div>


<?php get_footer(); ?>
