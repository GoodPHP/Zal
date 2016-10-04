<?php
if(!LOAD){die('Not Found');}

$inCore = getAjaxCore::getFunction();
$widget = $this->obj;
$config = $this->widget;

$get_category = $inCore->get_table('cms_category','published = 1');


$inCore->displayWid(array('user'=>$inCore->user,'category'=>$get_category)
,$config['tamplates_file']);