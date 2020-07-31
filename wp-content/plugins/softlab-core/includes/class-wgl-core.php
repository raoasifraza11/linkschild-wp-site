<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://themeforest.net/user/webgeniuslab
 * @since      1.0.0
 *
 * @package    Softlab_Core
 * @subpackage Softlab_Core/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Softlab_Core
 * @subpackage Softlab_Core/includes
 * @author     WebGeniusLab <webgeniuslab@gmail.com>
 */
class Softlab_Core {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Softlab_Core_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'softlab-core';

		$this->load_dependencies();
		$this->set_locale();
		
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_cpt_hooks();

		add_filter('the_content', array($this, 'fix_shortcodes_autop'));
	}

	/**
	 * Create the ajax functionality of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function wgl_ajax_init (){	
		extract($_POST['data']);

		//Global variables blog
		global $wgl_blog_atts;
	    global $wgl_query_vars;

		$offset_items = (int) $offset_items;
		$items_load = (int) $items_load;

		$out = '';
		$post_type = isset($query_args['post_type']) ? esc_attr($query_args['post_type']) : "";
	    
	    $atts = isset($_POST['data']['atts']) ? $_POST['data']['atts'] : $_POST['data'];
	    list($query_args) = Softlab_Loop_Settings::buildQuery($atts);
	    
	    $query_args['post_type'] = $post_type;
	    $query_args['order'] = isset($query_args['order']) ? $query_args['order'] : 'DESC';
	    $query_args['orderby'] = isset($query_args['orderby']) ? $query_args['orderby'] : 'date';
	    $query_args['offset'] = $offset_items;
	    $query_args['post_status'] = 'publish';
	    $query_args['posts_per_page'] = $items_load;

	    $query_args['update_post_meta_cache'] = false;
	    $query_args['update_post_term_cache'] = false;

	    $q = new WP_Query($query_args);

	    $found_posts = $q->found_posts;
	    
	    if( $offset_items + $items_load >= (int) $q->found_posts){
	    	$out .= "<div class='hidden_load_more'></div>";
	    }

	    switch ($post_type) {
	    	case 'portfolio':
	    		$custom_post = new WglPortfolio();
	    		$out .= $custom_post->output_loop_query($q, $_POST['data']);	
	    		break;    	
	    	
	    	default:
	    		$wgl_blog_atts = $_POST['data'];
	    		$wgl_query_vars = $q;
	    		$out .= get_template_part('templates/post/post', isset($blog_style) ? $blog_style : 'standard');
	    		break;
	    }  
	    
	    wp_reset_postdata();   
	    echo $out;
	    
	   	unset($wgl_blog_atts);
	   	unset($wgl_query_vars);
	   	
	    wp_die();
	}

	/**
	 * Create the ajax functionality mega menu of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function wgl_mega_menu_load_ajax (){	
		extract($_POST);

		//Global variables blog
		global $wgl_blog_atts;
	    global $wgl_query_vars;

		$out = '';
	    list($query_args) = Softlab_Loop_Settings::buildQuery($_POST);
	    
	    $query_args['cat'] = $id;
	    $query_args['order'] = 'DESC';
	    $query_args['orderby'] = 'date';
	    $query_args['post_status'] = 'publish';
	    $query_args['posts_per_page'] = $posts_count;

	    $query_args['no_found_rows'] = true;
	    $query_args['update_post_meta_cache'] = false;
	    $query_args['update_post_term_cache'] = false;

	    $q = $this->wgl_cache_query($query_args);	    

	    $wgl_blog_atts = $_POST;
	    $wgl_query_vars = $q;
	    $out .= get_template_part('templates/post/post', 'mega_menu');
	     
	    wp_reset_postdata();   

	    $out .= "<div class='items_id' data-identifier='".esc_attr($id)."'></div>";
	    echo $out;
	    
	   	unset($wgl_blog_atts);
	   	unset($wgl_query_vars);

	    wp_die();
	}

	/**
	 * Cache Query
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function wgl_cache_query($args = array()){
		
		$cache_key = http_build_query( $args );
		$custom_query = wp_cache_get( $cache_key, 'softlab_theme' );
		if ( false === $custom_query ) {
			$custom_query = new WP_Query( $args );
		    if ( ! is_wp_error( $custom_query ) && $custom_query->have_posts() ) {
		    	
		    	wp_cache_set( $cache_key, $custom_query, 'softlab_theme' );
		    }
		}
	  	return $custom_query;		
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Softlab_Core_Loader. Orchestrates the hooks of the plugin.
	 * - Softlab_Core_i18n. Defines internationalization functionality.
	 * - Softlab_Core_Admin. Defines all hooks for the admin area.
	 * - Softlab_Core_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wgl-core-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wgl-core-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wgl-core-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wgl-core-public.php';

		/**
		 * Include Redux Framework.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/framework/class.redux-plugin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/framework/init.php';

		/**
		 * Include Redux Framework Loader https://github.com/reduxframework/redux-extensions-loader
		 */	
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/redux-extension-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/extensions/wbc_importer/redux-importer-config.php';

		/**
		 * Include MetaBoxes IO.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/meta-box/meta-box.php';	
		
		/**
		 * Include MetaBoxes IO Addon.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/meta-box-extensions/social_field.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/meta-box-extensions/select_icon_field.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/meta-box-extensions/heading_field.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/meta-box-extensions/background_field/background_field.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/meta-box-extensions/offset_field.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/meta-box-extensions/font_field.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/meta-box-extensions/image-select_field.php';

		/**
		 * Post type register
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/post-types-register.php';
		/**
		 * Include Theme Helper
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/theme-helper-functions.php';

		/**
		 * Include Theme Helper Class.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/theme-helper/theme-helper.php';
		
		/**
		 * Include likes.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/wgl_likes/likes.php';

		/**
		 * Include Aqua Resizer.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/aq_resizer/aq_resizer.php';

		/**
		 * Include Widgets.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/posts.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/posts_hero.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/author.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/banner.php';
		
		$this->loader = new Softlab_Core_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Softlab_Core_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Softlab_Core_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Softlab_Core_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Softlab_Core_Public( $this->get_plugin_name(), $this->get_version() );

		/*$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );*/

		add_action( 'wp_ajax_wgl_ajax', array($this, 'wgl_ajax_init')  );
		add_action( 'wp_ajax_nopriv_wgl_ajax', array($this, 'wgl_ajax_init') );
	
		add_action( 'wp_ajax_wgl_mega_menu_load_ajax', array($this, 'wgl_mega_menu_load_ajax')  );
		add_action( 'wp_ajax_nopriv_wgl_mega_menu_load_ajax', array($this, 'wgl_mega_menu_load_ajax') );
	}

	/**
	 * Fix Shortcode
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function fix_shortcodes_autop($content){
	    $array = array (
	        '<p>[' => '[',
	        ']</p>' => ']',
	        ']<br />' => ']'
	    );

	    $content = strtr($content, $array);
	    return $content;
	}

	/**
	 * Register 'custom' post type.
	 *
	 * @since  1.0.0
	 * @access private
	 */
	private function define_cpt_hooks() {
		$plugin_cpt = WglPostTypesRegister::getInstance();
		// Add post type.
		$this->loader->add_action( 'after_setup_theme', $plugin_cpt, 'init' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Softlab_Core_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
