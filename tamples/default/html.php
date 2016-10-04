<?php
if(!LOAD){die('Not Found');}

$inCore = getAjaxCore::getFunction();


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ru">
<head>
<?php echo $inCore->getHead(); ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="/tamples/<?php echo $inCore->html;?>/css/styles.css" rel="stylesheet"> 
<link href="/tamples/<?php echo $inCore->html;?>/css/bootstrap.min.css" rel="stylesheet"> 
<script src="/tamples/<?php echo $inCore->html;?>/js/modernizr.custom.53451.js"></script>
</head>
<body>
    
    
    <div id="header">
    <div class="container">
    <div class="row">
    <div class="col-md-4 col-xs-4 col-lg-4 col-sm-4">
	<a href="/"><div class="logo"></div></a>
    </div>
    <div class="col-md-8  col-xs-8 col-lg-8 col-sm-8">
    <a class="pull-right" style="margin-top:20px;" href="/kino/add"><img src="/tamples/<?php echo $inCore->html;?>/images/info.png"/></a>
    </div>
    
    </div>
    </div>
    </div>
    
    <div class="container">
   <div class="row">
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
   <?php $messages = $inCore->getSessionAlert(); ?>
   <?php if ($messages) { ?>
   <?php foreach($messages as $message){ ?>
   <?php echo $message; ?>
   <?php } ?>
   <?php } ?>
   </div>
   </div>
    </div>
    
    
    <?php $inCore->getBody(); ?>
    
    
   <div class="container" id="content">
   <div class="row">
  
   
   <?php if(!$inCore->component){ ?>
   <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
   <section id="dg-container" class="dg-container">
	   <?php
		   $kino = $inCore->get_table('cms_kino');
		   ?>
				<div class="dg-wrapper">
					<?php foreach($kino as $zal){ ?>
					<a href="/kino/<?php echo $zal['id']; ?>"><img src="/tamples/<?php echo $inCore->html;?>/images/1.jpg" alt="image01"><div><?php echo $zal['name']; ?></div></a>
					<?php } ?>
					</div>
				<nav class="col-md-12 col-xs-12 col-lg-12 col-sm-12">	
					<div class="dg-prev navbar-left"></div>
					<div class="dg-next navbar-right"></div>
				</nav>
			</section>
   </div>
   <?php } ?>
   </div>
   </div>
   
   <?php if($inCore->getSEO()){?>
   <div class="container">
   <div class="row">
   <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
   <div class="bottom_info">
  <?php echo $inCore->getSEO(); ?>
   </div>
   </div>
   </div>
   </div>
   <?php } ?>
 
    <div id="footer">
    <div class="container">
    <div class="row">
    
    </div>
    </div>
    </div>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/tamples/<?php echo $inCore->html;?>/js/bootstrap.min.js"></script>
 <?php if(!$inCore->component){ ?>  <script src="/tamples/<?php echo $inCore->html;?>/js/jquery.gallery.js"></script>
		<script type="text/javascript">
			$(function() {
				$('#dg-container').gallery();
			});
		</script>
<?php } ?>
</body>
</html> 