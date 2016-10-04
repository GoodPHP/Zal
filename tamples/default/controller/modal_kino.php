<?php
if(!LOAD){die('Not Found');}
$con = $this->obj;

?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ряд №<?php echo $con['ryad']+1; ?> - Место №<?php echo $con['mesto']; ?></h4>
      </div>
      <div class="modal-body">
	 <?php if($ins['ins_pub'] != 2 AND $ins['ip_client'] != $_SERVER['REMOTE_ADDR']) { ?>
       <form method="post">
  <div class="form-group">
    <label for="name_order">Имя</label>
    <input type="text" class="form-control" id="name_order" name="name_order" placeholder="Алексей">
    <label><?php if($con['kino']['kinozal']['price'][$con['ryad']]){ ?>Цена - <?php echo $con['kino']['kinozal']['price'][$con['ryad']]; ?>UAH<?php }else{ ?>Бесплатно<?php } ?></label>
  </div>
     <?php }else{ ?>
     <p>Данное место уже кто-то бронирует, попробуйте через 30 секунд.</p>
     <?php } ?>
  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
       <?php if($ins['ins_pub'] != 2 AND $ins['ip_client'] != $_SERVER['REMOTE_ADDR']) { ?> <button class="btn btn-primary" type="submit" name="submit_order">Забронировать</button> <?php } ?>
        <input type="hidden" value="<?php echo $con['ryad']; ?>" name="ryad"/>
        <input type="hidden" value="<?php echo $con['mesto']; ?>" name="mesto"/>
        <input type="hidden" value="<?php echo $con['id']; ?>" name="id"/>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$('#myModal').modal('show');
	
	$("#mesto_<?php echo $con['ryad']; ?>_<?php echo $con['mesto']; ?>").removeClass("btn-default");

  $('#mesto_<?php echo $con['ryad']; ?>_<?php echo $con['mesto']; ?>').addClass("btn-warning");

</script>