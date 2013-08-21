<?php

class Base_Controller extends Controller {

	public $restful = true;
	protected $_host = '';
	
	protected $_min_salary = array(
		'0' => '0',
		'30000' => '30k',
		'40000' => '40k',
		'50000' => '50k',
		'60000' => '60k',
		'70000' => '70k',
		'80000' => '80k',
		'90000' => '90k',
		'100000' => '10k',
		'110000' => '110k',
		'120000' => '140k',
		'130000' => '130k',
		'140000' => '140k',
		'150000' => '150k',
	);
	
	protected $_h_min_salary = array(
		'0' => '0',
		'30' => '30/hr',
		'40' => '40/hr',
		'50' => '50/hr',
		'60' => '60/hr',
		'70' => '70/hr',
		'80' => '80/hr',
		'90' => '90/hr',
		'100' => '10/hr',
		'110' => '110/hr',
		'120' => '140/hr',
		'130' => '130/hr',
		'140' => '140/hr',
		'150' => '150/hr',
	);
	public $colors = array("green", "red", "yellow", "purple");

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __construct() {
		$this->_host = $_SERVER['HTTP_HOST'];
		parent::__construct();
	}

	public function __call($method, $parameters) {
		return Response::error('404');
	}

	protected function _cleanReturnUrl($referer) {


		if (strpos($referer, 'index.php')) {
			return str_replace('index.php/', '', $referer);
		} else {
			return $referer;
		}
	}

	protected function _remove_tmp_files($folder, $unique_folder_name, $role) {
		$directory = TMP_IMAGE_FOLDER . $role . '/' . $unique_folder_name . '/' . $folder . '/';
		File::rmdir($directory);
	}

	//only for ajax call
	protected function get_sub_category($id = null) {
		if ($id) {
			$sub_category = SubCategory::where('category_id', "=", $id)->lists("name", "id");
			$sub_category = array('' => 'Choose a sub category') + $sub_category;
			echo Form::select('sub-category', $sub_category, Session::get('old-sub-category'));

			Session::forget('old-sub-category');
		} else {
			
		}
	}

	protected function get_sub_location($id = null) {
		if ($id) {
			$sub_location = SubLocation::where('location_id', "=", $id)->lists("name", "id");
			$sub_location = array('' => 'Choose a sub location') + $sub_location;
			echo Form::select('sub-location', $sub_location, Session::get('old-sub-location'));
			Session::forget('old-sub-location');
		} else {
			
		}
	}

	protected function _calculate_max_salary($min_salary = 0, $type) {
		$max_salary = array();
		$factor = 3;
		$multiply = 10000;
		$append = 'k';
		$_j = 10;
		if ($type == 'hourly') {
			$multiply = 10;
			
			$append = '/hr';
		}
		
		
		if ($min_salary != 0) {
			$factor = $min_salary / $multiply;
		}

		for ($i = $factor; $i <= 20; $i++) {
			$max_salary[$i * $multiply] = $i * $_j . $append;
		}

		return $max_salary;
	}
	
	

}