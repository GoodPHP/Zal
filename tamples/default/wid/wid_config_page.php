<?php
if(!LOAD){die('Not Found');}

$widget = $this->obj;
$config = $this->widget;

$mod = $this->obj;



if($mod['page']){

echo $this->getModal(
    array(
	1=>'configPage',
	2=>'Закрыть',
	3=>'Применить',
	4=>'Настройка страницы',
	5=>'submit',
	6=>'savePage',
	7=>'POST'
	),
	array(
	1=>
	'
	 <input type="hidden" value="'.$mod['page']['id'].'" name="id_page"/>
  <input type="hidden" value="'.$mod['page']['page'].'" name="url_page"/>
	<div class="form-group">
    <label for="id_page">ID страницы</label>
    <input type="text" class="form-control" name="id_page" value="'.$mod['page']['id'].'" id="id_page" disabled>
  </div>
  
  <div class="form-group">
    <label for="url_page">URL страницы</label>
    <input type="text" class="form-control" name="url_page" value="'.$mod['page']['page'].'" id="url_page" disabled>
  </div>
  
  <div class="form-group">
    <label for="name_page">Название</label>
    <input type="text" class="form-control" id="name_page" name="name_page" value="'.$mod['page']['name'].'">
  </div>
  
  
  <div class="form-group">
    <label>SEO</label>
	<p>Название</p>
    <input type="text" class="form-control" id="seo_title_page" name="seo_title_page" value="'.$mod['page']['seo_page'][0].'">
<p>Ключи</p>
    <input type="text" class="form-control" id="seo_key_page" name="seo_key_page" value="'.$mod['page']['seo_page'][1].'">
<p>Описание</p>
	<input type="text" class="form-control" id="seo_des_page"
name="seo_des_page"	value="'.$mod['page']['seo_page'][2].'">

<p>Текст на странице</p>
 <script src="/include/ckeditor/ckeditor.js"></script>
     <textarea name="descript" id="text" class="form-control">'.$mod['page']['descript'].'</textarea>
        <script>
            CKEDITOR.replace("text");
        </script>

  </div>
	'
	));

?>

<a class="bottom_info" data-toggle="modal" style="cursor:pointer; color:#f18c0f;" data-target="#configPage">
Настройки страницы
</a>

<?php }

if (!$mod['page']){ ?>

<?php

echo $this->getModal(
    array(
	1=>'addPage',
	2=>'Отменить',
	3=>'Добавить',
	4=>'Добавить настройки страницы',
	5=>'submit',
	6=>'addPage',
	7=>'POST'
	),
	array(
	1=>
	'
  <input type="hidden" value="'.$this->getUrl().'" name="url_page"/>
	<div class="form-group">
    <label for="id_page">ID страницы</label>
    <input type="text" class="form-control" name="id_page" value="'.$mod['page']['id'].'" id="id_page" disabled>
  </div>
  
  <div class="form-group">
    <label for="url_page">URL страницы</label>
    <input type="text" class="form-control" name="url_page" value="'.$this->getUrl().'" id="url_page" disabled>
  </div>
  
  <div class="form-group">
    <label for="name_page">Название</label>
    <input type="text" class="form-control" id="name_page" name="name_page">
  </div>
  
  
  <div class="form-group">
    <label>SEO</label>
	<p>Название</p>
    <input type="text" class="form-control" id="seo_title_page" name="seo_title_page">
<p>Ключи</p>
    <input type="text" class="form-control" id="seo_key_page" name="seo_key_page">
<p>Описание</p>
	<input type="text" class="form-control" id="seo_des_page"
name="seo_des_page">

<p>Текст на странице</p>
 <script src="/include/ckeditor/ckeditor.js"></script>
     <textarea name="descript" id="text" class="form-control"></textarea>
        <script>
            CKEDITOR.replace("text");
        </script>

  </div>
	'
	));
	
	?>

<a class="bottom_info" style="cursor:pointer; color:#82f30f;" data-toggle="modal" data-target="#addPage">
Создать страницу
</a>

<?php } ?>

<a href="/adm">Админка</a>