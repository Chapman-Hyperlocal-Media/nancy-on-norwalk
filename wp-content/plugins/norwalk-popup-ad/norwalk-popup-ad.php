<?php
/*
Plugin Name: Nancy On Norwalk Popup Ad
Plugin URI: 
Description: Adds configurable popup house-ad functionality. Intended for use with fundraising ads, with possible mailing list use as well.
Author: Eric Chapman	
Version: 1.0
Author URI: http://www.ericchapman.net/
*/

  function norwalk_popups_init(){

    register_post_type( 'norwalk_popup',
        array(
          'labels' => array(
              'name' => __( 'Pop-ups' ),
              'singular_name' => __( 'Pop-up' )
          ),
          'public' => false,  
          'has_archive' => false,
          'show_ui' => true,
          'show_in_admin_bar' => false,
          'menu_position' => 50,
          'exclude_from_search' => true,
        'show_in_menu' => true,
          'description' => 'Pop-up ads that will display on page load.',
          'support' => array(
            'title',
            'editor',
            'custom-fields',
            'revisions'
          ),
          'capabilities_type' => 'post',
        )
    );

  }
   /**  
    *   For reference:
    *   add_meta_box( $id, $title, $callback, $post_type, $context, $priority, $callback_args );
    *  
    *   http://codex.wordpress.org/Function_Reference/add_meta_box
    */
    
   /**
    *  Popup cooldown
    *
    *  Tracks whether a user has seen the current popup already within a certain duration using cookies.
    *  If the user has seen it already, we do not annoy them with it again.
    */
    function norwalk_create_popup_metaboxes(){

      add_meta_box(
        'norwalk-popup-cooldown',
        'Popup cooldown',
        'norwalk_popup_cooldown_meta_box_render',
        'norwalk_popup'
      );

      add_meta_box(
        'norwalk-popup-exit-widget',
        'Exit widget',
        'norwalk_popup_exit_widget_meta_box_render',
        'norwalk_popup'
      );

      $admin_style = plugins_url('norwalk-popup-admin.css', __FILE__);
      wp_enqueue_style('norwalk-popup-admin-styles', $admin_style );
    }
    function norwalk_popup_cooldown_meta_box_render($post, $metabox){ 
      $id = $post->ID; 
      ?>

      <p> 
        <label for="norwalk-popup-cooldown">Cooldown duration:</label>
        <input type="text" value="<?php echo wp_specialchars( get_post_meta( $id, 'norwalk-popup-cooldown', true ), 1 ); ?>" name="norwalk-popup-cooldown" id="norwalk-popup-cooldown" size="25">
        <?php wp_nonce_field('popup-cooldown-field','verify-that-shit'); ?>
        <p class="instructions">Format: 1y = 1 year, 1h = 1 hour,<br />
        m = minutes, d = days, w = weeks, etc.</p>
        <p class="instructions">Ex. "1m 2w" = 1 month and 2 weeks</p>
      </p>

      <?php
    }
    function norwalk_popup_exit_widget_meta_box_render($post, $metabox){
      $id = $post->ID;
      ?>

      <p> 
        <label for="norwalk-popup-exit-widget">Widget title:</label>
        <input type="text" value="<?php echo wp_specialchars( get_post_meta( $id, 'norwalk-popup-exit-widget', true ), 1 ); ?>" name="norwalk-popup-exit-widget" id="norwalk-popup-exit-widget" size="25">
        <?php wp_nonce_field('norwalk-popup-exit-widget','verify-that-shit'); ?>
        <p class="instructions">The pop up ad will transition towards the named widget when closed, if that widget is present.</p>
      </p>

      <?php
    }



    function norwalk_save_popup_meta(){
      global $post;

      // only run the below code if this is a norwalk_popup post type
      //if($post->post_type != 'norwalk_popup') return;

      $id = $post->ID;
      $meta = array(
        'norwalk-popup-cooldown',
        'norwalk-popup-exit-widget'
      );

      foreach($meta as $field){
        $old_value = get_post_meta( $id, $field, true );
        $new_value = stripslashes( $_POST[$field] );

        if ( $new_value && $old_value == '')
          add_post_meta( $id, $field, $new_value, true );
      
        elseif ( $new_value != $old_value && $new_value != '' ){
          update_post_meta( $id, $field, $new_value );
        }
        elseif ( $new_value == '' && $old_value ){
          delete_post_meta( $id, $field );}
      }  
    }

  add_action('init', 'norwalk_popups_init');
  add_action('admin_menu', 'norwalk_create_popup_metaboxes');
  add_action('save_post', 'norwalk_save_popup_meta');

?>