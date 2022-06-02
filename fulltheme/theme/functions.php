<?php
/**
 * ReplaceThis functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ReplaceThis
 */

if ( ! defined( 'UPBDS_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'UPBDS_VERSION', '1.0.0' );
}

if ( ! function_exists( 'upbds_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function upbds_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ReplaceThis, use a find and replace
		 * to change 'replacethis' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'replacethis', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'replacethis' ),
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
				'upbds_custom_background_args',
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

		/**
		 * Add responsive embeds and block editor styles.
		 */
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'style-editor.css' );
	}
endif;
add_action( 'after_setup_theme', 'upbds_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function upbds_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'upbds_content_width', 640 );
}
add_action( 'after_setup_theme', 'upbds_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function upbds_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'replacethis' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'replacethis' ),
			'before_widget' => '<section id="%1$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar( array(
		'name'          => 'Header',
		'id'            => 'header',
		'description'   => '.',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<!--',
		'after_title'   => '-->',
	));
	register_sidebar( array(
		'name'          => 'Footer',
		'id'            => 'footer',
		'description'   => '.',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<!--',
		'after_title'   => '-->',
	));
}
add_action( 'widgets_init', 'upbds_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function upbds_scripts() {
	wp_enqueue_style( 'replacethis-style', get_stylesheet_directory_uri() . '/style.css', array(), filemtime( get_stylesheet_directory() . '/style.css' ) );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'upbds_scripts' );

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
 * ACF Blocks
 */

add_action('block_categories_all', 'upbds_category', 10, 2);
function upbds_category($categories)
{
	return array_merge(
		$categories,
		[
			[
				'slug'  => 'upbrands',
				'title' => 'UpBrands!',
			],
		]
	);
}

add_action('acf/init', 'upbrands_blocks');
function upbrands_blocks()
{

	// Check function exists.
	if (function_exists('acf_register_block_type')) {

		// Register header block.
		acf_register_block_type(array(
			'name'              => 'header',
			'title'             => __('Header'),
			'description'       => __('Displays the header in a block fashion.'),
			'render_template'   => 'template-parts/blocks/header.php',
			'category'          => 'upbrands',
			'icon'              => 'arrow-up-alt',
			'keywords'          => array('header', 'upbrands'),
			'align'							=> 'full',
			'mode'						  => 'edit',
			'enqueue_assets'	  => function () {
				wp_enqueue_script('header', get_template_directory_uri() . '/template-parts/blocks/header.js', array('jquery'), '1.0.0', true);
			},
		));

		// Register carousel block.
		acf_register_block_type(array(
			'name'              => 'example-carousel',
			'title'             => __('Example Carousel'),
			'description'       => __(''),
			'render_template'   => 'template-parts/blocks/example-carousel.php',
			'category'          => 'upbrands',
			'icon'              => 'admin-home',
			'keywords'          => array('carousel', 'upbrands'),
			'align'							=> 'full',
			'enqueue_assets' 		=> function () {
				wp_enqueue_style('tiny-css', 'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css', array(), '2.9.2');
				wp_enqueue_style('example-carousel', get_template_directory_uri() . '/template-parts/blocks/example-carousel.css', array(), '1.0.0');
				wp_enqueue_script('tiny-js', 'https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js', array(), '2.9.2', true);
				wp_enqueue_script('example-carousel', get_template_directory_uri() . '/template-parts/blocks/example-carousel.js', array('jquery'), '1.0.0', true);
			},
		));

		// Register footer block.
		acf_register_block_type(array(
			'name'              => 'footer',
			'title'             => __('Footer'),
			'description'       => __('Displays the footer in a block fashion.'),
			'render_template'   => 'template-parts/blocks/footer.php',
			'category'          => 'upbrands',
			'icon'              => 'arrow-down-alt',
			'keywords'          => array('footer', 'upbrands'),
			'align'							=> 'full',
			'mode'						  => 'edit'
		));
	}
}
