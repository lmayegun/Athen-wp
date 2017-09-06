<?php
/**
 * Description : Staff Post-type configuration class. 
 * 
 * @package     Athen
 * @subpackage  Closer - Controller
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

class Athen_Staff_Config {

	/**
	 * Get things started.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function __construct() {

		// Helper functions
		add_action( 'after_setup_theme', array( &$this, 'helpers' ), 10 );

		// Adds the staff post type
		add_action( 'init', array( &$this, 'register_post_type' ), 0 );

		// Adds the staff taxonomies
		add_action( 'init', array( &$this, 'register_tags' ), 0 );
		add_action( 'init', array( &$this, 'register_categories' ), 0 );

		// Adds columns in the admin view for taxonomies
		add_filter( 'manage_edit-staff_columns', array( &$this, 'edit_columns' ) );
		add_action( 'manage_staff_posts_custom_column', array( &$this, 'column_display' ), 10, 2 );

		// Allows filtering of posts by taxonomy in the admin view
		add_action( 'restrict_manage_posts', array( &$this, 'tax_filters' ) );

		// Create Editor for altering the post type arguments
		add_action( 'admin_menu', array( &$this, 'add_page' ) );
		add_action( 'admin_init', array( &$this,'register_page_options' ) );
		add_action( 'admin_notices', array( &$this, 'notices' ) );

		// Adds the staff custom sidebar
		add_filter( 'widgets_init', array( &$this, 'register_sidebar' ), 10 );
		add_filter( 'athen_get_sidebar', array( &$this, 'display_sidebar' ), 10 );

		// Alter the post layouts for staff posts and archives
		add_filter( 'athen_post_layout_class', array( &$this, 'layouts' ), 10 );

		// Add subheading for staff member if enabled
		add_filter( 'athen_post_subheading', array( &$this, 'add_position_to_subheading' ), 10 );

		// Posts per page
		add_action( 'pre_get_posts', array( &$this, 'posts_per_page' ), 10 );

		// Add image sizes
		add_filter( 'athen_image_sizes', array( &$this, 'add_image_sizes' ), 10 );

		// Single next/prev visibility
		add_filter( 'athen_has_next_prev', array( &$this, 'next_prev' ) );

		// Tweak page header title
		add_filter( 'athen_title', array( &$this, 'athen_title' ) );

		// Add gallery metabox to staff
		add_filter( 'athen_gallery_metabox_post_types', array( &$this, 'add_gallery_metabox' ), 20 );

		// Return true for social share check so it can use the builder
		add_filter( 'athen_has_social_share', array( &$this, 'social_share' ) );
		
	}

	/**
	 * Helper functions.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function helpers() {
		require_once( ATHEN_FRAMEWORK_DIR .'post-types/staff-helpers.php' );
	}
	
	/**
	 * Register post type.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function register_post_type() {

		// Get values and sanitize
		$name           = get_theme_mod( 'staff_labels' );
		$name           = $name ? $name : __( 'Staff', 'athen_transl' );
		$singular_name  = get_theme_mod( 'staff_singular_name' );
		$singular_name  = $singular_name ? $singular_name : __( 'Staff Item', 'athen_transl' );
		$slug           = get_theme_mod( 'staff_slug' );
		$slug           = $slug ? $slug : 'staff-member';
		$menu_icon      = get_theme_mod( 'staff_admin_icon' );
		$menu_icon      = $menu_icon ? $menu_icon : 'groups';
		$staff_search   = get_theme_mod( 'staff_search', true );
		$staff_search   = ! $staff_search ? true : false;

		// Labels
		$labels = array(
			'name'                  => $name,
			'singular_name'         => $singular_name,
			'add_new'               => __( 'Add New', 'athen_transl' ),
			'add_new_item'          => __( 'Add New Item', 'athen_transl' ),
			'edit_item'             => __( 'Edit Item', 'athen_transl' ),
			'new_item'              => __( 'Add New Staff Item', 'athen_transl' ),
			'view_item'             => __( 'View Item', 'athen_transl' ),
			'search_items'          => __( 'Search Items', 'athen_transl' ),
			'not_found'             => __( 'No Items Found', 'athen_transl' ),
			'not_found_in_trash'    => __( 'No Items Found In Trash', 'athen_transl' )
		);

		// Args
		$args = array(
			'labels'                => $labels,
			'public'                => true,
			'supports'              => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'comments',
				'custom-fields',
				'revisions',
				'author',
				'page-attributes',
			),
			'capability_type'       => 'post',
			'rewrite'               => array(
				'slug'  => $slug,
			),
			'has_archive'           => false,
			'menu_icon'             => 'dashicons-'. $menu_icon,
			'menu_position'         => 20,
			'exclude_from_search'   => $staff_search,
		);

		// Apply filters
		$args = apply_filters( 'athen_staff_args', $args );

		// Register the post type
		register_post_type( 'staff', $args );

	}

	/**
	 * Register Staff tags.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function register_tags() {

		// Define and sanitize options
		$name   = get_theme_mod( 'staff_tag_labels');
		$name   = $name ? $name : __( 'Staff Tags', 'athen_transl' );
		$slug   = get_theme_mod( 'staff_tag_slug' );
		$slug   = $slug ? $slug : 'staff-tag';

		// Define staff tag labels
		$labels = array(
			'name'                          => $name,
			'singular_name'                 => $name,
			'menu_name'                     => $name,
			'search_items'                  => __( 'Search Staff Tags', 'athen_transl' ),
			'popular_items'                 => __( 'Popular Staff Tags', 'athen_transl' ),
			'all_items'                     => __( 'All Staff Tags', 'athen_transl' ),
			'parent_item'                   => __( 'Parent Staff Tag', 'athen_transl' ),
			'parent_item_colon'             => __( 'Parent Staff Tag:', 'athen_transl' ),
			'edit_item'                     => __( 'Edit Staff Tag', 'athen_transl' ),
			'update_item'                   => __( 'Update Staff Tag', 'athen_transl' ),
			'add_new_item'                  => __( 'Add New Staff Tag', 'athen_transl' ),
			'new_item_name'                 => __( 'New Staff Tag Name', 'athen_transl' ),
			'separate_items_with_commas'    => __( 'Separate staff tags with commas', 'athen_transl' ),
			'add_or_remove_items'           => __( 'Add or remove staff tags', 'athen_transl' ),
			'choose_from_most_used'         => __( 'Choose from the most used staff tags', 'athen_transl' ),
		);

		// Define staff tag arguments
		$args = array(
			'labels'                => $labels,
			'public'                => true,
			'show_in_nav_menus'     => true,
			'show_ui'               => true,
			'show_tagcloud'         => true,
			'hierarchical'          => false,
			'rewrite'               => array(
				'slug'  => $slug,
			),
			'query_var'             => true
		);

		// Apply filters for child theming
		$args = apply_filters( 'athen_taxonomy_staff_tag_args', $args );

		// Register the staff tag taxonomy
		register_taxonomy( 'staff_tag', array( 'staff' ), $args );

	}

	/**
	 * Register Staff category.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function register_categories() {

		// Define and sanitize options
		$name   = get_theme_mod( 'staff_cat_labels');
		$name   = $name ? $name : __( 'Staff Categories', 'athen_transl' );
		$slug   = get_theme_mod( 'staff_cat_slug' );
		$slug   = $slug ? $slug : 'staff-category';

		// Define staff category labels
		$labels = array(
			'name'                          => $name,
			'singular_name'                 => $name,
			'menu_name'                     => $name,
			'search_items'                  => __( 'Search','athen_transl' ),
			'popular_items'                 => __( 'Popular', 'athen_transl' ),
			'all_items'                     => __( 'All', 'athen_transl' ),
			'parent_item'                   => __( 'Parent', 'athen_transl' ),
			'parent_item_colon'             => __( 'Parent', 'athen_transl' ),
			'edit_item'                     => __( 'Edit', 'athen_transl' ),
			'update_item'                   => __( 'Update', 'athen_transl' ),
			'add_new_item'                  => __( 'Add New', 'athen_transl' ),
			'new_item_name'                 => __( 'New', 'athen_transl' ),
			'separate_items_with_commas'    => __( 'Separate with commas', 'athen_transl' ),
			'add_or_remove_items'           => __( 'Add or remove', 'athen_transl' ),
			'choose_from_most_used'         => __( 'Choose from the most used', 'athen_transl' ),
		);

		// Define staff category arguments
		$args = array(
			'labels'                => $labels,
			'public'                => true,
			'show_in_nav_menus'     => true,
			'show_ui'               => true,
			'show_tagcloud'         => true,
			'hierarchical'          => true,
			'rewrite'               => array(
				'slug'  => $slug
			),
			'query_var'             => true
		);

		// Apply filters for child theming
		$args = apply_filters( 'athen_taxonomy_staff_category_args', $args );

		// Register the staff category taxonomy
		register_taxonomy( 'staff_category', array( 'staff' ), $args );

	}


	/**
	 * Adds columns to the WP dashboard edit screen.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function edit_columns( $columns ) {
		$columns['staff_category']  = __( 'Category', 'athen_transl' );
		$columns['staff_tag']       = __( 'Tags', 'athen_transl' );
		return $columns;
	}
	

	/**
	 * Adds columns to the WP dashboard edit screen.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function column_display( $column, $post_id ) {

		switch ( $column ) :

			// Display the staff categories in the column view
			case 'staff_category':

				if ( $category_list = get_the_term_list( $post_id, 'staff_category', '', ', ', '' ) ) {
					echo $category_list;
				} else {
					echo '&mdash;';
				}

			break;

			// Display the staff tags in the column view
			case 'staff_tag':

				if ( $tag_list = get_the_term_list( $post_id, 'staff_tag', '', ', ', '' ) ) {
					echo $tag_list;
				} else {
					echo '&mdash;';
				}

			break;

		endswitch;

	}

	/**
	 * Adds taxonomy filters to the staff admin page.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function tax_filters() {
		global $typenow;

		// An array of all the taxonomyies you want to display. Use the taxonomy name or slug
		$taxonomies = array( 'staff_category', 'staff_tag' );

		// must set this to the post type you want the filter(s) displayed on
		if ( 'staff' == $typenow ) {

			foreach ( $taxonomies as $tax_slug ) {
				$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
				$tax_obj = get_taxonomy( $tax_slug );
				$tax_name = $tax_obj->labels->name;
				$terms = get_terms($tax_slug);
				if ( count( $terms ) > 0) {
					echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
					echo "<option value=''>$tax_name</option>";
					foreach ( $terms as $term ) {
						echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
					}
					echo "</select>";
				}
			}
		}
	}

	/**
	 * Add sub menu page for the Staff Editor.
	 *
	 * @link    http://codex.wordpress.org/Function_Reference/add_theme_page
	 * @since   2.0.0
	 * @access  public
	 */
	public function add_page() {
		add_submenu_page(
			'edit.php?post_type=staff',
			__( 'Post Type Editor', 'athen_transl' ),
			__( 'Post Type Editor', 'athen_transl' ),
			'administrator',
			'wpex-staff-editor',
			array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Function that will register the staff editor admin page.
	 *
	 * @link    http://codex.wordpress.org/Function_Reference/register_setting
	 * @since   2.0.0
	 * @access  public
	 */
	public function register_page_options() {
		register_setting( 'athen_staff_options', 'athen_staff_branding', array( $this, 'sanitize' ) );
	}

	/**
	 * Displays saved message after settings are successfully saved.
	 *
	 * @link    http://codex.wordpress.org/Function_Reference/settings_errors
	 * @since   2.0.0
	 * @access  public
	 */
	public function notices() {
		settings_errors( 'athen_staff_editor_page_notices' );
	}

	/**
	 * Sanitizes input and saves theme_mods.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function sanitize( $options ) {

		// Save values to theme mod
		if ( ! empty ( $options ) ) {
			foreach( $options as $key => $value ) {
				set_theme_mod( $key, $value );
			}
		}

		// Add notice
		add_settings_error(
			'athen_staff_editor_page_notices',
			esc_attr( 'settings_updated' ),
			__( 'Settings saved.', 'athen_transl' ),
			'updated'
		);

		// Lets delete the options as we are saving them into theme mods
		$options = '';
		return $options;
	}

	/**
	 * Output for the actual Staff Editor admin page.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function create_admin_page() { ?>
		<div class="wrap">
			<h2><?php _e( 'Post Type Editor', 'athen_transl' ); ?></h2>
			<form method="post" action="options.php">
				<?php settings_fields( 'athen_staff_options' ); ?>
				<p><?php _e( 'If you alter any slug\'s make sure to reset your permalinks to prevent 404 errors.', 'athen_transl' ); ?></p>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php _e( 'Admin Icon', 'athen_transl' ); ?></th>
						<td>
							<?php
							// Dashicons select
							$dashicons = array('admin-appearance','admin-collapse','admin-comments','admin-generic','admin-home','admin-media','admin-network','admin-page','admin-plugins','admin-settings','admin-site','admin-tools','admin-users','align-center','align-left','align-none','align-right','analytics','arrow-down','arrow-down-alt','arrow-down-alt2','arrow-left','arrow-left-alt','arrow-left-alt2','arrow-right','arrow-right-alt','arrow-right-alt2','arrow-up','arrow-up-alt','arrow-up-alt2','art','awards','backup','book','book-alt','businessman','calendar','camera','cart','category','chart-area','chart-bar','chart-line','chart-pie','clock','cloud','dashboard','desktop','dismiss','download','edit','editor-aligncenter','editor-alignleft','editor-alignright','editor-bold','editor-customchar','editor-distractionfree','editor-help','editor-indent','editor-insertmore','editor-italic','editor-justify','editor-kitchensink','editor-ol','editor-outdent','editor-paste-text','editor-paste-word','editor-quote','editor-removeformatting','editor-rtl','editor-spellcheck','editor-strikethrough','editor-textcolor','editor-ul','editor-underline','editor-unlink','editor-video','email','email-alt','exerpt-view','facebook','facebook-alt','feedback','flag','format-aside','format-audio','format-chat','format-gallery','format-image','format-links','format-quote','format-standard','format-status','format-video','forms','googleplus','groups','hammer','id','id-alt','image-crop','image-flip-horizontal','image-flip-vertical','image-rotate-left','image-rotate-right','images-alt','images-alt2','info','leftright','lightbulb','list-view','location','location-alt','lock','marker','menu','migrate','minus','networking','no','no-alt','performance','plus','staff','post-status','pressthis','products','redo','rss','screenoptions','search','share','share-alt','share-alt2','share1','shield','shield-alt','slides','smartphone','smiley','sort','sos','star-empty','star-filled','star-half','tablet','tag','testimonial','translation','trash','twitter','undo','update','upload','vault','video-alt','video-alt2','video-alt3','visibility','welcome-add-page','welcome-comments','welcome-edit-page','welcome-learn-more','welcome-view-site','welcome-widgets-menus','wordpress','wordpress-alt','yes');
							$dashicons = array_combine( $dashicons, $dashicons ); ?>
							<select name="athen_staff_branding[staff_admin_icon]">
								<option value="0"><?php _e( 'Select', 'athen_transl' ); ?></option>
								<?php foreach ( $dashicons as $dashicon ) { ?>
									<option value="<?php echo $dashicon; ?>" <?php selected( athen_get_mod( 'staff_admin_icon' ), $dashicon, true ); ?>><?php echo $dashicon; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e( 'Post Type: Name', 'athen_transl' ); ?></th>
						<td><input type="text" name="athen_staff_branding[staff_labels]" value="<?php echo athen_get_mod( 'staff_labels' ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e( 'Post Type: Singular Name', 'athen_transl' ); ?></th>
						<td><input type="text" name="athen_staff_branding[staff_singular_name]" value="<?php echo athen_get_mod( 'staff_singular_name' ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e( 'Post Type: Slug', 'athen_transl' ); ?></th>
						<td><input type="text" name="athen_staff_branding[staff_slug]" value="<?php echo athen_get_mod( 'staff_slug' ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e( 'Tags: Label', 'athen_transl' ); ?></th>
						<td><input type="text" name="athen_staff_branding[staff_tag_labels]" value="<?php echo athen_get_mod( 'staff_tag_labels' ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e( 'Tags: Slug', 'athen_transl' ); ?></th>
						<td><input type="text" name="athen_staff_branding[staff_tag_slug]" value="<?php echo athen_get_mod( 'staff_tag_slug' ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e( 'Categories: Label', 'athen_transl' ); ?></th>
						<td><input type="text" name="athen_staff_branding[staff_cat_labels]" value="<?php echo athen_get_mod( 'staff_cat_labels' ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e( 'Categories: Slug', 'athen_transl' ); ?></th>
						<td><input type="text" name="athen_staff_branding[staff_cat_slug]" value="<?php echo athen_get_mod( 'staff_cat_slug' ); ?>" /></td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
	<?php }

	/**
	 * Registers a new custom staff sidebar.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function register_sidebar() {


		// Return if custom sidebar is disabled
		if ( ! athen_get_mod( 'staff_custom_sidebar', true ) ) {
			return;
		}

		// Get heading tag
		$heading_tag = athen_get_mod( 'sidebar_headings', 'div' );
		$heading_tag = $heading_tag ? $heading_tag : 'div';

		// Get post type object to name sidebar correctly
		$obj            = get_post_type_object( 'staff' );
		$post_type_name = $obj->labels->name;

		// Register staff_sidebar
		register_sidebar( array (
			'name'          => $post_type_name .' '. __( 'Sidebar', 'athen_transl' ),
			'id'            => 'staff_sidebar',
			'before_widget' => '<div class="sidebar-box %2$s clr">',
			'after_widget'  => '</div>',
			'before_title'  => '<'. $heading_tag .' class="widget-title">',
			'after_title'   => '</'. $heading_tag .'>',
		) );
	}

	/**
	 * Alter main sidebar to display staff sidebar.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function display_sidebar( $sidebar ) {
		if ( athen_get_mod( 'staff_custom_sidebar', true ) && ( is_singular( 'staff' ) || athen_is_staff_tax() ) ) {
			$sidebar = 'staff_sidebar';
		}
		return $sidebar;
	}

	/**
	 * Alter the post layouts for staff posts and archives.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function layouts( $class ) {
		if ( is_singular( 'staff' ) ) {
			$class = athen_get_mod( 'staff_single_layout', 'right-sidebar' );
		} elseif ( athen_is_staff_tax() && ! is_search() ) {
			$class = athen_get_mod( 'staff_archive_layout', 'full-width' );
		}
		return $class;
	}

	/**
	 * Display position for page header subheading.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function add_position_to_subheading( $subheading ) {

		// Display position for subheading under title
		if ( is_singular( 'staff' )
			&& athen_get_mod( 'staff_subheading_position', true )
			&& ! in_array( 'title', athen_staff_post_blocks() )
			&& $meta = get_post_meta( get_the_ID(), 'athen_staff_position', true )
		) {
				$subheading = $meta;
		}
		
		// Return subheading
		return $subheading;

	}

	/**
	 * Alters posts per page for the staff taxonomies.
	 *
	 * @since   2.0.0
	 * @access  public
	 * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
	 */
	public function posts_per_page( $query ) {
		if ( athen_is_staff_tax() && $query->is_main_query() ) {
			$query->set( 'posts_per_page', athen_get_mod( 'staff_archive_posts_per_page', '12' ) );
			return;
		}
	}

	/**
	 * Adds image sizes for the staff to the image sizes panel.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function add_image_sizes( $sizes ) {
		$obj            = get_post_type_object( 'staff' );
		$post_type_name = $obj->labels->singular_name;
		$new_sizes  = array(
			'staff_entry'   => array(
				'label'     => sprintf( __( '%s Entry', 'athen_transl' ), $post_type_name ),
				'width'     => 'staff_entry_image_width',
				'height'    => 'staff_entry_image_height',
				'crop'      => 'staff_entry_image_crop',
			),
			'staff_post'    => array(
				'label'     => sprintf( __( '%s Post', 'athen_transl' ), $post_type_name ),
				'width'     => 'staff_post_image_width',
				'height'    => 'staff_post_image_height',
				'crop'      => 'staff_post_image_crop',
			),
		);
		$sizes = array_merge( $sizes, $new_sizes );
		return $sizes;
	}

	/**
	 * Disables the next/previous links if disabled via the customizer.
	 *
	 * @since   2.0.0
	 * @access  public
	 * @return  bool
	 */
	public function next_prev( $return ) {
		if ( is_singular( 'staff' ) && ! athen_get_mod( 'staff_next_prev', true ) ) {
			$return = false;
		}
		return $return;
	}

	/**
	 * Tweak the page header
	 *
	 * @since   2.1.0
	 * @access  public
	 * @return  bool
	 */
	public function athen_title( $title ) {
		if ( is_singular( 'staff' ) && in_array( 'title', athen_staff_post_blocks() ) ) {
			$obj   = get_post_type_object( 'staff' );
			$title = $obj->labels->singular_name;
		}
		return $title;
	}

	/**
	 * Adds the staff post type to the gallery metabox post types array.
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function add_gallery_metabox( $types ) {
		$types[] = 'staff';
		return $types;
	}

	/**
	 * Enables social sharings
	 *
	 * @since   2.1.0
	 * @access  public
	 * @return  bool
	 */
	public function social_share( $return ) {
		if ( is_singular( 'staff' ) ) {
			$return = true;
		}
		return $return;
	}

}
$athen_staff_config = new Athen_Staff_Config;