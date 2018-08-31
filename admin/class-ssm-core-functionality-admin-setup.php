<?php

class SSM_Core_Functionality_Admin_Setup extends SSM_Core_Functionality_Admin {

    /**
	 * Remove unnecessary standard WP Roles
	 * @since 1.0.0
	 */
    public function remove_roles() {

		remove_role( 'subscriber' );
		remove_role( 'contributor' );
	
	}

	/**
	 * Remove default link for images
	 * @since 1.0.0
	 */
	public function remove_image_link() {

		$image_set = SSM::get_option( 'image_default_link_type' );
		
		if ($image_set !== 'none') {
			update_option('image_default_link_type', 'none');
		}
	}

	/**
	 * Show Kitchen Sink in WYSIWYG Editor by default
	 * @since 1.0.0
	 */
	public function show_kitchen_sink( $args ) {
		$args['wordpress_adv_hidden'] = false;
		return $args;
	}

	/**
	 * Disable unused widgets.
	 * @since 1.0.0
	 */
	public function remove_widgets() {

		unregister_widget( 'WP_Widget_Pages' );
		unregister_widget( 'WP_Widget_Calendar' );
		// unregister_widget( 'WP_Widget_Archives' );
		unregister_widget( 'WP_Widget_Meta' );
		unregister_widget( 'WP_Widget_Recent_Posts' );
		unregister_widget( 'WP_Widget_Recent_Comments' );
		unregister_widget( 'WP_Widget_RSS' );
		unregister_widget( 'WP_Widget_Tag_Cloud' );
	
    }
    
    /**
	 * Add SSM widget to the dashboard.
	 */
	public function hosting_dashboard_widget() {

		wp_add_dashboard_widget(
			'ssm_main_dashboard_widget', // Widget slug.
			'Managed Hosting by Secret Stache Media', // Title.
			array( $this, 'hosting_widget_function') // Display function.
		);  
	}
	
	/**
	 * Create the function to output the contents of our Dashboard Widget.
	 */
	public function hosting_widget_function() {
	
		$html = '<p>As a customer of our managed hosting service, you can rest assured that your software is kept up to date and served on the best hosting technology available.</p>';
		$html .= '<p>You are also covered by our <strong>Code Warantee</strong>, so if you see something that doesn\'t seem right, feel free to <a href="mailto:help@secretstache.com">reach out</a>.';
	
		echo $html;
	
	}

	/**
	 * Modifies the TinyMCE settings array
	 * @since 1.0.0
	 */
	public function update_tiny_mce( $init ) {

		$init['block_formats'] = 'Paragraph=p;Heading 2=h2; Heading 3=h3; Heading 4=h4; Blockquote=blockquote';
		return $init;
	
	}

	/**
	 * Remove <p> tags from around images
	 * See: http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
	 * @since 1.0.0
	 */
	public function remove_ptags_on_images( $content ) {

		return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	
	}

	/**
	 * Remove the injected styles for the [gallery] shortcode
	 * @since 1.0.0
	 */
	public function remove_gallery_styles( $css ) {

		return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
	
	}

	/**
	* Set Home Page Programmatically if a Page Called "Home" Exists
	* @since 1.0.0
	*/
	public function force_homepage() {
		$homepage = get_page_by_title( 'Home' );
	
		if ( $homepage ) {
			update_option( 'page_on_front', $homepage->ID );
			update_option( 'show_on_front', 'page' );
		}
	}

	/**
	* Removes unnecessary menu items from add new dropdown
	* @since 1.0.0
	*/
	public function remove_wp_nodes() {
		global $wp_admin_bar;
		
		$wp_admin_bar->remove_node( 'new-link' );
		$wp_admin_bar->remove_node( 'new-media' );
		$wp_admin_bar->remove_node( 'new-user' );
	}
	
	/**
	 * Filter Yoast SEO Metabox Priority
	 * @since 1.0.0
	 */
	public function yoast_seo_metabox_priority() {
		return 'low';
	}

	/**
	 * Remove Editor Support on Pages (Replaced with SSMPB)
	 * 
	 * @since 1.0.0
	 */
	public function remove_post_type_support() {
		remove_post_type_support( 'page', 'editor' );
	}

	/**
	 * Remove default dasboards
	 * 
	 * @since 1.0.0
	 */
	public function remove_dashboard_meta() {

		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
		remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'normal' );
		remove_meta_box( 'wpe_dify_news_feed', 'dashboard', 'normal' );
		remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' );
		remove_meta_box( 'ssm_main_dashboard_widget', 'dashboard', 'normal' );
	
	}

	/**
	 * Add SSM menu item
	 * 
	 * @since 1.0.0
	 */
	public function ssm_admin_menu() {

		add_menu_page(
			__( 'Secret Stache', 'ssm' ), // page_title
			'Secret Stache', // menu_title
			'manage_options', // capability
			'ssm', // menu_slug
			'', // function
			'dashicons-layout', // icon
			5 // position
		);

	}

	/**
	 * Move various menu items into LIB menu
	 * 
	 * @since 1.0.0
	 */
	public function move_cpts_to_admin_menu() {
	
		global $wp_post_types;
	
		if ( post_type_exists('insert_cpt') ) {
			$wp_post_types['insert_cpt']->show_in_menu = 'ssm';
		}
	
	}

	/**
	 * Filter the admin body classes if is_front
	 * 
	 * @since 1.0.0
	 */
	public function is_front_admin_body_class( $classes ) {
		
		global $post;
	
		$current_id = $post->ID;
		$front_page_id = SSM::get_option( 'page_on_front' );
	
		if ( $current_id == $front_page_id ) {
			return $classes = 'is-front';
		}
	
	}

	/**
	 * Update width post meta on AJAX call
	 * 
	 * @since 1.0.0
	 */
	public function update_width_post_meta( $post_ID, $post, $update ) {
	
		if ( isset( $_POST['columns_count'] ) ) {
	
			for ( $i = 0; $i < $_POST['columns_count']; $i++ ) { 

				if ( get_post_meta( $_POST['post_ID'], 'columns_width_' . $i ) ) {
					update_post_meta( $_POST['post_ID'], 'columns_width_' . $i, $_POST['columns_width_' . $i] );
				} else {
					add_post_meta( $_POST['post_ID'], 'columns_width_' . $i, $_POST['columns_width_' . $i] );       
				}
			}
		}
	}

	/**
	 * Get width values on AJAX call
	 * 
	 * @since 1.0.0
	 */
	public function get_width_values() {
		
		$response = array();
		
		for ( $i = 0; $i < $_POST['columns_count']; $i++ ) { 
			array_push( $response, get_post_meta( $_POST['page_id'], 'columns_width_' . $i, true ) );
		}
		
		echo json_encode( $response );
		wp_die();
	
	}

}