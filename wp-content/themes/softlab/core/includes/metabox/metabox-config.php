<?php 


if (!class_exists( 'RWMB_Loader' )) {
	return;
}
class Softlab_Metaboxes{
	public function __construct(){
		//Team Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'team_meta_boxes' ) );

		//Portfolio Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'portfolio_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'portfolio_post_settings_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'portfolio_related_meta_boxes' ) );

		//Blog Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'blog_settings_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'blog_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'blog_related_meta_boxes' ));
		
		//Page Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_layout_meta_boxes' ) );
		//Colors Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_color_meta_boxes' ) );		
		//Logo Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_logo_meta_boxes' ) );		
		//Header Builder Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_header_meta_boxes' ) );
		//Title Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_title_meta_boxes' ) );
		//Side Panel Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_side_panel_meta_boxes' ) );		

		//Social Shares Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_soc_icons_meta_boxes' ) );	
		//Footer Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_footer_meta_boxes' ) );				
		//Copyright Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_copyright_meta_boxes' ) );		
	} 

	public function team_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Team Options', 'softlab' ),
	        'post_types' => array( 'team' ),
	        'context' => 'advanced',
	        'fields'     => array(
	        	array(
		            'name' => esc_html__( 'Info Name Department', 'softlab' ),
		            'id'   => 'department_name',
		            'type' => 'text',
		            'class' => 'name-field'
		        ),       
	        	array(
		            'name' => esc_html__( 'Member Department', 'softlab' ),
		            'id'   => 'department',
		            'type' => 'text',
		            'class' => 'field-inputs'
				),
				array(
					'name' => esc_html__( 'Member Info', 'softlab' ),
		            'id'   => 'info_items',
		            'type' => 'social',
		            'clone' => true,
		            'sort_clone'     => true,
		            'options' => array(
						'name'    => array(
							'name' => esc_html__( 'Name', 'softlab' ),
							'type_input' => 'text'
							),
						'description' => array(
							'name' => esc_html__( 'Description', 'softlab' ),
							'type_input' => 'text'
							),
						'link' => array(
							'name' => esc_html__( 'Link', 'softlab' ),
							'type_input' => 'text'
							),
					),
		        ),		
		        array(
					'name'     => esc_html__( 'Social Icons', 'softlab' ),
					'id'          => "soc_icon",
					'type'        => 'select_icon',
					'options'     => WglAdminIcon()->get_icons_name(),
					'clone' => true,
					'sort_clone'     => true,
					'placeholder' => esc_html__( 'Select an icon', 'softlab' ),
					'multiple'    => false,
					'std'         => 'default',
				),
		        array(
					'name'             => esc_html__( 'Info Background Image', 'softlab' ),
					'id'               => "mb_info_bg",
					'type'             => 'file_advanced',
					'max_file_uploads' => 1,
					'mime_type'        => 'image',
				), 
	        ),
	    );
	    return $meta_boxes;
	}
	
	public function portfolio_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Portfolio Options', 'softlab' ),
	        'post_types' => array( 'portfolio' ),
	        'context' => 'advanced',
	        'fields'     => array(
	        	array(
					'id'   => 'mb_portfolio_featured_img',
					'name' => esc_html__( 'Show Featured image on single', 'softlab' ),
					'type' => 'switch',
					'std' => 'true',
				),        	
				array(
					'id'   => 'mb_portfolio_title',
					'name' => esc_html__( 'Show Title on single', 'softlab' ),
					'type' => 'switch',
					'std' => 'true',
				),	
				array(
					'id'   => 'mb_portfolio_link',
					'name' => esc_html__( 'Add Custom Link for Portfolio Grid', 'softlab' ),
					'type' => 'switch',
				),
				array(
                    'name' => esc_html__( 'Custom Url for Portfolio Grid', 'softlab' ),
                    'id'   => 'portfolio_custom_url',
                    'type' => 'text',
					'class' => 'field-inputs',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_portfolio_link','=','1')
							),
						),
					),
                ),
                array(
                    'id'   => 'portfolio_custom_url_target',
                    'name' => esc_html__( 'Open Custom Url in New Window', 'softlab' ),
                    'type' => 'switch',
                    'std' => 'true',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_portfolio_link','=','1')
							),
						),
					),
                ),
				array(
					'name' => esc_html__( 'Info', 'softlab' ),
		            'id'   => 'mb_portfolio_info_items',
		            'type' => 'social',
		            'clone' => true,
		            'sort_clone'     => true,
		            'desc' => esc_html__( 'Description', 'softlab' ),
		            'options' => array(
						'name'    => array(
							'name' => esc_html__( 'Name', 'softlab' ),
							'type_input' => 'text'
							),
						'description' => array(
							'name' => esc_html__( 'Description', 'softlab' ),
							'type_input' => 'text'
							),
						'link' => array(
							'name' => esc_html__( 'Url', 'softlab' ),
							'type_input' => 'text'
							),
					),
		        ),		
		        array(
					'name'     => esc_html__( 'Info Description', 'softlab' ),
					'id'          => "mb_portfolio_editor",
					'type'        => 'wysiwyg',
					'multiple'    => false,
					'desc' => esc_html__( 'Info description is shown in one row with a main info', 'softlab' ),
				),			
		        array(
					'name'     => esc_html__( 'Categories On/Off', 'softlab' ),
					'id'          => "mb_portfolio_single_meta_categories",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'softlab' ),
						'yes' => esc_html__( 'On', 'softlab' ),
						'no' => esc_html__( 'Off', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => 'default',
				),			
		        array(
					'name'     => esc_html__( 'Date On/Off', 'softlab' ),
					'id'          => "mb_portfolio_single_meta_date",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'softlab' ),
						'yes' => esc_html__( 'On', 'softlab' ),
						'no' => esc_html__( 'Off', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => 'default',
				),			
		        array(
					'name'     => esc_html__( 'Tags On/Off', 'softlab' ),
					'id'          => "mb_portfolio_above_content_cats",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'softlab' ),
						'yes' => esc_html__( 'On', 'softlab' ),
						'no' => esc_html__( 'Off', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => 'default',
				),		
		        array(
					'name'     => esc_html__( 'Share Links On/Off', 'softlab' ),
					'id'          => "mb_portfolio_above_content_share",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'softlab' ),
						'yes' => esc_html__( 'On', 'softlab' ),
						'no' => esc_html__( 'Off', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => 'default',
				),	
	        ),
	    );
	    return $meta_boxes;
	}

	public function portfolio_post_settings_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Portfolio Post Settings', 'softlab' ),
	        'post_types' => array( 'portfolio' ),
	        'context' => 'advanced',
	        'fields'     => array(
				array(
					'name'     => esc_html__( 'Post Layout', 'softlab' ),
					'id'          => "mb_portfolio_post_conditional",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'softlab' ),
						'custom' => esc_html__( 'Custom', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => 'default',
				),        
				array(
					'name'     => esc_html__( 'Post Layout Settings', 'softlab' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_post_conditional','=','custom')
						)),
					),
				),  	    
				array(
					'name'     => esc_html__( 'Post Layout', 'softlab' ),
					'id'          => "mb_portfolio_single_type_layout",
					'type'        => 'button_group',
					'options'     => array(
						'1' => esc_html__( 'Title First', 'softlab' ),
						'2' => esc_html__( 'Image First', 'softlab' ),
						'3' => esc_html__( 'Overlay Image', 'softlab' ),
						'4' => esc_html__( 'Overlay Image with Info', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => '2',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_portfolio_post_conditional','=','custom')
							),
						),
					),
				), 
				array(
					'name'     => esc_html__( 'Alignment', 'softlab' ),
					'id'          => "mb_portfolio_single_align",
					'type'        => 'button_group',
					'options'     => array(
						'left' => esc_html__( 'Left', 'softlab' ),
						'center' => esc_html__( 'Center', 'softlab' ),
						'right' => esc_html__( 'Right', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => 'left',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_portfolio_post_conditional','=','custom')
							),
						),
					),
				), 
				array(
					'name' => esc_html__( 'Spacing', 'softlab' ),
					'id'   => 'mb_portfolio_single_padding',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_post_conditional','=','custom'),
							array('mb_portfolio_single_type_layout','!=','1'),
							array('mb_portfolio_single_type_layout','!=','2'),
						)),
					),
					'std' => array(
						'padding-top' => '165',
						'padding-bottom' => '165'
					)
				),
				array(
					'id'   => 'mb_portfolio_parallax',
					'name' => esc_html__( 'Add Portfolio Parallax', 'softlab' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_post_conditional','=','custom'),
							array('mb_portfolio_single_type_layout','!=','1'),
							array('mb_portfolio_single_type_layout','!=','2'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Prallax Speed', 'softlab' ),
					'id'   => "mb_portfolio_parallax_speed",
					'type' => 'number',
					'std'  => 0.3,
					'step' => 0.1,
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_post_conditional','=','custom'),
							array('mb_portfolio_single_type_layout','!=','1'),
							array('mb_portfolio_single_type_layout','!=','2'),
							array('mb_portfolio_parallax','=',true),
						)),
					),
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function portfolio_related_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Related Portfolio', 'softlab' ),
	        'post_types' => array( 'portfolio' ),
	        'context' => 'advanced',
	        'fields'     => array(
				array(
					'id'       => 'mb_portfolio_related_switch',
					'name'     => esc_html__( 'Portfolio Related', 'softlab' ),
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'softlab' ),
						'on' => esc_html__( 'On', 'softlab' ),
						'off' => esc_html__( 'Off', 'softlab' ),
					),
					'inline'   => true,
					'multiple' => false,
					'std'      => 'default'
				),
				array(
					'name'     => esc_html__( 'Portfolio Related Settings', 'softlab' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),
	        	array(
					'id'   => 'mb_pf_carousel_r',
					'name' => esc_html__( 'Display items carousel for this portfolio post', 'softlab' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Title', 'softlab' ),
					'id'   => "mb_pf_title_r",
					'type' => 'text',
					'std'  => esc_html__( 'Related Portfolio', 'softlab' ),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				), 			
				array(
					'name' => esc_html__( 'Categories', 'softlab' ),
					'id'   => "mb_pf_cat_r",
					'multiple'    => true,
					'type' => 'taxonomy_advanced',
					'taxonomy' => 'portfolio-category',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),     
				array(
					'name'     => esc_html__( 'Columns', 'softlab' ),
					'id'          => "mb_pf_column_r",
					'type'        => 'button_group',
					'options'     => array(
						'2' => esc_html__( '2', 'softlab' ),
						'3' => esc_html__( '3', 'softlab' ),
						'4' => esc_html__( '4', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => '3',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),  
				array(
					'name' => esc_html__( 'Number of Related Items', 'softlab' ),
					'id'   => "mb_pf_number_r",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 3,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_portfolio_related_switch','=','on')
						)),
					),
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function blog_settings_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Post Settings', 'softlab' ),
	        'post_types' => array( 'post' ),
	        'context' => 'advanced',
	        'fields'     => array(
				array(
					'name'     => esc_html__( 'Post Layout', 'softlab' ),
					'id'          => "mb_post_layout_conditional",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'softlab' ),
						'custom' => esc_html__( 'Custom', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => 'default',
				),        
				array(
					'name'     => esc_html__( 'Post Layout Settings', 'softlab' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_post_layout_conditional','=','custom')
						)),
					),
				),  	    
				array(
					'name'     => esc_html__( 'Post Layout', 'softlab' ),
					'id'          => "mb_single_type_layout",
					'type'        => 'button_group',
					'options'     => array(
						'1' => esc_html__( 'Title First', 'softlab' ),
						'2' => esc_html__( 'Image First', 'softlab' ),
						'3' => esc_html__( 'Overlay Image', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => '1',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_post_layout_conditional','=','custom')
							),
						),
					),
				), 
				array(
					'name' => esc_html__( 'Spacing', 'softlab' ),
					'id'   => 'mb_single_padding_layout_3',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_post_layout_conditional','=','custom'),
							array('mb_single_type_layout','=','3'),
						)),
					),
					'std' => array(
						'padding-top' => '372',
						'padding-bottom' => '72'
					)
				),
				array(
					'id'   => 'mb_single_apply_animation',
					'name' => esc_html__( 'Apply Animation', 'softlab' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_post_layout_conditional','=','custom'),
							array('mb_single_type_layout','=','3'),
						)),
					),
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function blog_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Post Format Layout', 'softlab' ),
			'post_types' => array( 'post' ),
			'context' => 'advanced',
			'fields'     => array(
				// Standard Post Format
				array(
					'name'             => esc_html__( 'Standard Post( Enabled only Featured Image for this post format)', 'softlab' ),
					'id'               => "post_format_standard",
					'type'             => 'static-text',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('formatdiv','=','0')
							),
						),
					),
				),
				// Gallery Post Format  
				array(
					'name'     => esc_html__( 'Gallery Settings', 'softlab' ),
					'type'     => 'wgl_heading',
				),  
				array(
					'name'             => esc_html__( 'Add Images', 'softlab' ),
					'id'               => "post_format_gallery",
					'type'             => 'image_advanced',
					'max_file_uploads' => '',
				),
				// Video Post Format
				array(
					'name'     => esc_html__( 'Video Settings', 'softlab' ),
					'type'     => 'wgl_heading',
				), 
				array(
					'name' => esc_html__( 'Video Style', 'softlab' ),
					'id'   => "post_format_video_style",
					'type'        => 'select',
					'options'     => array(
						'bg_video' => esc_html__( 'Background Video', 'softlab' ),
						'popup' => esc_html__( 'Popup', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => 'bg_video',
				),	
				array(
					'name' => esc_html__( 'Start Video', 'softlab' ),
					'id'   => "start_video",
					'type' => 'number',
					'std'  => '0',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('post_format_video_style','=','bg_video'),
							),
						),
					),
				),				
				array(
					'name' => esc_html__( 'End Video', 'softlab' ),
					'id'   => "end_video",
					'type' => 'number',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('post_format_video_style','=','bg_video'),
							),
						),
					),
				),	
				array(
					'name' => esc_html__( 'oEmbed URL', 'softlab' ),
					'id'   => "post_format_video_url",
					'type' => 'oembed',
				),
				// Quote Post Format
				array(
					'name'     => esc_html__( 'Quote Settings', 'softlab' ),
					'type'     => 'wgl_heading',
				), 
				array(
					'name'             => esc_html__( 'Quote Text', 'softlab' ),
					'id'               => "post_format_qoute_text",
					'type'             => 'textarea',
				),
				array(
					'name'             => esc_html__( 'Author Name', 'softlab' ),
					'id'               => "post_format_qoute_name",
					'type'             => 'text',
				),			
				array(
					'name'             => esc_html__( 'Author Position', 'softlab' ),
					'id'               => "post_format_qoute_position",
					'type'             => 'text',
				),
				array(
					'name'             => esc_html__( 'Author Avatar', 'softlab' ),
					'id'               => "post_format_qoute_avatar",
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
				// Audio Post Format
				array(
					'name'     => esc_html__( 'Audio Settings', 'softlab' ),
					'type'     => 'wgl_heading',
				), 
				array(
					'name' => esc_html__( 'oEmbed URL', 'softlab' ),
					'id'   => "post_format_audio_url",
					'type' => 'oembed',
				),
				// Link Post Format
				array(
					'name'     => esc_html__( 'Link Settings', 'softlab' ),
					'type'     => 'wgl_heading',
				), 
				array(
					'name'             => esc_html__( 'URL', 'softlab' ),
					'id'               => "post_format_link_url",
					'type'             => 'url',
				),
				array(
					'name'             => esc_html__( 'Text', 'softlab' ),
					'id'               => "post_format_link_text",
					'type'             => 'text',
				),
			)
		);
		return $meta_boxes;
	}

	public function blog_related_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Related Blog Post', 'softlab' ),
	        'post_types' => array( 'post' ),
	        'context' => 'advanced',
	        'fields'     => array(        	
				array(
					'id'   => 'mb_blog_show_r',
					'name' => esc_html__( 'Related On/Off', 'softlab' ),
					'type' => 'switch',
					'std'  => 1,
				),
				array(
					'name'     => esc_html__( 'Related Settings', 'softlab' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_blog_show_r','=','1')
						)),
					),
				), 
				array(
					'name' => esc_html__( 'Title', 'softlab' ),
					'id'   => "mb_blog_title_r",
					'type' => 'text',
					'std'  => 'Related Posts',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_blog_show_r','=','1')
							),
						),
					),
				), 			
				array(
					'name' => esc_html__( 'Categories', 'softlab' ),
					'id'   => "mb_blog_cat_r",
					'multiple'    => true,
					'type' => 'taxonomy_advanced',
					'taxonomy' => 'category',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_blog_show_r','=','1')
							),
						),
					),
				),     
				array(
					'name'     => esc_html__( 'Columns', 'softlab' ),
					'id'          => "mb_blog_column_r",
					'type'        => 'button_group',
					'options'     => array(
						'12' => esc_html__( '1', 'softlab' ),
						'6' => esc_html__( '2', 'softlab' ),
						'4' => esc_html__( '3', 'softlab' ),
						'3' => esc_html__( '4', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => '6',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_blog_show_r','=','1')
							),
						),
					),
				),  
				array(
					'name' => esc_html__( 'Number of Related Items', 'softlab' ),
					'id'   => "mb_blog_number_r",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 2,
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_blog_show_r','=','1')
							),
						),
					),
				),
	        	array(
					'id'   => 'mb_blog_carousel_r',
					'name' => esc_html__( 'Display items carousel for this blog post', 'softlab' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_blog_show_r','=','1')
							),
						),
					),
				),  
	        ),
	    );
	    return $meta_boxes;
	}

	public function page_layout_meta_boxes( $meta_boxes ) {

	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Page Layout', 'softlab' ),
	        'post_types' => array( 'page' , 'post', 'team', 'practice','portfolio' ),
	        'context' => 'advanced',
	        'fields'     => array(
				array(
					'name'     => esc_html__( 'Page Sidebar Layout', 'softlab' ),
					'id'          => "mb_page_sidebar_layout",
					'type'        => 'wgl_image_select',
					'options'     => array(
						'default' => get_template_directory_uri() . '/core/admin/img/options/1c.png',
						'none'    => get_template_directory_uri() . '/core/admin/img/options/none.png',
						'left'    => get_template_directory_uri() . '/core/admin/img/options/2cl.png',
						'right'   => get_template_directory_uri() . '/core/admin/img/options/2cr.png',
					),
					'std'         => 'default',
				),
				array(
					'name'     => esc_html__( 'Sidebar Settings', 'softlab' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_sidebar_layout','!=','default'),
							array('mb_page_sidebar_layout','!=','none'),
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Page Sidebar', 'softlab' ),
					'id'          => "mb_page_sidebar_def",
					'type'        => 'select',
					'placeholder' => 'Select a Sidebar',
					'options'     => softlab_get_all_sidebar(),
					'multiple'    => false,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_sidebar_layout','!=','default'),
							array('mb_page_sidebar_layout','!=','none'),
						)),
					),
				),			
				array(
					'name'     => esc_html__( 'Page Sidebar Width', 'softlab' ),
					'id'          => "mb_page_sidebar_def_width",
					'type'        => 'button_group',
					'options'     => array(	
						'9' => esc_html( '25%' ),
						'8' => esc_html( '33%' ),
					),
					'std'  => '9',
					'multiple'    => false,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_sidebar_layout','!=','default'),
							array('mb_page_sidebar_layout','!=','none'),
						)),
					),
				),
				array(
					'id'   => 'mb_sticky_sidebar',
					'name' => esc_html__( 'Sticky Sidebar On?', 'softlab' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_sidebar_layout','!=','default'),
							array('mb_page_sidebar_layout','!=','none'),
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Sidebar Side Gap', 'softlab' ),
					'id'          => "mb_sidebar_gap",
					'type'        => 'select',
					'options'     => array(	
						'def' => 'Default',
	                    '0' => '0',     
	                    '15' => '15',     
	                    '20' => '20',     
	                    '25' => '25',     
	                    '30' => '30',     
	                    '35' => '35',     
	                    '40' => '40',     
	                    '45' => '45',     
	                    '50' => '50', 
					),
					'std'         => 'def',
					'multiple'    => false,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_sidebar_layout','!=','default'),
							array('mb_page_sidebar_layout','!=','none'),
						)),
					),
				),
	        )
	    );
	    return $meta_boxes;
	}

	public function page_color_meta_boxes( $meta_boxes ) {

	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Page Colors', 'softlab' ),
	        'post_types' => array( 'page' , 'post', 'team', 'practice','portfolio' ),
	        'context' => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Page Colors', 'softlab' ),
					'id'          => "mb_page_colors_switch",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'softlab' ),
						'custom' => esc_html__( 'Custom', 'softlab' ),
					),
					'inline'   		=> true,
					'multiple'    => false,
					'std'         => 'default',
				),
				array(
					'name'     => esc_html__( 'Colors Settings', 'softlab' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch','=','custom')
						)),
					),
				),
				array(
					'name'     	=> esc_html__( 'General Theme Color', 'softlab' ),
	                'id'        => 'mb_page_theme_color',
	                'type'      => 'color',
	                'std'         => '#fdb900',
					'js_options' => array(
						'defaultColor' => '#fdb900',
					),
	                'validate'  => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch','=','custom'),
						)),
					),
	            ),
				array(
					'name'     	=> esc_html__( 'Body Background Color', 'softlab' ),
	                'id'        => 'mb_body_background_color',
	                'type'      => 'color',
	                'std'         => '#ffffff',
					'js_options' => array(
						'defaultColor' => '#ffffff',
					),
	                'validate'  => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch','=','custom'),
						)),
					),
	            ),
				array(
					'name'     => esc_html__( 'Scroll Up Settings', 'softlab' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch','=','custom')
						)),
					),
				),
				array(
					'name'     	=> esc_html__( 'Button Background Color', 'softlab' ),
	                'id'        => 'mb_scroll_up_bg_color',
	                'type'      => 'color',
	                'std'         => '#ffffff',
					'js_options' => array(
						'defaultColor' => '#ffffff',
					),
	                'validate'  => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch','=','custom'),
						)),
					),
	            ),				
	            array(
					'name'     	=> esc_html__( 'Button Arrow Color', 'softlab' ),
	                'id'        => 'mb_scroll_up_arrow_color',
	                'type'      => 'color',
	                'std'         => '#664bc4',
					'js_options' => array(
						'defaultColor' => '#664bc4',
					),
	                'validate'  => 'color',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_colors_switch','=','custom'),
						)),
					),
	            ),
	        )
	    );
	    return $meta_boxes;
	}

	public function page_logo_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Logo', 'softlab' ),
	        'post_types' => array( 'page', 'post' ),
	        'context' => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Logo', 'softlab' ),
					'id'          => "mb_customize_logo",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'softlab' ),
						'custom' => esc_html__( 'Custom', 'softlab' ),
					),
					'multiple'    => false,
					'inline'    => true,
					'std'         => 'default',
				),
				array(
					'name'     => esc_html__( 'Logo Settings', 'softlab' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'name'             => esc_html__( 'Header Logo', 'softlab' ),
					'id'               => "mb_header_logo",
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'id'   => 'mb_logo_height_custom',
					'name' => esc_html__( 'Enable Logo Height', 'softlab' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
					    	array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Set Logo Height', 'softlab' ),
					'id'   => "mb_logo_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 50,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom'),
							array('mb_logo_height_custom','=',true)
						)),
					),
				),
				array(
					'name'             => esc_html__( 'Sticky Logo', 'softlab' ),
					'id'               => "mb_logo_sticky",
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'id'   => 'mb_sticky_logo_height_custom',
					'name' => esc_html__( 'Enable Sticky Logo Height', 'softlab' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
					    	array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Set Sticky Logo Height', 'softlab' ),
					'id'   => "mb_sticky_logo_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom'),
							array('mb_sticky_logo_height_custom','=',true),
						)),
					),
				),
				array(
					'name'             => esc_html__( 'Mobile Logo', 'softlab' ),
					'id'               => "mb_logo_mobile",
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'id'   => 'mb_mobile_logo_height_custom',
					'name' => esc_html__( 'Enable Mobile Logo Height', 'softlab' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
					    	array('mb_customize_logo','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Set Mobile Logo Height', 'softlab' ),
					'id'   => "mb_mobile_logo_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_logo','=','custom'),
							array('mb_mobile_logo_height_custom','=',true),
						)),
					),
				),
	        )
	    );
	    return $meta_boxes;
	}	

	public function page_header_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Header', 'softlab' ),
	        'post_types' => array( 'page', 'post', 'portfolio' ),
	        'context' => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Header Settings', 'softlab' ),
					'id'          => "mb_customize_header_layout",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'default', 'softlab' ),
						'custom' => esc_html__( 'custom', 'softlab' ),
						'hide' => esc_html__( 'hide', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => 'default',
				),
	        	array(
					'name'     => esc_html__( 'Header Builder', 'softlab' ),
					'id'          => "mb_customize_header",
					'type'        => 'select',
					'options'     => softlab_get_custom_preset(),
					'multiple'    => false,
					'std'         => 'default',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_header_layout','!=','hide')
						)),
					),
				),			
				// It is works 
				array(
					'id'   => 'mb_menu_header',
					'name' => esc_html__( 'Menu ', 'softlab' ),
					'type' => 'select',
					'options'     => softlab_get_custom_menu(),
					'multiple'    => false,
					'std'         => 'default',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_header_layout','=','custom')
						)),
					),
				),
				// It is works 
				array(
					'id'   => 'mb_mobile_menu_header',
					'name' => esc_html__( 'Mobile Menu ', 'softlab' ),
					'type' => 'select',
					'options'     => softlab_get_custom_menu(),
					'multiple'    => false,
					'std'         => 'default',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_header_layout','=','custom')
						)),
					),
				),
				array(
					'id'   => 'mb_header_sticky',
					'name' => esc_html__( 'Sticky Header', 'softlab' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_header_layout','=','custom')
						)),
					),
				),
	        )
	    );
	    return $meta_boxes;
	}

	public function page_title_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Page Title', 'softlab' ),
	        'post_types' => array( 'page', 'post', 'team', 'practice','portfolio' ),
	        'context' => 'advanced',
	        'fields'     => array(
				array(
					'id'       => 'mb_page_title_switch',
					'name'     => esc_html__( 'Page Title', 'softlab' ),
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'softlab' ),
						'on' => esc_html__( 'On', 'softlab' ),
						'off' => esc_html__( 'Off', 'softlab' ),
					),
					'inline'   => true,
					'multiple' => false,
					'std'      => 'default'
				),
				array(
					'name'     => esc_html__( 'Page Title Settings', 'softlab' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),
				array(
					'name'             => esc_html__( 'Background', 'softlab' ),
					'id'               => "mb_page_title_bg",
					'type'             => 'wgl_background',	
					'color'      	   => '',
				    'image'     	   => '',
				    'position'   	   => 'center bottom',
				    'attachment' 	   => 'scroll',
				    'size'       	   => 'cover',
				    'repeat'     	   => 'no-repeat',			
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),			
				array( 
					'name' => esc_html__( 'Height', 'softlab' ),
					'id'   => 'mb_page_title_height',
					'type' => 'number',
					'std'  => 378,
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Text Align', 'softlab' ),
					'id'       => 'mb_page_title_align',
					'type'     => 'button_group',
					'options'  => array(
						'left' => esc_html__( 'left', 'softlab' ),
						'center' => esc_html__( 'center', 'softlab' ),
						'right' => esc_html__( 'right', 'softlab' ),
					),
					'multiple' => false,
					'std'         => 'left',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Padding Top/Bottom', 'softlab' ),
					'id'   => 'mb_page_title_padding',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => array(
						'padding-top'    => '60',
						'padding-bottom' => '155',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Margin Bottom', 'softlab' ),
					'id'   => "mb_page_title_margin",
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'margin',
						'top'    => false,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => array(
						'margin-bottom' => '40',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),
				array(
					'id'   => 'mb_page_title_parallax',
					'name' => esc_html__( 'Add Page Title Parallax', 'softlab' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Prallax Speed', 'softlab' ),
					'id'   => "mb_page_title_parallax_speed",
					'type' => 'number',
					'std'  => 0.3,
					'step' => 0.1,
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(
							array('mb_page_title_parallax','=',true),
							array('mb_page_title_switch','=','on'),
						)),
					),
				),
				array(
					'id'   => 'mb_page_change_tile_switch',
					'name' => esc_html__( 'Custom Page Title', 'softlab' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),		
				array(
		            'name' => esc_html__( 'Page Title', 'softlab' ),
		            'id'   => 'mb_page_change_tile',
		            'type' => 'text',
		            'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
					    	array('mb_page_change_tile_switch','=',1),
							array('mb_page_title_switch','=','on'),
						)),
					),
		        ),		
				array(
					'id'   => 'mb_page_title_breadcrumbs_switch',
					'name' => esc_html__( 'Show Breadcrumbs', 'softlab' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				), 
				array(
					'name'     => esc_html__( 'Page Title Typography', 'softlab' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title Font', 'softlab' ),
					'id'   => 'mb_page_title_font',
					'type' => 'wgl_font',
					'options' => array(
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					),
					'std' => array(
						'font-size' => '42',
						'line-height' => '72',
						'color' => '#161616',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title Breadcrumbs Font', 'softlab' ),
					'id'   => 'mb_page_title_breadcrumbs_font',
					'type' => 'wgl_font',
					'options' => array(
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					),
					'std' => array(
						'font-size' => '16',
						'line-height' => '24',
						'color' => '#8b9baf',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),
								array(
					'name'     => esc_html__( 'Responsive Layout', 'softlab' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),
				array(
					'id'   => 'mb_page_title_resp_switch',
					'name' => esc_html__( 'Responsive Layout On/Off', 'softlab' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on')
						)),
					),
				),
				array( 
					'name' => esc_html__( 'Switch to responsive in the resolution', 'softlab' ),
					'id'   => 'mb_page_title_resp_resolution',
					'type' => 'number',
					'std'  => 768,
					'min'  => 1,
					'step' => 1,
				    'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
						)),
					),
				),
				array( 
					'name' => esc_html__( 'Height', 'softlab' ),
					'id'   => 'mb_page_title_resp_height',
					'type' => 'number',
					'std'  => 378,
					'min'  => 0,
					'step' => 1,
				    'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Padding Top/Bottom', 'softlab' ),
					'id'   => 'mb_page_title_resp_padding',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => array(
						'padding-top'    => '15',
						'padding-bottom' => '40',
					),
				    'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title Font', 'softlab' ),
					'id'   => 'mb_page_title_resp_font',
					'type' => 'wgl_font',
					'options' => array(
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					),
					'std' => array(
						'font-size' => '42',
						'line-height' => '72',
						'color' => '#161616',
					),
				    'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
						)),
					),
				),
				array(
					'id'   => 'mb_page_title_resp_breadcrumbs_switch',
					'name' => esc_html__( 'Show Breadcrumbs', 'softlab' ),
					'type' => 'switch',
					'std'  => 1,
				    'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
						)),
					),
				),
				array(
					'name' => esc_html__( 'Page Title Breadcrumbs Font', 'softlab' ),
					'id'   => 'mb_page_title_resp_breadcrumbs_font',
					'type' => 'wgl_font',
					'options' => array(
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					),
					'std' => array(
						'font-size' => '16',
						'line-height' => '24',
						'color' => '#8b9baf',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_page_title_switch','=','on'),
							array('mb_page_title_resp_switch','=','1'),
							array('mb_page_title_resp_breadcrumbs_switch','=','1'),
						)),
					),
				),
	        ),
	    );
	    return $meta_boxes;
	}

	public function page_side_panel_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Side Panel', 'softlab' ),
	        'post_types' => array( 'page' ),
	        'context' => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Side Panel', 'softlab' ),
					'id'          => "mb_customize_side_panel",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'softlab' ),
						'custom' => esc_html__( 'Custom', 'softlab' ),
					),
					'multiple'    => false,
					'inline'    => true,
					'std'         => 'default',
				),
				array(
					'name'     => esc_html__( 'Side Panel Settings', 'softlab' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_side_panel','=','custom')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Text Color', 'softlab' ),
					'id'   => "mb_side_panel_text_color",
					'type' => 'color',
					'std'  => '#313538',
					'js_options' => array(
						'defaultColor' => '#313538',
					),
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(						
							array('mb_customize_side_panel','=','custom')
						)),
					),
				),				
				array(
					'name' => esc_html__( 'Background Color', 'softlab' ),
					'id'   => "mb_side_panel_bg",
					'type' => 'color',
					'std'  => '#ffffff',
					'alpha_channel' => true,
					'js_options' => array(
						'defaultColor' => '#ffffff',
					),
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(						
							array('mb_customize_side_panel','=','custom')
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Text Align', 'softlab' ),
					'id'          => "mb_side_panel_text_alignment",
					'type'        => 'button_group',
					'options'     => array(
						'left' => esc_html__( 'Left', 'softlab' ),
						'center' => esc_html__( 'Center', 'softlab' ),
						'right' => esc_html__( 'Right', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => 'center',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_customize_side_panel','=','custom')
							),
						),
					),
				),
				array(
					'name' => esc_html__( 'Width', 'softlab' ),
					'id'   => "mb_side_panel_width",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 480,
					'attributes' => array(
						'data-conditional-logic'  =>  array( array(						
							array('mb_customize_side_panel','=','custom')
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Position', 'softlab' ),
					'id'          => "mb_side_panel_position",
					'type'        => 'button_group',
					'options'     => array(
						'left' => esc_html__( 'Left', 'softlab' ),
						'right' => esc_html__( 'Right', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => 'right',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_customize_side_panel','=','custom')
							),
						),
					),
				),
	        )
	    );
	    return $meta_boxes;
	}	

	public function page_soc_icons_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Social Shares', 'softlab' ),
	        'post_types' => array( 'page' ),
	        'context' => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Social Shares', 'softlab' ),
					'id'          => "mb_customize_soc_shares",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'softlab' ),
						'on' => esc_html__( 'On', 'softlab' ),
						'off' => esc_html__( 'Off', 'softlab' ),
					),
					'multiple'    => false,
					'inline'    => true,
					'std'         => 'default',
				),
				array(
					'name'     => esc_html__( 'Choose your share style.', 'softlab' ),
					'id'          => "mb_soc_icon_style",
					'type'        => 'button_group',
					'options'     => array(
						'standard' => esc_html__( 'Standard', 'softlab' ),
						'hovered' => esc_html__( 'Hovered', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => 'standard',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),				
				array(
					'id'   => 'mb_soc_icon_position',
					'name' => esc_html__( 'Fixed Position On/Off', 'softlab' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),
				array( 
					'name' => esc_html__( 'Offset Top(in percentage)', 'softlab' ),
					'id'   => 'mb_soc_icon_offset',
					'type' => 'number',
					'std'  => 50,
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
					'desc' => esc_html__( 'Measurement units defined as "percents" while position fixed is enabled, and as "pixels" while position is off.', 'softlab' ),
				),
				array(
					'id'   => 'mb_soc_icon_facebook',
					'name' => esc_html__( 'Facebook Share On/Off', 'softlab' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),				
				array(
					'id'   => 'mb_soc_icon_twitter',
					'name' => esc_html__( 'Twitter Share On/Off', 'softlab' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),				
				array(
					'id'   => 'mb_soc_icon_linkedin',
					'name' => esc_html__( 'Linkedin Share On/Off', 'softlab' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),					
				array(
					'id'   => 'mb_soc_icon_pinterest',
					'name' => esc_html__( 'Pinterest Share On/Off', 'softlab' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),				
				array(
					'id'   => 'mb_soc_icon_tumblr',
					'name' => esc_html__( 'Tumblr Share On/Off', 'softlab' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_customize_soc_shares','=','on')
						)),
					),
				),
				
	        )
	    );
	    return $meta_boxes;
	}

	public function page_footer_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Footer', 'softlab' ),
	        'post_types' => array( 'page' ),
	        'context' => 'advanced',
	        'fields'     => array(
	        	array(
					'name'     => esc_html__( 'Footer', 'softlab' ),
					'id'          => "mb_footer_switch",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'softlab' ),
						'on' => esc_html__( 'On', 'softlab' ),
						'off' => esc_html__( 'Off', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => 'default',
				),
				array(
					'name'     => esc_html__( 'Footer Settings', 'softlab' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				), 
				array(
					'id'   => 'mb_footer_add_wave',
					'name' => esc_html__( 'Add Wave', 'softlab' ),
					'type' => 'switch',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Set Wave Height', 'softlab' ),
					'id'   => "mb_footer_wave_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 158,
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
					    	array('mb_footer_switch','=','on'),
							array('mb_footer_add_wave','=','1')
						)),
					),
				),
				array(
					'name'     => esc_html__( 'Content Type', 'softlab' ),
					'id'          => 'mb_footer_content_type',
					'type'        => 'button_group',
					'options'     => array(
						'widgets' => esc_html__( 'Default', 'softlab' ),
						'pages' => esc_html__( 'Page', 'softlab' )		
					),
					'multiple'    => false,
					'std'         => 'widgets',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				),
				array(
	        		'name'        => 'Select a page',
					'id'          => 'mb_footer_page_select',
					'type'        => 'post',
					'post_type'   => 'footer',
					'field_type'  => 'select_advanced',
					'placeholder' => 'Select a page',
					'query_args'  => array(
					    'post_status'    => 'publish',
					    'posts_per_page' => - 1,
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on'),
							array('mb_footer_content_type','=','pages')
						)),
					),
	        	),
				array(
					'name' => esc_html__( 'Paddings', 'softlab' ),
					'id'   => 'mb_footer_spacing',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => true,
						'bottom' => true,
						'left'   => true,
					),
					'std' => array(
						'padding-top'    => '90',
						'padding-right'  => '0',
						'padding-bottom' => '60',
						'padding-left'   => '0'
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				),	
				array(
					'name'             => esc_html__( 'Background', 'softlab' ),
					'id'               => "mb_footer_bg",
					'type'             => 'wgl_background',	
					'color'      	   => '#2e323e',
				    'image'     	   => '',
				    'position'   	   => 'center center',
				    'attachment' 	   => 'scroll',
				    'size'       	   => 'cover',
				    'repeat'     	   => 'no-repeat',			
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_footer_switch','=','on')
						)),
					),
				),				
	        ),
	     );
	    return $meta_boxes;
	}	

	public function page_copyright_meta_boxes( $meta_boxes ) {
	    $meta_boxes[] = array(
	        'title'      => esc_html__( 'Copyright', 'softlab' ),
	        'post_types' => array( 'page' ),
	        'context' => 'advanced',
	        'fields'     => array(
				array(
					'name'     => esc_html__( 'Copyright', 'softlab' ),
					'id'          => "mb_copyright_switch",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'softlab' ),
						'on' => esc_html__( 'On', 'softlab' ),
						'off' => esc_html__( 'Off', 'softlab' ),
					),
					'multiple'    => false,
					'std'         => 'default',
				),
				array(
					'name'     => esc_html__( 'Copyright Settings', 'softlab' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_copyright_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Editor', 'softlab' ),
					'id'   => "mb_copyright_editor",
					'type' => 'textarea',
					'cols' => 20,
					'rows' => 3,
					'std'  => 'Copyright © 2019 Softlab by WebGeniusLab. All Rights Reserved',
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(						
							array('mb_copyright_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Text Color', 'softlab' ),
					'id'   => "mb_copyright_text_color",
					'type' => 'color',
					'std'  => '#838383',
					'js_options' => array(
						'defaultColor' => '#838383',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(						
							array('mb_copyright_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Background Color', 'softlab' ),
					'id'   => "mb_copyright_bg_color",
					'type' => 'color',
					'std'  => '#171a1e',
					'js_options' => array(
						'defaultColor' => '#171a1e',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(						
							array('mb_copyright_switch','=','on')
						)),
					),
				),
				array(
					'name' => esc_html__( 'Paddings', 'softlab' ),
					'id'   => 'mb_copyright_spacing',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => array(
						'padding-top'    => '10',
						'padding-bottom' => '10',
					),
					'attributes' => array(
					    'data-conditional-logic'  =>  array( array(
							array('mb_copyright_switch','=','on')
						)),
					),
				),
	        ),
	     );
	    return $meta_boxes;

	}

}
new Softlab_Metaboxes();

?>