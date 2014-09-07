<?php
/**
 * MedSpeaks Events and Search Features
 * @package     MedSpeaks / Admin Functions and Post Types
 * @author      Ing. Nancy Barraza - Oc2Interactive.
 * @copyright   Copyright (c) 2014, Oc2Interactive, Inc.
 * @license     MIT 2014
 */


class MedSpeaks_Admin {

	public function __construct(){


        add_action('admin_enqueue_scripts', array( $this, 'custom_dashicons') );
		add_action( 'init', array($this,'mse_custom_post_type'), 0 );
		add_action( 'init', array($this,'mse_taxonomies'), 0 );
		add_filter('acf/load_field/name=mse_speaker', array($this,'speakers_load_field'));


	}


   public function custom_dashicons() {
       
       echo '<style>';
       echo '#menu-posts-medspeaksevents > a > div.wp-menu-image.dashicons-before.dashicons-admin-post:before, #adminmenu #toplevel_page_acf-options-settings .menu-icon-generic .wp-menu-image:before {
               content: "\f145";
       }
			#menu-posts-speakers > a > div.wp-menu-image.dashicons-before.dashicons-admin-post:before {
       	content: "\f307";
   }
       ';
       echo '</style>';
    
	}

	public function mse_custom_post_type() {

	$labels = array(
		'name'                => _x( 'MedSpeaks Events', 'Events', 'MedSpeaks' ),
		'singular_name'       => _x( 'Event', 'Event', 'MedSpeaks' ),
		'menu_name'           => __( 'Events', 'MedSpeaks' ),
		'parent_item_colon'   => __( 'Parent Event:', 'MedSpeaks' ),
		'all_items'           => __( 'All Events', 'MedSpeaks' ),
		'view_item'           => __( 'View Event', 'MedSpeaks' ),
		'add_new_item'        => __( 'Add New Event', 'MedSpeaks' ),
		'add_new'             => __( 'Add New', 'MedSpeaks' ),
		'edit_item'           => __( 'Edit Event', 'MedSpeaks' ),
		'update_item'         => __( 'Update Event', 'MedSpeaks' ),
		'search_items'        => __( 'Search Event', 'MedSpeaks' ),
		'not_found'           => __( 'Not found', 'MedSpeaks' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'MedSpeaks' ),
	);
	$args = array(
		'label'               => __( 'Events', 'MedSpeaks' ),
		'description'         => __( 'MedSpeaks Events', 'MedSpeaks' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'custom-fields' ),
		'taxonomies'          => array( 'mse_category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'MedSpeaks Events', $args );


	$labels = array(
		'name'                => _x( 'Speakers', 'Speakers', 'MedSpeaks' ),
		'singular_name'       => _x( 'Speaker', 'Speaker', 'MedSpeaks' ),
		'menu_name'           => __( 'Speakers', 'MedSpeaks' ),
		'parent_item_colon'   => __( 'Parent Speaker:', 'MedSpeaks' ),
		'all_items'           => __( 'All Speakers', 'MedSpeaks' ),
		'view_item'           => __( 'View Speaker', 'MedSpeaks' ),
		'add_new_item'        => __( 'Add New Speaker', 'MedSpeaks' ),
		'add_new'             => __( 'Add New', 'MedSpeaks' ),
		'edit_item'           => __( 'Edit Speaker', 'MedSpeaks' ),
		'update_item'         => __( 'Update Speaker', 'MedSpeaks' ),
		'search_items'        => __( 'Search Speaker', 'MedSpeaks' ),
		'not_found'           => __( 'Not found', 'MedSpeaks' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'MedSpeaks' ),
	);
	$args = array(
		'label'               => __( 'Speakers', 'MedSpeaks' ),
		'description'         => __( 'Speakers', 'MedSpeaks' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'custom-fields' ),
		'taxonomies'          => array( 'mse_category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'Speakers', $args );


}

public function mse_taxonomies() {

	$labels = array(
		'name'                       => _x( 'Events Categories', 'Taxonomy General Name', 'MedSpeaks' ),
		'singular_name'              => _x( 'Events Category', 'Taxonomy Singular Name', 'MedSpeaks' ),
		'menu_name'                  => __( 'Event Cateogry', 'MedSpeaks' ),
		'all_items'                  => __( 'Events Categories', 'MedSpeaks' ),
		'parent_item'                => __( 'Parent Event Category', 'MedSpeaks' ),
		'parent_item_colon'          => __( 'Parent Event Category', 'MedSpeaks' ),
		'new_item_name'              => __( 'New Event Category', 'MedSpeaks' ),
		'add_new_item'               => __( 'Add New Event Category', 'MedSpeaks' ),
		'edit_item'                  => __( 'Edit Event Category', 'MedSpeaks' ),
		'update_item'                => __( 'Update Event Category', 'MedSpeaks' ),
		'separate_items_with_commas' => __( 'Separate Categories with commas', 'MedSpeaks' ),
		'search_items'               => __( 'Search Event Categories', 'MedSpeaks' ),
		'add_or_remove_items'        => __( 'Add or Remove Event Cateogries', 'MedSpeaks' ),
		'choose_from_most_used'      => __( 'Choose from the most used event categories', 'MedSpeaks' ),
		'not_found'                  => __( 'Not Found', 'MedSpeaks' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'mse_category', array( 'medspeaksevents' ), $args );
	
	$labels = array(
		'name'                       => _x( 'Events Tags', 'Taxonomy General Name', 'MedSpeaks' ),
		'singular_name'              => _x( 'Events Tag', 'Taxonomy Singular Name', 'MedSpeaks' ),
		'menu_name'                  => __( 'Event Tag', 'MedSpeaks' ),
		'all_items'                  => __( 'Events Tags', 'MedSpeaks' ),
		'parent_item'                => __( 'Parent Event Tag', 'MedSpeaks' ),
		'parent_item_colon'          => __( 'Parent Event Tag', 'MedSpeaks' ),
		'new_item_name'              => __( 'New Event Tag', 'MedSpeaks' ),
		'add_new_item'               => __( 'Add New Event Tag', 'MedSpeaks' ),
		'edit_item'                  => __( 'Edit Event Tag', 'MedSpeaks' ),
		'update_item'                => __( 'Update Event Tag', 'MedSpeaks' ),
		'separate_items_with_commas' => __( 'Separate Tags with commas', 'MedSpeaks' ),
		'search_items'               => __( 'Search Event Tags', 'MedSpeaks' ),
		'add_or_remove_items'        => __( 'Add or Remove Event Tags', 'MedSpeaks' ),
		'choose_from_most_used'      => __( 'Choose from the most used event tags', 'MedSpeaks' ),
		'not_found'                  => __( 'Not Found', 'MedSpeaks' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'mse_tags', array( 'medspeaksevents' ), $args );

	$labels = array(
		'name'                       => _x( 'Events Topics', 'Taxonomy General Name', 'MedSpeaks' ),
		'singular_name'              => _x( 'Events Topic', 'Taxonomy Singular Name', 'MedSpeaks' ),
		'menu_name'                  => __( 'Event Topic', 'MedSpeaks' ),
		'all_items'                  => __( 'Events Topics', 'MedSpeaks' ),
		'parent_item'                => __( 'Parent Event Topic', 'MedSpeaks' ),
		'parent_item_colon'          => __( 'Parent Event Topic', 'MedSpeaks' ),
		'new_item_name'              => __( 'New Event Topic', 'MedSpeaks' ),
		'add_new_item'               => __( 'Add New Event Topic', 'MedSpeaks' ),
		'edit_item'                  => __( 'Edit Event Topic', 'MedSpeaks' ),
		'update_item'                => __( 'Update Event Topic', 'MedSpeaks' ),
		'separate_items_with_commas' => __( 'Separate Topics with commas', 'MedSpeaks' ),
		'search_items'               => __( 'Search Event Topics', 'MedSpeaks' ),
		'add_or_remove_items'        => __( 'Add or Remove Event Topics', 'MedSpeaks' ),
		'choose_from_most_used'      => __( 'Choose from the most used event Topics', 'MedSpeaks' ),
		'not_found'                  => __( 'Not Found', 'MedSpeaks' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'mse_topics', array( 'medspeaksevents' ), $args );



	$labels = array(
		'name'                       => _x( 'Speakers Categories', 'Taxonomy General Name', 'MedSpeaks' ),
		'singular_name'              => _x( 'Speakers Category', 'Taxonomy Singular Name', 'MedSpeaks' ),
		'menu_name'                  => __( 'Speaker Cateogry', 'MedSpeaks' ),
		'all_items'                  => __( 'Speakers Categories', 'MedSpeaks' ),
		'parent_item'                => __( 'Parent Speaker Category', 'MedSpeaks' ),
		'parent_item_colon'          => __( 'Parent Speaker Category', 'MedSpeaks' ),
		'new_item_name'              => __( 'New Speaker Category', 'MedSpeaks' ),
		'add_new_item'               => __( 'Add New Speaker Category', 'MedSpeaks' ),
		'edit_item'                  => __( 'Edit Speaker Category', 'MedSpeaks' ),
		'update_item'                => __( 'Update Speaker Category', 'MedSpeaks' ),
		'separate_items_with_commas' => __( 'Separate Categories with commas', 'MedSpeaks' ),
		'search_items'               => __( 'Search Speaker Categories', 'MedSpeaks' ),
		'add_or_remove_items'        => __( 'Add or Remove Speaker Cateogries', 'MedSpeaks' ),
		'choose_from_most_used'      => __( 'Choose from the most used Speaker categories', 'MedSpeaks' ),
		'not_found'                  => __( 'Not Found', 'MedSpeaks' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'mse_speakers_category', array( 'speakers' ), $args );
	
	$labels = array(
		'name'                       => _x( 'Speakers Tags', 'Taxonomy General Name', 'MedSpeaks' ),
		'singular_name'              => _x( 'Speakers Tag', 'Taxonomy Singular Name', 'MedSpeaks' ),
		'menu_name'                  => __( 'Speaker Tag', 'MedSpeaks' ),
		'all_items'                  => __( 'Speakers Tags', 'MedSpeaks' ),
		'parent_item'                => __( 'Parent Speaker Tag', 'MedSpeaks' ),
		'parent_item_colon'          => __( 'Parent Speaker Tag', 'MedSpeaks' ),
		'new_item_name'              => __( 'New Speaker Tag', 'MedSpeaks' ),
		'add_new_item'               => __( 'Add New Speaker Tag', 'MedSpeaks' ),
		'edit_item'                  => __( 'Edit Speaker Tag', 'MedSpeaks' ),
		'update_item'                => __( 'Update Speaker Tag', 'MedSpeaks' ),
		'separate_items_with_commas' => __( 'Separate Tags with commas', 'MedSpeaks' ),
		'search_items'               => __( 'Search Speaker Tags', 'MedSpeaks' ),
		'add_or_remove_items'        => __( 'Add or Remove Speaker Tags', 'MedSpeaks' ),
		'choose_from_most_used'      => __( 'Choose from the most used Speaker tags', 'MedSpeaks' ),
		'not_found'                  => __( 'Not Found', 'MedSpeaks' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'mse_speakers_tags', array( 'speakers' ), $args );

	$labels = array(
		'name'                       => _x( 'Speakers Topics', 'Taxonomy General Name', 'MedSpeaks' ),
		'singular_name'              => _x( 'Speakers Topic', 'Taxonomy Singular Name', 'MedSpeaks' ),
		'menu_name'                  => __( 'Speaker Topic', 'MedSpeaks' ),
		'all_items'                  => __( 'Speakers Topics', 'MedSpeaks' ),
		'parent_item'                => __( 'Parent Speaker Topic', 'MedSpeaks' ),
		'parent_item_colon'          => __( 'Parent Speaker Topic', 'MedSpeaks' ),
		'new_item_name'              => __( 'New Speaker Topic', 'MedSpeaks' ),
		'add_new_item'               => __( 'Add New Speaker Topic', 'MedSpeaks' ),
		'edit_item'                  => __( 'Edit Speaker Topic', 'MedSpeaks' ),
		'update_item'                => __( 'Update Speaker Topic', 'MedSpeaks' ),
		'separate_items_with_commas' => __( 'Separate Topics with commas', 'MedSpeaks' ),
		'search_items'               => __( 'Search Speaker Topics', 'MedSpeaks' ),
		'add_or_remove_items'        => __( 'Add or Remove Speaker Topics', 'MedSpeaks' ),
		'choose_from_most_used'      => __( 'Choose from the most used event Topics', 'MedSpeaks' ),
		'not_found'                  => __( 'Not Found', 'MedSpeaks' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'mse_speakers_topics', array( 'speakers' ), $args );



}


public function speakers_load_field( $field ) {


      global $wpdb, $post;

      $id = get_the_ID();


      $current_speaker = get_post_meta($id,'mse_speaker' );


       if($current_speaker){

        $field['default_value'] = $current_speaker[0];

      	}  else {
        
          $field['default_value'] = 'Please Create a Speaker First';
        }



      $args = array(
		'posts_per_page'   => -1,
		'offset'           => 0,
		'category'         => '',
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'speakers',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
	'suppress_filters' => true );

      $speakers = get_posts($args);

       $field['choices'] = array();
   
      // loop through array and add to field 'choices'
      if( is_array($speakers) )
      {
          foreach( $speakers as $speaker )

          {
              $field['choices'][ $speaker->ID ] = $speaker->post_title;
          }

      } else {

      		$field['choices'][''] = 'Please Create a Speaker First';
      }


   
      // Important: return the field
      return $field;

      die();


    }

}

?>