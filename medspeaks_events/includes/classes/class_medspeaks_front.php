<?php
/**
 * MedSpeaks Events and Search Features
 * @package     MedSpeaks / Front End Functions
 * @author      Ing. Nancy Barraza - Oc2Interactive.
 * @copyright   Copyright (c) 2014, Oc2Interactive, Inc.
 * @license     MIT 2014
 */


 class MedSpeaks_Front {

 	public function __construct() {

     		add_action('wp_head', array($this,'add_styles'));
     		add_shortcode('medspeaks_list_view', array($this,'mse_display_calendar') );
			add_filter( 'template_include', array( $this, 'get_custom_post_type_template' ) );
     		
 	}

 	public function add_styles() {

			wp_enqueue_style('medspeaks_calendar', plugins_url('assets/css/medspeaks_calendar.css', dirname(__FILE__) ) );
			wp_enqueue_style( 'dashicons' );
	}

 	public function mse_enqueue_scripts(){

 	}

 	public function mse_display_calendar(){

 		$events = $this->mse_get_events(10);

 		$output = '<section class="mse_events">

 					<h3 class="mse_title">Upcoming Events</h3>

 				<ul>';

 		foreach($events as $event){
 			
 			 setup_postdata( $event ); 

 			$event_start = get_field('mse_event_start', $event->ID);
 			$event_end = get_field('mse_event_end', $event->ID);
 			if(!get_field('mse_allday',$event->ID)){
	 			$time_start = get_field('mse_time_start',$event->ID);
	 			$time_end = get_field('mse_time_end', $event->ID);
	 			$time = $time_start.'-'.$time_end;
 			} else {
 				$time = 'All Day';
 			}

 			$month = date("M", strtotime($event_start));

 			$day = date("d", strtotime($event_start));

 			$day_end = date("d", strtotime($event_end));

 			if($day_end > $day){

 				$days = '-'.$day_end;
 			} else {
 				$days = '';
 			}


 			switch($month){
 				case 'Jan':
 					$month = 'January';
  				break;
 				case 'Feb':
 					$month = 'February';
 				break;
 				case 'Mar':
 					$month = 'March';
 				break;
 				case 'Apr':
 					$month = 'April';
 				break;
 				case 'May':
 					$month = 'May';
 				break;
 				case 'Jun':
 					$month = 'June';

 				break;
 				case 'Jul':
 					$month = 'July';

 				break;
 				case 'Aug':
 					$month = 'August';

 				break;
 				case 'Sep':
 					$month = 'September';

 				break;
 				case 'Oct':
 					$month = 'October';

 				break;
 				case 'Nov':
 					$month = 'November';
 				
 				break;
 				case 'Dec':
 					$month = 'December';
 				
 				break;

 			}




 			$output .= '<li>';

 			$output .= '<span class="icon '.get_field('mse_type',$event->ID).'"></span> <div class="mse_date"><span class="month">'.$month.'</span> <br /><span class="days">'. $day.$days.'</span><br>'.$time.'</div><div class="mse_info"> <h4>'.$event->post_title.'</h4><p>'.get_field('mse_speaker',$event->ID).' </p></div>';

 			if(get_field('mse_sponsor_by', $event->ID)) {

 				$output.= '<div class="mse_sponsor"><img src="'.get_field('mse_sponsor_by', $event->ID).'" /></div>';

 			}

 			if(get_field('mse_url', $event->ID)){

 				$output.='<div class="mse_registry">';		

 					$output.='<a href="'.get_bloginfo('url').'/medspeaksevents/'.$event->slug.'" class="mse_button"> DETAILS </a> ';
 				
 				$output.='</div>';
 			}



 			$output.= '<div class="mse_popup" id="mse_event_'.$event->ID.'">';
 			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($event->ID), 'medium' );
			$url = $thumb['0'];
			if($url!=''){
				$output.= '<img src"'.$url.'" alt="'.$event->post_title.'" title.="'.$event->post_title.'" />';
			}
			$output.='<h3>'.$event->post_title.'</h3>';
			$output.= '<hr />';
			$output.= get_field('mse_description', $event->ID);
			$output.= '<br>';
			if(get_field('mse_sponsor_by', $event->ID)) {

 				$output.= '<div class="mse_sponsor"><img src="'.get_field('mse_sponsor_by', $event->ID).'" /></div>';

 			}
			$output.= '<div class="mse_date_pop">'.$month.'<br>'.$day.$days.'<br>'.$time.'</div>';
			if(is_user_logged_in()){

				$output.='<a href="#" class="mse_button"> ATTEND </a>';

			} else {

				$output.='<a href="'.get_field('mse_url',$events->ID).'" class="mse_button"> REGISTER </a> ';
			}
 			$output .='</div></li>';

 			

 		}

 		$output .= '</ul> <div class="clear"></div>

 		</section>
		
	
 		';

// 		$output.= get_post_type();


 		return $output;

 	}

 	public function mse_get_events($num_events = 5) {

 		$today = date('Ymd');

 		$args = array(
			'post_type' => 'medspeaksevents',
			'posts_per_page' => $num_events,

			'meta_query' => array(
				array(
					'key' => 'mse_event_start',
					'compare' => '>=',
					'value' => $today,
				)
			),

			'meta_key' => 'mse_event_start',
			'orderby' => 'meta_value',
			'order' => 'ASC',
		);



 		return get_posts( $args );

 	}

 	public function mse_get_category($post_id){

 	}


 	function get_custom_post_type_template($template) {
     global $post;

     if (is_single() && $post->post_type == 'medspeaksevents') {
     	
          $template = MS_PLUGIN_PATH . '/includes/templates/single-medspeaksevents.php';
     }
     return $template;
	}





 }
 ?>