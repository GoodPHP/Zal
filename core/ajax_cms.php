<?php
if(!LOAD){die('Not Found');}

$inCore = getAjaxCore::getFunction();

class getAjaxCore {
	
	private static $function;

	public $html = 'default';
	public $title;
	public $key;
	public $description;
	public $component;
	public $page_head = array();
	public $user;
	
	private $db = array(
	'host'=>'localhost',
	'user'=>'root',
	'db'=>'kinozal',
	'pass'=>'root',
	'target'=>'cms_'
	);
	
	public $db_link;
	
	private function __construct(){
	$this->db_link   = static::initConnection($this->db);
	$this->user = self::getUsers();
    }
	
	public function __destruct(){
	mysqli_close($this->db_link);
	}
	
	private function __clone(){
    }
	
	public static function getFunction() {
		if (self::$function === null) {
			self::$function = new self;
		}
		return self::$function;
	}
	
	
	//Функция include любой файл системы
	public function addInclude ($file){
	    if($this->getFileExist($file) == true){
	    $inCore = $this->inDB;
		return include(P.$file);
		}
	}
	
	//Функция проверяет файл на существование
	public function getFileExist ($file){
		if(file_exists(P.$file)){
			return true;
		}else{
			return false;
		}
	}
	//Функция подлкючает шаблон
	public function getTamplate (){
	return $this->addInclude('/tamples/'.$this->html.'/html.php');
	}
	
	
    //Функция добавляет title,key,description
	public function getHead (){
	
	$get_page = $this->get_fields('cms_page','page="'.$this->getUrl().'"','*');
	$page = explode("|", $get_page['seo_page']);

	if($page[0]){
	$this->title = $page[0];
	}
	if($page[1]){
	$this->key = $page[1];
	}
	if($page[2]){
	$this->description = $page[2];
	}

	if($this->title){
	echo '<title>'.htmlspecialchars($this->title).'</title>',"\n";
	}
	if($this->key){
	echo '<meta name="keywords" content="'.htmlspecialchars($this->key).'" />',"\n";
	}
	if($this->description){
	echo '<meta name="description" content="'.htmlspecialchars($this->description).'" />',"\n";
	}

	
	}
	
	public function getUsers(){
	
	if($us = $this->get_fields('cms_users','user_id_md5 = "'.$_SESSION['enterCMS']['user'].'"','*')){
	return $us;
	}else{
	$auth = array();
	$auth['id'] = 0;
	$auth['name'] = 'Гость';
	$auth['ip'] = $this->getIP();
	return $auth;
	}
	
	}
	
	

	public function getIP(){
	return $_SERVER["REMOTE_ADDR"];
	}
	
	#текущий url
	public function getUrl(){
	return $_SERVER['REQUEST_URI'];
	}
	
	
	#вывод контролера
	public function getBody(){
	
	$uri = preg_replace("/\?.*/i",'', $this->getUrl());
 
    if (strlen($uri)>1) {// если не главная страница...
    if (rtrim($uri,'/')!=$uri) {
    header("HTTP/1.1 301 Moved Permanently");
    header('Location: http://'.$_SERVER['SERVER_NAME'].str_replace($uri, rtrim($uri,'/'), $_SERVER['REQUEST_URI']));
    exit();    
    }
    }
	

    $this->module = 'error404';
    $this->action = 'main';

    $params = array();

    $uri = $this->getUrl();
    $controller = explode('/',$uri);

    $this->addInclude('/controller/'.$controller[1].'/router.php');
    $this->component = $controller[1];

    foreach ($this->routes as $map)
    {

    $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

	if (preg_match($map['pattern'], $url_path, $matches))
	{


		array_shift($matches);

 		foreach ($matches as $index => $value)
		{
			$this->params[$map['aliases'][$index]] = $value;
		}

		$this->module = $map['do'];
		$this->action = $map['method'];

		break;
	}
    }

    if($uri == "/"){
    $this->module = 'index';
    $this->action = 'index';
    }

    if($this->module == "error404"){
    $this->error404();
    }

    if($this->component){
	$this->config_controller = $this->get_fields('cms_controller','path = "'.$this->component.'"','*');

if(!$this->config_controller and $this->user['is_admin'] == 1){
	$this->alert('В базе не создан контролер '.$controller[1],'danger');
$this->redirectBack();
}


   if ($this->isCached('controller', $this->config_controller['id'])){

   $body = $this->getCache('controller', $this->config_controller['id']);

   }else{
   $this->saveCache('controller', $this->config_controller['id'], $body);
   }


	
    $this->addInclude('/controller/'.$controller[1].'/front.php');
    }	
	 
	}
	
	#Ошибка 404
	public function error404(){
	@ob_end_clean();

    header("HTTP/1.0 404 Not Found");
    header("HTTP/1.1 404 Not Found");
    header("Status: 404 Not Found");

    $this->addInclude('/tamples/'.$this->html.'/spec/error404.html');

    $this->halt();
	}
	
	#Отключить всё
	public static function halt($message=''){
        die((string)$message);
    }
    ############################## Уведомления
    public static function alert($text, $alert='info'){
        $_SESSION['core_alert'][] = '<div class="alert alert-'.$alert.' alert-dismissible fade in" role="alert">
                                     <button type="button" class="close" data-dismiss="alert">
                                     <span aria-hidden="true">×</span>
                                     <span class="sr-only">Закрыть</span>
                                     </button>
                                     <strong>'.$text.'</strong>
                                     </div>';
    }

     ##
     ### Возвращает массив сообщений сохраненных в сессии
     ##
    public static function getSessionAlert(){

        if (isset($_SESSION['core_alert'])){
            $messages = $_SESSION['core_alert'];
        } else {
            $messages = false;
        }

        self::clearSessionMessages();

        return $messages;

    }
    
    public static function clearSessionMessages(){
        unset($_SESSION['core_alert']);
    }
    ############################## 
    
    ############################## Редирект назад
    public static function redirectBack(){
        self::redirect(self::getBackURL(false));
    }
    
    public static function getBackURL($is_request = true){
        $back = '/';
        if(self::inRequest('back') && $is_request){
            $back = self::request('back', 'str', '/');
        } elseif(!empty($_SERVER['HTTP_REFERER'])) {
            $refer_host = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
            if($refer_host == $_SERVER['HTTP_HOST']){
                $back = strip_tags($_SERVER['HTTP_REFERER']);
            }
        }
        return $back;
    }

    ############################## Редирект
    public static function redirect($url, $code='303'){
        if ($code == '301'){
            header('HTTP/1.1 301 Moved Permanently');
        } else {
            header('HTTP/1.1 303 See Other');
        }
        header('Location:'.$url);
        self::halt();
    }
	
	##################
	####################### Подключение базы данных
	##################
	protected static function initConnection($db){

		$inConf = $db;

		$db_link = mysqli_connect($inConf['host'], $inConf['user'], $inConf['pass'], $inConf['db']);

        if (mysqli_connect_errno()) {
           die('Cannot connect to MySQL server: ' . mysqli_connect_error());
        }

		mysqli_set_charset($db_link, 'utf8');

		return $db_link;

	}
	
		public function query($sql, $ignore_errors=false, $replace_prefix = true){

        if (empty($sql)) { return false; }

        $sql = $replace_prefix ? $this->replacePrefix($sql) : $sql;

		$result = mysqli_query($this->db_link, $sql);


		if (!$ignore_errors){
            $error = $this->error();
            if($error){
                die('<div style="border:solid 1px gray;padding:12px">DATABASE ERROR: <pre>'.$sql.'</pre>'.$error.'</div>');
            }
		}

		return $result;

	}
	
	protected function replacePrefix($sql, $prefix='cms_'){
        if($prefix == $this->db['target']){
            return trim($sql);
        }
		return trim(str_replace($prefix, $this->db['target'], $sql));
	}
	
	public function error() {
		return mysqli_error($this->db_link);
	}
	
	public function get_field($table, $where, $field){

		$sql    = "SELECT $field as getfield FROM $table WHERE $where LIMIT 1";
		$result = $this->query($sql);

		if ($this->num_rows($result)){
			$data = $this->fetch_assoc($result);
			return $data['getfield'];
		} else {
			return false;
		}

	}
	
	public function get_fields($table, $where, $fields='*', $order='id ASC'){

		$sql    = "SELECT $fields FROM $table WHERE $where ORDER BY $order LIMIT 1";
		$result = $this->query($sql);

		if ($this->num_rows($result)){
			$data = $this->fetch_assoc($result);
			return $data;
		} else {
			return false;
		}
	}
	
	public function rows_count($table, $where, $limit=0){

		$sql = "SELECT 1 FROM $table WHERE $where";
		if ($limit) { $sql .= " LIMIT ".(int)$limit; }
		$result = $this->query($sql);

		return $this->num_rows($result);

	}
	
	public function num_rows($result){
		return mysqli_num_rows($result);
	}
	
	public function fetch_assoc($result){
		return mysqli_fetch_assoc($result);
	}
	
	public function fetch_row($result){
		return mysqli_fetch_row($result);
	}
	
	public function get_table($table, $where='', $fields='*'){

		$list = array();

		$sql = "SELECT $fields FROM $table";
		if ($where) { $sql .= ' WHERE '.$where; }
		$result = $this->query($sql);

		if ($this->num_rows($result)){
			while($data = $this->fetch_assoc($result)){
				$list[] = $data;
			}
			return $list;
		} else {
			return false;
		}

	}
	
	/**
     * Обновляет данные в таблице
	 * ключи массива должны совпадать с полями в таблице
     */
	public function update($table, $update_array, $id){

        if(isset($update_array['id'])){
            unset($update_array['id']);
        }

        // id или where
        if(is_numeric($id)){
            $where = "id = '{$id}' LIMIT 1";
        } else {
            $where = $id;
        }

		// убираем из массива ненужные ячейки
		$update_array = $this->removeTheMissingCell($table, $update_array);

		$set = '';
		// формируем запрос на вставку в базу
		foreach($update_array as $field=>$value){
		$value = addslashes($value);
			$set .= "{$field} = '{$value}',";
		}
		// убираем последнюю запятую
		$set = rtrim($set, ',');

		$this->query("UPDATE {$table} SET {$set} WHERE $where");

		if ($this->errno()) { return false; }

		return true;

	}
	
	public function errno() {
		return mysqli_errno($this->db_link);
	}
	
	 /**
     * Добавляет массив записей в таблицу
	 * ключи массива должны совпадать с полями в таблице
     */
	public function insert($table, $insert_array){

		// убираем из массива ненужные ячейки
		$insert_array = $this->removeTheMissingCell($table, $insert_array);
		$set = '';
		// формируем запрос на вставку в базу
		foreach($insert_array as $field=>$value){
		$value = addslashes($value);
			$set .= "{$field} = '{$value}',";
		}
		// убираем последнюю запятую
		$set = rtrim($set, ',');

		$this->query("INSERT INTO {$table} SET {$set}");

		if ($this->errno()) { return false; }

		return $this->get_last_id($table);

	}
	
	
	public function get_last_id($table=''){

        if(!$table){
            return (int)mysqli_insert_id($this->db_link);
        }

		$result = $this->query("SELECT LAST_INSERT_ID() as lastid FROM $table LIMIT 1");

		if ($this->num_rows($result)){
			$data = $this->fetch_assoc($result);
			return $data['lastid'];
		} else {
			return 0;
		}

	}
	
	/**
     * Убирает из массива ячейки, которых нет в таблице назначения
	 * используется при вставке/обновлении значений таблицы
     */
	public function removeTheMissingCell($table, $array){

		$result = $this->query("SHOW COLUMNS FROM `{$table}`");
		$list = array();
        while($data = $this->fetch_assoc($result)){
            $list[$data['Field']] = '';
        }
		// убираем ненужные ячейки массива
		foreach($array as $k=>$v){
		   if (!isset($list[$k])) { unset($array[$k]); }
		}

		if(!$array || !is_array($array)) { return array(); }

		return $array;

	}
	
	#######################################################
	#######################################################
	#######################################################
	
	public function getWindget ($position){
		$widget = $this->get_table('cms_module','position = "'.$position.'"');

		foreach($widget as $wid){
		$this->widget = $wid;
	    $this->addInclude('/widget/'.$wid['admin_name'].'/wid.php');
	    }
	}
	
	##################
	####################### Шаблонизатор
	##################
	public function displayWid($array,$template, $strip = true)
	{
	
	    $widget_tamp = '/tamples/'.$this->html.'/wid/'.$template;
		if (!$this->getFileExist($widget_tamp)) echo ('Шаблона ' . $widget_tamp . ' не существует!');

		ob_start();
		$this->obj = $array;
		$this->addInclude($widget_tamp);
		echo ($strip) ? $this->_strip(ob_get_clean()) : ob_get_clean();
	}
	
	public function displayCon($array,$template, $strip = true)
	{
	
	    $widget_tamp = '/tamples/'.$this->html.'/controller/'.$template;
		if (!$this->getFileExist($widget_tamp)) echo ('Шаблона ' . $widget_tamp . ' не существует!');

		ob_start();
		$this->obj = $array;
		$this->addInclude($widget_tamp);
		echo ($strip) ? $this->_strip(ob_get_clean()) : ob_get_clean();
	}
	
	
	private function _strip($data)
	{
		$lit = array("\\t", "\\n", "\\n\\r", "\\r\\n", "  ");
		$sp = array('', '', '', '', '');
		return str_replace($lit, $sp, $data);
	}
	####################################
	
	public function getModal ($ar = array(
	1=>'myModal',
	2=>'Закрыть',
	3=>'Сохранить',
	4=>'Форма',
	5=>'submit',
	6=>'save',
	7=>'POST'
	),$html = array(
	1=>'<p>текст</p>'
	)){
    return '<div class="modal fade" id="'.$ar[1].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form method="'.$ar[7].'">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">'.$ar[2].'</span></button>
        <h4 class="modal-title">'.$ar[4].'</h4>
      </div>
      <div class="modal-body">
       '.$html[1].'
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">'.$ar[2].'</button>
        <button type="'.$ar[5].'" name="'.$ar[6].'" class="btn btn-primary">'.$ar[3].'</button>
      </div>
    </div>
	</form>
  </div>
  </div>';
	}
	
	/**
     * Получает в соответствии с заданным типом переменную $var из $_REQUEST
     * @param string $var название переменной
     * @param string $type тип int | str | html | email | array | array_int | array_str | массив допустимых значений
     * @param string $default значение по умолчанию
     * @param string $r Откуда брать значение get | post | request
     * @return mixed
     */
	
	public static function request($var, $type='str', $default=false, $r = 'request'){

        // Задаем суперглобальный массив, из которого будем получать данные
        switch ($r) {
            case 'post':
                $request = $_POST;
                break;
            case 'get':
                $request = $_GET;
                break;
            default:
                $request = $_REQUEST;
                break;
        }

        if (isset($request[$var])){
            return self::cleanVar($request[$var], $type, $default);
        } else {
            return $default;
        }

    }
	public static function cleanVar($var, $type='str', $default=false) {
        // массив возможных параметров
        if(is_array($type)){
            if(in_array($var, $type)){
                return self::strClear((string)$var);
            } else {
                return $default;
            }
        }
        switch($type){
            case 'int':   if ($var!=='') { return (int)$var;  } else { return (int)$default; } break;
            case 'str':   if ($var) { return self::strClear((string)$var); } else { return (string)$default; } break;
            case 'email': if(preg_match("/^(?:[a-z0-9\._\-]+)@(?:[a-z0-9](?:[a-z0-9\-]*[a-z0-9])?\.)+(?:[a-z]{2,6})$/ui", (string)$var)){ return $var; } else { return (string)$default; } break;
            case 'html':  if ($var) { return self::strClear((string)$var, false); } else { return (string)$default; } break;
            case 'array': if (is_array($var)) { foreach($var as $k=>$s){ $arr[$k] = self::strClear($s, false); } return $arr; } else { return $default; } break;
            case 'array_int': if (is_array($var)) { foreach($var as $k=>$i){ $arr[$k] = (int)$i; } return $arr; } else { return $default; } break;
            case 'array_str': if (is_array($var)) { foreach($var as $k=>$s){ $arr[$k] = self::strClear($s); } return $arr; } else { return $default; } break;
        }
    }

	public static function inRequest($var){
        return isset($_REQUEST[$var]);
    }
	
    /**
     * Формирует массив данных из $_REQUEST в соответствии с параметрами
     * @param array $types массив, ключами которого являются названия полей в базе данных,
     * а значения его - массив параметров входной переменной
     * @return array
     */
    public static function getArrayFromRequest($types) {

        $items = array();

        foreach ($types as $field => $type_list) {

            $items[$field] = self::request($type_list[0], $type_list[1], $type_list[2]);
            // если передана функция обработки (ее название), обрабатываем
            // полная поддержка анонимных функций невозможна из-за поддержки php 5.2.x
            if(isset($type_list[3])){
                // если пришел массив, считаем что передан объект/название класса и метод
                if(is_array($type_list[3])){
                    if(class_exists($type_list[3][0]) && method_exists($type_list[3][0], $type_list[3][1])){
                        $items[$field] = call_user_func($type_list[3], $items[$field]);
                    }
                }
                // в остальных случаях считаем, что пришло название функции
                elseif(function_exists($type_list[3])){
                    $items[$field] = call_user_func($type_list[3], $items[$field]);
                }

            }

        }

        return $items;

    }
    
     function sefTranslit($string, $length = 128, $delimiter = '-') {
        $tr = array(
            "А" => "a", "Б" => "b", "В" => "v", "Г" => "g", "Д" => "d", "Е" => "e",
            "Ж" => "j", "З" => "z", "И" => "i", "Й" => "y", "К" => "k", "Л" => "l",
            "М" => "m", "Н" => "n", "О" => "o", "П" => "p", "Р" => "r", "С" => "s",
            "Т" => "t", "У" => "u", "Ф" => "f", "Х" => "h", "Ц" => "ts", "Ч" => "ch",
            "Ш" => "sh", "Щ" => "sch", "Ъ" => "", "Ы" => "yi", "Ь" => "", "Э" => "e",
            "Ю" => "yu", "Я" => "ya", "а" => "a", "б" => "b", "в" => "v", "г" => "g",
            "д" => "d", "е" => "e", "ж" => "j", "з" => "z", "и" => "i", "й" => "y",
            "к" => "k", "л" => "l", "м" => "m", "н" => "n", "о" => "o", "п" => "p",
            "р" => "r", "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
            "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y", "ы" => "yi",
            "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya", " " => $delimiter, "." => "",
            "/" => $delimiter
        );
        $res = strtr(trim($string), $tr);

        if (preg_match('/[^A-Za-z0-9_\-]/', $res)) {
            $res = preg_replace('/[^A-Za-z0-9_\-]/', '', $res);
            $res = preg_replace("/[$delimiter]{2,}/", '', $res);
        }

        return urlencode(substr(strtolower($res), 0, $length));
    }

    
    
    
	
	public static function strClear($input, $strip_tags=true){

        if(is_array($input)){

            foreach ($input as $key=>$string) {
                $value[$key] = self::strClear($string, $strip_tags);
            }

            return $value;

        }

        $string = trim((string)$input);
        //Если magic_quotes_gpc = On, сначала убираем экранирование
        $string = (@get_magic_quotes_gpc()) ? stripslashes($string) : $string;
        $string = rtrim($string, ' \\');
        if ($strip_tags) {
            $string = strip_tags($string);
        }
        return $string;

    }
    
       public function isCached($target, $target_id, $cachetime=1, $cacheint='MINUTE'){


        $where     = "target='$target' AND target_id='$target_id' AND cachedate >= DATE_SUB(NOW(), INTERVAL $cachetime $cacheint)";
       $cachefile = $this->get_fields('cms_cache', $where, 'cachefile');

        if ($cachefile){

            $cachefile = P.'/cache/'.$cachefile;
            if (file_exists($cachefile)){
                return true;
            } else {
                return false;
            }

        } else {

            self::deleteCache($target, $target_id);
            return false;

        }

    }
    
    public function getCache($target, $target_id){

		$cachefile = $this->get_fields('cms_cache', "target='$target' AND target_id='$target_id'", 'cachefile');

		if($cachefile){

			$cachefile = P.'/cache/'.$cachefile;

			if (file_exists($cachefile)){
				$cache = file_get_contents($cachefile);
				return $cache;
			}

		}

        return false;

    }


  /**
     * Удаляет кэш указанного контента
     * @param string $target
     * @param int $target_id
     * @return bool
     */
    public function deleteCache($target, $target_id){

        $this->query("DELETE FROM cms_cache WHERE target='$target' AND target_id='$target_id'");

        $oldcache = P.'/cache/'.md5($target.$target_id).'.html';

        if (file_exists($oldcache)) { @unlink($oldcache); }

        return true;

    }
    /**
     * Очищает системный кеш
     */
    public function clearCache(){

        $directory = P.'/cache';

        $handle = opendir($directory);

        while (false !== ($node = readdir($handle))){
            if($node != '.' && $node != '..' && $node != '.htaccess'){
                $path = $directory.'/'.$node;
                if(is_file($path)){
                    if(!@unlink($path)) { return false; }
                }
            }
        }

        closedir($handle);

        return true;

    }
    
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Сохраняет переданный кэш указанного контента
     * @param string $target
     * @param int $target_id
     * @param string $html
     * @return bool
     */
    public function saveCache($target, $target_id, $html){

        $filename = md5($target.$target_id).'.html';

        $sql = "INSERT DELAYED INTO cms_cache (target, target_id, cachedate, cachefile)
                VALUES ('$target', $target_id, NOW(), '$filename')";

        $this->query($sql);

        $filename = P.'/cache/'.$filename;

        file_put_contents($filename, $html);

        return true;

    }
    
    public function getCatagorySelect(){
	    $get_catagory = $this->get_table('cms_category');
	    $array = '';
	    if($get_catagory){
	    foreach ($get_catagory as $cat){
		$array .=  '<option value="'.$cat['id'].'">'.$cat['name'].'</option>';
	    }
	    }
	    return $array;
    }
    
    public function getNumRowsCatagory(){
	   $num_catagory = $this->rows_count('cms_category','id=id');
	   return $num_catagory;
    }
    
    public function getNameCategory($name){
	    $get_category = $this->get_fields('cms_category','id ='.$name,'*');
	    return $get_category['name'];
    }
    
    public function getSEO($url){
	    $get_page = $this->get_field('cms_page','page = "'.$this->getUrl().'"','descript');
        if($get_page){
	    return $get_page;
	    }else{
		return false;    
	    }
	    
    }
    
    
    ////////////////////////////////////////////////////////////////////////////
    /**
     * Преобразует массив в YAML
     * @param array $input_array
     * @return string
     */
    public function arrayToYaml( $input_array, $indent = 2, $word_wrap = 40 ){

        $this->addInclude('/include/spyc/spyc.php');

        if($input_array){
            foreach ($input_array as $key => $value) {
                $_k = str_replace( array( '[',']' ), '', $key );
                $array[$_k] = $value;
            }

        } else {
            $array = array();
        }

        return Spyc::YAMLDump( $array, $indent, $word_wrap );

    }

    /**
     * Преобразует YAML в массив
     * @param string $yaml
     * @return array
     */
    public  function yamlToArray($yaml) {

        $this->addInclude('/include/spyc/spyc.php');

        return Spyc::YAMLLoad($yaml);

    }
	
	
}