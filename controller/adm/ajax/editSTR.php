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

$id = $inCore->request('id','int');
$get_page = $inCore->get_fields('cms_page','id='.$id,'*');

$inCore->displayCon(array('page_config'=>$get_page),'adm_ajax_edit_str.php');