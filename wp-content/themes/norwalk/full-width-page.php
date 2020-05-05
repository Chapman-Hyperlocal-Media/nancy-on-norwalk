<?php
/**
 * Template Name: Full-width page
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Norwalk 1.2.6
 */

get_header(); ?>
<div id="main-content">
    <div class="facebook-hide" style="display:none !important;"><?php norwalk_facebook_like(); ?></div>
	<div class="content">
	<?php get_template_part( 'loop', 'page' ); ?>
	</div>
</div>

<?php get_footer(); ?>