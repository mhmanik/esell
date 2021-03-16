<div class="login-form-container">
	<div id="password-lost-form" class="widecolumn">
		<?php if ( $attributes['show_title'] ) : ?>
			<h3><?php esc_html_e( 'Forgot Your Password?', 'esell-elements' ); ?></h3>
		<?php endif; ?>

		<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
			<?php foreach ( $attributes['errors'] as $error ) : ?>
				<p class="alert alert-primary">
					<?php echo $error; ?>
				</p>
			<?php endforeach; ?>
		<?php endif; ?>

		<p>
			<?php
				esc_html_e(
					"Enter your email address and we'll send you a link you can use to pick a new password.",
					'personalize_login'
				);
			?>
		</p>

		<form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">
			<p class="form-col">
				<label for="user_login"><?php esc_html_e( 'Email', 'esell-elements' ); ?></label>
				<input type="text" name="user_login" class="input" id="user_login">
			</p>

			<p class="lostpassword-submit">
				<input type="submit" name="submit" class="lostpassword-button"
				       value="<?php esc_html_e( 'Reset Password', 'esell-elements' ); ?>"/>
			</p>
		</form>
	</div>
</div>