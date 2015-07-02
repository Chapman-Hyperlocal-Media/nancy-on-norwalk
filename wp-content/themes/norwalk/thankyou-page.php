<?php
/**
 * Template Name: Thank you page
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>
<div id="main-content">

	<div class="content">
	<?php get_template_part( 'loop', 'thankyou' ); ?>
	</div>
</div>

<?php get_footer(); ?>