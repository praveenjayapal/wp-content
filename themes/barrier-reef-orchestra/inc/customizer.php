<?php
/**
 * barrier reef orchestra Theme Customizer.
 *
 * @package barrier_reef_orchestra
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function barrier_reef_orchestra_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Custom Customizer Customizations
	 */

	// Create header background color setting
	$wp_customize->add_setting( 'header_color', array(
		'default' => '#1e90ff',
		'type' => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'postMessage',
	));

	// Add control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_color', array(
				'label' => __( 'Header Background Color', 'barrier_reef_orchestra' ),
				'section' => 'colors',
			)
		)
	);

    // Add section to the Customizer
    $wp_customize->add_section( 'barrier_reef_orchestra-options', array(
        'title' => __( 'Theme Options', 'barrier_reef_orchestra' ),
        'capability' => 'edit_theme_options',
        'description' => __( 'Change the default display options for the theme.', 'barrier_reef_orchestra' ),
    ));

    // Create sidebar layout setting
    $wp_customize->add_setting(	'layout_setting',
        array(
            'default' => 'left-sidebar',
            'type' => 'theme_mod',
            'sanitize_callback' => 'barrier_reef_orchestra_sanitize_layout',
            'transport' => 'postMessage'
        )
    );
    // Add sidebar layout controls
    $wp_customize->add_control(	'layout_control',
        array(
            'settings' => 'layout_setting',
            'type' => 'radio',
            'label' => __( 'Sidebar position', 'barrier_reef_orchestra' ),
            'choices' => array(
                'no-sidebar' => __( 'No sidebar', 'barrier_reef_orchestra' ),
                'sidebar-left' => __( 'Left sidebar (default)', 'barrier_reef_orchestra' ),
                'sidebar-right' => __( 'Right sidebar', 'barrier_reef_orchestra' )
            ),
            'section' => 'barrier_reef_orchestra-options',
        )
    );
}
add_action( 'customize_register', 'barrier_reef_orchestra_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function barrier_reef_orchestra_customize_preview_js() {
	wp_enqueue_script( 'barrier_reef_orchestra_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'barrier_reef_orchestra_customize_preview_js' );


/**
 * Inject Customizer CSS when appropriate
 */
function barrier_reef_orchestra_customizer_css() {
	$header_color = get_theme_mod('header_color');

	?>
	<style type="text/css">
		.site-header {
			background-color: <?php echo $header_color; ?>
		}
	</style>
	<?php
}
add_action( 'wp_head', 'barrier_reef_orchestra_customizer_css' );


/**
 * Sanitize layout options
 */
function barrier_reef_orchestra_sanitize_layout( $value ) {
    if ( !in_array( $value, array( 'sidebar-left', 'sidebar-right', 'no-sidebar' ) ) ) {
        $value = 'no-sidebar';
    }
    return $value;
}
