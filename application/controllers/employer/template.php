<?php

class Employer_Template_Controller extends Base_Controller {
	
	protected $_secure_pages = array(
		'templating',
		'save_template',
		'templates',
		'template_edit',
		'template_delete',
		'template_preview',
		'create'
	);
	
	protected $_position_options = array(
		'Top' => array(
			'top left' => 'Top Left',
			'top center' => 'Top Center',
			'top right' => 'Top Right'
		),
		'Center' => array(
			'center left' => 'Left',
			'center' => 'Center',
			'center right' => 'Right'
		),
		'Bottom' => array(
			'bottom left' => 'Bottom Left',
			'bottom center' => 'Bottom Center',
			'bottom right' => 'Bottom Right',
		),
	);
	
	public function __construct() {

		parent::__construct();

		$this->filter('before', 'auth')->only(
				$this->_secure_pages
		);

		$this->filter('before', 'employer')->only(
				$this->_secure_pages
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
			return View::make('employer.templating')
					->with('position_options', $this->_position_options);
		} else {
			$template = Template::find($id);
			
//			var_dump(unserialize($template->data));
//			die();
			return View::make('employer.templating')
					->with(
							array(
								'template' => $template, 
								'data' => unserialize($template->data),
								'position_options' => $this->_position_options,
								)
							);
		}
	}

	public function post_create($id = null) {
		
		$employer = Employer::find(Session::get("employer_id"));
		$temp = Input::all();
		
		$previous_data = null;
		if (!$id) {
			$temp = Input::all();
		} else {
			$template = Template::find($id);
			$previous_data = unserialize($template->data);
		}
		
		
		if (Input::has_file('header-background') && Input::get('title-type') == 'title' ) {
			$header_bg_image = Input::file('header-background');
			Input::upload("header-background", EMP_UPLOAD_DIR . $employer->unique_folder . '/backgrounds/header', $header_bg_image['name']);
			$temp['header-background'] = "/uploads/employer/" . $employer->unique_folder . "/backgrounds/header/{$header_bg_image['name']}";
		} else {
			unset( $temp['header-background'] );
		}
		
		if( Input::has_file('header-image') && Input::get('title-type') == 'image') {
			$header_image = Input::file('header-image');
			$_image_folder = EMP_UPLOAD_DIR . $employer->unique_folder . '/templates/header';
			$imgHandler = new ImageHandler($_image_folder);
					
			$imgHandler->setImage($header_image['tmp_name'], $header_image['name']);
			$imgHandler->resize(768, 120, true, false);
			$imgHandler->close();

			$temp['header-image'] = $imgHandler->getFrontEndImagePath();
		} else {
			
			if( isset($previous_data['header-image'])) {
				$temp['header-image'] = $previous_data['header-image'];
			} else {
				unset( $temp['header-image'] );
			}
		}

		if (Input::has_file('body-background')) {
			$body_image = Input::file('body-background');
			Input::upload("body-background", EMP_UPLOAD_DIR . $employer->unique_folder . '/backgrounds/body', $body_image['name']);
			$temp['body-background'] = "/uploads/employer/" . $employer->unique_folder . "/backgrounds/body/{$body_image['name']}";
		} else {
			unset( $temp['body-background'] );
		}

		if (Input::has_file('footer-background')) {
			$footer_image = Input::file('footer-background');
			Input::upload("footer-background", EMP_UPLOAD_DIR . $employer->unique_folder . '/backgrounds/footer', $footer_image['name']);
			$temp['footer-background'] = "/uploads/employer/" . $employer->unique_folder . "/backgrounds/footer/{$footer_image['name']}";
		} else {
			unset( $temp['footer-background'] );
		}
		
		$custom_css = View::make('employer.templatecss')
							->with('temp', $temp)->render();
		

		$template = null;
		if (!$id) {
			$template = new Template;
			$template->css = $custom_css;
			$template->name = Input::get('template-name');
			$template->data = serialize($temp);
//			$template->header = ((!isset($temp['header-background'])) ? "" : $temp['header_background']);
//			$template->body = ((!isset($temp['body-background'])) ? "" : $temp['body_background']);
//			$template->footer = ((!isset($temp['footer-background'])) ? "" : $temp['footer_background']);
			$template->save();
			
			
			
		} else {

			$template = Template::find($id);
			$template->css = $custom_css;
			$template->name = Input::get('template-name');
			$template->data = serialize($temp);
//			$template->header = ((!isset($temp['header_background'])) ? "" : $temp['header_background']);
//			$template->body = ((!isset($temp['body_background'])) ? "" : $temp['body_background']);
//			$template->footer = ((!isset($temp['footer_background'])) ? "" : $temp['footer_background']);
			$template->save();
		}

		//$this->generate_image($template);
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

		return View::make('employer.preview')
				->with('template', $template)
				->with('data', unserialize($template->data));
	}
	
	protected function generate_image($template) {
		
//		$html_code =  View::make('employer.preview')->with(array('template' => $template))->render();
//		
//		shell_exec("C:\wamp\www\careershire\wkhtmltoall\wkhtmltoimage --version 2>> http://google.com 1>> test.png");
//		var_dump('test');
		//
//		# Display the image 
//		header("Content-type: image/jpeg"); 
//		imagejpeg($img); 

		die();
		
	}

}
