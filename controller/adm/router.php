<?php 
if(!LOAD){die('Not Found');}


$this->routes = array
(

	
	array(
	// паттерн в формате Perl-совместимого реулярного выражения
	'pattern' => '~^/adm$~',
	// Имя класса обработчика 
	'do' => 'view'
	)
	

);