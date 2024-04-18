<div class="form-group">
  <?php if($sqr_quantitys) { ?>
  <div class="table-responsive" id="input-qnty">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <td class="text-center bgc1"><b><?php echo $text_checked; ?></b></td>
          <td class="text-center bgc1"><b><?php echo $text_qty; ?></b></td>
          <td class="text-center bgc1"><b><?php echo $text_price; ?></b></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($sqr_quantitys as $sqr_quantity) { ?>
        <tr>
          <td class="text-center">
            <input type="hidden" name="prices" value="<?php echo $sqr_quantity['sub']; ?>" class="sqrqunty_rad<?php echo $sqr_quantity['key_id']; ?>" />
            <input type="radio" name="customoption[cus_price]"  value="<?php echo $sqr_quantity['price1']; ?>" rel="<?php echo $sqr_quantity['price1']; ?>" rel1="<?php echo $sqr_quantity['quantity']; ?>" data-key-id="<?php echo $sqr_quantity['key_id']; ?>" class="sqrqunty_rad" />
          </td>
          <td class="text-center"><?php echo $sqr_quantity['quantity']; ?></td>
          <td class="text-right">
            <?php echo $sqr_quantity['price']; ?>
          </td>
        </tr>
        <?php } ?>
        <input type="hidden" name="option[sqr_qty]" class="sqr_qty" value="" />
        <input type="hidden" name="option[sqr_price]" class="sqr_price" value=""/>
      </tbody>
    </table>
  </div>
<?php } else { ?>
  <div class="alert alert-danger alert-dismissible warning"><?php echo $error; ?></div>
<?php } ?>
</div>
<div class="tmdalert"></div>
<style>
.bgc1{background:<?php echo $tmd_productdimension_h_color; ?>;color:<?php echo $tmd_productdimension_h_textcolor; ?>;padding: 12px;}
</style>