<?php 
if(!LOAD){die('Not Found');}


$this->routes = array
(

	
	array(
	// паттерн в формате Perl-совместимого реулярного выражения
	'pattern' => '~^/kino/([0-9]+)$~',
	// Имя класса обработчика 
	'do' => 'view',
	'aliases' => array('id')
	),
	
	array(
	// паттерн в формате Perl-совместимого реулярного выражения
	'pattern' => '~^/kino/add$~',
	// Имя класса обработчика 
	'do' => 'add'
	)		

);