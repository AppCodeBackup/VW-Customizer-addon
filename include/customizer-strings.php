<?php
/**
 * Customizer strings for the logo control.
 * @since 1.1.3
 * @version 1.1.22
 */
$logo_range_control = array( 'customize_logo_width', 'customize_logo_height', 'customize_logo_padding' );
$logo_range_default = array( '84', '84', '0' );
$logo_range_label = array( __( 'Logo Width:', 'themes' ), __( 'Logo Height:', 'themes' ), __( 'Space Bottom:', 'themes' ) );
$logo_range_attrs = array(
  array( 'min' => 0, 'max' => 500, 'step' => 1, 'suffix' => 'px' ),
  array( 'min' => 0, 'max' => 500, 'step' => 1, 'suffix' => 'px' ),
  array( 'min' => 0, 'max' => 100, 'step' => 1, 'suffix' => 'px' )
);
$logo_range_unit    = array( 'px', 'px', 'px' );

/**
 * Customizer strings for the grouping control.
 * @since 1.1.3
 */
$group_control  = array( 'login_input_group', 'login_label_group', 'login_form_group', 'footer_form_group', 'footer_back_group', 'footer_group', 'bg_image_group', 'bg_video_group' );
$group_label    = array(
  __( 'Input Fields:', 'themes'),
  __( 'Input Field Labels:', 'themes'),
  __( 'Login Form:', 'themes'),
  __( 'Lost Your Password Text', 'themes' ),
  __( 'Back To Site Text', 'themes' ),
  __( 'ThemeSetting Footer Text', 'themes' ),
  __( 'Background Image', 'themes' ),
  __( 'Background Video', 'themes' )  );
$group_info     = array(
  __( 'This section helps you to easily Customize the login form input field elements.', 'themes' ),
  __( 'This section helps you to easily Customize the login form input field labels.', 'themes' ),
  __( 'This section helps you to easily Customize the login form elements whether they are form lables, fields or backgrounds.', 'themes' ),
  __( ' Customize the "Lost your password" and "Register" text section under the form.', 'themes' ),
  __( 'Customize the "Back to" text section under the form.', 'themes' ),
  __( 'Customize the copyright note and branding sections at the footer of login page.', 'themes' ),
  __( 'Customize the background Image.', 'themes' ),
  __( 'Customize the background Video.', 'themes' ) );
/** ------------------Grouping Control-------------------- */

/**
 * [ Customizer strings for the section login form. ]
 * @since 1.1.3
 */
$form_range_control = array( 'customize_form_width', 'customize_form_height', 'customize_form_radius', 'customize_form_shadow', 'customize_form_opacity', 'textfield_width', 'textfield_radius', 'textfield_shadow', 'textfield_shadow_opacity', 'customize_form_label', 'remember_me_font_size' );
$form_range_default = array( '350', '200', '0', '0', '0', '100', '0', '0', '80', '14', '13' );
$form_range_label   = array(
  __( 'Form Width:', 'themes' ),
  __( 'Form Minimum Height:', 'themes' ),
  __( 'Form Radius:', 'themes' ),
  __( 'Form Shadow:', 'themes' ),
  __( 'Form Shadow Opacity:', 'themes' ),
  __( 'Input Text Field Width:', 'themes' ),
  __( 'Input Text Field Radius:', 'themes' ),
  __( 'Input Text Field Shadow:', 'themes' ),
  __( 'Input Text Field Shadow Opacity:', 'themes' ),
  __( 'Input Field Label Font Size:', 'themes' ),
  __( 'Remember Me Font Size:', 'themes' ) );
$form_range_attrs   = array(
  array( 'min' => 320, 'max' => 800, 'step' => 1, 'suffix' => 'px' ), // form width
  array( 'min' => 0, 'max'   => 500, 'step' => 1, 'suffix' => 'px' ), // form height
  array( 'min' => 0, 'max'   => 100, 'step' => 1, 'suffix' => 'px' ), // form radius
  array( 'min' => 0, 'max'   => 30, 'step'  => 1, 'suffix' => 'px' ), // form shadow
  array( 'min' => 0, 'max'   => 100, 'step' => 1, 'suffix' => '%' ), // form Opacity
  array( 'min' => 0, 'max'   => 100, 'step' => 1, 'suffix' => '%' ), // textfield width
  array( 'min' => 0, 'max'   => 30, 'step'  => 1, 'suffix' => 'px' ), // textfield radius
  array( 'min' => 0, 'max'   => 30, 'step'  => 1, 'suffix' => 'px' ), // textfield shadow
  array( 'min' => 0, 'max'   => 100, 'step' => 1, 'suffix' => '%' ), // textfield Opacity
  array( 'min' => 9, 'max'   => 30, 'step'  => 1, 'suffix' => 'px' ), // testfield label
  array( 'min' => 9, 'max'   => 30, 'step'  => 1, 'suffix' => 'px' ) // readme label
);
$form_range_unit    = array( 'px', 'px', 'px', 'px', '%', '%', 'px', 'px', '%', 'px', 'px' );
//--------------------
$form_color_control = array( 'form_background_color', 'textfield_background_color', 'textfield_color', 'textfield_label_color', 'remember_me_label_size' );
$form_color_default = array( '#FFF', '#FFF', '#333', '#777', '#72777c' );
$form_color_label   = array(
  __( 'Form Background Color:', 'themes' ),
  __( 'Input Field Background Color:', 'themes' ),
  __( 'Input Field Text Color:', 'themes' ),
  __( 'Input Field Label Color:', 'themes' ),
  __( 'Remember me Label Color:', 'themes' ),
);
//--------------------
$form_control       = array( 'customize_form_padding', 'customize_form_border', 'textfield_margin', 'form_username_label', 'form_password_label' );
$form_default       = array( '0 24px 12px', '', '2px 6px 18px 0px', __( 'Username or Email Address', 'themes' ), __( 'Password', 'themes' ) );
$form_label         = array(
  __( 'Form Padding:', 'themes' ),
  __( 'Border (Example: 2px dotted black):', 'themes' ),
  __( 'Input Text Field Margin:', 'themes' ),
  __( 'Username Label:', 'themes' ),
  __( 'Password Label:', 'themes' ),
);
$form_sanitization = array( 'wp_strip_all_tags', 'wp_strip_all_tags', 'wp_strip_all_tags', 'wp_strip_all_tags', 'wp_strip_all_tags' );
/** -----------------Sectin Login Form------------------ */

/**
 * [ Customizer strings for the section button beauty. ]
 * @since 1.1.3
 * @version 1.4.3
 */
 $button_control = array( 'custom_button_color', 'button_border_color', 'button_hover_color', 'button_hover_border', 'custom_button_shadow', 'button_text_color', 'button_hover_text_color' );
 $button_default = array( '#2EA2CC', '#0074A2', '#1E8CBE', '#0074A2', '#78C8E6', '#FFF', '#FFF' );
 $button_label = array(
   __( 'Button Color:', 'themes' ),
   __( 'Button Border Color:', 'themes' ),
   __( 'Button Color (Hover):', 'themes' ),
   __( 'Button Border (Hover):', 'themes' ),
   __( 'Button Box Shadow:', 'themes' ),
   __( 'Button Text Color:', 'themes' ),
   __( 'Button Text Color (Hover):', 'themes' )
 );

$button_range_control = array( 'login_button_size', 'login_button_top', 'login_button_bottom', 'login_button_radius', 'login_button_shadow', 'login_button_shadow_opacity', 'login_button_text_size' );
$button_range_default = array( '100', '13', '13', '5', '0', '80', '15' );
$button_range_label = array( __( 'Button Size:', 'themes' ), __( 'Button Top Padding:', 'themes' ), __( 'Button Bottom Padding:', 'themes' ), __( 'Radius:', 'themes' ), __( 'Shadow:', 'themes' ), __( 'Shadow Opacity:', 'themes' ), __( 'Text Size:', 'themes' ) );
$button_range_attrs = array(
  array( 'min' => 20, 'max' => 100, 'step' => 1, 'suffix' => '%' ),
  array( 'min' => 0, 'max'  => 30, 'step'  => 1, 'suffix' => 'px' ),
  array( 'min' => 0, 'max'  => 30, 'step'  => 1, 'suffix' => 'px' ),
  array( 'min' => 0, 'max'  => 50, 'step'  => 1, 'suffix' => 'px' ),
  array( 'min' => 0, 'max'  => 30, 'step'  => 1, 'suffix' => 'px' ),
  array( 'min' => 0, 'max'  => 100, 'step' => 1, 'suffix' => 'px' ),
  array( 'min' => 7, 'max'  => 35, 'step'  => 1, 'suffix' => 'px' ),
);
$button_range_unit = array( '%', 'px', 'px', 'px', 'px', '%', 'px' );
/** -----------------Section Button Beauty------------------ */

/**
 * [ Customizer strings for the group close. ]
 * @since 1.1.3
 */
$close_control = array( 'login_input_br', 'login_label_br', 'login_form_br', 'footer_form_br', 'footer_back_br', 'footer_br' );
/** -----------------Section Login Footer------------------ */

/**
 * [ Customizer strings for the error messages. ]
 * @since 1.1.22
 */
$error_control = array( 'incorrect_username', 'incorrect_password', 'empty_username', 'empty_password', 'invalid_email', 'empty_email', 'username_exists', 'email_exists', 'invalidcombo_message', 'force_email_login' );
$error_default = array(
  sprintf( __( '%1$sError:%2$s Invalid Username.', 'themes' ), '<strong>', '</strong>' ), sprintf( __( '%1$sError:%2$s Invalid Password.', 'themes' ), '<strong>', '</strong>' ),
  sprintf( __( '%1$sError:%2$s The username field is empty.', 'themes' ), '<strong>', '</strong>' ),
  sprintf( __( '%1$sError:%2$s The password field is empty.', 'themes' ), '<strong>', '</strong>' ),
  sprintf( __( '%1$sError:%2$s The email address isn\'t correct..', 'themes' ), '<strong>', '</strong>' ),
  sprintf( __( '%1$sError:%2$s Please type your email address.', 'themes' ), '<strong>', '</strong>' ),
  sprintf( __( '%1$sError:%2$s This username is already registered. Please choose another one.', 'themes' ), '<strong>', '</strong>' ),
  sprintf( __( '%1$sError:%2$s This email is already registered, please choose another one.', 'themes' ), '<strong>', '</strong>' ),
  sprintf( __( '%1$sError:%2$s Invalid username or email.', 'themes' ), '<strong>', '</strong>' ),
  sprintf( __( '%1$sError:%2$s Invalid Email Address', 'themes' ), '<strong>', '</strong>' ) );
$error_label = array(
  __( 'Incorrect Username Message:',  'themes' ),
  __( 'Incorrect Password Message:',  'themes' ),
  __( 'Empty Username Message:',      'themes' ),
  __( 'Empty Password Message:',      'themes' ),
  __( 'Invalid Email Message:',       'themes' ),
  __( 'Empty Email Message:',         'themes' ),
  __( 'Username Already Exist Message:','themes' ),
  __( 'Email Already Exist Message:', 'themes' ),
  __( 'Forget Password Message:',     'themes' ),
  __( 'Login with Email Message:',    'themes' ),
);
/** -----------------Error Section------------------ */

/**
 * [ Customizer strings for the welcome messages. ]
 * @since 1.1.22
 */
$welcome_control = array( 'lostpwd_welcome_message', 'welcome_message', 'register_welcome_message', 'logout_message', 'message_background_border' );
$welcome_default = array( 'Forgot password?', 'Welcome', 'Register For This Site', 'Logout', '' );
$welcome_label	 = array(
  __( 'Welcome Message on Lost Password:', 'themes' ),
  __( 'Welcome Message on Login Page:', 'themes' ),
  __( 'Welcome Message on Registration:', 'themes' ),
  __( 'Logout Message:', 'themes' ),
  __( 'Message Field Border: ( Example: 1px solid #00a0d2; )', 'themes' ),
);
$welcome_sanitization = array( 'wp_kses_post', 'wp_kses_post', 'wp_kses_post', 'wp_kses_post', 'wp_strip_all_tags' );