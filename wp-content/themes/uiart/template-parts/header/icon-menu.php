<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */
namespace wooctheme\Uiart;
$nav_menu_args  		= Helper::nav_menu_offcanvas_args();

$socials        		= Helper::socials();
$logo           		= empty( WOOCTheme::$options['logo']['url'] ) ? Helper::get_img( 'logo-dark.png' ) : WOOCTheme::$options['logo']['url'];
$offcanvas_addit_info  	= ( WOOCTheme::$options['phone'] || WOOCTheme::$options['email'] ) ? true : false;
?>

<div class="additional-menu-area">
	<div  class="sidenav additional-menu-msidebar" data-simplebar>
			<a href="#" class="closebtn"><i class="flaticon-cancel-1"></i></a>
	        <div class="nav-item">
	        	<?php if ( WOOCTheme::$options['offcanvas_title'] ): ?> 
	            <span class="offcanvas_title"><?php echo WOOCTheme::$options['offcanvas_title']; ?> </span>
	        <?php endif; ?>
	        	<?php wp_nav_menu( $nav_menu_args );?> 
	        </div>
			<div class="nav-addit-info">
				<?php if ( WOOCTheme::$options['offcanvas_sub_title'] ): ?> 
				    <span class="offcanvas_sub_title"><?php echo WOOCTheme::$options['offcanvas_sub_title']; ?> </span>
				<?php endif; ?>	

		        <?php if ( $offcanvas_addit_info ) { ?>					
				<?php if ( WOOCTheme::$options['phone'] ) { ?>
					<span class="offcanvas-list"><a href="tel:<?php echo esc_attr( WOOCTheme::$options['phone'] );?>"><?php echo esc_html( WOOCTheme::$options['phone'] );?></a></span>
				<?php } ?>
				<?php if ( WOOCTheme::$options['email'] ) { ?>
					<span class="offcanvas-list"><a href="mailto:<?php echo esc_attr( WOOCTheme::$options['email'] );?>"><?php echo esc_html( WOOCTheme::$options['email'] );?></a></span>
				<?php } ?>
			<?php } ?>
		</div>
        <?php if ( WOOCTheme::$options['offcanvas_socials'] && $socials ): ?>
            <div class="social-item">
               <ul class="main-nav">
                    <?php foreach ( $socials as $social ): ?>
                        <li><a target="_blank" href="<?php echo esc_url( $social['url'] );?>"><i class="fab <?php echo esc_attr( $social['icon'] );?>"></i></a></li>
                    <?php endforeach; ?>                    
                </ul>
            </div>
        <?php endif; ?>  		
	</div>
	<span class="side-menu-open side-menu-trigger">
	<i class="flaticon-menu-4"></i>
	</span>
</div>