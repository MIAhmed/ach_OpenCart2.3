<?php if ($testmode) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $text_testmode; ?></div>
<?php } ?>
<form action="<?php echo $action; ?>" method="post">
  <input type="hidden" name="cmd" value="_cart" />
  <input type="hidden" name="upload" value="1" />
<input type="hidden" name="MerchantID" value="<?php echo $merchant; ?>" />
  <input type="hidden" name="Amount" value="<?php echo $Amount; ?>" />
  <input type="hidden" name="business" value="<?php echo $business; ?>" />
  <input type="hidden" name="Country" value="AUSTRALIA">
  <input type="hidden" name="Currency" value="AUD">
  <input type="hidden" name="MerchantTxnID" value="<?php echo $merchanttxnid; ?>">
  <input type="hidden" name="UserId" value="<?php echo $user; ?>" />

  <input type="hidden" name="SuccessURL" value="<?php echo $notify_url; ?>" />
  <input type="hidden" name="CancelURL" value="<?php echo $cancel_return; ?>" />
 
  <div class="buttons">
    <div class="pull-right">
      <input type="submit" value="<?php echo $button_confirm; ?>" class="btn btn-primary" />
    </div>
  </div>
</form>
