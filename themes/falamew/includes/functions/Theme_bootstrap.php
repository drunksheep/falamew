<?php

class Flm_bootstrapping
{
    // Bloginfo for themes and stylesheet_directory_uri for child themes
    var $basePath;

    function __construct()
    {
        // Theme base path
		$this->set_base_path( get_bloginfo('template_url') );

		// Theme Supports
		add_action('after_setup_theme', [$this, 'theme_supports']);

        // Enqueue styles and scripts
		add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
		add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
		add_action('admin_enqueue_scripts', [$this, 'enqueue_styles']);
		add_action('wp_enqueue_scripts', [$this, 'hoist_vars']);

		// remove scripts
		add_action('wp_enqueue_scripts', [$this, 'dequeue_scripts']);

		// remove styles
		add_action('wp_print_styles', [$this, 'dequeue_styles']);

		// fucking emojis
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );

        // // Nav menus
		// add_action('after_setup_theme', [$this, 'register_theme_menus']);
		
		// // Post types
		// add_action('init', [$this, 'register_theme_post_types']);

		// // Taxonomies
		// // add_action('init', [$this, 'register_theme_taxonomies']);

		// remove admin bar
		add_filter('show_admin_bar', '__return_false');

    }

	public function set_base_path($path)
	{
		$this->basePath = $path;
	}

	public function get_base_path() : string
	{
		return $this->basePath;
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script( 'app', get_template_directory_uri() . '/dist/app.js', null, null, true );
    }

    public function enqueue_styles()
	{
        wp_enqueue_style( 'stylesheet', get_template_directory_uri() . '/dist/main.css', null, null, 'all'	 );
	}


	public function hoist_vars()
	{
		$vars = [];
		$vars['adminURL'] = admin_url('admin-ajax.php');
		$vars['templateURL'] = get_template_directory_uri();
		$vars['homeURL'] = site_url('/');
		$vars['frontPage'] = is_front_page();
		$vars['currentPage'] = get_permalink(get_the_ID());
		$vars['currentID'] = get_the_ID();
		$vars = json_encode($vars);

		wp_localize_script('app', 'wpVars', array($vars) );
		
	}

	public function dequeue_styles()
	{
		wp_deregister_style('dashicons');
	}

	public function dequeue_scripts()
	{
		wp_deregister_script( 'wp-embed' );
	}

	public function theme_supports()
	{
		if ( function_exists('add_theme_support') ) {
			add_theme_support('post-thumbnails');
		}
    }

    public function register_theme_menus()
    {
        register_nav_menu('Menu Principal', 'Menu do Header');
	}
	
	public function register_theme_post_types() {

		// $labels = [
		// 	'name'                  => _x( 'Cases', 'Post type general name', 'textdomain' ),
		// 	'singular_name'         => _x( 'Case', 'Post type singular name', 'textdomain' ),
		// 	'menu_name'             => _x( 'Cases', 'Admin Menu text', 'textdomain' ),
		// 	'name_admin_bar'        => _x( 'Case', 'Add New on Toolbar', 'textdomain' ),
		// 	'add_new'               => __( 'Adicionar Novo', 'textdomain' ),
		// 	'add_new_item'          => __( 'Adicionar Novo Case', 'textdomain' ),
		// 	'new_item'              => __( 'Novo Case', 'textdomain' ),
		// 	'edit_item'             => __( 'Editar Case', 'textdomain' ),
		// 	'view_item'             => __( 'Ver Case', 'textdomain' ),
		// 	'all_items'             => __( 'Todos Cases', 'textdomain' ),
		// 	'search_items'          => __( 'Buscar Cases', 'textdomain' ),
		// 	'parent_item_colon'     => __( 'Parent Cases:', 'textdomain' ),
		// 	'not_found'             => __( 'Nenhum Case encontrado.', 'textdomain' ),
		// 	'not_found_in_trash'    => __( 'Nenhum Case encontrado no Lixo.', 'textdomain' ),
		// 	'featured_image'        => _x( 'Capa do Cases', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
		// 	'archives'              => _x( 'Arquivos do Case', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
		// 	'insert_into_item'      => _x( 'Inserir no Case', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
		// 	'uploaded_to_this_item' => _x( 'Fazer upload no Case', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
		// 	'filter_items_list'     => _x( 'Filtrar lista de Cases', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
		// ];
	
		// $args = [
		// 	'labels'             => $labels,
		// 	'public'             => true,
		// 	'publicly_queryable' => true,
		// 	'show_ui'            => true,
		// 	'show_in_menu'       => true,
		// 	'query_var'          => true,
		// 	'rewrite'            => [ 'slug' => 'case' ],
		// 	'capability_type'    => 'post',
		// 	'has_archive'        => true,
		// 	'hierarchical'       => false,
		// 	'menu_position'      => null,
		// 	'show_in_rest'		 => true,
		// 	'supports'           => [ 'editor', 'title' ],
		// ];
	
		// register_post_type( 'cases', $args );

	}

	public function register_theme_taxonomies()
	{
	}
}

$bootstrap = new Flm_bootstrapping();