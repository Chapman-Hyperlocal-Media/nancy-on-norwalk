<?php
/*
Plugin Name: Google Ad Widget
Plugin URI: 
Description: Adds a widget that can inserts a google ad slot.
Author: Eric Chapman	
Version: 1.0
Author URI: http://www.ericchapman.net/
*/


/**
 * google_ad_widget Class
 */
class google_ad_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function google_ad_widget() {
        parent::WP_Widget(false, $name = 'Google Ad');	
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {	
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
        $message 	= $instance['message'];
        ?>
              <?php echo '<li class="widget googad" style="background-color:transparent;">'; ?>
                <?php //if ( $title ) echo $before_title . $title . $after_title; ?>
					<!-- <?php echo $title; ?> -->
                    <div id='<?php echo $message; ?>'>
                    <script type='text/javascript'>
	                    googletag.cmd.push(function() { googletag.display('<?php echo $message; ?>'); });
                    </script>
                    </div>						
              <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['message'] = $new_instance['message'];
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
 
        $title 		= esc_attr($instance['title']);
        $message	= esc_attr($instance['message']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Slot name:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('ID number:'); ?></label> 
          <input type="text" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>"  value="<?php echo $message; ?>" />
        </p>
        <?php 
    }
 
 
} // end class example_widget
add_action('widgets_init', create_function('', 'return register_widget("google_ad_widget");'));
?>