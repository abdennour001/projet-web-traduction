<?php

include 'app/Models/Client.php';
include 'app/Models/Traducteur.php';
include 'app/Models/User.php';
include 'app/Models/Devis.php';
include 'app/Models/Langue.php';
include 'app/Models/Document.php';
include 'app/Models/PieceJointe.php';
include 'app/Models/Demande.php';
require "config/Session.php";
require "app/Middleware/Auth.php";

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
	        return env('ROOT_PATH') . 'resources/views/'.$viewRelativePath;
        }
    }

	if(!function_exists('url')) {
		function url($route) {
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/projet";
			return $actual_link.$route;
		}
	}

	if (! function_exists('redirect')) {
	    function redirect($to = null, $data = null, $status = 302) {
            $base_url = "http://$_SERVER[HTTP_HOST]/projet";
            header('Location: ' . $base_url . $to, true, $status);
            if (!is_null($data)) {
                Session::put($data);
            };
            die();
        }
    }

	if (! function_exists('old')) {
	    function old($key) {
	        if (Session::has($key)) {
	            $value = Session::get($key);
	            Session::forget($key);
	            return $value;
            }
	        return null;
        }
    }

	if (! function_exists('current_url')) {
	    function current_url() {
	        if (preg_match('/\/projet(\/.*)/', $_SERVER['REQUEST_URI'] , $match) == 1) {
	            return $match[1];
            }
	        return null;
        }
    }

	if (! function_exists('upload_file')) {
	    function upload_file($file, $path = "") {
            $origin = $_SERVER['DOCUMENT_ROOT'];
            $upload_file = $origin . "projet/public/storage/uploads/" . $path;
            // upload the file
            if (move_uploaded_file($file['tmp_name'], $upload_file)) {
                return $upload_file;
            } else {
                return null;
            }
        }
    }

	if (! function_exists('unlink_file')) {
	    function unlink_file($file_path) {
            unlink($file_path);
            return;
        }
    }

	Session::start();
