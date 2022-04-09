<?php
/**
 * Your MA functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Your_MA
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ma_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Your MA, use a find and replace
		* to change 'ma' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'ma', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'ma' ),
		)
	);
	register_nav_menus(
		array(
			'menu-2' => esc_html__( 'Social', 'ma' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'ma_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'ma_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ma_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ma_content_width', 640 );
}
add_action( 'after_setup_theme', 'ma_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ma_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ma' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ma' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Area', 'ma' ),
			'id'            => 'footer-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'ma' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'ma_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ma_scripts() {
	wp_enqueue_style('ma-fonts','https://fonts.googleapis.com/css2?family=Cairo:wght@200&display=swap');
	wp_enqueue_style('ma-font-awesome','https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style( 'ma-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'ma-style', 'rtl', 'replace' );

	wp_enqueue_script( 'ma-navigation', get_template_directory_uri() . '/js/ma_nav.js', array('jquery'), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ma_scripts' );

/**
 * Add preconnect for Google fonts. (._.)
 */
function ma_resource_hints($urls, $relation_type){
 if(wp_style_is('ma-fonts','queue') && 'preconnect' === $relation_type){
	 $urls[]= array(
		'href'=>'https://fonts.gstatic.com',
		'crossorigin'
	 );}
	 if(wp_style_is('ma-font-awesome','queue') && 'preconnect'===$relation_type){
		 $urls[]= array(
			'href'=>'https://stackpath.bootstrapcdn.com',
			'crossorigin',
		 );
	 }
	 return $urls;
}
add_filter('wp_resource_hints','ma_resource_hints',1,2);
/**
 * disply theme information on admin dashboard. (._.)
 */
function ma_info() {
	$current_user = wp_get_current_user();
	echo  '<ul style="background-color:#def5ff; font-size:1rem; border:0.4rem dashed #f2f2f2; text-align: center; font-weight:bold;">
	<li>'.__('User Name: ','ma').$current_user->user_login.'</li>
	<li>'.__('Blog Name: ','ma'). get_bloginfo( 'name' ).'</li>
	<li>'.__('Theme Folder: ','ma').get_bloginfo( 'stylesheet_directory' ).'</li>
	<li>'.__('Language: ','ma').get_bloginfo( 'language' ).'</li>
	<li>'.__('RTL Status: ','ma').(is_rtl()==1 ? 'true' : 'false').'</li>
	</ul>';
	}
	function ma_addto_dashboard() {
		wp_add_dashboard_widget('admin_dashboard_widget', __('Site Information','ma'), 'ma_info');
	}
	add_action('wp_dashboard_setup', 'ma_addto_dashboard', 1 ); 

/* changing login page logo */
function ma_login_logo() { 
	$admin_logo_url = get_option('admin_logo_url');
	?>
	<style type="text/css">
		#login h1 a, .login h1 a {
			background-image: url(
				<?php echo $admin_logo_url;
				?>); 
		}
	</style>
	<?php }
	add_action( 'login_enqueue_scripts', 'ma_login_logo' );

/* changing admin bar logo */
function ma_admin_bar_logo() { ?>
	<style type="text/css">
		#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
		background-image: url(<?php echo get_stylesheet_directory_uri() ; ?>/images/logo2.png);
		background-position: center;
		background-repeat: no-repeat;
		color:rgba(0, 0, 0, 0);
		}
	</style>
	<?php } 
	add_action('wp_before_admin_bar_render', 'ma_admin_bar_logo');

/* changing dashboard footer */
function ma_change_footer () {
	$copyright = get_option( 'copyright', 'default_value' );
	$author = get_option( 'author', 'default_value' );
	$authorurl = get_option( 'authorurl', 'default_value' );
	echo '<span class="description">'.__($copyright,"ma").
	'<a href="'.__($authorurl).' "> '.__($author,"ma").'</a></span>';					 
}
// Admin panel footer
add_filter( 'admin_footer_text', 'ma_change_footer' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Load ma widget.
 */

 require get_template_directory(). '/inc/ma_widget.php';

 /**
 * Load ma dashboard files.
 */

require get_template_directory(). '/dashboard.php';
require get_template_directory(). '/info.php';