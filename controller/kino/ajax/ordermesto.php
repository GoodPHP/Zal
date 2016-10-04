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

$ryad = $inCore->request('ryad','int');
$mesto = $inCore->request('mesto','int');
$id = $inCore->request('kino_id','int');

$kino = $inCore->get_fields('cms_kino','id='.$id,'*');

$kino['kinozal'] = $inCore->yamlToArray($kino['kinozal']);

$ins = $inCore->get_fields('cms_kino_order','kino_id = '.$id.' AND ryad = '.$ryad.' AND mesto = '.$mesto,'*');

if(!$ins){


$or['datepub'] =  date("Y-m-d H:i:s", time() + 40);
$or['ins_pub'] =  2;
$or['ryad'] = $ryad;
$or['mesto'] = $mesto;
$or['kino_id'] = $id;
$or['ip_client'] = $_SERVER['REMOTE_ADDR'];

$idss = $inCore->insert('cms_kino_order',$or);

}

if($ins['id']){
	$iid = $ins['id'];
}

if($idss){
	$iid = $idss;
}

$inCore->displayCon(array('ryad'=>$ryad,'mesto'=>$mesto,'kino'=>$kino,'id'=>$iid,'ins'=>$ins),'modal_kino.php');