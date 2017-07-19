<?php
/**
 * Theme functions for NOO JobMonster Child Theme.
 *
 * @package    NOO JobMonster Child Theme
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */
 
// An example of how to write your own code in another file:
// require_once dirname(__FILE__) . 'example-code.php';

// Load language file from child-theme
// add_action( 'after_setup_theme', 'noo_child_theme_setup' );
// function noo_child_theme_setup() {
	// load_child_theme_textdomain( 'noo', get_stylesheet_directory() . '/languages' );
// }

/*
FYI • • • • •

plugin patch:
/wp-content/plugins/front-end-pm/functions.php
line 1062
wp_enqueue_script( 'fep-notification-script', $in_footer = true );
added:
, $in_footer = true
because:
front-end-pm was echoing a div into the html head,
which is so illegal that the web inspector was
showing that the body tag was beggining halfway
through the head tag 

*/

if ( ! function_exists( 'noo_get_social_fields' ) ) :
	function noo_get_social_fields() {
		$social_fields = array(
			'website' => array(
					'label' => __('Website', 'noo'),
					'icon' => 'fa-link',
			),
			'facebook' => array(
					'label' => __('Facebook', 'noo'),
					'icon' => 'fa-facebook',
					'icon_square' => 'fa-facebook-square',
					'alt_icon' => 'fa-facebook-f',
			),
			'twitter' => array(
					'label' => __('Twitter', 'noo'),
					'icon' => 'fa-twitter',
					'icon_square' => 'fa-twitter-square',
			),
			'instagram' => array(
					'label' => __('Instagram', 'noo'),
					'icon' => 'fa-instagram',
			),
			'googleplus' => array( // Be careful with google plus field name
					'label' => __('Google+', 'noo'),
					'icon' => 'fa-google-plus',
					'icon_square' => 'fa-google-plus-square',
			),
			'linkedin' => array(
					'label' => __('LinkedIn', 'noo'),
					'icon' => 'fa-linkedin',
					'icon_square' => 'fa-linkedin-square',
			),
			'email_address' => array(
					'label' => __('Email', 'noo'),
					'icon' => 'fa-envelope-o',
					'alt_icon' => 'fa-envelope',
			),
			'pinterest' => array(
					'label' => __('Pinterest', 'noo'),
					'icon' => 'fa-pinterest',
					'icon_square' => 'fa-pinterest-square',
					'alt_icon' => 'fa-pinterest-p',
			),
			'youtube' => array(
					'label' => __('Youtube', 'noo'),
					'icon' => 'fa-youtube',
					'icon_square' => 'fa-youtube-square',
					'alt_icon' => 'fa-youtube-play',
			),
			'tumblr' => array(
					'label' => __('Tumblr', 'noo'),
					'icon' => 'fa-tumblr',
					'icon_square' => 'fa-tumblr-square',
			),
			'behance' => array(
					'label' => __('Behance', 'noo'),
					'icon' => 'fa-behance',
					'icon_square' => 'fa-behance-square',
			),
			'flickr' => array(
					'label' => __('Flickr', 'noo'),
					'icon' => 'fa-flickr',
			),
			'vimeo' => array(
					'label' => __('Vimeo', 'noo'),
					'icon' => 'fa-vimeo',
					'icon_square' => 'fa-vimeo-square',
			),
			'github' => array(
					'label' => __('GitHub', 'noo'),
					'icon' => 'fa-github',
					'icon_square' => 'fa-github-square',
					'alt_icon' => 'fa-github-alt',
			),
			'vk' => array(
					'label' => __('VKontakte', 'noo'),
					'icon' => 'fa-vk',
			),
			'Xing' => array(
					'label' => __('Xing', 'noo'),
					'icon' => 'fa-link',
			),
		);

		return apply_filters( 'noo_social_fields', $social_fields );
	}
endif;

if( !function_exists('jm_get_page_post_resume_post_step') ) :
	function jm_get_page_post_resume_post_step(){
		$title = __('Your Pitch','noo');
		$link_args = array('action'=>'resume_post');
		$resume_id = isset($_GET['resume_id']) ? absint($_GET['resume_id']) : 0;
		if($resume_id) {
			$link_args['resume_id'] = $resume_id;
		}
		$link = esc_url(add_query_arg($link_args));
		
		return apply_filters( 'jm_page_post_resume_post_step', array(
			'actions' => array( 'resume_post' ),
			'title' => $title,
			'link' => $link
		) );
	}
endif;

if( !function_exists('jm_get_page_post_resume_detail_step') ) :
	function jm_get_page_post_resume_detail_step(){
		$title = __('Pitch Details','noo');
		$link_args = array('action'=>'resume_detail');
		$resume_id = isset($_GET['resume_id']) ? absint($_GET['resume_id']) : 0;
		if($resume_id) {
			$link_args['resume_id'] = $resume_id;
		}
		$link = esc_url(add_query_arg($link_args));
		
		return apply_filters( 'jm_page_post_resume_detail_step', array(
			'actions' => array( 'resume_detail' ),
			'title' => $title,
			'link' => $link
		) );
	}
endif;

if( !function_exists('jm_get_page_post_resume_preview_step') ) :
	function jm_get_page_post_resume_preview_step(){
		$title = __('Preview and Submit for Screening','noo');
		
		return apply_filters( 'jm_get_page_post_resume_preview_step', array(
			'actions' => array( 'resume_preview' ),
			'title' => $title,
			'link' => 'javascript:void(0);'
		) );
	}
endif;

if (!function_exists('get_page_heading')):
	function get_page_heading() {
		$heading = '';
		$sub_heading = '';
		if ( is_home() ) {
			$heading = noo_get_option('noo_blog_heading_title', __( 'Blog', 'noo' ) );
		} elseif ( is_search() ) {
			$heading = __( 'Search Results', 'noo' );
			global $wp_query;
			$search_query = get_search_query();
			$search_query = (isset($_GET['s']) && empty($search_query) ? $_GET['s'] : $search_query);
			// if(!empty($wp_query->found_posts) ) {
			// 	if( !empty($search_query ) ) {
			// 		if($wp_query->found_posts > 1) {
			// 			$heading =  $wp_query->found_posts ." ". __('Search Results for:','noo')." ".esc_attr( $search_query );
			// 		} else {
			// 			$heading =  $wp_query->found_posts ." ". __('Search Results for:','noo')." ".esc_attr( $search_query );
			// 		}
			// 	}
			// } else {
				if(!empty($search_query)) {
					$heading = __('Search Results for:','noo')." ".esc_attr( $search_query );
				}
			// }
		} elseif ( is_post_type_archive( 'noo_job' ) ) {
			$heading = noo_get_option('noo_job_heading_title', __( 'Jobs', 'noo' ) );
		} elseif ( is_post_type_archive( 'noo_company' ) ) {
			$heading = noo_get_option('noo_companies_heading_title', __( 'Companies', 'noo' ) );
		} elseif ( is_post_type_archive( 'noo_resume' ) ) {
			$heading = noo_get_option('noo_resume_heading_title', __( 'Personal Pitch Listing', 'noo' ) );
		} elseif ( NOO_WOOCOMMERCE_EXIST && is_shop() ) {
			$heading = noo_get_option( 'noo_shop_heading_title', __( 'Shop', 'noo' ) );
		} elseif ( is_author() ) {
			$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
			$heading = __('Author Archive','noo');

			if(isset($curauth->nickname)) $heading .= ' ' . __('for:','noo')." ".$curauth->nickname;
		}elseif ( is_year() ) {
    		$heading = __( 'Post Archive by Year: ', 'noo' ) . get_the_date( 'Y' );
		} elseif ( is_month() ) {
    		$heading = __( 'Post Archive by Month: ', 'noo' ) . get_the_date( 'F,Y' );
		} elseif ( is_day() ) {
    		$heading = __( 'Post Archive by Day: ', 'noo' ) . get_the_date( 'F j, Y' );
		} elseif ( is_404() ) {
    		$heading = __( 'Oops! We could not find anything to show you.', 'noo' );
    		$sub_heading =  __( 'Would you like to go somewhere else to find your stuff?', 'noo' );
		} elseif ( is_archive() ) {
			$heading        = single_cat_title( '', false );
			$sub_heading   = term_description();
		} elseif( is_page() ) {
			$page_temp = get_page_template_slug();
			if( noo_get_post_meta(get_the_ID(), '_noo_wp_page_hide_page_title', false) ) {
				$heading = '';
			} elseif(get_the_ID() == Noo_Member::get_member_page_id()){
				$heading = get_the_title();
				$current_user = wp_get_current_user();
				if( 'username' == Noo_Member::get_setting('member_title', 'page_title') && 0 != $current_user->ID ) {
					$heading = Noo_Member::get_display_name( $current_user->ID );
				}
				$sub_heading = Noo_Member::get_member_heading_label();
				if(empty($sub_heading) && !is_user_logged_in()){
					$sub_heading = Noo_Member::can_register() ? __('Your PBIQ Profile','noo') : __('Login', 'noo');
				}
			}elseif('page-post-job.php' === $page_temp){
				$heading = __('Post a Job','noo');
				$step = isset($_GET['action']) ? $_GET['action'] : '';
				if($step == 'login'){
					$sub_heading = Noo_Member::can_register() ? __('Your PBIQ Profile','noo') : __('Login', 'noo');
				}elseif ($step == 'job_package'){
					$sub_heading = __('Choose a package','noo');
				}elseif ($step == 'post_job'){
					$sub_heading = __('Describe your company and vacancy','noo');
				}elseif ($step == 'preview_job'){
					$sub_heading = __('Preview and submit your job','noo');
				}else{
					$sub_heading = Noo_Member::can_register() ? __('Your PBIQ Profile','noo') : __('Login', 'noo');
				}
			} elseif('page-post-resume.php' === $page_temp){
				$heading = __('Create a PBIQ Profile','noo');
				$step = isset($_GET['action']) ? $_GET['action'] : '';
				if($step == 'login'){
					$sub_heading = Noo_Member::can_register() ? __('Your PBIQ Profile','noo') : __('Login', 'noo');
				}elseif ($step == 'resume_general'){
					$sub_heading = __('General Information','noo');
				}elseif ($step == 'resume_detail'){
					$sub_heading = __('Pitch Details','noo');
				}elseif ($step == 'resume_preview'){
					$sub_heading = __('Preview and Submit for Screening','noo');
				}else{
					$sub_heading = Noo_Member::can_register() ? __('Your PBIQ Profile','noo') : __('Login', 'noo');
				}
			} else {
				$heading = get_the_title();
			}
		} elseif ( is_singular() ) {
			$heading = get_the_title();
		}

		return array($heading, $sub_heading);
	}
endif;

if( !function_exists( 'jm_member_heading_label_job_bookmark' ) ) :
	function jm_member_heading_label_job_bookmark( $label, $endpoint ) {
		if( $endpoint == 'bookmark-job' ) {
			return __('Bookmarked Jobs','noo');
		}
		
		return $label;
	}
	add_action( 'jm_member_heading_label', 'jm_member_heading_label_job_bookmark', 10, 2 );
endif;

if( !function_exists( 'jm_member_heading_job_bookmark' ) ) :
	function jm_member_heading_job_bookmark() {
		?>
		<!--<li class="<?php echo esc_attr(Noo_Member::get_actice_enpoint_class('bookmark-job'))?>"><a href="<?php echo Noo_Member::get_endpoint_url('bookmark-job')?>"><i class="fa fa-heart"></i> <?php _e('Bookmarked Jobs','noo')?></a></li>-->
		<?php
	}
	add_action( 'noo-member-candidate-heading', 'jm_member_heading_job_bookmark' );
endif;

if( !function_exists( 'jm_member_menu_job_bookmark' ) ) :
	function jm_member_menu_job_bookmark() {
		?>
		<!--<li class="menu-item" ><a href="<?php echo Noo_Member::get_endpoint_url('bookmark-job')?>"><i class="fa fa-heart"></i> <?php _e('Bookmarked Jobs','noo')?></a></li>-->
		<?php
	}
	add_action( 'noo-member-candidate-menu', 'jm_member_menu_job_bookmark' );
endif;

if (!function_exists('noo_sidebar_class')): //making left sidebar full width
	function noo_sidebar_class() {
		$class = ' noo-sidebar col-md-4';
		$page_layout = get_page_layout();
		
		if ( $page_layout == 'left_sidebar' || $page_layout == 'left_company' ) {
			$class = ' col-md-12 profile-search-filter';
		}
		
		echo $class;
	}
endif;

if (!function_exists('noo_main_class')): //making page fullwidth when left sidebar chosen
	function noo_main_class() {
		$class = 'noo-main';
		$page_layout = get_page_layout();
		if ($page_layout == 'fullwidth') {
			$class.= ' col-md-12';
		} elseif ($page_layout != 'left_sidebar' && $page_layout != 'left_company') {
			$class.= ' col-md-8 right-sidebar';
		} else {
			$class.= ' col-md-12';
		}
		
		echo $class;
	}
endif;

add_action('wp_head', 'myplugin_ajaxurl');

function myplugin_ajaxurl() {

   echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

require_once dirname(__FILE__) . '/framework/functions/noo-utilities.php';
require_once dirname(__FILE__) . '/framework/admin/noo_member.php';
require_once dirname(__FILE__) . '/framework/admin/noo_form_handler.php';
require_once dirname(__FILE__) . '/framework/admin/noo_application.php';
require_once dirname(__FILE__) . '/framework/resume/init.php';
require_once dirname(__FILE__) . '/framework/resume/admin-settings.php';
require_once dirname(__FILE__) . '/framework/resume/resume-viewable.php';
require_once dirname(__FILE__) . '/framework/admin/noo_resume.php';
require_once dirname(__FILE__) . '/framework/job/init.php';
require_once dirname(__FILE__) . '/framework/job/admin-job-edit.php';
require_once dirname(__FILE__) . '/framework/job/job-default-fields.php';
require_once dirname(__FILE__) . '/framework/job/job-template.php';
require_once dirname(__FILE__) . '/framework/admin/link_role_and_interest.php';
require_once dirname(__FILE__) . '/framework/admin/share_role_with_referers.php';

add_action('wp_ajax_deduct_credit', 'deduct_credit_callback');
add_action('wp_ajax_nopriv_deduct_credit', 'deduct_credit_callback');

function deduct_credit_callback() {
    //global $wpdb; // this is how you get access to the database

    Noo_Form_Handler::deductCredit();

    die(); // this is required to return a proper result
}

//helper functions
function get_avatar_src($get_avatar){
    preg_match("/src=('|\")(.*?)('|\")/i", $get_avatar, $matches);
    return html_entity_decode($matches[2]);
}

function filter_candidate_name($name)
{
	$parts = explode(" ", $name);
	$lastname = array_pop($parts);
	$firstname = implode(" ", $parts);
	
	$candidate_name = substr($firstname, 0, 1). "**** ".substr($lastname, 0, 1). "****";
	
	return $candidate_name;
}

function shortlist_ajax_email_send_process() {
	
	$no_html = array();
	
	//foreach id, get the link and email the recruiter. done!
	$interestIDs = isset( $_POST['ids'] ) ? wp_kses( $_POST['ids'], $no_html ) : '';
	
	$candidateShortlist = array();
	$candiCounter = 0;
	
	if(empty($interestIDs))
	{
		//send a message
		echo "Nothing Selected";
	}
	else
	{
		//echo var_dump($interestIDs);	
		
		foreach($interestIDs as $interestID)
		{
			$interestPost  = get_post($interestID);
			
			$roleID  	   = $interestPost->post_parent;
			$role    	   = get_post($roleID);
			$roleName	   = $role->post_title;
			$roleLink	   = html_entity_decode($role->guid);
			
			$candidateID   = $interestPost->post_author;
			$candidateAVA  = get_avatar($candidateID);
			$candidateIMG  = get_avatar_src($candidateAVA);
			$candidateName = filter_candidate_name($interestPost->post_title);
			
			$resumeID      = noo_get_post_meta( $interestID, '_resume', '' );
			$resumeLink    = add_query_arg('application_id', $interestID, get_permalink($resumeID));
			$pitch		   = get_post_field('post_content', $resumeID); 
			
			
			// echo var_dump($resumeLink);
			// echo var_dump($roleName);
			// echo var_dump($roleLink);
			// echo var_dump($candidateIMG);
			// echo var_dump($candidateName);
			
			$candidateShortlist[$candiCounter]['ID']   = $candidateID;
			$candidateShortlist[$candiCounter]['name'] = $candidateName;
			$candidateShortlist[$candiCounter]['link'] = $resumeLink;
			$candidateShortlist[$candiCounter]['img']  = $candidateIMG;
			$candidateShortlist[$candiCounter]['role'] = $roleID;
			$candidateShortlist[$candiCounter]['pitch'] = $pitch;
			
			$candiCounter++;
		}

		// echo var_dump($candidateShortlist);
		
		//get Recruiter Data //RESEARCH: Why are 2D arrays not coming through??##########################################################
		$recruiterNames  = isset( $_POST['recNames'] ) ? wp_kses( $_POST['recNames'], $no_html ) : '';
		$recruiterEmails = isset( $_POST['recEmails'] ) ? wp_kses( $_POST['recEmails'], $no_html ) : '';
		
		$recruiters = array();
		$recCounter = 0;
		
		foreach($recruiterEmails as $k=>$r)
		{
			$recruiters[$recCounter]['name']  = $recruiterNames[$k];
			$recruiters[$recCounter]['email'] = $recruiterEmails[$k];
			
			$recCounter++;
		}
		
		//var_dump($recruiters);
		
		//send emails out
		if(!empty($candidateShortlist) && !empty($recruiters))
		{
			//init email stuff
				
			$subject   = "Candidate Shortlist from PurpleBeach Intelligence";
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-Type: text/html; charset=UTF-8';
			$headers[] = 'From: PBIQ <info.iq@purplebeach.com>';
				
			foreach($recruiters as $recKey=>$recruiter)
			{
				// set up user data
				$userdata = WP_User::get_data_by( 'email', $recruiter['email'] );
				if ( !$userdata ) // new referrer user for the system
				{
					// generate password
					$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
					$gennedPass = array();
					$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
					for ($i = 0; $i < 8; $i++) {
						$n = rand(0, $alphaLength);
						$gennedPass[] = $alphabet[$n];
					}
					// handle new user
					$user_args = array();
					$user_args['user_login'] = $user_args['user_email'] = $recruiter['email'];
					$user_args['display_name'] = $recruiter['name'];
					$name = $user_args['display_name'];
					$parts = explode(" ", $name);
					$lastname = array_pop($parts);
					$firstname = implode(" ", $parts);

					$user_args['first_name'] = $firstname;
					$user_args['last_name'] = $lastname;
					$user_args['user_pass'] = implode($gennedPass);

					$user_args['role'] = Noo_Member::EMPLOYER_ROLE;

					$user_args = apply_filters( 'noo_register_user_data', $user_args, $_POST );
					
					$user_id = wp_insert_user( apply_filters( 'noo_create_user_data', $user_args ) );
					update_user_option( $user_id, 'default_password_nag', true, true ); // Set up the Password change nag.
					
					// Create new company
					$company_data = array(
						'post_title'     => $recruiter['name'],
						'post_type'      => 'noo_company',
						'comment_status' => 'closed',
						'post_status'	 => 'publish',
						'post_author'	 => $user_id
					);
					
					$company_id = wp_insert_post( $company_data );
					update_user_meta( $user_id, 'employer_company', $company_id );
					
					// add Candidates 
					update_user_meta( $user_id, 'candidate_shortlist', $candidateShortlist);

					$newOrExistingPassword = ', login with your email address ' . $recruiter['email'] . ' and use the following setup password: <span style="background-color: yellow;">' . $user_args['user_pass'].'</span>';
					
					//add package and credits
					$new_order_ID = create_new_order( $name, $user_id );
					$order = new WC_Order( $new_order_ID );
					
					$product = wc_get_product( "929" ); //this is hardcoded so it takes the first package (10credits)
					if ($product->is_type( 'job_package' ) && $order->customer_user ) 
					{
						$user_id = $order->customer_user;

						$package_interval = absint($product->get_package_interval());
						$package_interval_unit = $product->get_package_interval_unit();
						$package_data = array(
							'product_id'   => $product->id,
							'order_id'	   => $order_id,
							'created'      => current_time('mysql'),
							'package_interval' => $package_interval,
							'package_interval_unit' => $package_interval_unit,
							'job_duration' => absint($product->get_job_display_duration()),
							'job_limit'    => absint($product->get_post_job_limit()),
							'job_featured' => absint($product->get_job_feature_limit()),
							'company_featured' => $product->get_company_featured(),
						);
						
						$package_data = apply_filters( 'jm_job_package_user_data', $package_data, $product );

						update_user_meta( $user_id, '_job_package', $package_data );
						update_user_meta( $user_id, '_job_added', '0' );
						update_user_meta( $user_id, '_job_featured', '0' );
						
						$job_id = noo_get_post_meta( $order_id, '_job_id', '' );
						if ( !empty( $job_id ) && is_numeric( $job_id ) ) {
							$job = get_post( $job_id );
							if ( $job->post_type == 'noo_job' ){
								jm_increase_job_posting_count( $user_id );
								$job_need_approve = jm_get_job_setting( 'job_approve','yes' ) == 'yes';
								if( !$job_need_approve ) {
									wp_update_post(array(
										'ID'=>$job_id,
										'post_status'=>'publish',
										'post_date'		=> current_time( 'mysql' ),
										'post_date_gmt'	=> current_time( 'mysql' , 1 )
									));
									jm_set_job_expired( $job_id );
								} else {
									wp_update_post(array(
										'ID'=>$job_id,
										'post_status'=>'pending'
									));
									update_post_meta($job_id, '_in_review', 1);
								}
							}
						}
						
						if( $product->get_price() <= 0 ) {
							update_user_meta( $user_id, '_free_package_bought', 1 );
						}
					}
				}
				else // add role references to existing referrer user
				{
					$user_id = $userdata->ID;
					
					$oldCandArray = get_user_meta($user_id, "candidate_shortlist");
					
					//var_dump($oldCandArray);
					
					if(!empty($oldCandArray[0]))
					{	$newCandArray = $oldCandArray[0];
						$newCounter = count($newCandArray);
						
						foreach($candidateShortlist as $newCand)
						{
							$newCandArray[$newCounter] = $newCand;
							$newCounter++;
						}
					}
					else
						$newCandArray = $candidateShortlist;
					
					//var_dump($newCandArray);

					update_user_meta( $user_id, 'candidate_shortlist', $newCandArray);
					$newOrExistingPassword = '.'; // just end the sentence in role_to_referers.php
				}
				
				//send emails.
				//echo "sending to $recKey<br/>\n";
				
				$to 	  = $recruiter['email'];
				$name 	  = $recruiter['name'];
				$passtxt  = $newOrExistingPassword;
				$message = '';
				
				include(get_stylesheet_directory()."/emails/candidate_to_recruiters.php"); //email template == here you get $message
				
				echo wp_mail( $to, $subject, $message, $headers ); // send email
			}
		}
	}
    exit;
}

function share_role_process() {
	
	$no_html = array();
	
	//get Referer Data //RESEARCH: Why are 2D arrays not coming through??##########################################################
	$refererNames  = isset( $_POST['refNames'] ) ? wp_kses( $_POST['refNames'], $no_html ) : '';
	$refererEmails = isset( $_POST['refEmails'] ) ? wp_kses( $_POST['refEmails'], $no_html ) : '';
	$roleID 	   = isset( $_POST['rID'] ) ? wp_kses( $_POST['rID'], $no_html ) : '';
	
	$referers = array();
	$refCounter = 0;
	
	$role    	   = get_post($roleID);
	$roleName	   = $role->post_title;
	$roleLink	   = html_entity_decode($role->guid)."&ref=1";
	
    // input recruiter details

	foreach($refererEmails as $k=>$r)
	{
		$referers[$refCounter]['name']  = $refererNames[$k];
		$referers[$refCounter]['email'] = $refererEmails[$k];

		$refCounter++;
	}
	
	//var_dump($referers);

	// if there are referrers, email, dbStore and optionally create referrer account

	if(!empty($referers))
	{
		//init email stuff
			
		$subject   = "Role from PurpleBeach Intelligence";
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-Type: text/html; charset=UTF-8';
		$headers[] = 'From: PBIQ <info.iq@purplebeach.com>';
			
		foreach($referers as $refKey=>$referer)
		{

			// set up user data
			$userdata = WP_User::get_data_by( 'email', $referer['email'] );
			if ( !$userdata ) // new referrer user for the system
			{
                // generate password
                $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $gennedPass = array();
                $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                for ($i = 0; $i < 8; $i++) {
                    $n = rand(0, $alphaLength);
                    $gennedPass[] = $alphabet[$n];
                }
                // handle new user
                $user_args = array();
				$user_args['user_login'] = $user_args['user_email'] = $referer['email'];
				$user_args['display_name'] = $referer['name'];
				$name = $user_args['display_name'];
				$parts = explode(" ", $name);
				$lastname = array_pop($parts);
				$firstname = implode(" ", $parts);

				$user_args['first_name'] = $firstname;
				$user_args['last_name'] = $lastname;
				$user_args['user_pass'] = implode($gennedPass);

				$user_args['role'] = Noo_Member::REFERER_ROLE;

				$user_args = apply_filters( 'noo_register_user_data', $user_args, $_POST );
				// $user_id = Noo_Form_Handler::_register_new_user( $user_args ); //creates a new user
				$user_id = wp_insert_user( apply_filters( 'noo_create_user_data', $user_args ) );
				update_user_option( $user_id, 'default_password_nag', true, true ); // Set up the Password change nag.
				// create referrer code
				$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				$res = "";
				for ($i = 0; $i < 10; $i++) {
					$res .= $chars[mt_rand(0, strlen($chars)-1)];
				}
				update_user_meta( $user_id, 'referral_code', $res);
				// add role ID
				$roleIDArray = array();
				$roleIDArray[] = $roleID;
				update_user_meta( $user_id, 'referred_roles', $roleIDArray);

				$newOrExistingPassword = '<br><br>Please login with your email address ' . $referer['email'] . ' using the password: <span style="background-color: yellow;">' . $user_args['user_pass'].'</span>';
			}
			else // add role references to existing referrer user
			{
					$user_id = $userdata->ID;
					$roleIDArray = get_user_meta($user_id, "referred_roles", true);
					if(!empty($roleIDArray))
					{
						if(is_array($roleIDArray))
							$tempData = implode(",", $roleIDArray);
						else
							$tempData = $roleIDArray;
							
						$tempData .= "," . $roleID;
						$newRoleIDArray = explode(",", $tempData);
					}
					else
					{
						$newRoleIDArray = array();
						$newRoleIDArray[] = $roleID;
					}
					
					if(count($newRoleIDArray) > 1)
						$newRoleIDArray = array_unique($newRoleIDArray);

                    update_user_meta( $user_id, 'referred_roles', $newRoleIDArray);
					$newOrExistingPassword = '.'; // just end the sentence in role_to_referers.php
            }
    
			//send emails.
			//echo "sending to $recKey<br/>\n";
			
			$to 	  = $referer['email'];
			$name 	  = $referer['name'];
			$tmppass  = $referer['tmppass'];
			$passtxt  = $newOrExistingPassword;
			$message = '';
			include(get_stylesheet_directory()."/emails/role_to_referers.php"); //email template == here you get $message
			echo wp_mail( $to, $subject, $message, $headers ); // send email

		} // looped through referrers
	} // because there was at least one
    exit;
} // share_role_process()


// PurpleBeach Intelligence extra Body Classes
function pbi_body_classes( $extra_classes ) {
    if ( Noo_Member::is_employer() ) :
        $extra_classes[] = 'loggedinRecruiter';   
    elseif ( Noo_Member::is_candidate() ) :
        $extra_classes[] = 'loggedinCandidate';   
    elseif ( Noo_Member::is_referer() ) : // one r misspelling here, ah well
        $extra_classes[] = 'loggedinReferrer';   
    elseif ( Noo_Member::is_logged_in() ) :
        $extra_classes[] = 'loggedinDefault';   
    else :
        $extra_classes[] = 'loggedOut';   
    endif;
    return $extra_classes;
}
add_filter( 'body_class', 'pbi_body_classes' );


add_action('wp_ajax_shortlist_ajax_email_send', 'shortlist_ajax_email_send_process');
add_action("wp_ajax_nopriv_shortlist_ajax_email_send", "shortlist_ajax_email_send_process");

add_action('wp_ajax_share_role', 'share_role_process');
add_action("wp_ajax_nopriv_share_role", "share_role_process");

function my_enqueue_scripts() {
    wp_enqueue_script( 'my-ajax-action-0', get_template_directory_uri().'-child/assets/js/custom.js', array('jquery'));
    
	wp_enqueue_script( 'my-ajax-action', get_template_directory_uri().'-child/assets/js/shortlist_ajax_email_send.js', array('jquery'));
	wp_localize_script( 'my-ajax-action', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	
    wp_enqueue_script( 'my-ajax-action-2', get_template_directory_uri().'-child/assets/js/share_role.js', array('jquery'));
	wp_localize_script( 'my-ajax-action-2', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'admin_enqueue_scripts', 'my_enqueue_scripts');
add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts');
