<?php if ($sqrpriceinfos || $infos) { ?>
<h3><?php echo $text_size; ?></h3>
<ul class="list-unstyled sqrsize">
  <input type="hidden" name="category_id[]" value="<?php echo $category_id; ?>"/>
  <li class="sqrwidth">
    <input type="text" name="option[sqr_width]" value="" placeholder="<?php echo $text_width ; ?>" id="input-sqrwidth" class="form-control input_sqr"  />
    <span class="text-danger tmder"><b><?php echo $textwidth; ?></b></span>
  </li>
  <li>
  <span class="multi_size"> x </span>
  </li>
  <li class="sqrheight">
    <input type="text" name="option[sqr_height]" value="" placeholder="<?php echo $text_height; ?>" id="input-sqrheight" class="form-control input_sqr" />
    <span class="text-danger tmder"><b><?php echo $textheight; ?></b></span>
  </li>
</ul>
<span id="greater"></span>

<div id="productsqr"></div>
<?php } ?>

<script>
$( ".input_sqr" ).keyup(function() {
  var width_min   = <?php echo $width_min; ?>;
  var width_max   = <?php echo $width_max; ?>;
  var height_min  = <?php echo $height_min; ?>;
  var height_max  = <?php echo $height_max; ?>;
  $(".alert-danger").remove();

  var width   = $('#input-sqrwidth').val();
  var height  = $('#input-sqrheight').val();

  if((width_min <= width && width_max >= width) && (height_min <= height && height_max >= height)){
    var productid = <?php echo $product_id; ?>;
    <?php if($category_id) { ?>
      var category_id = $('input[name="category_id[]"]').map(function(){ return this.value; }).get();
    <?php } else { ?>
    var category_id =0;
    <?php } ?>

    var manufacturer_id = <?php echo $manufacturer_id; ?>;

    var width_value = $('#input-sqrwidth').val();
    var height_value = $('#input-sqrheight').val();
    var sqr_meter = width_value*height_value;

    if(sqr_meter){
      var url='index.php?route=extension/tmd_productdimension/quantityprice&product_id=' + productid+'&width=' + width_value+'&height='+height_value;
      
      $('#productsqr').load(url);
    }
    $(".tmder").remove();
  } else {
      $('#productsqr').html('<div class="alert alert-danger alert-dismissible warning"><?php echo $error_size; ?></div>');
    $("#greater").after(' ');
  }
});

</script>

<!--load price quantity-->
<script>
$(document).on('click', '.sqrqunty_rad',function(){
  var key_id=$(this).attr('data-key-id');
  var subprice = $('.sqrqunty_rad'+key_id).val();
  var quantityprice=$(this).attr('rel');

  var qty=$(this).attr('rel1');
  $('#input-quantity').val(qty);
  $('.sqr_qty').val(qty);

  var sqrprice=quantityprice;
  $('.sqr_price').val(sqrprice);

  $(".journal-stepper").attr('style', 'display:none');
  $('#input-quantity').attr('readonly', true);
  lodprice(subprice);
})

function lodprice(subprice){
    var product_id =<?php echo $product_id; ?>;
    $.ajax({
    url: 'index.php?route=extension/loadprice&sqrprice=' + subprice+'&product_id='+product_id,
    type: 'post',
     data: '',
    dataType: 'json',
    success: function(json) {
      html="";
    if(json['special'])
     {
    $('.price-new').html(json['special']);
    $('.tmd_productdimensions').html('<input type="hidden" name="sqrprice" value="'+subprice+'" />');
    // $('.price-old').html('<span style="text-decoration: line-through;">'+json['pprice']+'</span>');
    }
     else
    {
    $('.product-price').html(json['pprice']+'<input type="hidden" name="sqrprice" value="'+json['pprice']+'" />');
    $('.tmd_productdimensions').html('<input type="hidden" name="sqrprice" value="'+subprice+'" />');
    $('.product-price').html(json['price']);
    }
     if(json['tax'])
    {
    $('.price-tax').html(json['tax']);
    }

    }
  });
 }
</script> 
<style>
.qnty_price{
margin-left: 20px;
}
.sqrsize{
 display: -webkit-inline-box;
}
.sqrwidth{
width: 169px;
}
.sqrheight{
width: 169px;
}

.multi_size{
padding-left: 5px;
padding-right: 5px;
top: 7px;
position: relative;
}

</style>
