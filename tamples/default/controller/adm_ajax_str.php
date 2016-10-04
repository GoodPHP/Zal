<?php 
if(!LOAD){die('Not Found');}

 
$con = $this->obj;

?>

<table class="table table-hover">
<tr>
<td><b>ID</b></td>
<td><b>Название</b></td>
<td><b>SEO данные</b></td>
<td><b>Url страницы</b></td>
<td>Действия</td>
</tr>
<?php foreach($con['page'] as $page){ ?>
<tr>
<td><?php echo $page['id'];?></td>
<td><?php echo $page['name'];?></td>
<td><?php echo $page['seo_page'];?></td>
<td><?php echo $page['page'];?></td>
<td><a onClick="editSTR(<?php echo $page['id'];?>);"><span class="glyphicon glyphicon-pencil"></span></a> <a href=""><span class="glyphicon glyphicon-trash"></span></a></td>
</tr>
<?php } ?>
</table>