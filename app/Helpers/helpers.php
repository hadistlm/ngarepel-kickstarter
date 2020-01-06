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

if (! function_exists('get_user_data')) {
  function get_user_data($user_id = null){
    if (empty($user_id)) return false;

    $data = \App\User::find($user_id)->first();

    if (!empty($data)) :
      return $data;
    else:
      return false;
    endif;
  }
}

if (! function_exists('get_image')) {
  function get_image($image_id = null)
  {
    if (empty($image_id)) return false;

    $image = \App\Http\Controllers\FileController::fileDetail($image_id);

    if (!empty($image)) :
      return $image;
    else:
      return false;
    endif;
  }
}

if (! function_exists('toSlug')) {
  function toSlug($text){
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // trim
    $text = trim($text, '-');
    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);
    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
      return 'n-a';
    }

    return $text;
  }
}

if (! function_exists('controller_lists')) {
    function controller_lists($nameOnly = true)
    {
        $controllers = array();

        foreach (\Illuminate\Support\Facades\Route::getRoutes()->getRoutes() as $route)
        {
            $action = $route->getAction();

            if (array_key_exists('controller', $action))
            {
                // explode the string with @ creating an array with a count of 2
                $explodedAction = explode('@', $action['controller']);
                // explode the string with Controllers
                $controllerRoute = explode("Controllers\\", $explodedAction[0]);
                // check to see if an array exists for the controller name
                if (!in_array($controllerRoute[1], $controllers) && strpos($controllerRoute[1], 'Auth') !== 0) :
                    $controllers[] = $controllerRoute[1];
                endif;
            }
        }

        // if user request to only return the name
        if ($nameOnly == true) :
            $controllers = array_map(function($val) { 
                return str_replace("Controller", "", $val); 
            }, $controllers);
        endif;

        return $controllers;
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

if (! function_exists('formatBytes')) {
    /**
     * return bytes from integer into string word
     * @source https://www.codercrunch.com/question/727833297/how-convert-bytes-human-readable-string-format-php
     *
     * @param  int  $bytes
     * @param  int  $format
     * @return string
     */
    function formatBytes($bytes, $format = 99) {
        $byte_size = 1024;
        $byte_type = array(" KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
     
        $bytes /= $byte_size;
        $i = 0;
     
        if ($format == 99 || $format > 7) {
          while ($bytes > $byte_size) {
                $bytes /= $byte_size;
                $i++;
            }
        } else {
          while ($i < $format) {
                $bytes /= $byte_size;
                $i++;
            }
        }
     
        $bytes = sprintf("%1.2f", $bytes);
        $bytes .= $byte_type[$i];
     
        return$bytes;
    }
}