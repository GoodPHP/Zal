<?php
if(!LOAD){die('Not Found');}
$con = $this->obj;

?>



<div class="container">
<div class="row">
<div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">

<h1 class="con_head"><?php echo $this->title;?></h1>

<form class="form-horizontal" role="form" method="POST">
<div class="form-group">
    <label for="name" class="col-md-4 control-label">Название</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="reg_name" id="name" placeholder="Кинозал 1">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-md-4 control-label">Количество рядов</label>
    <div class="col-sm-4">
     <div class="input-group">
  <div class="input-group-btn">
	  <button class="btn btn-default" type="button" onclick="plus_ryad();">&nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;</button>
   <button class="btn btn-default" type="button" onclick="minus_ryad();">&nbsp;<span class="glyphicon glyphicon-minus"></span>&nbsp;</button>
  </div>
  <input type="text" class="form-control" id="count_ryad" name="ryad" value="1">
</div>    </div>
  </div>  

<div class="form-group">
    <label for="name" class="col-md-4 control-label">Кинозал</label>
  </div>
<div id="kinozal">
	
<div class="col-md-12">
<div class="col-md-2"><button class="btn btn-success" type="button" onclick="plus_mesto(1);">&nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;</button><button class="btn btn-danger" type="button" onclick="minus_mesto(1);">&nbsp;<span class="glyphicon glyphicon-minus"></span>&nbsp;</button></div>

<div class="form-group col-md-8" id="ryad_1">
  <div class="col-md-1 btn btn-default" id="ryad_1_1">1</div>
  <input type="hidden" id="ryad_1_count" name="count_ryad[]" value="1"/>
 </div>
 
 <div class="col-md-1"><input type="text" name="sector[]" maxlength="1" class="form-control text-center" value="A"></div>
 
 <div class="col-md-1"><input type="text" name="price[]" class="form-control text-center" placeholder="UAH"></div>
 
</div>
 
</div>

  <div class="form-group">
    <div class="col-sm-offset-3 col-md-10">
      <button type="submit" class="btn btn-primary col-md-6" name="subbmit"><span class=" glyphicon glyphicon-share"></span> Сохранить</button>
     
    </div>
  </div>
  

  
  
</form>


</div>
</div>
</div>

<script type="text/javascript">
	function plus_ryad(){
		var val = parseInt($('#count_ryad').val());
		var count = val + 1;
		$('#count_ryad').val(count);
		$( "#kinozal" ).append('<div class="col-md-12"><div class="col-md-2" id="button_'+count+'_ryad"><button class="btn btn-success" type="button" onclick="plus_mesto('+count+');">&nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;</button><button class="btn btn-danger" type="button" onclick="minus_mesto('+count+');">&nbsp;<span class="glyphicon glyphicon-minus"></span>&nbsp;</button></div><div id="mesto_'+count+'"><div class="form-group col-md-8" id="ryad_'+count+'"><div class="col-md-1 btn btn-default" id="ryad_'+count+'_1">1</div><input type="hidden" name="count_ryad[]" id="ryad_'+count+'_count" value="1"/></div></div><div class="col-md-1" id="sector_'+count+'"><input type="text" maxlength="1" class="form-control text-center" name="sector[]" value="A"></div><div class="col-md-1" id="price_'+count+'"><input type="text" name="price[]" class="form-control text-center" placeholder="UAH"></div></div>');
	}
	
	function minus_ryad(){
		var val = parseInt($('#count_ryad').val());
		if(val > 1){
		var count = val - 1;
		$('#count_ryad').val(count);
		$("#ryad_"+val).remove();
		$('#button_'+val+'_ryad').remove();
		$("#sector_"+val).remove();
		$("#price_"+val).remove();
		}
		
	}
	
	function plus_mesto(id){
		var val = parseInt($('#ryad_'+id+'_count').val());
		var count = val + 1;
		if(val < 12){
		$('#ryad_'+id+'_count').val(count);
		$( "#ryad_"+id ).append('<div class="col-md-1 btn btn-default" id="ryad_'+id+'_'+count+'">'+count+'</div>');
		}
	}
	
	function minus_mesto(id){
		var val = parseInt($('#ryad_'+id+'_count').val());
		if(val > 1){
		var count = val - 1;
		$('#ryad_'+id+'_count').val(count);
		$("#ryad_"+id+"_"+val).remove();
		}
	}
</script>