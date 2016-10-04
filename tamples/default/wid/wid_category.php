 <?php
if(!LOAD){die('Not Found');}


$config = $this->widget;

$mod = $this->obj;

?>

<a href="/content" class="btn btn-default col-md-12 col-xs-12 col-lg-12 col-sm-12 bottom_info">Весь контент</a>
<?php foreach($mod['category'] as $cat){ ?>
<a href="/content/<?php echo $cat['url']; ?>" class="btn btn-default col-md-12 col-xs-12 col-lg-12 col-sm-12 bottom_info"><?php echo $cat['name']; ?></a>
<?php } ?>