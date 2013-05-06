<?php 

class Formatter {
	
	
	const DATE_LONG = 'long';
	const DATE_SHORT = 'short';
	const DATE_MONTH_YEAR = 'month_year';
	const DATE_LONG_W_TIME = 'tlwt'; // abbr of date long with time
	const DATE_SHORT_W_TIME = 'tswt'; //abbr of date short with time
	
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
	
	public static function format_dollar( $n , $digits = 2 ) {
		
		// If the item is numric, format it
		$n = (float) $n;
		
		// Negative values
		if ( $n < 0 ) {
			$n = number_format( $n , $digits );
		}
		// All other values
		else if ( $n ) {
			$n = number_format( $n , $digits );
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

		//$bytes /= pow(1024, $pow);
		$bytes /= (1 << (10 * $pow)); 

		return round($bytes, $precision) . ' ' . $units[$pow]; 
	} 

	public static function format_filetype($file) {
		//maybe u can try and use const here so we don have to look thru the code to find this
		switch($file) {
			case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
			return 'doc';
		break;
			case 'application/msword':
			return 'doc';
		break;
			case 'application/pdf':
			return 'pdf';
		break;
		}         
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