<?php
/**
 * Info setup
 * @package wpma
 */

function ma_details_setup() {

    $info = array(
    // Welcome message.
        'welcome-texts' => sprintf( esc_html__( 'Howdy %1$s, we would like to thank you for installing and activating %2$s theme for your precious site. All of the features provided by the theme are now ready to use. Here, we have gathered all of the essential details and helpful links for you and your better experience with %2$s. Once again, Thanks for using our theme!', 'ma' ), get_bloginfo('name'), 'wpma' ),

        // Getting started sections.
        'getting_started' => array(
            'one' => array(
                'title'       => esc_html__( 'Theme Documentation', 'ma' ),
                'icon'        => 'dashicons dashicons-format-aside',
                'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'ma' ),
                'button_text' => esc_html__( 'View Documentation', 'ma' ),
                'button_url'  => 'https://hsoub.com/documentations/ma/',
                'button_type' => 'link',
                'is_new_tab'  => true,
            ),
            'two' => array(
                'title'       => esc_html__( 'Static Front Page', 'ma' ),
                'icon'        => 'dashicons dashicons-admin-generic',
                'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page & assign "Home" template from page attributes.', 'ma' ),
                'button_text' => esc_html__( 'Static Front Page', 'ma' ),
                'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
                'button_type' => 'primary',
            ),
            'three' => array(
                'title'       => esc_html__( 'Theme Options', 'ma' ),
                'icon'        => 'dashicons dashicons-admin-customizer',
                'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'ma' ),
                'button_text' => esc_html__( 'Customize', 'ma' ),
                'button_url'  => wp_customize_url(),
                'button_type' => 'primary',
            ),
            'four' => array(
                'title'       => esc_html__( 'Widgets', 'ma' ),
                'icon'        => 'dashicons dashicons-welcome-widgets-menus',
                'description' => esc_html__( 'Theme uses Wedgets API for widget options. Using the Widgets you can easily customize different aspects of the theme.', 'ma' ),
                'button_text' => esc_html__( 'Widgets', 'ma' ),
                'button_url'  => admin_url('widgets.php'),
                'button_type' => 'primary',
            ),
        ),
    );
    ma_dashboard_page::init( $info ); 
}
add_action( 'after_setup_theme', 'ma_details_setup' );