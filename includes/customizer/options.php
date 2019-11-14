<?php

/**
 * Converts string to bool
 *
 * @param string $string [the input].
 *
 * @return boolean
 */
function sk_typekit_sanitize_checkbox( $value ) {
    return is_bool( $value ) ? $value : ( 'yes' === $value || 1 === $value || 'true' === $value || '1' === $value );
}

/**
 * Checks if Adobe Typekit fonts is enabled.
 */
function sk_typekit_is_adobe_font(){

    return get_option( 'enable_typekit_fonts', false );
}

add_action( 'customize_register', 'shopkeeper_typekit_fonts_controls' );
/**
 * Adds controls for Typekit fonts.
 *
 * @param  [object] $wp_customize [customizer object].
 */
function shopkeeper_typekit_fonts_controls( $wp_customize ) {

   // Enable Adobe Typekit Fonts.
   $wp_customize->add_setting(
       'enable_typekit_fonts',
       array(
           'type'                 => 'option',
           'sanitize_callback'    => 'sk_typekit_sanitize_checkbox',
           'default'              => false,
       )
   );

   $wp_customize->add_control(
       new WP_Customize_Control(
           $wp_customize,
           'enable_typekit_fonts',
           array(
               'type'     => 'checkbox',
               'label'    => esc_html__( 'Enable Adobe Typekit Fonts', 'shopkeeper-typekit-fonts' ),
               'section'  => 'fonts',
               'priority' => 10,
           )
       )
   );

   // Typekit Kit ID.
   $wp_customize->add_setting(
       'addon_font_typekit_kit_id',
       array(
           'type'    => 'option',
           'default' => '',
       )
   );

   $wp_customize->add_control(
       new WP_Customize_Control(
           $wp_customize,
           'addon_font_typekit_kit_id',
           array(
               'type'     => 'text',
               'label'    => esc_html__( 'Typekit Kit ID', 'shopkeeper-typekit-fonts' ),
               'description'   => esc_html__( 'Paste the provided Typekit Kit ID.', 'shopkeeper-typekit-fonts'),
               'section'  => 'fonts',
               'priority' => 10,
               'active_callback' => 'sk_typekit_is_adobe_font'
           )
       )
   );

   // Main Typekit Font Face.
   $wp_customize->add_setting(
       'addon_main_typekit_font_face',
       array(
           'type'    => 'option',
           'default' => '',
       )
   );

   $wp_customize->add_control(
       new WP_Customize_Control(
           $wp_customize,
           'addon_main_typekit_font_face',
           array(
               'type'     => 'text',
               'label'    => esc_html__( 'Main Typekit Font Face', 'shopkeeper-typekit-fonts' ),
               'description'   => esc_html__( 'Enter your Typekit Font Name for the theme\'s Main Typography.', 'shopkeeper-typekit-fonts'),
               'section'  => 'fonts',
               'priority' => 10,
               'active_callback' => 'sk_typekit_is_adobe_font'
           )
       )
   );

   // Main Typekit Font Face.
   $wp_customize->add_setting(
       'addon_secondary_typekit_font_face',
       array(
           'type'    => 'option',
           'default' => '',
       )
   );

   $wp_customize->add_control(
       new WP_Customize_Control(
           $wp_customize,
           'addon_secondary_typekit_font_face',
           array(
               'type'     => 'text',
               'label'    => esc_html__( 'Secondary Typekit Font Face', 'shopkeeper-typekit-fonts' ),
               'description'   => esc_html__( 'Enter your Typekit Font Name for the theme\'s Secondary Typography.', 'shopkeeper-typekit-fonts'),
               'section'  => 'fonts',
               'priority' => 10,
               'active_callback' => 'sk_typekit_is_adobe_font'
           )
       )
   );
}

?>
