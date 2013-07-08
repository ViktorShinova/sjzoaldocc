<?php

class Formatter {

	const DATE_LONG = 'long';
	const DATE_SHORT = 'short';
	const DATE_MONTH_YEAR = 'month_year';
	const DATE_LONG_W_TIME = 'tlwt'; // abbr of date long with time
	const DATE_SHORT_W_TIME = 'tswt'; //abbr of date short with time
	const PART_TIME = 'PT';

	public static function format_date($date, $type) {

		switch ($type) {
			case self::DATE_LONG :
			default:
				$_date = new DateTime($date);
				return date_format($_date, 'd F Y');
				break;
			case self::DATE_SHORT :
				$_date = new DateTime($date);
				return date_format($_date, 'd/m/y');
				break;

			case self::DATE_LONG_W_TIME :
				$_date = new DateTime($date);
				return date_format($_date, 'd F Y H:i a');
				break;
			case self::DATE_SHORT_W_TIME :
				$_date = new DateTime($date);
				return date_format($_date, 'd/m/y H:i a');
				break;
			case self::DATE_MONTH_YEAR :
				$_date = new DateTime($date);
				return date_format($_date, 'F Y');
				break;
		}
	}

	public static function format_dollar($n, $digits = 2) {

		// If the item is numric, format it
		$n = (float) $n;

		// Negative values
		if ($n < 0) {
			$n = number_format($n, $digits);
		}
		// All other values
		else if ($n) {
			$n = number_format($n, $digits);
		}
		// 0
		else {
			$n = '0.00';
		}

		return $n;
	}

	public static function format_bytes($bytes, $precision = 2) {

		$units = array('B', 'KB', 'MB', 'GB', 'TB');

		$bytes = max($bytes, 0);
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
		$pow = min($pow, count($units) - 1);

		$bytes /= pow(1024, $pow);
		//$bytes /= (1 << (1024 * $pow));

		return round($bytes, $precision) . ' ' . $units[$pow+1];
	}

	public static function format_filetype($file) {
		//maybe u can try and use const here so we don have to look thru the code to find this
		switch ($file) {
			case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
				return 'doc';
				break;
			case 'application/msword':
				return 'doc';
				break;
			case 'application/pdf':
				return 'pdf';
				break;
			
			case 'text/plain':
			default:
				return 'txt';
				break;
		}
	}

	public static function format_reverse_filetype($type) {
		//maybe u can try and use const here so we don have to look thru the code to find this
		switch ($type) {
			case 'doc':
				return 'application/msword';
				break;
			case 'pdf':
				return 'application/pdf';
				break;
		}
	}

	public static function format_worktype($type) {

		switch ($type) {

			case self::PART_TIME:
				return 'Part time';
			default:
				return 'test';
		}
	}
	
	public static function strip_tags($text) {
		
		
		$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript 
					   '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly 
					   '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA 
		); 
		
		$text = preg_replace($search, '', $text); 
		return $text;
	}

	// private static function format_date($date) {
	// 	if($date != "") {
	// 		list($day, $month, $year) = explode("/", $date);
	// 		$formatted_date = $year.'-'.$month.'-'.$day;
	// 	} else {
	// 		$formatted_date = null;
	// 	}
	// 	return $formatted_date;
	// }
}