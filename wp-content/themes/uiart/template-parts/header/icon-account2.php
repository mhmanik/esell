<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

?>
	<div class="header-icon-btn-block header-icon-acount-area header-btn-set2 ">	
		<div class="dropdown">
		    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="wooc-button-secondary-icon dropbtn">
			      <i class="flaticon-user-profile"></i>
			  </a>	
			<div class="dropdown-content">	
				<div class="dropdown-content-wrp">	
					<ul class="user-info">
                                               
					<?php
					$current_user = get_userdata(1);
						ob_start();
						wp_loginout('index.php');
						$loginoutlink = ob_get_contents();
						ob_end_clean();
						$items .= '<li class="user-name">'. $current_user->user_login  .'</li>';
						$items .= '<li>'. $loginoutlink .'</li>';
						echo esc_attr($items);
					?>
					</ul>

				<?php
					wp_nav_menu( array( 
						'theme_location'  => 'acount',
						'container'       => 'nav',
						'container_class' => 'dropdown-content-nav',
						'fallback_cb'     => false,
						) );
					?>
			</div>
		</div>
	</div>
</div>