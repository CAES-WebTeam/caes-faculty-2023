<?php

function caes_wpjm_options_settings() {
	$sections = array();
	// $sections[$id] = __($title, 'caes_textdomain');
	$sections['job_manager'] = __('Job Manager Customize', 'caes_textdomain');
	return $sections;	
}


function caes_wpjm_options_page_fields() {

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobemailnew",
			"title"   => __( 'Admin New Job Notification', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "text",
			"std"    => ''
		);
		
		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobemailupdated",
			"title"   => __( 'Admin Updated Job Notification', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "text",
			"std"    => ''
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobemailexpired",
			"title"   => __( 'Admin Expired Job Notification', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "text",
			"std"    => ''
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq",
			"title"   => __( '', 'caes_textdomain' ),
			"desc"    => __( '<hr/>"Post a Job" field and you can decide if you want to set required, optional, or hide.', 'caes_textdomain' ),
			"type"    => "hidden",
			"std"    => ''
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_description",
			"title"   => __( 'Field: Job Description', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'req',
			"choices" => array('req' => 'required (default)', 'opt' => 'optional', 'hide' => 'hide')
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_duties",
			"title"   => __( 'Field: Job Duties', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'req',
			"choices" => array('req' => 'required (default)', 'opt' => 'optional', 'hide' => 'hide')
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_qual",
			"title"   => __( 'Field: Qualifications', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'req',
			"choices" => array('req' => 'required (default)', 'opt' => 'optional', 'hide' => 'hide')
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_benefits",
			"title"   => __( 'Field: Benefits', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'req',
			"choices" => array('req' => 'required (default)', 'opt' => 'optional', 'hide' => 'hide')
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_comp",
			"title"   => __( '', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'req',
			"choices" => array('req' => 'required (default)', 'opt' => 'optional', 'hide' => 'hide')
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_appemailurl",
			"title"   => __( 'Field: Application email/URL', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'req',
			"choices" => array('req' => 'required (default)', 'opt' => 'optional', 'hide' => 'hide')
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_contactname",
			"title"   => __( 'Field: Contact name', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'req',
			"choices" => array('req' => 'required (default)', 'opt' => 'optional', 'hide' => 'hide')
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_contactpos",
			"title"   => __( 'Field: Contact position', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'req',
			"choices" => array('req' => 'required (default)', 'opt' => 'optional', 'hide' => 'hide')
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_contactemail",
			"title"   => __( 'Field: Contact email address', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'req',
			"choices" => array('req' => 'required (default)', 'opt' => 'optional', 'hide' => 'hide')
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_contactph",
			"title"   => __( 'Field: Contact phone number', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'req',
			"choices" => array('req' => 'required (default)', 'opt' => 'optional', 'hide' => 'hide')
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_comname",
			"title"   => __( 'Field: Company Name', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'req',
			"choices" => array('req' => 'required (default)', 'opt' => 'optional', 'hide' => 'hide')
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_comurl",
			"title"   => __( 'Field: Company Website', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'opt',
			"choices" => array('req' => 'required', 'opt' => 'optional (default)', 'hide' => 'hide')
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_comtagline",
			"title"   => __( 'Field: Tagline', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'opt',
			"choices" => array('req' => 'required', 'opt' => 'optional (default)', 'hide' => 'hide')
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_comvid",
			"title"   => __( 'Field: Video', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'opt',
			"choices" => array('req' => 'required', 'opt' => 'optional (default)', 'hide' => 'hide')
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_comtwitter",
			"title"   => __( 'Field: Twitter username', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'opt',
			"choices" => array('req' => 'required', 'opt' => 'optional (default)', 'hide' => 'hide')
		);

		$options[] = array(
			"section" => "job_manager",
			"id"      => caeswpjm_SHORTNAME . "jobreq_comlogo",
			"title"   => __( 'Field: Logo', 'caes_textdomain' ),
			"desc"    => __( '', 'caes_textdomain' ),
			"type"    => "option",
			"std"    => 'opt',
			"choices" => array('req' => 'required', 'opt' => 'optional (default)', 'hide' => 'hide')
		);

    return $options;	
}