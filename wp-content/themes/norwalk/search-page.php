<?php
/**
 * Template Name: Search page
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>
<div id="main-content">

	<div class="content search-fallback">
    	<h1 id="search-head"><?php the_title(); ?></h1>
		<?php get_search_form(); ?>

    </div>
    <div class="clear-floats"></div>
</div>
<?php get_footer(); ?>
