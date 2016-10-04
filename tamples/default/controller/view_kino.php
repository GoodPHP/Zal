<?php
if(!LOAD){die('Not Found');}
$con = $this->obj;
?>


<div class="container">
<div class="row" id="kinozal">
	<h1><?php echo $con['content']['name']; ?></h1>
	
	
	<?php
		
		$pp = 1;
		$ss = 1;

for ($d = 0; $d <= $con['content']['ryad']-1; $d++){
  echo '<div class="col-md-1">'.$con['content']['kinozal']['sector'][$d].'</div>';
  echo '<div class="col-md-1">'.$pp++.'</div>';
  if($con['content']['kinozal']['price'][$d]){echo '<div class="col-md-1">'.$con['content']['kinozal']['price'][$d].' UAH</div>';}else{echo '<div class="col-md-1">Бесплатно</div>';}
  echo '<div class="col-md-9"><div style="text-align:center;">';
  $sec = 1;
  for ($oo = 1; $oo <= $con['content']['kinozal']['count_mest'][$d]; $oo++){
	  if($con['content']['kinozal']['type_mesto'][$d][$oo] == 2) { $class = 'btn-warning'; }
	  if($con['content']['kinozal']['type_mesto'][$d][$oo] == 3) { $class = 'btn-success disabled'; }
	  if(!$con['content']['kinozal']['type_mesto'][$d][$oo]) { $class = 'btn-default'; $num = $sec++; }
  echo '<p class="btn '.$class.' col-md-1" style="float:none;" onClick="orderMesto('.$d.','.$oo.','.$con['content']['id'].');" id="mesto_'.$d.'_'.$oo.'">'.$oo.'</p>';
  $svobo = $ss++;
  }
  echo '<span style="position:absolute; right:-100px;">'.$num.' - свободных </span>';
  echo '</div></div>';
  }

  ?>
  
  <div class="col-md-12"><h3>Статистика</h3> <span>Забронированных - <span class="label label-success"><?php echo $con['tree']; ?></span></span> <span>В процессе брони - <span class="label label-warning"><?php echo $con['two']; ?></span></span> <span>Свободных - <span class="label label-default"><?php echo $svobo - $con['tree'] - $con['two']; ?></span></span> </div>
  
<div id="loader"></div>
</div>
</div>

<script type="text/javascript">
	function orderMesto(ryad,mesto,id){
		$('#loader').load('/controller/kino/ajax/ordermesto.php', {'ryad':ryad,'mesto':mesto,'kino_id':id});
	}
</script>