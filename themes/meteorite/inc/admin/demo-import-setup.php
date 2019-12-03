<?php
/**
 * Functions to provide support for the One Click Demo Import plugin (wordpress.org/plugins/one-click-demo-import)
 *
 * @package Meteorite
 */


/**
 * Set import files
 */
function meteorite_import_files() {
	return array(
		array(
			'import_file_name'				=> 'Default',
			'local_import_file'				=> trailingslashit( get_template_directory() ) . 'demo-content/default/demo-content.xml',
			'local_import_widget_file'		=> trailingslashit( get_template_directory() ) . 'demo-content/default/widgets.wie',
			'local_import_customizer_file' 	=> trailingslashit( get_template_directory() ) . 'demo-content/default/customizer.dat',
			'import_preview_image_url'		=> trailingslashit( get_template_directory_uri() ) . 'demo-content/default/preview_image_default.jpg',
			'preview_url'					=> 'http://demo.terra-themes.com/meteorite-default/',
		),
		array(
			'import_file_name'				=> 'Agency',
			'local_import_file'				=> trailingslashit( get_template_directory() ) . 'demo-content/agency/demo-content.xml',
			'local_import_widget_file'		=> trailingslashit( get_template_directory() ) . 'demo-content/agency/widgets.wie',
			'local_import_customizer_file' 	=> trailingslashit( get_template_directory() ) . 'demo-content/agency/customizer.dat',
			'import_preview_image_url'		=> trailingslashit( get_template_directory_uri() ) . 'demo-content/agency/preview_image_agency.jpg',
			'preview_url'					=> 'http://demo.terra-themes.com/meteorite-agency/',
		),
		array(
			'import_file_name'				=> 'Construction',
			'local_import_file'				=> trailingslashit( get_template_directory() ) . 'demo-content/construction/demo-content.xml',
			'local_import_widget_file'		=> trailingslashit( get_template_directory() ) . 'demo-content/construction/widgets.wie',
			'local_import_customizer_file' 	=> trailingslashit( get_template_directory() ) . 'demo-content/construction/customizer.dat',
			'import_preview_image_url'		=> trailingslashit( get_template_directory_uri() ) . 'demo-content/construction/preview_image_construction.jpg',
			'preview_url'					=> 'http://demo.terra-themes.com/meteorite-construction/',
		),
		array(
			'import_file_name'				=> 'Law',
			'local_import_file'				=> trailingslashit( get_template_directory() ) . 'demo-content/law/demo-content.xml',
			'local_import_widget_file'		=> trailingslashit( get_template_directory() ) . 'demo-content/law/widgets.wie',
			'local_import_customizer_file' 	=> trailingslashit( get_template_directory() ) . 'demo-content/law/customizer.dat',
			'import_preview_image_url'		=> trailingslashit( get_template_directory_uri() ) . 'demo-content/law/preview_image_law.jpg',
			'preview_url'					=> 'http://demo.terra-themes.com/meteorite-law/',
		),
		array(
			'import_file_name'				=> 'Charity',
			'local_import_file'				=> trailingslashit( get_template_directory() ) . 'demo-content/charity/demo-content.xml',
			'local_import_widget_file'		=> trailingslashit( get_template_directory() ) . 'demo-content/charity/widgets.wie',
			'local_import_customizer_file' 	=> trailingslashit( get_template_directory() ) . 'demo-content/charity/customizer.dat',
			'import_preview_image_url'		=> trailingslashit( get_template_directory_uri() ) . 'demo-content/charity/preview_image_charity.jpg',
			'preview_url'					=> 'http://demo.terra-themes.com/meteorite-charity/',
		),
	);
}
add_filter( 'pt-ocdi/import_files', 'meteorite_import_files' );

/**
 * Define actions that happen after import
 */
function meteorite_after_import() {

	// Assign the menu
	$main_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
	set_theme_mod( 'nav_menu_locations', array(
			'primary' => $main_menu->term_id,
		)
	);

	// Asign the static front page and the blog page
	$front_page = get_page_by_title( 'Home' );
	$blog_page  = get_page_by_title( 'Blog' );


	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page -> ID );
	update_option( 'page_for_posts', $blog_page -> ID );

	// Assign the Front Page template
	update_post_meta( $front_page -> ID, '_wp_page_template', 'page-templates/page_page-builder.php' );

}
add_action( 'pt-ocdi/after_import', 'meteorite_after_import' );

/**
* Remove branding
*/
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

/**
 * Show a warning, if not all recommended plugins are activated
 */
function meteorite_import_intro_text( $default_text ) {
	if ( ! class_exists( 'Terra_Themes_Tools' ) || ! class_exists( 'Meteorite_Extensions' ) || ! class_exists( 'SiteOrigin_Panels' ) || ! class_exists( 'SiteOrigin_Widgets_Bundle' ) ) :
		$default_text .= '<div class="ocdi__intro-text" style="background-color: #F44336; color: #fff; margin: 25px 0; padding: 5px;">';
			$default_text .= '<p style="margin: 5px;">' . esc_html__( 'Please make sure that all recommended plugins are installed and activated. Otherwise the demo import may not work properly.', 'meteorite' ) . '<a href="' . admin_url( 'themes.php?page=meteorite-theme-info.php' ) . '" class="button" style="margin-left: 10px;">' . esc_html__( 'Go to recommended plugins', 'meteorite' ) . '</a></p>';
		$default_text .= '</div>';
	endif;
	$default_text .= '<div class="ocdi__intro-text" style="margin-bottom: 45px;">';
		$default_text .= '<h2>' . esc_html__( 'Choose one of the layouts', 'meteorite' ) . '</h2>';
		$default_text .= '<p>' . esc_html__( 'Take a look at the demo pages made for Meteorite and import them with just a few clicks.', 'meteorite' ) . '</p>';
	$default_text .= '</div>';
	return $default_text;

}
add_filter( 'pt-ocdi/plugin_intro_text', 'meteorite_import_intro_text' );
