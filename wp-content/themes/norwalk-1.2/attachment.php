<?php
/**
 * The template for displaying attachments.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header(); ?>
 <div id="main-content">

	<div class="content">
    	<?php get_template_part( 'loop', 'attachment' ); ?>
    </div>
     <aside class="sidebar">
		<?php get_sidebar('media'); ?>
    </aside>
    <div class="clear-floats"></div>
    
 </div>
<?php get_footer(); ?>