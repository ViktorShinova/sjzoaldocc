<?php

class ApplicantCoverletters extends Eloquent {

	public static $table = "applicant_coverletters";
	const FILE_EXISTS = -1;
	const FILE_SUCCESS = 1;
	const FILE_FAILURE = 0;
	public function applicant() {
		return $this->belongs_to('Applicant');
	}

	public static function uploadCoverletter($filename, $size, $filetype, $name) {

		$folder = APP_UPLOAD_DIR . md5(Auth::user()->username) . '/coverletter/';

		if (!is_dir($folder)) {
			mkdir($folder, 777);
		}
		if (!file_exists($folder . $filename)) {
			Input::upload($name, $folder, $filename);
			$path = str_replace('public', '', $folder) . $filename;

			$applicant_coverletter = new ApplicantCoverletters();
			$applicant_coverletter->applicant_id = Session::get('applicant_id');
			$applicant_coverletter->coverletter = $filename;
			$applicant_coverletter->path = $path;
			$applicant_coverletter->filesize = Formatter::format_bytes($size, 0);
			$applicant_coverletter->type = Formatter::format_filetype($filetype);
			$applicant_coverletter->disabled = 0;


			if ( $applicant_coverletter->save() ) {
				return self::FILE_SUCCESS;
			}
			return self::FILE_FAILURE;
		} else {
			return self::FILE_EXISTS;
		}
	}

}