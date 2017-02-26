<?php 

if ( !function_exists('norwalk_sidebar_fallback') ):
	function norwalk_sidebar_fallback(){ 
		?>
			
				<li class="widget">
					<!-- Nancy_on_Norwalk_top_sidebar_large_rectangle_ad -->
          <div id='div-gpt-ad-1357460250405-0'>
            <script type='text/javascript'>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1357460250405-0'); });
            </script>
          </div>
				</li>

    		<li class="widget">
        	<h3 class="title">Popular Stories</h3>
          <?php

						$args = array(
							'theme_location'  => '',
							'menu'            => 'popular-stories',
							'container'       => 'div',
							'container_class' => 'menu-popular-stories-container',
							'container_id'    => '',
							'menu_class'      => 'menu',
							'menu_id'         => 'menu-popular-stories',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 0,
							'walker'          => ''
						);
						
						wp_nav_menu( $args );
						
		    	?>
	      </li>

				<li class="widget">
          <!-- Nancy_on_Norwalk_bottom_sidebar_large_rectangle_ad -->
          <div id='div-gpt-ad-1357504601556-0' >
	          <script type='text/javascript'>
	          googletag.cmd.push(function() { googletag.display('div-gpt-ad-1357504601556-0'); });
	          </script>
          </div>
				</li>
	<?php 
	}
endif;
