<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

$footer_columns = 0;

foreach ( range( 1, 4 ) as $i ) {
	if ( is_active_sidebar( 'footer-'. $i ) ){
		$footer_columns++;
	}
}

switch ( $footer_columns ) {
	case '1':
	$footer_class = 'col-sm-12 col-12';
	break;
	case '2':
	$footer_class = 'col-sm-6 col-12';
	break;
	case '3':
	$footer_class = 'col-md-4 col-sm-12 col-12';
	break;
	default:
	$footer_class = 'col-lg-3 col-sm-6 col-12';
	break;
}
$copyright_class = WOOCTheme::$options['payment_icons'] ? '' : ' copyright-no-payments';
$socials = Helper::socials();

$footer_logo       = empty( WOOCTheme::$options['footer_logo_light']['url'] ) ? Helper::get_img( 'logo-light.png' ) : WOOCTheme::$options['footer_logo_light']['url'];

$footer_separator = '';
if ( WOOCTheme::$options['footer_area'] && $footer_columns && WOOCTheme::$options['copyright_area'] ) {
	$footer_separator = '<div class="footer-sep"></div>';
}
$nav_menu_args  = Helper::nav_menu_footermenu_args();
?>

</div><!-- #content -->
<footer class="site-footer site-footer-<?php echo esc_attr( WOOCTheme::$footer_style );?>">

	<?php if ( WOOCTheme::$options['footer_top_area']  ): ?>
		<div class="footer-padding-lr"> 
			<div class="footer-top-4 footer-top-layout-4"> 
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-6 col-sm-12 col-md-6 col-12">
							<div class="footer-logo-4 media align-items-center">
								<a class="flogo" href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $footer_logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
								<span class="copyright-text media-body"><?php echo wp_kses( WOOCTheme::$options['copyright_text'], 'allow_link' );?></span>
							</div>
						</div>					
						<div class="col-lg-6 col-sm-12 col-md-6 col-12">
						<?php if ( WOOCTheme::$options['payment_icons'] ): ?>
						<ul class="payment-icons-4">
							<?php if ( WOOCTheme::$options['payment_img'] ) : ?>
								<?php
								$wooctheme_cards = explode( ',', WOOCTheme::$options['payment_img'] );
								?>
								<?php foreach ( $wooctheme_cards as $wooctheme_card ): ?>
									<li><?php echo wp_get_attachment_image( $wooctheme_card );?></li>
								<?php endforeach; ?>
								<?php else: ?>
									<li><img alt="<?php esc_attr_e( 'payment', 'uiart' ); ?>" src="<?php echo esc_url( Helper::get_img( 'shiping1.png' ) ); ?>"></li>
									<li><img alt="<?php esc_attr_e( 'payment', 'uiart' ); ?>" src="<?php echo esc_url( Helper::get_img( 'shiping2.png' ) ); ?>"></li>
									<li><img alt="<?php esc_attr_e( 'payment', 'uiart' ); ?>" src="<?php echo esc_url( Helper::get_img( 'shiping3.png' ) ); ?>"></li>
									<li><img alt="<?php esc_attr_e( 'payment', 'uiart' ); ?>" src="<?php echo esc_url( Helper::get_img( 'shiping4.png' ) ); ?>"></li>
									<li><img alt="<?php esc_attr_e( 'payment', 'uiart' ); ?>" src="<?php echo esc_url( Helper::get_img( 'shiping5.png' ) ); ?>"></li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>	
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php endif; ?>	

		<?php if ( WOOCTheme::$options['footer_area'] && $footer_columns ): ?>
			<div class="footer-padding-lr"> 
				<div class="footer-mid-area footer-mid-4">
					<div class="container">
						<div class="row">
							<?php
							foreach ( range( 1, 4 ) as $i ) {
								if ( !is_active_sidebar( 'footer-'. $i ) ) continue;
								echo '<div class="' . esc_attr( $footer_class ) . '">';
								dynamic_sidebar( 'footer-'. $i );
								echo '</div>';
							}
							?>
						</div>
					</div>
				</div>			
			</div>			
		<?php endif; ?>	
			
		<div class="footer-bottom-area footer-bottom-4">
			<div class="container">
				<div class="row">
					
					<div class="col-lg-3 col-md-6 col-12">
						<div class="wooc-icon-wrp-box media">  
						<?php if( WOOCTheme::$options['icon_class_1']['url']){ ?>							
							<div class="img-box">
								<img src="<?php echo esc_url( WOOCTheme::$options['icon_class_1']['url'] );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>">
							</div>
						<?php }else{ ?>	
							<div class="feature-icon">
								<i class="flaticon-worldwide-shipping"></i>
							</div>
						<?php } ?>	
							<div class="wooc-content-area media-body">
								<div class="wooc-content">                
									<h2 class="wooc-title"><?php echo WOOCTheme::$options['title_class_1'];?></h2>
									<span class="wooc-subtitle"><?php echo WOOCTheme::$options['content_class_1'];?></span>
								</div>
							</div>      
						</div>
					</div>
					
					<div class="col-lg-3 col-md-6 col-12">
						<div class="wooc-icon-wrp-box media">  
						<?php if( WOOCTheme::$options['icon_class_2']['url']){ ?>							
							<div class="img-box">
								<img src="<?php echo esc_url( WOOCTheme::$options['icon_class_1']['url'] );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>">
							</div>
						<?php }else{ ?>	
							<div class="feature-icon">
								<i class="flaticon-box"></i>
							</div>
						<?php } ?>	
							<div class="wooc-content-area media-body">
								<div class="wooc-content">                
									<h2 class="wooc-title"><?php echo WOOCTheme::$options['title_class_1'];?></h2>
									<span class="wooc-subtitle"><?php echo WOOCTheme::$options['content_class_1'];?></span>
								</div>
							</div>      
						</div>
					</div>
					
					<div class="col-lg-3 col-md-6 col-12">
						<div class="wooc-icon-wrp-box media">  
						<?php if( WOOCTheme::$options['icon_class_3']['url']){ ?>							
							<div class="img-box">
								<img src="<?php echo esc_url( WOOCTheme::$options['icon_class_1']['url'] );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>">
							</div>
						<?php }else{ ?>	
							<div class="feature-icon">
								<i class="flaticon-shopping-bag"></i>
							</div>
						<?php } ?>	
							<div class="wooc-content-area media-body">
								<div class="wooc-content">                
									<h2 class="wooc-title"><?php echo WOOCTheme::$options['title_class_1'];?></h2>
									<span class="wooc-subtitle"><?php echo WOOCTheme::$options['content_class_1'];?></span>
								</div>
							</div>      
						</div>
					</div>
					
					<div class="col-lg-3 col-md-6 col-12">
						<div class="wooc-icon-wrp-box media">  
						<?php if( WOOCTheme::$options['icon_class_4']['url']){ ?>							
							<div class="img-box">
								<img src="<?php echo esc_url( WOOCTheme::$options['icon_class_1']['url'] );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>">
							</div>
						<?php }else{ ?>	
							<div class="feature-icon">
								<i class="flaticon-telephone-1"></i>
							</div>
						<?php } ?>	
							<div class="wooc-content-area media-body">
								<div class="wooc-content">                
									<h2 class="wooc-title"><?php echo WOOCTheme::$options['title_class_1'];?></h2>
									<span class="wooc-subtitle"><?php echo WOOCTheme::$options['content_class_1'];?></span>
								</div>
							</div>      
						</div>
					</div>

				</div>
			</div>
		</div>	

	</footer>	
<?php wp_footer();?>
</body>
</html>