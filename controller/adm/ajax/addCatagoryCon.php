<?php

define('P', $_SERVER['DOCUMENT_ROOT']);
define('LOAD','ACTIVE');

session_start();
ob_start();  

include(P.'/core/ajax_cms.php');

if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
}else{
$inCore->error404();
}

$get_str = $inCore->get_table('cms_category');

$inCore->displayCon(array('cats'=>$get_str),'adm_ajax_cat.php');