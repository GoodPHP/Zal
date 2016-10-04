<?php

if(!LOAD){die('Not Found');}

$inCore = getAjaxCore::getFunction();
$config = $this->config_controller;

if($this->module == "view"){
	
$id = $this->params['id'];

$get_content = $inCore->get_fields('cms_kino','id='.$id,'*');

$get_content['kinozal'] = $inCore->yamlToArray($get_content['kinozal']);


for($d = 0; $d <= $get_content['ryad']-1; $d++){
	for($pppx = 1; $pppx <= $get_content['kinozal']['count_mest'][$d]; $pppx++){
	$get_content['kinozal']['type_mesto'][$d][$pppx] = $inCore->get_field('cms_kino_order','kino_id = '.$this->params['id'].' AND ryad = '.$d.' AND mesto = '.$pppx,'ins_pub');
	}
}

if($inCore->inRequest('submit_order')){
	
$order['name'] = $inCore->request('name_order','str');

$order['kino_id'] = $this->params['id'];
$order['ryad'] = $inCore->request('ryad','int');
$order['price'] = $get_content['kinozal']['price'][$inCore->request('ryad','int')];
$order['mesto'] = $inCore->request('mesto','int');
$order['datepub'] = date("Y-m-d H:i:s");
$order['ins_pub'] = 3;

if(!$order['name']){
$inCore->alert('Введите имя!','danger');
$inCore->redirectBack();	
}

$id = $inCore->update('cms_kino_order',$order,$inCore->request('id','int'));

if($id){
$inCore->alert('Бронь места добавлена!','success');
$inCore->redirectBack();
}else{
$inCore->alert('Ошибка!','danger');
$inCore->redirectBack();
}
	
}

$two = $inCore->get_field('cms_kino_order','ins_pub = 2 and kino_id ='.$this->params['id'],'COUNT(id)');

$tree = $inCore->get_field('cms_kino_order','ins_pub = 3 and kino_id ='.$this->params['id'],'COUNT(id)');

$inCore->displayCon(array('content'=>$get_content,'two'=>$two,'tree'=>$tree),'view_kino.php');


if($inCore->query("DELETE FROM cms_kino_order WHERE datepub < '".date("Y-m-d H:i:s")."' AND ins_pub = 2"));

}



if($this->module == "add"){

if($inCore->inRequest('subbmit')){

$cat['name'] = $inCore->request('reg_name','str');

$cat['ryad'] = $inCore->request('ryad','str');
$cat['kinozal']['count_mest'] = $inCore->request('count_ryad','array');
$cat['kinozal']['sector'] = $inCore->request('sector','array');
$cat['kinozal']['price'] = $inCore->request('price','array',0);

$cat['kinozal'] = $inCore->arrayToYaml($cat['kinozal']);

$cat['pubdate'] = date("Y-m-d H:i:s");

if(!$cat['name']){
$inCore->alert('Введите название!','danger');
$inCore->redirectBack();
}

$id = $inCore->insert('cms_kino', $cat);

if($id){
$inCore->alert('Кинозал добавлен!','success');
$inCore->redirect('/');
}else{
$inCore->alert('Ошибка!','danger');
$inCore->redirectBack();
}

}

$inCore->displayCon(array('content'=>$get_content),'add_kino.php');

}