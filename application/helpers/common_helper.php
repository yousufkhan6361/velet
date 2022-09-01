<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		Muhammad Uzair Khan * Muhammad.uzair@tradekey.com
 * @copyright	Copyright (c) 2014 TKDigitals.com.
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------
/**

 */

if ( ! function_exists('pre'))
{
	function pre() {
		$args = func_get_args();

		echo "<pre>";
		foreach($args AS $ar)
			print_r($ar);
		die ;
	}
}

if ( ! function_exists('end_script'))
{
	function end_script($message) {
		echo $message;
		exit() ;
	}
}

if ( ! function_exists('end_script_json'))
{
	function end_script_json($arr) {
		$arr = is_array( $arr ) ? json_encode( $arr ) : $arr ;
		end_script( $arr ) ;
	}
}

if ( ! function_exists('debug'))
{
	function debug($param,$exit = 0)
	{
		echo "<pre>";print_r($param);echo "</pre>";
		if($exit)
			exit;
	}
}

if ( ! function_exists('prevar'))
{
	function prevar($params) {
		var_dump($params);die;
	}
}

// Check if Array is filled or empty 
if ( ! function_exists('array_filled'))
{
	function array_filled($array=array()) {
		return (is_array($array) && count($array));
	}
}

// Return array with same keys as values.
if ( ! function_exists('array_value_as_key'))
{
	function array_value_as_key($array=array()) {

		$return = array() ;
		foreach ($array as $value) {
			$return[ $value ] = $value ;
		}
		return $return;
	}
}

// Check if Array is filled or empty 
if ( ! function_exists('nl_to_list'))
{
	function nl_to_list($str="" , $start_li = "<li>", $end_li="</li>") {

		return '<ul>'.$start_li.preg_replace("/([\n]+)/", $end_li.$start_li , $str).$end_li.'</ul>';
	}
}

// Check if Array is filled or empty 
if ( ! function_exists('nl_to_br'))
{
	function nl_to_br($str="") {

		return preg_replace("/([\n]+)/", "</br>", $str);
	}
}

// Check if Array is filled or empty 
if ( ! function_exists('prepare_value'))
{
	function prepare_value($str="" , $funcs) {
		$func_array = explode("|", $funcs) ;
		foreach ($func_array as $fn) {
			if(function_exists($fn))
				$str = $fn($str);
		}
		return $str;
	}
}

// Hidden debug - For LIVE use. 
// Protects you site cosmetics while doing all the dirty work in commented HTMLs
if ( ! function_exists('live_debug'))
{
	function live_debug($params) {
		echo "<!--LIVE DEBUGGER>"; var_dump($params) ; echo"-->";
	}
}

// Checks if the view you are dreaming for really exists in reality
if ( ! function_exists('view_exists'))
{
	function view_exists($view,$class="") {

		$view_path = APPPATH."views/".$view;
		if(@file_exists($view_path.".php"))
		{
			return $view;
		}
		else
		{
			return str_replace($class."/", "default/", $view);
		}
	}
}



// This cutting-edge technology has the ability to cut through any string. 
// Just try it out if it's too good to be believed.
if ( ! function_exists('truncate'))
{
	function truncate( $text = "" , $limit = 150 ) {
		
		return ( strlen($text) > $limit ) ? ( substr($text, 0, $limit) . "..." ) : $text ;

	}
}

// Occasional JavaScript redirect.
if ( ! function_exists('redirect_script'))
{
	function redirect_script( $path ) {
		
		global $config;
		ob_clean();
		ob_start();
		echo '<script>window.location="'.$config['base_url'].$path.'";</script>';
		exit();

	}
}

// Occasional not_found redirect.
if ( ! function_exists('not_found'))
{
	function not_found( $msg ) {
		
		redirect("404?error=".urlencode($msg));
		exit();

	}
}

// If Array has an element --- IN_ARRAY.
if ( ! function_exists('inside_array'))
{
	function inside_array( $needle, $hey_stack ) 
	{
		return is_array($hey_stack) && in_array($needle, $hey_stack) ;
	}
}

// Innovate Payment - Signature verification
if ( ! function_exists('SignData'))
{
	function SignData($post_data,$secretKey,$fieldList) 
	{
		$signatureParams = explode(',', $fieldList);
		$signatureString = $secretKey;
		foreach ($signatureParams as $param) {
			if (array_key_exists($param, $post_data)) {
				$signatureString .= ':' . trim($post_data[$param]);
			} else {
				$signatureString .= ':';
			}
		}
		return sha1($signatureString);
	}
}

if ( ! function_exists('csl_date'))
{
	function csl_date($date,$format="d M, Y h:i:sA") 
	{
		return date($format,strtotime($date));
	}
}
// This returns Discount value. The prices must be in BASE Currency . ie. $
if ( ! function_exists('discount_text'))
{
	function discount_text( $discount_rate , $discount_type = "value" , $currency = "$" , $currency_rate = "1.00" , $prep_currency = true ) 
	{
		if($discount_type == "percent")
			return $prep_currency ? $discount_rate . "%" : $discount_rate ;
		else
		{
			return price($discount_rate , $currency , $currency_rate , $prep_currency) ;
		}
		 
			
	}
}

// This returns Discount value. The prices must be in BASE Currency . ie. $
if ( ! function_exists('discount_value'))
{
	function discount_value( $discount_rate , $discount_type = "value" , $price = 0 ) 
	{
		$discount_rate = floatval($discount_rate) ;
		$price = floatval($price) ;
		
		if($discount_type == 'percent') 
		{
			$discount_rate = ( $price * $discount_rate ) / 100 ;
		}
			
		return $discount_rate ;
	}
}

// This returns price w.r.t to currencies provided in the parameter
if ( ! function_exists('price'))
{
	function price( $price,$currency="$" , $currency_rate = "1.00" , $prep_currency = true )
	//function price( $price,$currency="£" , $currency_rate = "1.00" , $prep_currency = true )
	{
		if(!$currency_rate)
			$currency_rate = 1.00 ;
		
		$price = number_format($price / $currency_rate , 2 ) ;
		return $prep_currency ? ( $currency . "" . $price ) : $price ;
	}
}
if ( ! function_exists('price_without_symbol'))
{
	
	function price_without_symbol( $price,$currency= "$" , $currency_rate = "1.00" , $prep_currency = true ) 
		{

			$ci =& get_instance();

			 // debug($ci->session->userdata);

			if(isset($ci->session->userdata['conversion_rate']))
				$currency_rate = $ci->session->userdata['conversion_rate'];

			if(isset($ci->session->userdata['symbol']))
				$currency = $ci->session->userdata['symbol'];


			if(!$currency_rate)
			$currency_rate = $this->conversion_rate ;

			$price = number_format($price * $currency_rate , 2 ) ;
			return $prep_currency ? ( $price ) : $price ;

		}
}

// This returns price from currency provided to Base Currency : PKR
if ( ! function_exists('price_reverse'))
{
	function price_reverse( $price,$currency="$" , $currency_rate = "1.00" , $prep_currency = true ) 
	{
		$price = number_format($price * $currency_rate , 2 ) ;
		return $prep_currency ? ( $currency . " " . $price ) : $price ;
	}
}

// This one is to return Price formatted w.r.t default Currency setup in session
if ( ! function_exists('price_default'))
{
	function price_default( $price, $prep_currency = false ) 
	{
		global $config;
		return price( $price ,  $config[ 'currency' ] ,  $config[ 'currency_rate' ] , $prep_currency ) ;
	}
}

if ( ! function_exists('get_xp_level'))
{
	function get_xp_level($xp_gained = 0) 
	{
		return intval($xp_gained % MAX_XP );
	}
}

if ( ! function_exists('get_user_level'))
{
	function get_user_level($xp_gained = 0) 
	{
		$level = sprintf("%02d",floor($xp_gained / MAX_XP) + 1 );
		return $level>MAX_LEVEL ? MAX_LEVEL : $level ; 
	}
}

if ( ! function_exists('can_register'))
{
	function can_register($user_data = array(),$registration_cost=0) 
	{
		return ( $user_data['credits_total']-$user_data['credits_consumed'] >= intval($registration_cost) ) ; 
	}
}

if ( ! function_exists('label_encode'))
{
	function label_encode($text = '') 
	{
		return ucfirst(preg_replace("/([-_]+)/", " ", $text)) ; 
	}
}

if ( ! function_exists('recursive_array') )
{
	function recursive_array( $data , $children, $second=false) 
	{
		
		foreach ($data as $key => $row) {

			$data[$row['category_id']] = $row ;
			$data[$key]['children'] = array() ;

			if( isset($children[$row['category_id']]) && is_array($children[$row['category_id']]))
				$data[$row['category_id']]['children'] = recursive_array($children[$row['category_id']] , $children , true )  ;
			else
				return $data;
			return $data;
		}
	}
}

if ( ! function_exists('is') )
{
	function is( $variable ) 
	{
		
		return isset($variable) && $variable ;
	}
}

if ( ! function_exists('has_value') )
{
	function has_value( $needle, $haystack ) 
	{
		if(is_array($haystack))
			return in_array($needle, $haystack);
		else
			return $needle == $haystack;
	}
}

if ( ! function_exists('to_bit') )
{
	function to_bit( $is_addon ) 
	{
		return $is_addon ? 1 : 0 ;
	}
}

if( ! function_exists('order_mask') )
{
	function order_mask($id=0)
	{
		return sprintf(ORDER_NO_MASK , $id) ;
	}
}

if( ! function_exists('g') )
{
	function g($var="")
	{
		global $config; 
		if($var)
			$var = explode(".", $var);
		$return = $config;
		while( is_array($var) && count($var) )
		{
			$return = $return[ array_shift($var) ];
		}

		return $return ;
	}
}

/** 
* Image url
**/
if( ! function_exists('get_image') )
{
	function get_image($image_path,$image_name)
	{
		global $config; 
		return $config['base_url'].$image_path.$image_name;
	}
}

/*
* Array Intersect working in Cross.  
* @params : flip_second -- 
* 					Flip second array and then intersect. 
*					Or flip first and then intersect
*/
if ( ! function_exists('array_intersect_cross') )
{
	function array_intersect_cross( $array1, $array2 , $flip_second = true ) 
	{
		if(!$array1 || !$array2)
			return false;
		
		if($flip_second)
			$array2 = array_flip($array2);
		else
			$array1 = array_flip($array1);

		$array1 = array_intersect($array1, $array2);
		
		return $flip_second ? $array1 : array_flip($array1) ;
	}
}


if(!function_exists('get_selected_navigation'))
{
	function get_selected_navigation($class_name)
	{
		$ci =& get_instance();
		return ($ci->router->fetch_class() == $class_name ? 'class="active"' : '');
	}
}


if(!function_exists('get_facebook_share'))
{
	function get_facebook_share()
	{
		global $config; 
		$request_url = substr($_SERVER['REQUEST_URI'],1);
		$facebook_link = "https://www.facebook.com/sharer/sharer.php?u=";
		$base_url = $config['base_url'];

		return $facebook_link.$base_url.$request_url;
	}
}

if(!function_exists('get_twitter_share'))
{
	function get_twitter_share()
	{
		global $config; 
		$request_url = substr($_SERVER['REQUEST_URI'],1);
		$twitter_link = "https://twitter.com/home?status=";
		$base_url = $config['base_url'];

		return $twitter_link.$base_url.$request_url;
	}
}

if(!function_exists('get_pinterest_share'))
{
	function get_pinterest_share()
	{

		global $config; 
		$request_url = substr($_SERVER['REQUEST_URI'],1);
		$pinterest_link = "https://pinterest.com/pin/create/button/?url=";
		$base_url = $config['base_url'];

		return $pinterest_link.$base_url.$request_url;
	}
}

// Encrypt String Start
if(!function_exists('string_encrypt'))
{
    function string_encrypt($input)
    {
        $cryptKey     = 'e01c9261bf1626d678acdc44f1e06826';
        $pass_encoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5($cryptKey), $input, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return($pass_encoded);
    }
}
// Encrypt String End

// Decrypt String Start
if(!function_exists('string_decrypt'))
{
    function string_decrypt($input)
    {
        $cryptKey    = 'e01c9261bf1626d678acdc44f1e06826';
        $pass_decode = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode($input), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return $pass_decode;
    }
}
// Decrypt String End

// Time ago String Start
if(!function_exists('timeago'))
{
    function timeago($date) {
        $timestamp = strtotime($date);

        $strTime = array("second", "minute", "hour", "day", "month", "year");
        $length = array("60","60","24","30","12","10");

        $currentTime = time();
        if($currentTime >= $timestamp) {
            $diff     = time()- $timestamp;
            for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
                $diff = $diff / $length[$i];
            }

            $diff = round($diff);
            return $diff . " " . $strTime[$i] . "(s) ago ";
        }
    }

}
// Time ago String End

// Search Highlighter start
if(!function_exists('text_highlights'))
{
    function text_highlights($text, $words, $case = false) {

        $words = trim($words);
        //$words_array = explode(',', $words);

        /*$regex = ($case !== false) ? '/\b(' . implode('|', array_map('preg_quote', $words_array)) . ')\b/i' : '/\b(' . implode('|', array_map('preg_quote', $words_array)) . ')\b/';
        foreach($words_array as $word) {
            if(strlen(trim($word)) != 0)
                $text = preg_replace($regex, '<font style="background: yellow";>$1</font>', $text);
        }*/

        // WORKING CODE
        $text = str_ireplace($text,'<label style="background: yellow;">'.$text.'</label>',$words);

        //$pattern = '/\b('.$text.')\b/i';
        //$text = preg_replace($pattern, "<label style='background: yellow;'>$1</label>", $words);

        /*$pattern = "/$text/i";
        if(preg_match($pattern, $words)){
            $text = preg_replace($pattern, "<label style='background: yellow;'>$1</label>", $words);
        }*/

        /*$p = preg_quote($words, $text);  // The pattern to match
        $text = preg_replace("/($p)/i",'<span style="background:yellow;">$1</span>',$words);*/

        return $text;
    }

}

function time_difference($start_date,$end_date)
{
    $now = new DateTime($end_date);
    $ago = new DateTime($start_date);
    $diff = $now->diff($ago);
    
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string):'Today';
}


function time_difference1($departure_time,$arrival_time)
{
    $diff = $departure_time->diff($arrival_time);
    
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string):'just now';
}

// Search Highlighter end

// Calculate File SIZE IN GB,MB,KB
function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}

// Convert milli second to seconds
function millitosecond($video_millis=0)
{
    $seconds = floor($video_millis / 1000);
    $minutes = floor($seconds / 60);
    $hours = floor($minutes / 60);
    $milliseconds = $milliseconds % 1000;
    $seconds = $seconds % 60;
    $minutes = $minutes % 60;

    $format = '%u:%02u:%02u.%03u';
    $time = sprintf($format, $hours, $minutes, $seconds, $milliseconds);
    $vcl = rtrim($time, '0');

    return $vcl;
}

// Convert Bytes to SIZE
function formatBytes($size, $precision = 2)
{
    if ($size > 0) {
        $size = (int) $size;
        $base = log($size) / log(1024);
        $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

        return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    } else {
        return $size;
    }
}
// Search Highlighter end



/* End of file path_helper.php */
/* Location: ./system/helpers/path_helper.php 
 */  
