<?php

class ImageHandler {

	//Class variables
	protected $_x = 0;
	protected $_y = 0;
	protected $_x2 = 0;
	protected $_y2 = 0;
	protected $_width = 0;
	protected $_height = 0;
	protected $_org_width = 0;
	protected $_org_height = 0;
	//protected $_imgSource = null;
	protected $_imgDestination = null;
	protected $_image_folder = '';
	protected $_sannitized_image = null;
	protected $_frontend_image_folder = '';
	protected $_frontend_image_path = '';
	protected $_image_name = '';

	public function __construct($imageFolder) {
		$this->_image_folder = $imageFolder;
		$this->_frontend_image_folder = '/' . str_replace(PUBLIC_DIR, '', $imageFolder);
	}
	
	
	/**
	 * 
	 * @param type $imageSrc
	 * Image source can be uploaded image ['tmp_name'] or an image path
	 */
	public function setImage($src, $imageName) {
		$imageName = explode("." , $imageName);
		$this->_image_name = $imageName[0] . '.png';

		list($this->_org_width, $this->_org_height, $type) = getimagesize($src);

		//We need to sannitise the image
		$this->_sannitized_image = $this->_image_sannitiser($type, $src);
	}

	/**
	 * 
	 * @param type $width 
	 * The resize width
	 * @param type $height
	 * The resize height
	 * @param type $force_height
	 * Boolean: if force height is set, the height will always be used as the base for resize
	 * @param type $force_width
	 * if force width is set, the width will always be used as the base for resize
	 * @return string|boolean
	 */
	public function resize($width, $height, $force_height, $force_width) {
		//var_dump($width . ' : ' . $height);
		//var_dump( $this->_org_width . ' : ' . $this->_org_height);
//before we resize, we need to check if the given height and width is smaller


		if ($this->_org_height < $height && $this->_org_width < $width) {
			$width = $this->_org_width;
			$height = $this->_org_height;
		}

		if (!$force_height && !$force_width ) {
			//landscape 
			if ($this->_org_width > $this->_org_height) {
				//for landscape we reduce the width
				//height = ( width / org_width ) * org_height;
				$height = $this->_doCalculation($width, $this->_org_width, $this->_org_height);
			} elseif ($this->_org_height > $this->_org_width) {
				// for portrait we reduce the height
				//( $height / $this->_org_height ) * $this->_org_width;
				$width = $this->_doCalculation($height, $this->_org_height, $this->_org_width);
			}
		} else if ($force_height) {
			// we must also check if height is already smaller than the resize height
			if( $this->_org_height > $height ) {
				//( $height / $this->_org_height ) * $this->_org_width;
				$width = $this->_doCalculation($height, $this->_org_height, $this->_org_width);
			}
			else if ($this->_org_width > $width ) {
				//( $width / $this->_org_width ) * $this->_org_height;
				$height = $this->_doCalculation($width, $this->_org_width, $this->_org_height);
			}
			
			
		} else if ($force_width) {
			if( $this->_org_width > $width ) {
				
				//height = ( width / org_width ) * org_height;
				$height = $this->_doCalculation($width, $this->_org_width, $this->_org_height);
			}
			else if ($this->_org_width > $width) {
				//( $height / $this->_org_height ) * $this->_org_width;
				$width = $this->_doCalculation( $height / $this->_org_height ) * $this->_org_width; 
			}
			
		}

		if ($this->_sannitized_image) {

			$newImage = imagecreatetruecolor($width, $height);
			imagealphablending($newImage, false);
			imagesavealpha($newImage, true); 
			
			imagecopyresampled($newImage, $this->_sannitized_image, $this->_x, $this->_y, $this->_x2, $this->_y2, $width, $height, $this->_org_width, $this->_org_height);
			
			//check if directory exists
			$this->_createDirectory();
			
			
			$this->_frontend_image_path = $this->_frontend_image_folder . "/" . $this->_image_name;
			imagepng($newImage, $this->_getDestFile());
			//release the memory
			imagedestroy($newImage);
			return $this->_getDestFile();
		} else {
			return false;
		}
	}
	
	/**
	 * 
	 * @param type $x
	 * x coordinate
	 * @param type $x2
	 * x ending corrdinate
	 * @param type $y
	 * y corrdinate
	 * @param type $y2
	 * y ending coordinate
	 * @param type $width 
	 * Width of the cropped image
	 * @param type $height
	 * Height of the cropped image
	 */
	public function crop($x, $x2, $y, $y2, $width, $height, $targ_width, $targ_height) {
		
		$cropImage = imagecreatetruecolor( $targ_width, $targ_height);
		imagealphablending($cropImage, false);
		imagesavealpha($cropImage, true); 
		
		imagecopyresampled($cropImage, $this->_sannitized_image, 0, 0, Input::get('x'), Input::get('y'), $targ_width, $targ_height, Input::get('w'), Input::get('h') );
		//replace cropped image
		$this->_createDirectory();
		$this->_frontend_image_path = $this->_frontend_image_folder . "/" . $this->_image_name;
		imagepng($cropImage, $this->_getDestFile());
		
		imagedestroy($cropImage);
		
		return $this->_getDestFile();
		
	}
	
	
	
	private function _doCalculation($param1, $param2, $param3 ) {
		return ( $param1 / $param2 ) * $param3;
	}
	//This will convert all image to png
	private function _image_sannitiser($mime, $src) {

		switch ($mime) {
			case IMAGETYPE_PNG:
				$image = imagecreatefrompng($src);
				imagealphablending($image, true);
				break;
			case IMAGETYPE_GIF:
				$image = imagecreatefromgif($src);
				break;
			case IMAGETYPE_JPEG:
				$image = imagecreatefromjpeg($src);
				break;
			default:
				throw new Exception('Unrecognized image type ' . $type);
				break;
		}
		//store the image
		return $image;
	}
	
	
	
	public function getFrontEndFolderPath () {
		return $this->_frontend_image_folder;
	}
	
	public function getFrontEndImagePath() {
		return $this->_frontend_image_path;
	}
	public function close() {
		imagedestroy($this->_sannitized_image);
	}
	private function _getDestFile() {
		$destFile = $this->_image_folder . "/" . $this->_image_name;
		return $destFile;
	}
	
	private function _createDirectory() {
		//check if directory exists
		if(!file_exists($this->_image_folder) && !is_dir($this->_image_folder)) {
			
			mkdir($this->_image_folder, 777,true);
		}
	}
}
