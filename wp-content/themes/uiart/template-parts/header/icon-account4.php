<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

?>

<div class="icon-area-content account-icon-area header-middlebar">	
	<div class="btn-account">
		<div class="dropdown">		  
		    <button class="dropdown-toggle wooctheme-border-button" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		       <i class="fas fa-user-tie"></i><?php esc_html_e( ' My Account  ', 'uiart' );?> 
		    </button>
		    <div class="dropdown-menu dropdown-menu-right">
			<div class="item-title"><?php esc_html_e( 'My Account ', 'uiart' );?> 
				<?php if ( is_user_logged_in() ) { ?>
				<a class="dlog-button" href="<?php  echo wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) )  ?>"><?php  echo WOOCTheme::$options['signout_txt'];?></a>
				<?php }else{ ?>	  			
				<a class="dlog-button" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php  echo WOOCTheme::$options['signin_txt'];?></a>
				<?php } ?>	
			</div>
			<?php Helper::get_template_part( 'template-parts/account-menu', array( 'icon_display' => true ) );?>		     		       
		    </div>
		</div>
	</div>
</div>
