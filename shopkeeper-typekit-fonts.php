<?php
/**
 * Plugin Name:       		Shopkeeper Typekit Fonts
 * Plugin URI:        		https://shopkeeper.wp-theme.design/
 * Description:       		A simple extension that allows you to use Typekit Fonts with your Shopkeeper theme.
 * Version:           		1.3
 * Author:            		GetBowtied
 * Author URI:				https://getbowtied.com
 * Text Domain:				shopkeeper-typekit-fonts
 * Domain Path:				/languages/
 * License:                 GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Requires at least: 		5.0
 * Tested up to: 			5.3
 *
 * @package  Shopkeeper Typekit Fonts
 * @author   GetBowtied
 */

 if ( ! defined( 'ABSPATH' ) ) {
     exit;
 } // Exit if accessed directly

if( ! function_exists( 'get_plugin_data' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if( ! function_exists( 'get_current_screen' ) ) {
    require_once(ABSPATH . 'wp-admin/includes/screen.php');
}

 // Plugin Updater
 require 'core/updater/plugin-update-checker.php';
 $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
 	'https://raw.githubusercontent.com/getbowtied/shopkeeper-typekit-fonts/master/core/updater/assets/plugin.json',
 	__FILE__,
 	'shopkeeper-typekit-fonts'
 );

if ( !class_exists( 'ShopkeeperTypekitFonts' ) ) {

	/**
	 * ShopkeeperTypekitFonts class.
	*/
    class ShopkeeperTypekitFonts {

		/**
		 * The single instance of the class.
		 *
		 * @var ShopkeeperTypekitFonts
		*/
		protected static $_instance = null;

		/**
		 * Version of Shopkeeper Typekit Fonts plugin.
		 *
		 * @var string
		*/
		protected $version = null;

		/**
		 * ShopkeeperTypekitFonts constructor.
		 *
		*/
        public function __construct() {

			$this->version = get_plugin_data( __FILE__ )['Version'];

			// Customizer Options.
			include_once( dirname( __FILE__ ) . '/includes/customizer/options.php' );

			if( !get_option( 'sk_adobe_typekit_kirki_options_sanitize', false ) ) {
				$this->sanitize_options();
				update_option( 'sk_adobe_typekit_kirki_options_sanitize', true );
			}

            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_sk_typekit_scripts' ), 99 );
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_sk_typekit_scripts' ), 99 );
        }

		/**
		 * Make sure options are being saved after Kirki removal.
		 *
		*/
		public function sanitize_options() {
			if( get_theme_mod('enable_typekit_fonts', false) ) {
				set_option( 'enable_typekit_fonts', get_theme_mod('enable_typekit_fonts', false) );
			}
			if( get_theme_mod('addon_font_typekit_kit_id', false) ) {
				set_option( 'addon_font_typekit_kit_id', get_theme_mod('addon_font_typekit_kit_id', false) );
			}
			if( get_theme_mod('addon_main_typekit_font_face', false) ) {
				set_option( 'addon_main_typekit_font_face', get_theme_mod('addon_main_typekit_font_face', false) );
			}
			if( get_theme_mod('addon_secondary_typekit_font_face', false) ) {
				set_option( 'addon_secondary_typekit_font_face', get_theme_mod('addon_secondary_typekit_font_face', false) );
			}
		}

        public function enqueue_sk_typekit_scripts() {
			if( get_option( 'enable_typekit_fonts', false ) && !empty( get_option( 'addon_font_typekit_kit_id', '' ) ) ) {
                wp_enqueue_script(
					'shopkeeper-adobe_typekit',
					'//use.typekit.net/'.get_option( 'addon_font_typekit_kit_id', '' ).'.js',
					array(),
					$this->version,
					FALSE
				);

                wp_enqueue_script(
					'shopkeeper-adobe_typekit_exec',
                    plugins_url( '/assets/js/typekit.js', __FILE__ ),
					array(),
					$this->version,
					FALSE
				);

                // Frontend styles.
                wp_enqueue_style(
                    'shopkeeper-adobe_typekit',
                    plugins_url( '/assets/css/typekit.css', __FILE__ ),
                    array( 'shopkeeper-styles' ),
                    $this->version
                );

                // Frontend custom styles.
                $custom_styles = '';
                include( dirname( __FILE__ ) . '/includes/custom-styles/frontend/fonts.css.php' );
             	wp_add_inline_style( 'shopkeeper-adobe_typekit', $custom_styles );
            }
        }

        public function enqueue_admin_sk_typekit_scripts() {

            if( get_option( 'enable_typekit_fonts', false ) && !empty( get_option( 'addon_font_typekit_kit_id', '' ) ) ) {
                wp_enqueue_script(
					'shopkeeper-adobe_typekit',
					'//use.typekit.net/'.get_option( 'addon_font_typekit_kit_id', '' ).'.js',
					array(),
					$this->version,
					FALSE
				);

                wp_enqueue_script(
					'shopkeeper-adobe_typekit_exec',
                    plugins_url( '/assets/js/typekit.js', __FILE__ ),
					array(),
					$this->version,
					FALSE
				);

                // Backend styles.
                wp_enqueue_style(
                    'shopkeeper-admin_adobe_typekit',
                    plugins_url( '/assets/css/admin/typekit.css', __FILE__ ),
                    array( 'shopkeeper_admin_styles' ),
                    $this->version
                );

                // Backend custom styles.
                $custom_gutenberg_styles = '';
                include( dirname( __FILE__ ) . '/includes/custom-styles/backend/fonts.css.php' );
                $current_screen = get_current_screen();
                if ( method_exists($current_screen, 'is_block_editor') && $current_screen->is_block_editor() ) {
                    wp_add_inline_style( 'shopkeeper-admin_adobe_typekit', $custom_gutenberg_styles );
                }
            }
        }

		/**
		 * Ensures only one instance of ShopkeeperTypekitFonts is loaded or can be loaded.
		 *
		 * @return ShopkeeperTypekitFonts
		*/
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

    }

    new ShopkeeperTypekitFonts();
}
