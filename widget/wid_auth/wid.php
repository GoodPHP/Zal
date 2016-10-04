<?php
if(!LOAD){die('Not Found');}

$inCore = getAjaxCore::getFunction();
$widget = $this->obj;
$config = $this->widget;


$inCore->displayWid(array('user'=>$inCore->user)
,$config['tamplates_file']);