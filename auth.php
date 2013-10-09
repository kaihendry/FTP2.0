<?php
$cc = __DIR__ . '/cookies/'; // cookie collective

function setAdmin($token) {
	global $cc;
	//error_log("cc: " . $cc);
	if (empty($token)) return;
	// if (! is_file($token)) return;
	$uniquser = json_encode($_SERVER);
	//error_log($cc . $token);
	file_put_contents($cc . $token, $uniquser);
	setCookie('ftptwo', $token, time() + 1576800000, '/'); // 50 years
}

function getAdmin() {
	global $cc;
	if (isset($_COOKIE['ftptwo'])) {
		$cookie_var = $_COOKIE['ftptwo'];
	} elseif (isset($_REQUEST['ftptwo'])) {
		$cookie_var = $_REQUEST['ftptwo'];
	} else { return false; }
	$path = $cc . $cookie_var;
	error_log("got: " . $path);
	if ( is_file($path) ) {
		setAdmin($cookie_var);
		return true;
	} else {
		// Destroy cookie, I assume
		setCookie('ftptwo', '', time() - 86400);
		return false;
	}
}


?>
