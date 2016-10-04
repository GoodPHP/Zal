<?php

if(!LOAD){die('Not Found');}

$inCore = getAjaxCore::getFunction();
$config = $this->config_controller;


if($inCore->user['is_admin'] != 1){ $inCore->error404();}

if($inCore->module == 'view'){

if($inCore->inRequest('addCatagoryCon')){
$cat = array();
$cat['parent_id'] = $inCore->request('cat_caty','int');
$cat['name'] = $inCore->request('name_cat','str');
$cat['order_by'] = $inCore->request('nymer_cat','int');
$cat['show_tag'] = $inCore->request('show_tags','int');
$cat['url'] = $inCore->sefTranslit($cat['name']);
$cat['published'] = $inCore->request('published_cat','int');
$cat['tamp'] = $inCore->request('tamp','str');

$seo = array();
$seo_title = $inCore->request('seo_title','str');
$seo_key = $inCore->request('seo_key_page','str');
$seo_des = $inCore->request('seo_des_page','str');
$seo['name'] = $cat['name'];
$seo['descript'] = $inCore->request('descript','html');
if(!$seo_title){ $seo_title = $cat['name']; }
$seo['seo_page'] = $seo_title.'|'.$seo_key.'|'.$seo_des;
$seo['page'] = '/content/'.$cat['url'];
$seo['do'] = 'cats';
$seo['pubdate'] = date("Y-m-d H:i:s");
$id_page = $inCore->insert('cms_page',$seo);

$id = $inCore->insert('cms_category',$cat);
if($id){
$inCore->alert('Категория добавлена!','success');
$inCore->redirectBack();
}else{
$inCore->alert('Ошибка!','danger');
$inCore->redirectBack();
}
}

$inCore->displayCon(null,'adm_view.php');
}

