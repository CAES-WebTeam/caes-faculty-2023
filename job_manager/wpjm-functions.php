<?php
/**
 * CAES WP Job Manager Functions
 *
 * since 1.0.1
 * update: 2023-02-02
 */

 /////////////////////    START: Admin Job Notification   ////////////////////

    // Admin New Job Notification
    function jobmanageremail_new( $email ) {
      $caes_option = get_option('caes_options');
      $caes_jobemailnew = $caes_option['caes_jobemailnew'] ?? null;

      $getEmailArray = explode(",",$caes_jobemailnew);
      return $getEmailArray;
  }
  add_filter( 'job_manager_email_admin_new_job_to', 'jobmanageremail_new');

  // Admin Updated Job Notification
  function jobmanageremail_updated( $email ) {
      $caes_option = get_option('caes_options');
      $caes_jobemailupdated = $caes_option['caes_jobemailupdated'] ?? null;
      
      $getEmailArray = explode(",",$caes_jobemailupdated);
      return $getEmailArray;
  }
  add_filter( 'job_manager_email_admin_updated_job_to', 'jobmanageremail_updated');
  
  // Admin Expiring Job Notification
  function jobmanageremail_expired( $email ) {
      $caes_option = get_option('caes_options');
      $caes_jobemailexpired = $caes_option['caes_jobemailexpired'] ?? null;
      
      $getEmailArray = explode(",",$caes_jobemailexpired);
      return $getEmailArray;
  }
  add_filter( 'job_manager_email_admin_expiring_job_to', 'jobmanageremail_expired');

/////////////////////    END: Admin Job Notification   ////////////////////


///////////////////////////  START: WPJM MENU AND OPTION     ///////////////////////////
// Define Constants
define('caeswpjm_SHORTNAME', 'caes_');

// Include the required files
require_once('wpjm-options.php');

add_action( 'admin_menu', 'caes_wpjm_add_menu' );
add_action( 'admin_init', 'caes_wpjm_register_settings' );

function caes_wpjm_create_settings_field( $args = array() ) {
	// default array to overwrite when calling the function
	$defaults = array(
		'id'      => 'default_field', 					// the ID of the setting in our options array, and the ID of the HTML form element
		'title'   => 'Default Field', 					// the label for the HTML form element
		'desc'    => 'This is a default description.', 	// the description displayed under the HTML form element
		'std'     => '', 								// the default value for this setting
		'type'    => 'text', 							// the HTML form element to use
		'section' => 'main_section', 					// the section this setting belongs to � must match the array key of a section in ar_options_page_sections()
		'choices' => array(), 							// (optional): the values in radio buttons or a drop-down menu
		'class'   => '' 								// the HTML form element class. Is used for validation purposes and may be also use for styling if needed.
	);
	
	// "extract" to be able to use the array keys as variables in our function output below
	extract( wp_parse_args( $args, $defaults ) );
	
	// additional arguments for use in form field output in the function _form_field!
	$field_args = array(
		'type'      => $type,
		'id'        => $id,
		'desc'      => $desc,
		'std'       => $std,
		'choices'   => $choices,
		'label_for' => $id,
		'class'     => $class
	);

	add_settings_field( $id, $title, 'caes_wpjm_form_field_callback', 'caes_wpjm_page', $section, $field_args );
  add_settings_section( $id, $title, 'caes_wpjm_section', 'caes_wpjm_page');

}

function get_caes_wpjm_settings() {
	
	$output = array();
	
	// put together the output array 
	$output['caes_wpjm_option_name'] 		= 'caes_options'; // the option name as used in the get_option() call.
	//$output['caes_wpjm_page_title'] 		= __( 'CAES Settings','caes_textdomain'); // the settings page title
	$output['caes_wpjm_page_sections'] 	= caes_wpjm_options_settings(); // the setting section
	$output['caes_wpjm_page_fields'] 		= caes_wpjm_options_page_fields(); // the setting fields
	
	return $output;
}

// Register our setting, settings sections and settings fields
function caes_wpjm_register_settings(){
	
  
  $settings_output 	= get_caes_wpjm_settings();
	
	//setting
	register_setting('caes_wpjm_options', 'caes_options', 'caeswpjm_validate_options' );
	
	//sections
	if(!empty($settings_output['caes_wpjm_page_sections'])){
		// call the "add_settings_section" for each!
		foreach ( $settings_output['caes_wpjm_page_sections'] as $id => $title ) {
			add_settings_section( $id, $title, 'caes_wpjm_section', 'caes_wpjm_page');
		}
	}
	
	//fields
	if(!empty($settings_output['caes_wpjm_page_fields'])){
		// call the "add_settings_field" for each!
		foreach ($settings_output['caes_wpjm_page_fields'] as $option) {
			caes_wpjm_create_settings_field($option);
		}
	}
}

//Group scripts (js & css)
/*
function caes_wpjm_settings_scripts(){
	wp_enqueue_style('caes_wpjm_theme_settings_css', get_stylesheet_directory_uri() . '/lib/css/caes_wpjm_theme_settings.css');
	wp_enqueue_script( 'caes_wpjm_theme_settings_js', get_stylesheet_directory_uri() . '/lib/js/caes_wpjm_theme_settings.js', array('jquery'));
	wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker-settings', get_stylesheet_directory_uri() . '/lib/js/caes_wpjm_theme_settings.js' );
}
*/

function caes_wpjm_add_menu(){
  //add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
  //add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
  add_submenu_page(
    'edit.php?post_type=job_listing',
    'UGA CAES WP Job Manager Settings',
    'CAES Settings',
    'manage_options',
    'caeswpjm-menu',
    'caeswpjm_menu_callback'
  );
  // css & js
  //add_action( 'load-'. $caes_wpjm_settings_page, 'caes_wpjm_settings_scripts' );	
}


// Section HTML, displayed before the first option

function  caes_wpjm_section($desc) {
 echo "<p>" . __('Settings for this section','caes_textdomain') . "</p>";
}


function caes_wpjm_form_field_callback($args = array()) {
	
	extract( $args );
	
	$caes_wpjm_option_name = 'caes_options';
	$options = get_option($caes_wpjm_option_name);
	
	// pass the standard value if the option is not yet set in the database
	if (!isset( $type )) $type = null;
	if ( !isset( $options[$id] ) && $type != 'checkbox' ) {
		$options[$id] = $std ?? null;
	}
	
	// additional field class. output only if the class is defined in the create_setting arguments
	if (!isset( $class )) $class = null;
	$field_class = ($class != '') ? ' ' . $class : '';
	
	// switch html display based on the setting type.	
	switch ( $type ) {
		case 'text':
			$options[$id] = stripslashes($options[$id]);
			$options[$id] = esc_attr( $options[$id]);
			echo "<input class='regulcaes-text$field_class' type='text' id='$id' name='" . $caes_wpjm_option_name . "[$id]' value='$options[$id]' />";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;
		
		case 'textarea':
			$options[$id] = stripslashes($options[$id]);
			$options[$id] = esc_html( $options[$id]);
			echo "<textarea class='textarea$field_class' type='text' id='$id' name='" . $caes_wpjm_option_name . "[$id]' rows='5' cols='30'>$options[$id]</textarea>";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : ""; 		
		break;
		
		case 'select':
			echo "<select id='$id' class='select$field_class' name='" . $caes_wpjm_option_name . "[$id]'>";
				foreach($choices as $item) {
					$value 	= esc_attr($item, 'caes_textdomain');
					$item 	= esc_html($item, 'caes_textdomain');
					
					$selected = ($options[$id]==$value) ? 'selected="selected"' : '';
					echo "<option value='$value' $selected>$item</option>";
				}
			echo "</select>";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : ""; 
		break;
		
		case 'option':
			echo "<select id='$id' class='select$field_class' name='" . $caes_wpjm_option_name . "[$id]'>";
			foreach($choices as $val => $key) {
				$selected = ($options[$id]==$val) ? 'selected="selected"' : '';
				echo "<option value='$val' $selected>$key</option>";
			}
			echo "</select>";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;
		
		case 'checkbox':
			echo "<input class='checkbox$field_class' type='checkbox' id='$id' name='" . $caes_wpjm_option_name . "[$id]' value='1' " . checked( $options[$id], 1, false ) . " />";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
		break;
	}
}

//Admin Settings Page HTML

function caeswpjm_menu_callback () {
	?>
	<div class="wrap">
	<div id="icon-themes" class="icon32"></div>  
        <h2>CAES WP Job Manager Settings</h2>  
        <?php settings_errors(); ?>   
          
		<form action="options.php" method="post">
			<?php 
				settings_fields( 'caes_wpjm_options' );
				do_settings_sections( 'caes_wpjm_page' ); 
      ?>

			<?php submit_button(); ?>
			
		</form>
	</div><!-- wrap -->
<?php }

/**
 * Validate input
 * 
 * @return array
 */
function caeswpjm_validate_options($input) {
	// for enhanced security, create a new empty array
	$valid_input = array();
	
	// collect only the values we expect and fill the new $valid_input array i.e. whitelist our option IDs
	$options = caes_wpjm_options_page_fields(); //$settings_output['caes_wpjm_page_fields'];
		// run a foreach and switch on option type
	foreach ($options as $option) {
    $getOptionStd = $option['std'] ?? null;
    $getOptionClass = $option['class'] ?? 'default';
    $getOptionId = $option['id'] ?? null;

			switch ( $option['type'] ) {
				case 'text':
					//switch validation based on the class!
          switch ( $getOptionClass ) {
            //for numeric 
            case 'numeric':
              //accept the input only when numeric!
              $input[$getOptionId] 		= trim($input[$getOptionId]); // trim whitespace
              $valid_input[$getOptionId] = (is_numeric($input[$getOptionId])) ? $input[$getOptionId] : 'Expecting a Numeric value!';
              
              // register error
              if(is_numeric($input[$getOptionId]) == FALSE) {
                add_settings_error(
                  $getOptionId, // setting title
                  caes_SHORTNAME . 'txt_numeric_error', // error ID
                  __('Expecting a Numeric value! Please fix.','caes_textdomain'), // error message
                  'error' // type of message
                );
              }
            break;
            
            //for multi-numeric values (separated by a comma)
            case 'multinumeric':
              //accept the input only when the numeric values are comma separated
              $input[$getOptionId] 		= trim($input[$getOptionId]); // trim whitespace
              
              if($input[$getOptionId] !=''){
                // /^-?\d+(?:,\s?-?\d+)*$/ matches: -1 | 1 | -12,-23 | 12,23 | -123, -234 | 123, 234  | etc.
                $valid_input[$getOptionId] = (preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$getOptionId]) == 1) ? $input[$getOptionId] : __('Expecting comma separated numeric values','caes_textdomain');
              }else{
                $valid_input[$getOptionId] = $input[$getOptionId];
              }
              
              // register error
              if($input[$getOptionId] !='' && preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$getOptionId]) != 1) {
                add_settings_error(
                  $getOptionId, // setting title
                  caes_SHORTNAME . 'txt_multinumeric_error', // error ID
                  __('Expecting comma separated numeric values! Please fix.','caes_textdomain'), // error message
                  'error' // type of message
                );
              }
            break;
            
            //for no html
            case 'nohtml':
              //accept the input only after stripping out all html, extra white space etc!
              $input[$getOptionId] 		= sanitize_text_field($input[$getOptionId]); // need to add slashes still before sending to the database
              
              if($input[$getOptionId] == '' ) $input[$getOptionId] = null;
              else $valid_input[$getOptionId] = addslashes($input[$getOptionId]);
            break;
            
            //for url
            case 'url':
              //accept the input only when the url has been sanited for database usage with esc_url_raw()
              $input[$getOptionId] 		= trim($input[$getOptionId]); // trim whitespace
              
              if($input[$getOptionId] == '' ) $input[$getOptionId] = null;
              else $valid_input[$getOptionId] = esc_url_raw($input[$getOptionId]);
            break;
            
            //for email
            case 'email':
              //accept the input only after the email has been validated
              $input[$getOptionId] 		= trim($input[$getOptionId]); // trim whitespace
              if($input[$getOptionId] != ''){
                $valid_input[$getOptionId] = (is_email($input[$getOptionId])!== FALSE) ? $input[$getOptionId] : __('Invalid email! Please re-enter!','caes_textdomain');
              }elseif($input[$getOptionId] == ''){
                $valid_input[$getOptionId] = __('This setting field cannot be empty! Please enter a valid email address.','caes_textdomain');
              }
              
              // register error
              if(is_email($input[$getOptionId])== FALSE || $input[$getOptionId] == '') {
                add_settings_error(
                  $getOptionId, // setting title
                  caes_SHORTNAME . 'txt_email_error', // error ID
                  __('Please enter a valid email address.','caes_textdomain'), // error message
                  'error' // type of message
                );
              }
            break;
            
            // a "cover-all" fall-back when the class argument is not set
            default:
              // accept only a few inline html elements
              $allowed_html = array(
                'a' => array('href' => array (),'title' => array ()),
                'b' => array(),
                'em' => array (), 
                'i' => array (),
                'strong' => array()
              );
              $setoptid = $input[$getOptionId];
              $setoptid = trim($setoptid); // trim whitespace
              $setoptid = force_balance_tags($setoptid); // find incorrectly nested or missing closing tags and fix markup
              $setoptid = wp_kses( $setoptid, $allowed_html); // need to add slashes still before sending to the database
              if($input[$getOptionId] == '' ) $input[$getOptionId] = null;
              else $valid_input[$getOptionId] = addslashes($setoptid); 
            break;
          }
				break;
				
				case 'textarea':
					//switch validation based on the class!
					switch ( $option['class'] ) {
						//for only inline html
						case 'inlinehtml':
							// accept only inline html
							$input[$getOptionId] 		= trim($input[$getOptionId]); // trim whitespace
							$input[$getOptionId] 		= force_balance_tags($input[$getOptionId]); // find incorrectly nested or missing closing tags and fix markup
							$input[$getOptionId] 		= addslashes($input[$getOptionId]); //wp_filter_kses expects content to be escaped!
							
              if($input[$getOptionId] == '' ) $input[$getOptionId] = null;
              else $valid_input[$getOptionId] = wp_filter_kses($input[$getOptionId]); //calls stripslashes then addslashes
						break;
						
						//for no html
						case 'nohtml':
							//accept the input only after stripping out all html, extra white space etc!
							$input[$getOptionId] 		= sanitize_text_field($input[$getOptionId]); // need to add slashes still before sending to the database
							
              if($input[$getOptionId] == '' ) $input[$getOptionId] = null;
              else $valid_input[$getOptionId] = addslashes($input[$getOptionId]);
						break;
						
						//for allowlinebreaks
						case 'allowlinebreaks':
							//accept the input only after stripping out all html, extra white space etc!
							$input[$getOptionId] 		= wp_strip_all_tags($input[$getOptionId]); // need to add slashes still before sending to the database
							
              if($input[$getOptionId] == '' ) $input[$getOptionId] = null;
              else $valid_input[$getOptionId] = addslashes($input[$getOptionId]);
						break;
						
						case 'html':
							$input[$getOptionId] 		= trim($input[$getOptionId]); // trim whitespace
							//$input[$getOptionId] 		= force_balance_tags($input[$getOptionId]); // find incorrectly nested or missing closing tags and fix markup
							//$input[$getOptionId] 		= wp_kses( $input[$getOptionId], $allowed_html); // need to add slashes still before sending to the database
							
              if($input[$getOptionId] == '' ) $input[$getOptionId] = null;
              else $valid_input[$getOptionId] = addslashes($input[$getOptionId]);
						break;
						
						// a "cover-all" fall-back when the class argument is not set
						default:
							// accept only limited html
							//my allowed html
							$allowed_html = array(
								'a' 			=> array('href' => array (),'title' => array ()),
								'b' 			=> array(),
								'blockquote' 	=> array('cite' => array ()),
								'br' 			=> array(),
								'dd' 			=> array(),
								'dl' 			=> array(),
								'dt' 			=> array(),
								'em' 			=> array (), 
								'i' 			=> array (),
								'li' 			=> array(),
								'ol' 			=> array(),
								'p' 			=> array(),
								'q' 			=> array('cite' => array ()),
								'strong' 		=> array(),
								'ul' 			=> array(),
								'h1' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
								'h2' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
								'h3' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
								'h4' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
								'h5' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
								'h6' 			=> array('align' => array (),'class' => array (),'id' => array (), 'style' => array ())
							);
							
							$input[$getOptionId] 		= trim($input[$getOptionId]); // trim whitespace
							$input[$getOptionId] 		= force_balance_tags($input[$getOptionId]); // find incorrectly nested or missing closing tags and fix markup
							$input[$getOptionId] 		= wp_kses( $input[$getOptionId], $allowed_html); // need to add slashes still before sending to the database
							
              if($input[$getOptionId] == '' ) $input[$getOptionId] = null;
              else $valid_input[$getOptionId] = addslashes($input[$getOptionId]);						
						break;
					}
				break;
				
				case 'option':
					// process $select_values
						$select_values = array();
						foreach ($option['choices'] as $val => $key) {
							$select_values[] = $val;
						}
					// check to see if selected value is in our approved array of values!
          if( $input[$getOptionId] == $getOptionStd ) $input[$getOptionId] = null;
					else $valid_input[$getOptionId] = (in_array( $input[$getOptionId], $select_values) ? $input[$getOptionId] : '' );
				break;
				
				case 'checkbox':
					// if it's not set, default to null!
					if (!isset($input[$getOptionId])) {
						$input[$getOptionId] = null;
					}
					// Our checkbox value is either 0 or 1
					
          if( $input[$getOptionId] == $getOptionStd ) $input[$getOptionId] = null;
					else $valid_input[$getOptionId] = ( $input[$getOptionId] == 1 ? 1 : 0 );
				break;
				
				
			}
  }
return $valid_input; // return validated input
}




///////////////////////////  END: WPJM MENU AND OPTION     ///////////////////////////


///////////////////////////  START: CUSTOM WPJM FUNCTIONS     ///////////////////////////



function custom_job_manager_job_listing_data_fields( $fields ) {

    //print_r($fields);
	//$caes_option = caes_get_global_options();
	$caes_option = get_option('caes_options');
    //$caes_option['caes_']
	//WPJM core fields

	//default true
	

	$caes_jobreq_description = $caes_option['caes_jobreq_description'] ?? null;
	if(in_array(isset($caes_jobreq_description), array('opt','hide'))) $fields['job']['job_description']['required'] = false;
	if($caes_jobreq_description == 'hide') unset($fields['job']['job_description']);

	$caes_jobreq_appemailurl = $caes_option['caes_jobreq_appemailurl'] ?? null;
	if(in_array(isset($caes_jobreq_appemailurl), array('opt','hide'))) $fields['job']['application']['required'] = false;
	if($caes_jobreq_appemailurl == 'hide') unset($fields['job']['application']);

    $caes_jobreq_comname = $caes_option['caes_jobreq_comname'] ?? null;
    if(in_array(isset($caes_jobreq_comname), array('opt','hide'))) $fields['company']['company_name']['required'] = false;
    if($caes_jobreq_comname == 'hide') unset($fields['company']['company_name']);

    //default false
    $caes_jobreq_comurl = $caes_option['caes_jobreq_comurl'] ?? null;
    if($caes_jobreq_comurl == 'req') $fields['company']['company_website']['required'] = true;
    if($caes_jobreq_comurl == 'hide') unset($fields['company']['company_website']);

    $caes_jobreq_comtagline = $caes_option['caes_jobreq_comtagline'] ?? null;
    if($caes_jobreq_comtagline == 'req') $fields['company']['company_tagline']['required'] = true;
    if($caes_jobreq_comtagline == 'hide') unset($fields['company']['company_tagline']);

    $caes_jobreq_comvid = $caes_option['caes_jobreq_comvid'] ?? null;
    if($caes_jobreq_comvid == 'req') $fields['company']['company_video']['required'] = true;
    if($caes_jobreq_comvid == 'hide') unset($fields['company']['company_video']);

    $caes_jobreq_comtwitter = $caes_option['caes_jobreq_comtwitter'] ?? null;
    if($caes_jobreq_comtwitter == 'req') $fields['company']['company_twitter']['required'] = true;
    if($caes_jobreq_comtwitter == 'hide') unset($fields['company']['company_twitter']);

    $caes_jobreq_comlogo = $caes_option['caes_jobreq_comlogo'] ?? null;
    if($caes_jobreq_comlogo == 'req') $fields['company']['company_logo']['required'] = true;
    if($caes_jobreq_comlogo == 'hide') unset($fields['company']['company_logo']);

    return $fields;
}
add_filter( 'submit_job_form_fields', 'custom_job_manager_job_listing_data_fields' );


///// job categories on list /////////////
function dm_display_wpjm_single_categories () {
    $terms = get_the_terms( get_the_ID(), 'job_listing_category' );
    $added = false;
    $output = '';
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
        
        foreach ( $terms as $term ) {
        		if($added == true) $output .= '<br/>';
            	//$output .= '<a href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a>';
              /* $gettermname = $term->name ?? null;
            	$output .= $gettermname; */
            	$output .= $term->name;
            	$added=true;
        }
        echo $output;
    }
}


///// TinyMCE Editor Toolbar: add Underline button /////////////



function customize_editor_toolbar( $args ) {
	$args['tinymce']['toolbar1'] = 'bold,italic,underline,|,bullist,numlist,|,link,unlink,|,undo,redo';
	return $args;
}
add_filter( 'submit_job_form_wp_editor_args', 'customize_editor_toolbar' );

///// REPLACE TEXT /////
//id submit-job-form

function caes_job_gettext( $translated_text, $untranslated_text, $domain ) {
	//echo "post type: ".get_post_type();
	if ($untranslated_text == 'Description') {
		$translated_text = __( 'Job Description', $domain );
	} else if($untranslated_text == 'Application email/URL') {
		$translated_text = __( 'Where to apply <br/> (application email/URL)', $domain );
	}
	return $translated_text;
}
//add_filter( 'gettext', 'caes_job_gettext', 20, 3 );
function check_submit_job_form_shortcode($posts) {
    if ( empty($posts) )
        return $posts;
    // false because we have to search through the posts first
    $found = false;

    // search through each post
    foreach ($posts as $post) {
        // check the post content for the short code
        if ( stripos($post->post_content, '[submit_job_form') ){
            // we have found a post with the short code
            $found = true;
            // stop the search
            break;
        }
 	}
    if ($found) 
        add_filter( 'gettext', 'caes_job_gettext', 20, 3 );
    
    return $posts;
}
// perform the check when the_posts() function is called
add_action('the_posts', 'check_submit_job_form_shortcode');


///// Job Duties ///////
//FRONTEND
function frontend_add_duties_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $setreq = true;
  $caes_jobreq_duties = $caes_option['caes_jobreq_duties'] ?? null;
  if($caes_jobreq_duties == 'hide') return;
  if($caes_jobreq_duties == 'opt') $setreq = false;
  $fields['job']['job_duties'] = array(
    'label'       => __( 'Job Duties', 'job_manager' ),
    'type'        => 'wp-editor',
    'required'    => $setreq,
    'placeholder' => 'Type here',
    'priority'    => 5.6
  );
  return $fields;
}
add_filter( 'submit_job_form_fields', 'frontend_add_duties_field' );

// ADMIN
function admin_add_duties_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_duties = $caes_option['caes_jobreq_duties'] ?? null;
  if($caes_jobreq_duties == 'hide') return;
  //if($caes_option['caes_jobreq_duties'] == 'hide') return;
  //if(!isset($fields['_job_duties'])) return;
  $fields['_job_duties'] = array(
    'label'       => __( 'Job Duties', 'job_manager' ),
    'type'        => 'textarea',
    'placeholder' => 'Type here',
    'description' => '',
    'priority'    => 5.6
  );
  return $fields;
}

add_filter( 'job_manager_job_listing_data_fields', 'admin_add_duties_field' );

//DISPLAY ON SINGLE JOB PAGE
//callback at content-single-job_listing.php
function display_job_duties_data() {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_duties = $caes_option['caes_jobreq_duties'] ?? null;
  if($caes_jobreq_duties == 'hide') return;
  global $post;
  $duties = get_post_meta( $post->ID, '_job_duties', true );
  if ( $duties ) {
    $output = '<div id="jobduties">';
    $output .= '<h3>Job Duties</h3>';
    $output .= '<p>'.  $duties  .'</p>';
    $output .= '</div>';
    echo $output;
  }
}
add_action( 'single_job_listing_end', 'display_job_duties_data' );



///// Job Qualifications ///////
//FRONTEND
function frontend_add_qualifications_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $setreq = true;
  $caes_jobreq_qual = $caes_option['caes_jobreq_qual'] ?? null;
  if($caes_jobreq_qual == 'hide') return;
  if($caes_jobreq_qual == 'opt') $setreq = false;
  $fields['job']['job_qualifications'] = array(
    'label'       => __( 'Job Qualifications', 'job_manager' ),
    'type'        => 'wp-editor',
    'required'    => $setreq,
    'placeholder' => 'Type here',
    'priority'    => 5.7
  );
  return $fields;
}
add_filter( 'submit_job_form_fields', 'frontend_add_qualifications_field' );

// ADMIN
function admin_add_qualifications_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_qual = $caes_option['caes_jobreq_qual'] ?? null;
  if($caes_jobreq_qual == 'hide') return;
  //if($caes_option['caes_jobreq_qual'] == 'hide') return;
  $fields['_job_qualifications'] = array(
    'label'       => __( 'Job Qualifications', 'job_manager' ),
    'type'        => 'textarea',
    'placeholder' => 'Type here',
    'description' => '',
    'priority'    => 5.7
  );
  return $fields;
}

add_filter( 'job_manager_job_listing_data_fields', 'admin_add_qualifications_field' );

//DISPLAY ON SINGLE JOB PAGE
function display_job_qualifications_data() {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_qual = $caes_jobreq_qual['set'] ?? null;
  if($caes_jobreq_qual == 'hide') return;
  global $post;
  $qualifications = get_post_meta( $post->ID, '_job_qualifications', true );
  if ( $qualifications ) {
    $output = '<div id="jobduties">';
    $output .= '<h3>Job Qualifications</h3>';
    $output .= '<p>'.  $qualifications  .'</p>';
    $output .= '</div>';
    echo $output;
  }
}
add_action( 'single_job_listing_end', 'display_job_qualifications_data' );

///// Benefits ///////
//FRONTEND
function frontend_add_benefits_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_benefits = $caes_option['caes_jobreq_benefits'] ?? null;
  if($caes_jobreq_benefits == 'hide') return;
  $setreq = true;
  if($caes_jobreq_benefits == 'opt') $setreq = false;
  $fields['job']['job_benefits'] = array(
    'label'       => __( 'Benefits', 'job_manager' ),
    'type'        => 'wp-editor',
    'required'    => $setreq,
    'placeholder' => 'Type here',
    'priority'    => 5.8
  );
  return $fields;
}
add_filter( 'submit_job_form_fields', 'frontend_add_benefits_field' );

// ADMIN
function admin_add_benefits_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_benefits = $caes_option['caes_jobreq_benefits'] ?? null;
  if($caes_jobreq_benefits == 'hide') return;
  //if($caes_option['caes_jobreq_benefits'] == 'hide') return;
  $fields['_job_benefits'] = array(
    'label'       => __( 'Benefits', 'job_manager' ),
    'type'        => 'textarea',
    'placeholder' => 'Type here',
    'description' => '',
    'priority'    => 5.8
  );
  return $fields;
}

add_filter( 'job_manager_job_listing_data_fields', 'admin_add_benefits_field' );

//DISPLAY ON SINGLE JOB PAGE
function display_job_benefits_data() {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_benefits = $caes_option['caes_jobreq_benefits'] ?? null;
  if($caes_jobreq_benefits == 'hide') return;
  global $post;
  $benefits = get_post_meta( $post->ID, '_job_benefits', true );
  if ( $benefits ) {
    $output = '<div id="jobbenefits">';
    $output .= '<h3>Benefits</h3>';
    $output .= '<p>'.  $benefits  .'</p>';
    $output .= '</div>';
    echo $output;
  }
}
add_action( 'single_job_listing_end', 'display_job_benefits_data' );

///// Compensation ///////
//FRONTEND
function frontend_add_compensation_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_comp = $caes_option['caes_jobreq_comp'] ?? null;
  if($caes_jobreq_comp == 'hide') return;
  $setreq = true;
  if($caes_jobreq_comp == 'opt') $setreq = false;
  $fields['job']['job_compensation'] = array(
    'label'       => __( 'Compensation', 'job_manager' ),
    'type'        => 'text',
    'required'    => $setreq,
    'placeholder' => 'e.g. $20 hr or $10,0000 salary',
    'priority'    => 5.9
  );
  return $fields;
}
add_filter( 'submit_job_form_fields', 'frontend_add_compensation_field' );

// ADMIN
function admin_add_compensation_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_comp = $caes_option['caes_jobreq_comp'] ?? null;
  if($caes_jobreq_comp == 'hide') return;
  //if($caes_option['caes_jobreq_comp'] == 'hide') return;
  $fields['_job_compensation'] = array(
    'label'       => __( 'Compensation', 'job_manager' ),
    'type'        => 'text',
    'placeholder' => 'e.g. $20 hr or $10,0000 salary',
    'description' => '',
    'priority'    => 5.9
  );
  return $fields;
}

add_filter( 'job_manager_job_listing_data_fields', 'admin_add_compensation_field' );

//DISPLAY ON SINGLE JOB PAGE
function display_job_compensation_data() {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_comp = $caes_option['caes_jobreq_comp'] ?? null;
  if($caes_jobreq_comp == 'hide') return;
  global $post;
  $compensation = get_post_meta( $post->ID, '_job_compensation', true );
  if ( $compensation ) {
    echo '<li class="compensation">' . __( 'Compensation:' ) . '' . esc_html( $compensation ) . '</li>';
  }
}
add_action( 'single_job_listing_meta_end', 'display_job_compensation_data' );


///// Contact name ///////
//FRONTEND
function frontend_add_contact_name_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_contactname = $caes_option['caes_jobreq_contactname'] ?? null;
  if($caes_jobreq_contactname == 'hide') return;
  $setreq = true;
  if($caes_jobreq_contactname == 'opt') $setreq = false;
  $fields['job']['job_contact_name'] = array(
    'label'       => __( 'Contact name', 'job_manager' ),
    'type'        => 'text',
    'required'    => $setreq,
    'placeholder' => '(required)',
    'priority'    => 108
  );
  return $fields;
}
add_filter( 'submit_job_form_fields', 'frontend_add_contact_name_field' );

// ADMIN
function admin_add_contact_name_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_contactname = $caes_option['caes_jobreq_contactname'] ?? null;
  if($caes_jobreq_contactname == 'hide') return;
  //if($caes_option['caes_jobreq_contactname'] == 'hide') return;
  $fields['_job_contact_name'] = array(
    'label'       => __( 'Contact name', 'job_manager' ),
    'type'        => 'text',
    'placeholder' => '',
    'description' => '',
    'priority'    => 108
  );
  return $fields;
}

add_filter( 'job_manager_job_listing_data_fields', 'admin_add_contact_name_field' );

//DISPLAY ON SINGLE JOB PAGE
function display_job_contact_name_data() {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_contactname = $caes_option['caes_jobreq_contactname'] ?? null;
  if($caes_jobreq_contactname == 'hide') return;
  global $post;
  $contact_name = get_post_meta( $post->ID, '_job_contact_name', true );
  if ( $contact_name ) {
    echo '<li class="contact_name">' . __( 'Contact name:' ) . '' . esc_html( $contact_name ) . '</li>';
  }
}
//add_action( 'single_job_listing_meta_end', 'display_job_contact_name_data' );



///// Contact position ///////
//FRONTEND
function frontend_add_contact_position_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_contactpos = $caes_option['scaes_jobreq_contactposet'] ?? null;
  if($caes_jobreq_contactpos == 'hide') return;
  $setreq = true;
  if($caes_jobreq_contactpos == 'opt') $setreq = false;
  $fields['job']['job_contact_position'] = array(
    'label'       => __( 'Contact position', 'job_manager' ),
    'type'        => 'text',
    'required'    => $setreq,
    'placeholder' => '(required)',
    'priority'    => 108
  );
  return $fields;
}
add_filter( 'submit_job_form_fields', 'frontend_add_contact_position_field' );

// ADMIN
function admin_add_contact_position_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_contactpos = $caes_option['caes_jobreq_contactpos'] ?? null;
  if($caes_jobreq_contactpos == 'hide') return;
  //if($caes_option['caes_jobreq_contactpos'] == 'hide') return;
  $fields['_job_contact_position'] = array(
    'label'       => __( 'Contact position', 'job_manager' ),
    'type'        => 'text',
    'placeholder' => '',
    'description' => '',
    'priority'    => 108
  );
  return $fields;
}

add_filter( 'job_manager_job_listing_data_fields', 'admin_add_contact_position_field' );

//DISPLAY ON SINGLE JOB PAGE
function display_job_contact_position_data() {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_contactpos = $caes_option['caes_jobreq_contactpos'] ?? null;
  if($caes_jobreq_contactpos == 'hide') return;
  global $post;
  $contact_position = get_post_meta( $post->ID, '_job_contact_position', true );
  if ( $contact_position ) {
    echo '<li class="contact_position">' . __( 'Contact position:' ) . '' . esc_html( $contact_position ) . '</li>';
  }
}
//add_action( 'single_job_listing_meta_end', 'display_job_contact_position_data' );


///// Contact email address ///////
//FRONTEND
function frontend_add_contact_email_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_contactemail = $caes_option['caes_jobreq_contactemail'] ?? null;
  if($caes_jobreq_contactemail == 'hide') return;
  $setreq = true;
  if($caes_jobreq_contactemail == 'opt') $setreq = false;
  $fields['job']['job_contact_email'] = array(
    'label'       => __( 'Contact email address', 'job_manager' ),
    'type'        => 'text',
    'required'    => $setreq,
    'placeholder' => '(required)',
    'priority'    => 108
  );
  return $fields;
}
add_filter( 'submit_job_form_fields', 'frontend_add_contact_email_field' );

// ADMIN
function admin_add_contact_email_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_contactemail = $caes_option['caes_jobreq_contactemail'] ?? null;
  if($caes_jobreq_contactemail == 'hide') return;
  //if($caes_option['caes_jobreq_contactemail'] == 'hide') return;
  $fields['_job_contact_email'] = array(
    'label'       => __( 'Contact email address', 'job_manager' ),
    'type'        => 'text',
    'placeholder' => '',
    'description' => '',
    'priority'    => 108
  );
  return $fields;
}

add_filter( 'job_manager_job_listing_data_fields', 'admin_add_contact_email_field' );

//DISPLAY ON SINGLE JOB PAGE
function display_job_contact_email_data() {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_contactemail = $caes_option['caes_jobreq_contactemail'] ?? null;
  if($caes_jobreq_contactemail == 'hide') return;
  global $post;
  $contact_email = get_post_meta( $post->ID, '_job_contact_email', true );
  if ( $contact_email ) {
    echo '<li class="contact_email">' . __( 'Contact email address:' ) . '' . esc_html( $contact_email ) . '</li>';
  }
}
//add_action( 'single_job_listing_meta_end', 'display_job_contact_email_data' );


///// Contact phone number ///////
//FRONTEND
function frontend_add_contact_phnbr_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_contactph = $caes_option['caes_jobreq_contactph'] ?? null;
  if($caes_jobreq_contactph == 'hide') return;
  $setreq = true;
  if($caes_jobreq_contactph == 'opt') $setreq = false;
  $fields['job']['job_contact_phnbr'] = array(
    'label'       => __( 'Contact phone number', 'job_manager' ),
    'type'        => 'text',
    'required'    => $setreq,
    'placeholder' => '(required)',
    'priority'    => 108
  );
  return $fields;
}
add_filter( 'submit_job_form_fields', 'frontend_add_contact_phnbr_field' );

// ADMIN
function admin_add_contact_phnbr_field( $fields ) {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_contactph = $caes_option['caes_jobreq_contactph'] ?? null;
  if($caes_jobreq_contactph == 'hide') return;
 //if($caes_option['caes_jobreq_contactph'] == 'hide') return;
  $fields['_job_contact_phnbr'] = array(
    'label'       => __( 'Contact phone number', 'job_manager' ),
    'type'        => 'text',
    'placeholder' => '',
    'description' => '',
    'priority'    => 108
  );
  return $fields;
}

add_filter( 'job_manager_job_listing_data_fields', 'admin_add_contact_phnbr_field' );

//DISPLAY ON SINGLE JOB PAGE
function display_job_contact_phnbr_data() {
  //$caes_option = caes_get_global_options();
  $caes_option = get_option('caes_options');
  $caes_jobreq_contactph = $caes_option['caes_jobreq_contactph'] ?? null;
  if($caes_jobreq_contactph == 'hide') return;
  global $post;
  $contact_phnbr = get_post_meta( $post->ID, '_job_contact_phnbr', true );
  if ( $contact_phnbr ) {
    echo '<li class="contact_phnbr">' . __( 'Contact phone number:' ) . '' . esc_html( $contact_phnbr ) . '</li>';
  }
}
//add_action( 'single_job_listing_meta_end', 'display_job_contact_phnbr_data' );


/*
///// TEST: START  ///////
//FRONTEND
function frontend_add_test_field( $fields ) {
  $fields['job']['job_test'] = array(
    'label' => __( 'State', 'job_manager' ),
 'type' => 'select',
 'required' => true,
 'options' => array('', 'alabama' => 'Alabama', 'alaska' => 'Alaska', 'arizona' => 'Arizona', 'arkansas' => 'Arkansas', 'california' => 'California', 'colorado' => 'Colorado', 'connecticut' => 'Connecticut', 'delaware' => 'Delaware', 'dc' => 'DC', 'florida' => 'Florida', 'georgia' => 'Georgia', 'hawaii' => 'Hawaii', 'idaho' => 'Idaho', 'illinois' => 'Illinois', 'indiana' => 'Indiana', 'iowa' => 'Iowa', 'kansas' => 'Kansas', 'kentucky' => 'Kentucky', 'louisiana' => 'Louisiana', 'maine' => 'Maine', 'maryland' => 'Maryland', 'massachusetts' => 'Massachusetts', 'michigan' => 'Michigan', 'minnesota' => 'Minnesota', 'mississippi' => 'Mississippi', 'missouri' => 'Missouri', 'montana' => 'Montana', 'nebraska' => 'Nebraska', 'nevada' => 'Nevada', 'new hampshire' => 'New Hampshire', 'new jersey' => 'New Jersey', 'new mexico' => 'New Mexico', 'new york' => 'New York', 'north carolina' => 'North Carolina', 'north dakota' => 'North Dakota', 'ohio' => 'Ohio', 'oklahoma' => 'Oklahoma', 'oregon' => 'Oregon', 'pennsylvania' => 'Pennsylvania', 'rhode island' => 'Rhode Island', 'south carolina' => 'South Carolina', 'south dakota' => 'South Dakota', 'tennessee' => 'Tennessee', 'texas' => 'Texas', 'utah' => 'Utah', 'vermont' => 'Vermont', 'virginia' => 'Virginia', 'washington' => 'Washington', 'west virginia' => 'West Virginia', 'wisconsin' => 'Wisconsin', 'wyoming' => 'Wyoming', 'out of us' => 'Out of US'),
 'placeholder' => '',
 'priority' => 3
  );
  return $fields;
}
add_filter( 'submit_job_form_fields', 'frontend_add_test_field' );

// ADMIN
function admin_add_test_field( $fields ) {
  $fields['_job_test'] = array(
    'label' => __( 'State', 'job_manager' ),
 'type' => 'select',
 'options' => array('', 'alabama' => 'Alabama', 'alaska' => 'Alaska', 'arizona' => 'Arizona', 'arkansas' => 'Arkansas', 'california' => 'California', 'colorado' => 'Colorado', 'connecticut' => 'Connecticut', 'delaware' => 'Delaware', 'dc' => 'DC', 'florida' => 'Florida', 'georgia' => 'Georgia', 'hawaii' => 'Hawaii', 'idaho' => 'Idaho', 'illinois' => 'Illinois', 'indiana' => 'Indiana', 'iowa' => 'Iowa', 'kansas' => 'Kansas', 'kentucky' => 'Kentucky', 'louisiana' => 'Louisiana', 'maine' => 'Maine', 'maryland' => 'Maryland', 'massachusetts' => 'Massachusetts', 'michigan' => 'Michigan', 'minnesota' => 'Minnesota', 'mississippi' => 'Mississippi', 'missouri' => 'Missouri', 'montana' => 'Montana', 'nebraska' => 'Nebraska', 'nevada' => 'Nevada', 'new hampshire' => 'New Hampshire', 'new jersey' => 'New Jersey', 'new mexico' => 'New Mexico', 'new york' => 'New York', 'north carolina' => 'North Carolina', 'north dakota' => 'North Dakota', 'ohio' => 'Ohio', 'oklahoma' => 'Oklahoma', 'oregon' => 'Oregon', 'pennsylvania' => 'Pennsylvania', 'rhode island' => 'Rhode Island', 'south carolina' => 'South Carolina', 'south dakota' => 'South Dakota', 'tennessee' => 'Tennessee', 'texas' => 'Texas', 'utah' => 'Utah', 'vermont' => 'Vermont', 'virginia' => 'Virginia', 'washington' => 'Washington', 'west virginia' => 'West Virginia', 'wisconsin' => 'Wisconsin', 'wyoming' => 'Wyoming', 'out of us' => 'Out of US'),
 'placeholder' => '',
  );
  return $fields;
}

add_filter( 'job_manager_job_listing_data_fields', 'admin_add_test_field' );

//DISPLAY ON SINGLE JOB PAGE
function display_job_test_data() {
  global $post;
  $test = get_post_meta( $post->ID, '_job_test', true );
  if ( $test ) {
    $output = '<div id="jobduties">';
    $output .= '<h3>Job TEST</h3>';
    $output .= '<p>'.  $test  .'</p>';
    $output .= '</div>';
    echo $output;
  }
}





// This can either be done with a filter (below) or the field can be added directly to the job-filters.php template file!

 // job-manager-filter class handling was added in v1.23.6

add_action( 'job_manager_job_filters_search_jobs_end', 'filter_by_state_field' );

function filter_by_state_field() {
	?>
	<div class="search_categories">
		<label for="search_categories"><?php _e( 'State', 'wp-job-manager' ); ?></label>
		<select name="filter_by_state" class="job-manager-filter">
			<option value=""><?php _e( 'Any State', 'wp-job-manager' ); ?></option>
			<option value="alabama"><?php _e( 'Alabama', 'wp-job-manager' ); ?></option><option value="alaska"><?php _e( 'Alaska', 'wp-job-manager' ); ?></option><option value="arizona"><?php _e( 'Arizona', 'wp-job-manager' ); ?></option><option value="arkansas"><?php _e( 'Arkansas', 'wp-job-manager' ); ?></option><option value="california"><?php _e( 'California', 'wp-job-manager' ); ?></option><option value="colorado"><?php _e( 'Colorado', 'wp-job-manager' ); ?></option><option value="connecticut"><?php _e( 'Connecticut', 'wp-job-manager' ); ?></option><option value="delaware"><?php _e( 'Delaware', 'wp-job-manager' ); ?></option><option value="dc"><?php _e( 'DC', 'wp-job-manager' ); ?></option><option value="florida"><?php _e( 'Florida', 'wp-job-manager' ); ?></option><option value="georgia"><?php _e( 'Georgia', 'wp-job-manager' ); ?></option><option value="hawaii"><?php _e( 'Hawaii', 'wp-job-manager' ); ?></option><option value="idaho"><?php _e( 'Idaho', 'wp-job-manager' ); ?></option><option value="illinois"><?php _e( 'Illinois', 'wp-job-manager' ); ?></option><option value="indiana"><?php _e( 'Indiana', 'wp-job-manager' ); ?></option><option value="iowa"><?php _e( 'Iowa', 'wp-job-manager' ); ?></option><option value="kansas"><?php _e( 'Kansas', 'wp-job-manager' ); ?></option><option value="kentucky"><?php _e( 'Kentucky', 'wp-job-manager' ); ?></option><option value="louisiana"><?php _e( 'Louisiana', 'wp-job-manager' ); ?></option><option value="maine"><?php _e( 'Maine', 'wp-job-manager' ); ?></option><option value="maryland"><?php _e( 'Maryland', 'wp-job-manager' ); ?></option><option value="massachusetts"><?php _e( 'Massachusetts', 'wp-job-manager' ); ?></option><option value="michigan"><?php _e( 'Michigan', 'wp-job-manager' ); ?></option><option value="minnesota"><?php _e( 'Minnesota', 'wp-job-manager' ); ?></option><option value="mississippi"><?php _e( 'Mississippi', 'wp-job-manager' ); ?></option><option value="missouri"><?php _e( 'Missouri', 'wp-job-manager' ); ?></option><option value="montana"><?php _e( 'Montana', 'wp-job-manager' ); ?></option><option value="nebraska"><?php _e( 'Nebraska', 'wp-job-manager' ); ?></option><option value="nevada"><?php _e( 'Nevada', 'wp-job-manager' ); ?></option><option value="new hampshire"><?php _e( 'New Hampshire', 'wp-job-manager' ); ?></option><option value="new jersey"><?php _e( 'New Jersey', 'wp-job-manager' ); ?></option><option value="new mexico"><?php _e( 'New Mexico', 'wp-job-manager' ); ?></option><option value="new york"><?php _e( 'New York', 'wp-job-manager' ); ?></option><option value="north carolina"><?php _e( 'North Carolina', 'wp-job-manager' ); ?></option><option value="north dakota"><?php _e( 'North Dakota', 'wp-job-manager' ); ?></option><option value="ohio"><?php _e( 'Ohio', 'wp-job-manager' ); ?></option><option value="oklahoma"><?php _e( 'Oklahoma', 'wp-job-manager' ); ?></option><option value="oregon"><?php _e( 'Oregon', 'wp-job-manager' ); ?></option><option value="pennsylvania"><?php _e( 'Pennsylvania', 'wp-job-manager' ); ?></option><option value="rhode island"><?php _e( 'Rhode Island', 'wp-job-manager' ); ?></option><option value="south carolina"><?php _e( 'South Carolina', 'wp-job-manager' ); ?></option><option value="south dakota"><?php _e( 'South Dakota', 'wp-job-manager' ); ?></option><option value="tennessee"><?php _e( 'Tennessee', 'wp-job-manager' ); ?></option><option value="texas"><?php _e( 'Texas', 'wp-job-manager' ); ?></option><option value="utah"><?php _e( 'Utah', 'wp-job-manager' ); ?></option><option value="vermont"><?php _e( 'Vermont', 'wp-job-manager' ); ?></option><option value="virginia"><?php _e( 'Virginia', 'wp-job-manager' ); ?></option><option value="washington"><?php _e( 'Washington', 'wp-job-manager' ); ?></option><option value="west virginia"><?php _e( 'West Virginia', 'wp-job-manager' ); ?></option><option value="wisconsin"><?php _e( 'Wisconsin', 'wp-job-manager' ); ?></option><option value="wyoming"><?php _e( 'Wyoming', 'wp-job-manager' ); ?></option><option value="out of us"><?php _e( 'Out of US', 'wp-job-manager' ); ?></option>
		</select>
	</div>
	<?php
}

//This code gets your posted field and modifies the job search query

add_filter( 'job_manager_get_listings', 'filter_by_state_field_query_args', 10, 2 );

function filter_by_state_field_query_args( $query_args, $args ) {
	if ( isset( $_POST['form_data'] ) ) {
		parse_str( $_POST['form_data'], $form_data );

		// If this is set, we are filtering by state
		if ( ! empty( $form_data['filter_by_state'] ) ) {
			$selected_range = sanitize_text_field( $form_data['filter_by_state'] );
			$query_args['meta_query'][] = array(
						'key'     => '_job_test',
						'value'   => $selected_range,
					);

			// This will show the 'reset' link
			add_filter( 'job_manager_get_listings_custom_filter', '__return_true' );
		}
	}
	return $query_args;
}


///// TEST: END //////////

*/


////////////// END WP JOB MANAGER CUSTOM ///////////////////////