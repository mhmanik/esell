<div class="login-form-container">
	<div id="register-form" class="widecolumn">
		<?php if ( $attributes['show_title'] ) : ?>
			<h3><?php _e( 'Register', 'esell-elements' ); ?></h3>
		<?php endif; ?>

		<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
			<?php foreach ( $attributes['errors'] as $error ) : ?>
				<p class="alert alert-primary">
					<?php echo $error; ?>
				</p>
			<?php endforeach; ?>
		<?php endif; ?>

		<form id="signupform" action="<?php echo wp_registration_url(); ?>" method="post">
			<p class="form-col">
				<label for="email"><?php esc_html_e( 'Email', 'esell-elements' ); ?> <strong>*</strong></label>
				<input type="text"  class="input" name="email" id="email">
			</p>

			<p class="form-col">
				<label for="first_name"><?php esc_html_e( 'First name', 'esell-elements' ); ?></label>
				<input type="text"  class="input" name="first_name" id="first-name">
			</p>

			<p class="form-col">
				<label for="last_name"><?php esc_html_e( 'Last name', 'esell-elements' ); ?></label>
				<input type="text"  class="input" name="last_name" id="last-name">
			</p>

			<p class="form-col">
				<?php esc_html_e( 'Note: Your password will be generated automatically and emailed to the address you specify above.', 'esell-elements' ); ?>
			</p>

			<?php if ( $attributes['recaptcha_site_key'] ) : ?>
				<div class="recaptcha-container">
					<div class="g-recaptcha" data-sitekey="<?php echo $attributes['recaptcha_site_key']; ?>"></div>
				</div>
			<?php endif; ?>

			<p></p>

			<p class="signup-submit">
				<input type="submit" name="submit" class="register-button" value="<?php esc_html_e( 'Register', 'esell-elements' ); ?>"/>
			</p>
		</form>
	</div>
</div>