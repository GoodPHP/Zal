<?php
$begin_time = microtime();
define('P', $_SERVER['DOCUMENT_ROOT']);
define('LOAD','ACTIVE');



session_start();
ob_start();  

include(P.'/core/ajax_cms.php');

$inCore->getTamplate();

$alltime = microtime() - $begin_time;

echo $alltime.' сек';