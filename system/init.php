<?php

date_default_timezone_set('Asia/Makassar');

require 'config/config.php';

function refresh($url=''){
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$url.'">';
}

require_once 'core/database.php';
require_once 'core/db_query.php';
require_once 'core/session.php';

$db = new Db_query();
$session = new Session();
