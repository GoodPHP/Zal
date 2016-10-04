<?php 
if(!LOAD){die('Not Found');}

 
$con = $this->obj;

?>


<div class="container">
<div class="row">
<div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">

<h1 class="con_head">Добавить статью</h1>


<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="name" class="col-md-2 control-label">Название:</label>
    <div class="col-md-8">
      <input type="text" class="form-control" name="name" id="name">
    </div>
  </div>
  <div class="form-group">
    <label for="tags" class="col-md-2 control-label">Теги:</label>
    <div class="col-md-6">
      <input type="text" class="form-control"  name="tags" id="tags">
    </div>
  </div>
  
  <div class="form-group">
    <label for="file" class="col-md-2 control-label">Картинка:</label>
    <div class="col-md-6">
      <input type="file" name="file" id="file">
    </div>
  </div>

  
  <div class="form-group">
    <label for="cat_id" class="col-md-2 control-label">Категория:</label>
    <div class="col-md-6">
      <select name="cat_id" id="cat_id" class="form-control">
      <option value="0">--Корневой каталог--</option>
      <?php echo $this->getCatagorySelect(); ?>
      </select>
    </div>
  </div>
  
   <div class="form-group">
    <label for="text" class="col-md-2 control-label">Текст:</label>
    <div class="col-md-8">
    <script src="/include/ckeditor/ckeditor.js"></script>
     <textarea name="text" id="text" class="form-control"></textarea>
        <script>
            CKEDITOR.replace( 'text' );
        </script>
    </div>
  </div>

  <div class="form-group">
    <label for="is_comment" class="col-md-2 control-label">Показывать коментарии:</label>
    <div class="col-md-6">
     <select name="is_comment" id="is_comment" class="form-control">
     <option value="1">Да</option>
     <option value="0">Нет</option>
     </select>
    </div>
  </div>
  
    <div class="form-group">
    <label for="tampletes" class="col-md-2 control-label">Шаблон:</label>
    <div class="col-md-6">
     <input type="text" class="form-control" name="tampletes" value="read_content.php" id="tampletes">
    </div>
  </div>

  <div class="form-group">
    <div for="tags" class="col-md-12">
	    <h3 class="con_head">SEO данные</h3>
    </div>
  </div>
  
   <div class="form-group">
    <label for="seo_title" class="col-md-2 control-label">Название:</label>
    <div class="col-md-8">
     <input type="text" class="form-control" name="seo_title" id="seo_title">
    </div>
  </div>
  
  <div class="form-group">
    <label for="seo_key" class="col-md-2 control-label">Ключи:</label>
    <div class="col-md-8">
     <input type="text" class="form-control" id="seo_key" name="seo_key">
    </div>
  </div>
  
  <div class="form-group">
    <label for="seo_des" class="col-md-2 control-label">Описание:</label>
    <div class="col-md-8">
     <input type="text" class="form-control" id="seo_des" name="seo_des">
    </div>
  </div>


  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" name="addContent">Добавить</button>
    </div>
  </div>
</form>


</div>
</div>
</div>