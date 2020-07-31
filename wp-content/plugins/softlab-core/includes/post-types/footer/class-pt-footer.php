<?php
if(!class_exists('Softlab_Theme_Helper')){
    return;
}
/**
 * Class Team
 * @package PostType
 */
class Footer {
    /**
     * @var string
     *
     * Set post type params
     */
    private $type = 'footer';
    private $slug;
    private $name;
    private $plural_name;

    /**
     * Team constructor.
     *
     * When class is instantiated
     */
    public function __construct() {
        // Register the post type
        $this->name = __( 'Footer', 'softlab-core' );
        $this->slug = 'footer';
        $this->plural_name = __( 'Footers', 'softlab-core' );

        add_action('init', array($this, 'register'));
        add_action('template_redirect', array( $this, 'restrict_ui'));
    }

    /**
     * Register post type
     */
    public function register() {
        $labels = array(
            'name'                  => $this->name,
            'singular_name'         => $this->name,
            'add_new'               => sprintf( __('Add New %s', 'softlab-core' ), $this->name ),
            'add_new_item'          => sprintf( __('Add New %s', 'softlab-core' ), $this->name ),
            'edit_item'             => sprintf( __('Edit %s', 'softlab-core'), $this->name ),
            'new_item'              => sprintf( __('New %s', 'softlab-core'), $this->name ),
            'all_items'             => sprintf( __('All %s', 'softlab-core'), $this->plural_name ),
            'view_item'             => sprintf( __('View %s', 'softlab-core'), $this->name ),
            'search_items'          => sprintf( __('Search %s', 'softlab-core'), $this->name ),
            'not_found'             => sprintf( __('No %s found' , 'softlab-core'), strtolower($this->name) ),
            'not_found_in_trash'    => sprintf( __('No %s found in Trash', 'softlab-core'), strtolower($this->name) ),
            'parent_item_colon'     => '',
            'menu_name'             => $this->name
        );
        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'exclude_from_search'   => true,
            'show_in_nav_menus'     => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'rewrite'               => false,
            'menu_position' =>  5,
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'menu_icon'  =>  'dashicons-admin-page',
        );
        register_post_type( $this->type, $args );
    }

    function restrict_ui (){
        if ( is_singular( $this->type ) && ! current_user_can( 'edit_posts' ) ) {
            wp_safe_redirect( site_url(), 301 );
            die;
        }
    }
}