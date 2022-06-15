<?php
define('system', 'system/');
define('admin', 'public/admin/');
define('frontend', 'public/frontend/');

require_once system.'init.php';

if (!$_SESSION) {
	require_once 'public/login.php';
} else {
	if (isset($_GET['pdf'])) {
		require_once 'addons/pdf-download.php';
	} else {
		if (!$_GET) {
			refresh('?page=home');
		} else {
			require_once 'public/control.php';
		}
	}
}