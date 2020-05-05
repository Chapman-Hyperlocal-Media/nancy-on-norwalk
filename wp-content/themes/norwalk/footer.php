<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage norwalk
 * @since Norwalk HTML5 1.0
 */
        echo norwalk_footer();
        /* Always have wp_footer() just before the closing </body>
         * tag of your theme, or you will break many plugins, which
         * generally use this hook to reference JavaScript files.
         */
        wp_footer();
        ?>
    </body>
</html>