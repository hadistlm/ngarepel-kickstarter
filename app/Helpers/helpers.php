<?php

if (! function_exists('random_number')) {
	function random_number($digits) {
	    $min = pow(10, $digits - 1);
	    $max = pow(10, $digits) - 1;
	    return mt_rand($min, $max);
	}
}

if (! function_exists('isJson')) {
    function isJson($str) {
        $json = json_decode($str);
        return $json && $str != $json;
    }
}

if (! function_exists('get_option')) {
	function get_option($opt_name){
		return \App\Http\Controllers\SettingController::getSetting($opt_name);
	}
}

if (! function_exists('limit_words')) {
    /**
     * Limit the number of words in a string.
     *
     * @param  string  $value
     * @param  int     $words
     * @param  string  $end
     * @return string
     */
    function limit_words($value, $words = 100, $end = '...')
    {
        return \Illuminate\Support\Str::words($value, $words, $end);
    }
}