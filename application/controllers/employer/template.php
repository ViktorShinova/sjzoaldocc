<?php

class Employer_Template_Controller extends Base_Controller {

	public function __construct() {

		parent::__construct();

		$this->filter('before', 'auth')->only(
				array(
					'templating',
					'save_template',
					'templates',
					'template_edit',
					'template_delete',
					'template_preview',
				)
		);

		$this->filter('before', 'employer')->only(
				array(
					'templating',
					'save_template',
					'templates',
					'template_edit',
					'template_delete',
					'template_preview',
				)
		);
	}	
	
	public function get_list() {
		$templates = Template::order_by('created_at', 'asc')
				->where('id', "!=", 1)
				->paginate(20);
		//die(var_dump($templates->results));
		return View::make('employer.templates')->with(array('templates' => $templates));
	}
	
	
	public function get_create($id = null) {
		if (!$id) {
			return View::make('employer.templating');
		} else {
			$template = Template::find($id);
			return View::make('employer.templating')->with(array('template' => $template, 'data' => unserialize($template->data)));
		}
	}

	public function post_create($id = null) {

		$employer = Employer::find(Session::get("employer_id"));

		$default_css = Template::find(1)->css;
		if (!$id) {
			$temp = null;
		} else {
			$template = Template::find($id);
			$temp = unserialize($template->data);
		}

		//local variable
		$header_image = null;
		$body_image = null;
		$footer_image = null;


		//HEADER
		$header_text_align = Input::get('head-text-align');
		$header_repeat = Input::get('header-repeat');
		$header_position = Input::get('header-position');

		//BODY
		$body_repeat = Input::get('body-repeat');
		$body_position = Input::get('body-position');

		//FOOTER
		$footer_repeat = Input::get('footer-repeat');
		$footer_position = Input::get('footer-position');

		//Store them in an array in order to serialize them later on

		if (!$temp) {
			$temp = array(
				'header_text_align' => $header_text_align,
				'header_repeat' => $header_repeat,
				'header_position' => $header_position,
				'body_repeat' => $body_repeat,
				'body_position' => $body_position,
				'footer_repeat' => $footer_repeat,
				'footer_position' => $footer_position,
			);
		} else {
			$temp['header_text_align'] = $header_text_align;
			$temp['header_repeat'] = $header_repeat;
			$temp['header_position'] = $header_position;
			$temp['body_repeat'] = $body_repeat;
			$temp['body_position'] = $body_position;
			$temp['footer_repeat'] = $footer_repeat;
			$temp['footer_position'] = $footer_position;
		}


		//var_dump($temp);
		//Image upload
		if (Input::has_file('header-background')) {
			$header_image = Input::file('header-background');
			Input::upload("header-background", EMP_UPLOAD_DIR . $employer->unique_folder . '/backgrounds/header', $header_image['name']);
			$temp['header_background'] = "/uploads/employer/" . $employer->unique_folder . "/backgrounds/header/{$header_image['name']}";
		}

		if (Input::has_file('body-background')) {
			$body_image = Input::file('body-background');
			Input::upload("body-background", EMP_UPLOAD_DIR . $employer->unique_folder . '/backgrounds/body', $body_image['name']);
			$temp['body_background'] = "/uploads/employer/" . $employer->unique_folder . "/backgrounds/body/{$body_image['name']}";
		}

		if (Input::has_file('footer-background')) {
			$footer_image = Input::file('footer-background');
			Input::upload("footer-background", EMP_UPLOAD_DIR . $employer->unique_folder . '/backgrounds/footer', $footer_image['name']);
			$temp['footer_background'] = "/uploads/employer/" . $employer->unique_folder . "/backgrounds/footer/{$footer_image['name']}";
		}

		$search = array(
			"/*HEADER-BACKGROUND-REPEAT*/",
			"/*HEADER-BACKGROUND-IMAGE*/",
			"/*HEADER-BACKGROUND-POSITION*/",
			"/*TEXT-ALIGN*/",
			"/*BODY-BACKGROUND-REPEAT*/",
			"/*BODY-BACKGROUND-IMAGE*/",
			"/*BODY-BACKGROUND-POSITION*/",
			"/*FOOTER-BACKGROUND-REPEAT*/",
			"/*FOOTER-BACKGROUND-IMAGE*/",
			"/*FOOTER-BACKGROUND-POSITION*/"
		);

		$replace = array(
			(!$temp['header_repeat']) ? "" : "background-repeat: {$temp['header_repeat']};",
			"background-image: " . ((!isset($temp['header_background'])) ? "none;" : "url({$temp['header_background']});" ),
			(!$temp['header_position']) ? "" : "background-position: {$temp['header_position']} ;",
			"text-align: {$temp['header_text_align']};",
			(!$temp['body_repeat']) ? "" : "background-repeat: {$temp['body_repeat']};",
			"background-image: " . ((!isset($temp['body_background'])) ? "none;" : "url({$temp['body_background']});"),
			(!$temp['body_position']) ? "" : "background-position: {$temp['body_position']} ;",
			(!$temp['footer_repeat']) ? "" : "background-repeat: {$temp['footer_repeat']};",
			"background-image: " . ((!isset($temp['footer_background'])) ? "none;" : "url({$temp['footer_background']});"),
			(!$temp['footer_position']) ? "" : "background-position: {$temp['footer_position']} ;",
		);

		$custom_css = str_replace($search, $replace, $default_css);

		var_dump($custom_css);
		//die();

		if (!$id) {
			$template = new Template;
			$template->css = $custom_css;
			$template->name = Input::get('template-name');
			$template->data = serialize($temp);
			$template->header = ((!isset($temp['header_background'])) ? "" : $temp['header_background']);
			$template->body = ((!isset($temp['body_background'])) ? "" : $temp['body_background']);
			$template->footer = ((!isset($temp['footer_background'])) ? "" : $temp['footer_background']);
			$template->save();
		} else {

			$template = Template::find($id);
			$template->css = $custom_css;
			$template->name = Input::get('template-name');
			$template->data = serialize($temp);
			$template->header = ((!isset($temp['header_background'])) ? "" : $temp['header_background']);
			$template->body = ((!isset($temp['body_background'])) ? "" : $temp['body_background']);
			$template->footer = ((!isset($temp['footer_background'])) ? "" : $temp['footer_background']);
			$template->save();
		}

		//Remove all files in the tmp folder
		$this->_remove_tmp_files('backgrounds', $employer->unique_folder, 'employer');

		return Redirect::to('/employer/template/list');
	}

	

	public function post_delete($id = null) {
		if (!$id) {
			return false;
		}

		$template = Template::find($id);

		foreach ($template->jobs as $job) {
			//reset the id of the template to the default one
			$job->template_id = 1;
			$job->save();
		}
		$template->delete();
	}

	public function get_preview($id = null) {

		if (!$id) {
			return false;
		}

		$template = Template::find($id);

		return View::make('employer.preview')->with(array('template' => $template));
	}

}
