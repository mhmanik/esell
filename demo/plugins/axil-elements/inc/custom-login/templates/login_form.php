<?php if ( true ) : ?>
<div class="login-form-container">
	<?php if ( $attributes['show_title'] ) : ?>
		<h2><?php esc_html_e( 'Sign In', 'esell-elements' ); ?></h2>
	<?php endif; ?>

	<!-- Show errors if there are any -->
	<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
		<?php foreach ( $attributes['errors'] as $error ) : ?>
			<p class="login-error alert alert-primary">
				<?php echo $error; ?>
			</p>
		<?php endforeach; ?>
	<?php endif; ?>

	<!-- Show logged out message if user just logged out -->
	<?php if ( $attributes['logged_out'] ) : ?>
		<p class="login-info">
			<?php esc_html_e( 'You have signed out. Would you like to sign in again?', 'esell-elements' ); ?>
		</p>
	<?php endif; ?>

	<?php if ( $attributes['registered'] ) : ?>
		<p class="login-info">
			<?php
				printf(
					__( 'You have successfully registered to <strong>%s</strong>. We have emailed your password to the email address you entered.', 'esell-elements' ),
					get_bloginfo( 'name' )
				);
			?>
		</p>
	<?php endif; ?>

	<?php if ( $attributes['lost_password_sent'] ) : ?>
		<p class="login-info">
			<?php esc_html_e( 'Check your email for a link to reset your password.', 'esell-elements' ); ?>
		</p>
	<?php endif; ?>

	<?php if ( $attributes['password_updated'] ) : ?>
		<p class="login-info">
			<?php esc_html_e( 'Your password has been changed. You can sign in now.', 'esell-elements' ); ?>
		</p>
	<?php endif; ?>

	<?php
		wp_login_form(
			array(
				'label_username' => __( 'Email', 'esell-elements' ),
				'label_log_in' => __( 'Sign In', 'esell-elements' ),
				'redirect' => $attributes['redirect'],
			)
		);
	?>

	<a class="forgot-password" href="<?php echo wp_lostpassword_url(); ?>">
		<?php esc_html_e( 'Forgot your password?', 'esell-elements' ); ?>
	</a>

</div>
<?php else : ?>
	<div class="login-form-container">
		<form method="post" action="<?php echo wp_login_url(); ?>">
			<p class="login-username">
				<label for="user_login"><?php esc_html_e( 'Email', 'esell-elements' ); ?></label>
				<input type="text" name="log" id="user_login">
			</p>
			<p class="login-password">
				<label for="user_pass"><?php esc_html_e( 'Password', 'esell-elements' ); ?></label>
				<input type="password" name="pwd" id="user_pass">
			</p>
			<p class="login-submit">
				<input type="submit" value="<?php esc_html_e( 'Sign In', 'esell-elements' ); ?>">
			</p>
		</form>
	</div>
<?php endif; ?>
