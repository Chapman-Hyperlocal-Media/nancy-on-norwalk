<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */?>
 
<?php get_header(); ?>
    <div id="main-content">
    
        <div class="content">
            <div class="top-content-ads-container">
                <!-- /1732998/nancy_on_norwalk_top_of_content_2 -->
                <div id='div-gpt-ad-1462049414903-0' class="top-content-ad top-content-ad-1" style='height:250px; width:300px;'>
                    <script type='text/javascript'>
                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1462049414903-0'); });
                    </script>
                </div>

                <!-- /1732998/Norwalk_top_of_content_1 -->
                <div id='div-gpt-ad-1462049414903-1' class="top-content-ad top-content-ad-2" style='height:250px; width:300px;'>
                    <script type='text/javascript'>
                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1462049414903-1'); });
                    </script>
                </div>
            </div>
            <?php get_template_part( 'loop', 'index' ); ?>
        </div>
        <aside class="sidebar">
            <?php get_sidebar(); ?>
        </aside>
        <div class="clear-floats"></div>
        
    </div>
    
    

<?php get_footer(); ?>
