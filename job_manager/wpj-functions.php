<?php
////////////// START WP JOB MANAGER CUSTOM ///////////////////////

// change required



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