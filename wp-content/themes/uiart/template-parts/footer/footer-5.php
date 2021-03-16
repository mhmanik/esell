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

$nav_menu_args  = Helper::nav_menu_footermenu_args();
?>
</div><!-- #content -->
<footer class="site-footer site-footer-<?php echo esc_attr( WOOCTheme::$footer_style );?>">
	<?php if ( WOOCTheme::$options['footer_top_area']  ): ?>
		<div class="footer-padding-lr"> 
			<div class="footer-top-5 footer-top-layout-5"> 
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="footer-logo-5 align-items-center">
								<a class="flogo" href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $footer_logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
								
							</div>
						</div>					
						<div class="col-12">
							<?php if ( WOOCTheme::$options['social_icons'] && $socials ): ?>
							<div class="footer-social-wrp-5 align-items-center">
								<ul class="footer-social">
									<?php foreach ( $socials as $social ): ?>
										<li><a target="_blank" href="<?php echo esc_url( $social['url'] );?>"><i class="fab <?php echo esc_attr( $social['icon'] );?>"></i></a></li>
									<?php endforeach; ?>					
								</ul>
							</div>
						<?php endif; ?>
						</div>
						<div class="col-12">
						<?php if ( WOOCTheme::$options['payment_icons'] ): ?>
						<ul class="payment-icons-5">
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
			<?php if ( WOOCTheme::$options['copyright_area'] ): ?>
					<div class="footer-bottom-5">
						<div class="footer-bottom-wrp-5">
								<div class="container">
									<div class="row">
										<div class="col-lg-6 col-sm-12 col-md-6 col-12">
											<?php if ( WOOCTheme::$options['nav_menu_args'] ): ?>
												<div class="footer-menu">
													<?php wp_nav_menu( $nav_menu_args );?> 
												</div>	
											<?php endif; ?>	
										</div>	
										<div class="col-lg-6 col-sm-12 col-md-6 col-12">
											<span class="copyright-text"><?php echo wp_kses( WOOCTheme::$options['copyright_text'], 'allow_link' );?></span>	
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>	
			</footer>	
<?php wp_footer();?>
</body>
</html>