<?php
if(!LOAD){die('Not Found');}

 
$con = $this->obj;

//print_r($this->title);

?>
<div class="container">
<div class="row">
<div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">

<h1 class="con_head"><?php echo $this->title;?></h1>

<form class="form-horizontal" role="form" method="POST">
<div class="form-group">
    <label for="name" class="col-md-4 control-label">Имя</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="reg_name" id="name" placeholder="Алексей">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-md-4 control-label">Email</label>
    <div class="col-sm-4">
      <input type="email" class="form-control" name="reg_email" id="email" placeholder="name@domain.ru">
    </div>
  </div>
  <div class="form-group">
    <label for="pass1" class="col-md-4 control-label">Пароль</label>
    <div class="col-sm-4">
      <input type="password" class="form-control" name="reg_pass1" id="pass1">
    </div>
  </div>
  
  <div class="form-group">
    <label for="pass2" class="col-md-4 control-label">Повторить пароль</label>
    <div class="col-sm-4">
      <input type="password" class="form-control" name="reg_pass2" id="pass2">
    </div>
  </div>
  
  <div class="form-group">
    <label for="capcha" class="col-md-4 control-label"><img src="/include/kcaptcha/?<?php echo session_name()?>=<?php echo session_id()?>" onclick="this.src = '/include/kcaptcha/?<?php echo session_name()?>=<?php echo session_id()?>' + Math.random();" style="height:80px;"></label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="capcha" id="capcha">
    </div>
  </div>
  

  <div class="form-group">
    <div class="col-sm-offset-3 col-md-10">
      <button type="submit" class="btn btn-primary col-md-6" name="addUsers"><span class=" glyphicon glyphicon-share"></span> Зарегистрироваться</button>

      <a href="/users/send-pass.html" class="btn btn-default" style="margin-left:20px;">Забыли пароль?</a>
      <a href="/users/login.html" class="btn btn-default">Войти</a>
     
    </div>
  </div>
  

  
  
</form>


</div>
</div>
</div>