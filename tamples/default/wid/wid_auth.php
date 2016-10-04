<?php
if(!LOAD){die('Not Found');}


$config = $this->widget;

$mod = $this->obj;

?>

<?php if($mod['user']['id'] == 0){ ?>
<li><a href="/users/register.html"><span class="glyphicon glyphicon-import"></span> Регистрация</a></li>
<li><a href="/users/login.html"><span class="glyphicon glyphicon-saved"></span> Войти</a></li>
<?php }else{ ?>
<li><a><?php if($mod['user']['active'] == 0){ ?> <span class="glyphicon glyphicon-user" style="color:red;"></span>   <?php }else{ ?> <span class="glyphicon glyphicon-user" style="color:green;"></span>  <?php } ?>   Здраствуйте, <?php echo $mod['user']['name'];?>!</a></li>
<li><a href="/users/logout"><span class="glyphicon glyphicon-remove-sign"></span> Выход</a></li>
<?php } ?>
