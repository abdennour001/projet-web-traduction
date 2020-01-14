<?php


	if(file_exists(__DIR__.'/env.php')) {
		include __DIR__.'/env.php';
	}

	if(!function_exists('env')) {
		function env($key, $default = null) {
				$value = getenv($key);
				if ($value === false) {
					return $default;
				}
				return $value;
		}
	}

	if(!function_exists('asset')) {
		function asset($path) {
			echo 'resources/assets/'.$path;
		}
	}

	if(!function_exists('view')) {
	    function view($viewRelativePath) {
	        return 'resources/views/'.$viewRelativePath;
        }
    }

	if(!function_exists('url')) {
		function url($route) {
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/projet";
			return $actual_link.$route;
		}
	}
