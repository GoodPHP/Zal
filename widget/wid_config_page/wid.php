<?php
if(!LOAD){die('Not Found');}

$inCore = getAjaxCore::getFunction();
$widget = $this->obj;
$config = $this->widget;


if(!$inCore->inRequest('savePage')){
$get_page = $this->get_fields('cms_page','page="'.$this->getUrl().'"','*');

if($get_page){
$get_page['seo_page'] = setSEO($get_page['seo_page']);
}

$inCore->displayWid(array('title'=>'Name name','page'=>$get_page)
,$config['tamplates_file']);
}


if($inCore->inRequest('savePage')){
$item = array();
$item['id'] = $inCore->request('id_page','int');
$item['page'] = $inCore->request('url_page','str');
$item['name'] = $inCore->request('name_page','str');
$item['descript'] = $inCore->request('descript','html');
$item['do'] = $inCore->module;
$item['pubdate'] = date("Y-m-d H:i:s");
$item['seo_page'] = $inCore->request('seo_title_page','str').'|'.$inCore->request('seo_key_page','str').'|'.$inCore->request('seo_des_page','str');

$id = $inCore->update('cms_page',$item,$item['id']);
if($id){
$inCore->alert('Данные страницы успешно обновлены!','success');
}else{
$inCore->alert('Произошла ошибка','error');	
}
$inCore->redirectBack();
}

if($inCore->inRequest('addPage')){
$item = array();
$item['page'] = $inCore->request('url_page','str');
$item['name'] = $inCore->request('name_page','str');
$item['descript'] = $inCore->request('descript','html');
$item['do'] = $inCore->module;
$item['pubdate'] = date("Y-m-d H:i:s");
$item['seo_page'] = $inCore->request('seo_title_page','str').'|'.$inCore->request('seo_key_page','str').'|'.$inCore->request('seo_des_page','str');

$id = $inCore->insert('cms_page',$item);
if($id){
$inCore->alert('Данные страницы успешно сохранены!','success');
}else{
$inCore->alert('Произошла ошибка','error');	
}
$inCore->redirectBack();
}



function setSEO ($seo){
$seo = explode("|", $seo);

$pag = array();
foreach($seo as $page){
$pag[] = $page;
}
return $pag;
}

