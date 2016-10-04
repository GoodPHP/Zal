<?php 
if(!LOAD){die('Not Found');}

 
$con = $this->obj;

?>

<button class="btn btn-default" data-toggle="modal" data-target="#addCategory">Добавить категорию</button>
<br/><br/>

<table class="table table-hover">
<tr>
<td><b>ID</b></td>
<td><b>Родительская категория</b></td>
<td><b>Название</b></td>
<td><b>Нумерация</b></td>
<td><b>Выводить теги</b></td>
<td><b>Действия</b></td>
</tr>
<?php foreach($con['cats'] as $cats){ ?>
<tr>
<td><?php echo $cats['id'];?></td>
<td><?php if($cats['parent_id'] == 0){ echo 'Корневой раздел'; }else{ echo $this->getNameCategory($cats['parent_id']); }?></td>
<td><a href="/content/<?php echo $cats['url'];?>" target="_blank"><?php echo $cats['name'];?></a></td>
<td><?php echo $cats['order_by'];?></td>
<td><?php if($cats['show_tag'] == 1) {echo 'Да';}else{echo 'Нет';}?></td>
<td> </td>
</tr>
<?php } ?>
</table>

<?php $row = $this->getNumRowsCatagory() + 1; ?>

<?php echo $this->getModal(
    array(
	1=>'addCategory',
	2=>'Закрыть',
	3=>'Сохранить',
	4=>'Добавить категорию',
	5=>'submit',
	6=>'addCatagoryCon',
	7=>'POST'
	),
	array(
	1=>
	'
  
  <div class="form-group">
    <label for="name_page">Родительская категория</label>
    <select class="form-control" name="cat_caty">
    <option value="0">--Корневая категория--</option>
    '.$this->getCatagorySelect().'
    </select>
  </div>
  
  <div class="form-group">
    <label for="name_page">Название</label>
    <input type="text" class="form-control" name="name_cat"/>
  </div>
  
  <div class="form-group">
    <label for="name_page">Нумерация</label>
    <input type="text" class="form-control" name="nymer_cat" value="'.$row.'"/>
  </div>
  
  <div class="form-group">
    <label for="name_page">Шаблон</label>
    <input type="text" class="form-control" name="tamp" value="cats_content.php"/>
  </div>
  
  <div class="form-group">
    <label for="name_page">Выводить теги</label>
    <select class="form-control" name="show_tags">
    <option value="1">Да</option>
    <option value="0">Нет</option>
    </select>
  </div>
  
  <div class="form-group">
    <label for="name_page">Публиковать</label>
    <select class="form-control" name="published_cat">
    <option value="1">Да</option>
    <option value="0">Нет</option>
    </select>
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

        