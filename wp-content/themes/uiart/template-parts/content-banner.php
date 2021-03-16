<?php
/**
 * @author  WoocTheme
 * @since   1.0
 * @version 1.0
 */

namespace wooctheme\Uiart;

if ( !WOOCTheme::$has_banner ) {
	return;
}

if ( is_search() ) {
	$title = esc_html__( 'Search Results for : ', 'uiart' ) . get_search_query();
}
elseif ( is_404() ) {
	$title = esc_html__( 'Page not Found', 'uiart' );
}
elseif ( is_home() ) {
	if ( get_option( 'page_for_posts' ) ) {
		$title = get_the_title( get_option( 'page_for_posts' ) );
	}
	else {
		$title = apply_filters( "wooctheme_blog_title", esc_html__( 'All Posts', 'uiart' ) );
	}
}
elseif ( is_archive() ) {
	$title = get_the_archive_title();
}
else{
	$title = get_the_title();
}

$title = apply_filters( 'wooctheme_page_title', $title );

if (WOOCTheme::$bgtype ==  'texttype') { ?>
	<div class="banner3-wrp">
		<div class="container">
			<div class="banner3 has_breadcrumb-<?php echo esc_html( WOOCTheme::$has_breadcrumb );?>">		
				<div class="banner-content">
					<h1><?php echo wp_kses( $title , 'alltext_allow' );?></h1>
					<?php if ( WOOCTheme::$has_breadcrumb ): ?>
						<div class="main-breadcrumb"><?php Helper::the_breadcrumb();?></div>
					<?php endif; ?>			
				</div>
			</div>
		</div> 
	</div> 
 <?php } else{  ?>	
	 <?php if (WOOCTheme::$header_style == '4') { ?>
		<div class="container">
			<div class="banner3 has_breadcrumb-<?php echo esc_html( WOOCTheme::$has_breadcrumb );?>">		
				<div class="banner-content">
					<h1><?php echo wp_kses( $title , 'alltext_allow' );?></h1>
					<?php if ( WOOCTheme::$has_breadcrumb ): ?>
						<div class="main-breadcrumb"><?php Helper::the_breadcrumb();?></div>
					<?php endif; ?>			
				</div>
			</div>
		</div> 
		<?php } else { ?>
		<div class="banner">
			<div class="container">
				<div class="banner-content">					
					<h1><?php echo wp_kses( $title , 'alltext_allow' );?></h1>
					<?php if ( WOOCTheme::$has_breadcrumb ): ?>
						<div class="main-breadcrumb"><?php Helper::the_breadcrumb();?></div>
					<?php endif; ?>
				</div>
			</div>
		</div> 	
	<?php } ?>
<?php }  ?>