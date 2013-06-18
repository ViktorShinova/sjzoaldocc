<?php 

class ApplicantResumes extends Eloquent {
	
	public static $table = "applicant_resumes";

	const FILE_EXISTS = -1;
	const FILE_SUCCESS = 1;
	const FILE_FAILURE = 0;
	public function applicant()
	{
		return $this->belongs_to('Applicant');
	}
	
	public static function uploadResume($filename, $size, $filetype, $name) {
		
		$folder = APP_UPLOAD_DIR . md5(Auth::user()->username) . '/resume/';
		
		if (!is_dir($folder)) {
			mkdir($folder, 777, true);
		}
		if (!file_exists($folder . $filename ))  {
			
			Input::upload($name, $folder, $filename);
			$path = str_replace('public', '', $folder) . $filename;
			
			$applicant_resume = new ApplicantResumes();
			$applicant_resume->applicant_id = Session::get('applicant_id');
			$applicant_resume->resume = $filename;
			$applicant_resume->path = $path;
			$applicant_resume->filesize = Formatter::format_bytes($size, 0);
			$applicant_resume->type = Formatter::format_filetype($filetype);
			$applicant_resume->disabled = 0;
			
			
			if ( $applicant_resume->save() ) {
				return self::FILE_SUCCESS;
			}
			return self::FILE_FAILURE;
		} else {
			return self::FILE_EXISTS;
		}
		
	}
	
	
}