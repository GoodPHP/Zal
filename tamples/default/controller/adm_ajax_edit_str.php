<?php
if(!LOAD){die('Not Found');}



$con = $this->obj;
$config = $con['page_config'];
$seo = explode('|',$config['seo_page']);
print_r($seo);
?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Редактировать новость</h4>
      </div>
      <div class="modal-body">
       <form method="POST" enctype="multipart/form-data">
  
   <div class="form-group">
    <label for="name">Название</label>
   <input type="text" class="form-control" id="name" name="name" value="<?php echo $config['name']; ?>">
  </div>
  
  <div class="form-group">
    <label for="title">Title/Название</label>
   <input type="text" class="form-control" id="title" name="title" value="<?php echo $seo[0]; ?>">
  </div>
  
  <div class="form-group">
    <label for="keywords">Keywords/Ключи</label>
   <input type="text" class="form-control" id="keywords" name="keywords" value="<?php echo $seo[1]; ?>">
  </div>
  
  <div class="form-group">
    <label for="description">Description/Описание</label>
   <input type="text" class="form-control" id="description" name="description" value="<?php echo $seo[2]; ?>">
  </div>
  
   <div class="form-group">
    <label for="page">Url</label>
   <input type="text" class="form-control" id="page" name="page" value="<?php echo $config['page']; ?>">
  </div>
  
  <div class="form-group">
   <label for="descript">Текст на странице</label>
   <script src="/include/ckeditor/ckeditor.js"></script>
   <textarea name="descript" id="descript" class="form-control"></textarea>
   <script>
            CKEDITOR.replace( 'descript' );
  </script>
  </div>
  
  <div class="form-group">
    <label for="page">Обновлено</label>
   - <?php echo $config['pubdate']; ?>
  </div>
  
      </div>
      <div class="modal-footer">
      <input type="hidden" value="<?php echo $con['id']; ?>" name="id"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="submit" class="btn btn-primary" name="editContent">Изменить</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$('#myModal').modal('show');
</script>