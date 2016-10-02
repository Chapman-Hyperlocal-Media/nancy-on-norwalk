<?php
/**
 * Template Name: Memorial page
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Norwalk 1.2.5
 */

get_header(); ?>
<div id="main-content">

	<div class="content">
	<?php get_template_part( 'loop', 'memorial' ); ?>
	</div>
</div>

<?php get_footer(); ?>