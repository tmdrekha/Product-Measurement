<?php echo $header; ?><?php echo $column_left; ?> 
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a onclick="$('#form-tmd_productdimension').submit();" class="btn btn-primary" data-toggle="tooltip" title="<?php echo $button_save; ?>"><i class="fa fa-save"></i></a>
        <button type="submit" form="form-tmd_productdimension" onclick="$('#form-tmd_productdimension').attr('action','<?php echo $staysave; ?>');$('#form-tmd_productdimension').submit(); " data-toggle="tooltip" title="<?php echo $button_stay; ?>" class="btn btn-primary"><i class="fa fa-save"></i><?php echo $button_stay; ?></button>

        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?> 
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
	  <?php if ($error_keynotfound) { ?>
				<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_keynotfound; ?>
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
			<?php } ?>			
			<div class="loadlicensekey"></div>
        <form action="<?php echo $action ; ?>" method="post" enctype="multipart/form-data" id="form-tmd_productdimension" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i> <?php echo $tab_general; ?></a></li>
            <li><a href="#tab-link" data-toggle="tab"><i class="fa fa-link" aria-hidden="true"></i><?php echo $tab_link ; ?></a></li>
            <li><a href="#tab-language" data-toggle="tab"><i class="fa fa-language" aria-hidden="true"></i><?php echo $tab_language; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                <div class="col-sm-10">
                  <select name="tmd_productdimension_status" id="input-status" class="form-control">
                    <?php if ($tmd_productdimension_status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled ; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-h-color"><?php echo $entry_headingcolor; ?></label>
                <div class="col-sm-6">
                  <input type="text" name="tmd_productdimension_h_color" class="form-control color-picker" value="<?php echo $tmd_productdimension_h_color; ?>">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-text-color"><?php echo $entry_textcolor; ?></label>
                <div class="col-sm-6">
                  <input type="text" name="tmd_productdimension_h_textcolor" class="form-control color-picker" value="<?php echo $tmd_productdimension_h_textcolor ; ?>">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_width ; ?></label>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="input-group">
                      <div class="input-group-addon"><?php echo $entry_min ; ?></div>
                      <input type="number" name="tmd_productdimension_width_min" value="<?php echo $tmd_productdimension_width_min ; ?>" placeholder="<?php echo $entry_min; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="input-group">
                      <div class="input-group-addon"><?php echo $entry_max ; ?></div>
                      <input type="number" name="tmd_productdimension_width_max" value="<?php echo $tmd_productdimension_width_max; ?>" placeholder="<?php echo $entry_max; ?>" class="form-control" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_height; ?></label>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="input-group">
                      <div class="input-group-addon"><?php echo $entry_min; ?></div>
                      <input type="number" name="tmd_productdimension_height_min" value="<?php echo $tmd_productdimension_height_min; ?>" placeholder="<?php echo $entry_min; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="input-group">
                      <div class="input-group-addon"><?php echo $entry_max; ?></div>
                      <input type="number" name="tmd_productdimension_height_max" value="<?php echo $tmd_productdimension_height_max; ?>" placeholder="<?php echo $entry_max; ?>" class="form-control" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sqrprice"><?php echo $entry_sqrprice; ?></label>
                <div class="col-sm-10">
                  <div class="table-responsive">
                    <table id="tmddiscount" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <td class="text-left"><?php echo $column_from; ?></td>
                          <td class="text-left"><?php echo $column_to; ?></td>
                          <td class="text-left"><?php echo $column_price; ?></td>
                          <td class="text-left"><?php echo $entry_discount; ?></td>
                          <td class="text-center"><?php echo $entry_action; ?></td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $price_row = 0; ?>
                        <?php foreach ($tmd_productdimension_product_sqrs as $tmd_productdimension_productsqr) { ?>
                        <tr id="price-row<?php echo $price_row; ?>">
                          <td class="text-right"><input type="number" name="tmd_productdimension_productsqr[<?php echo $price_row; ?>][from_sqr]" value="<?php echo $tmd_productdimension_productsqr['from_sqr']; ?>" placeholder="<?php echo $entry_from; ?>" class="form-control"/></td>
                          <td class="text-right"><input type="number" name="tmd_productdimension_productsqr[<?php echo $price_row; ?>][to_sqr]" value="<?php echo $tmd_productdimension_productsqr['to_sqr'] ; ?>" placeholder="<?php echo $entry_to; ?>" class="form-control"/></td>
                          <td class="text-right"><input type="number" name="tmd_productdimension_productsqr[<?php echo $price_row ; ?>][price]" value="<?php echo $tmd_productdimension_productsqr['price']; ?>" placeholder="<?php echo $entry_price ; ?>" class="form-control"/></td>
                          <td class="text-right">
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-percent" aria-hidden="true"></i><b>%</b></div>
                              <input type="number" name="tmd_productdimension_productsqr[<?php echo $price_row; ?>][discount]" value="<?php echo 
                              $tmd_productdimension_productsqr['discount']; ?>" placeholder="<?php echo 
                              $entry_discount; ?>" class="form-control"/>
                            </div>
                          </td>
                          <td class="text-center"><button type="button" onclick="$('#price-row<?php echo $price_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                        </tr>
                        <?php $price_row++; ?>
                        <?php } ?>
                      </tbody>

                      <tfoot>
                        <tr>
                          <td colspan="4"></td>
                          <td class="text-center"><button type="button" onclick="addPrice();" data-toggle="tooltip" title="<?php echo $button_discount_add ; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="tab-link">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-tmdproducts"><?php echo $entry_product; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="tmdproducts" value="" placeholder="<?php echo $entry_product; ?>" id="input-tmdproducts" class="form-control" />
                  <div id="book-product" class="well well-sm" style="height: 150px; overflow: auto;"> 
                    <?php foreach ($tmd_productdimension_products as $product) { ?>
                    <div id="book-product<?php echo $product['product_id']; ?>"><i class="fa fa-minus-circle"></i><?php echo $product['name']; ?>
                      <input type="hidden" name="tmd_productdimension_pproducts[]" value="<?php echo $product['product_id']; ?>" />
                    </div>
                    <?php } ?>
                </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-category"><span data-toggle="tooltip" title="<?php echo $help_category; ?>"><?php echo $entry_category; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="category" value="" placeholder="<?php echo $entry_category; ?>" id="input-category" class="form-control" />
                  <div id="tmdscategory" class="well well-sm" style="height: 150px; overflow: auto;"> 
                    <?php foreach ($tmd_productdimension_categories as $tmd_productdimension_category) { ?>
                    <div id="tmdscategory<?php echo $tmd_productdimension_category['category_id']; ?>"><i class="fa fa-minus-circle"></i><?php echo $tmd_productdimension_category['name']; ?> 
                      <input type="hidden" name="tmd_productdimension_category[]" value="<?php echo $tmd_productdimension_category['category_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-manufacturer"><span data-toggle="tooltip" title="<?php echo $help_manufacture ; ?>"><?php echo $entry_manufacture; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="manufacturer" value="" placeholder="<?php echo $entry_manufacture; ?>" id="input-category" class="form-control" />
                  <div id="tmdsmanufacturer" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($tmd_productdimension_manufacturers as $tmd_productdimension_manufacturer) { ?>
                    <div id="tmdsmanufacturer<?php echo $tmd_productdimension_manufacturer['manufacturer_id'] ; ?>"><i class="fa fa-minus-circle"></i><?php echo $tmd_productdimension_manufacturer['name']; ?> 
                      <input type="hidden" name="tmd_productdimension_manufacturer[]" value="<?php echo $tmd_productdimension_manufacturer['manufacturer_id']; ?>" />
                    </div>
                    <?php } ?> 
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="tab-language">
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_total; ?></label>
                <div class="col-sm-10">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="tmd_productdimension_multi[<?php echo $language['language_id']; ?>][totaltext]" value="<?php echo isset($tmd_productdimension_multi[$language['language_id']]) ? $tmd_productdimension_multi[$language['language_id']]['totaltext'] : ''; ?>" placeholder="<?php echo $entry_total; ?>" class="form-control" />
                  </div>
                  <?php } ?> 
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_discounttext; ?></label>
                <div class="col-sm-10">
                 <?php foreach ($languages as $language) { ?>
                  <div class="input-group"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="tmd_productdimension_multi[<?php echo $language['language_id']; ?>][discounttext]" value="<?php echo isset($tmd_productdimension_multi[$language['language_id']]) ? $tmd_productdimension_multi[$language['language_id']]['discounttext'] : ''; ?>" placeholder="<?php echo $entry_discounttext; ?>" class="form-control" />
                  </div>
                  <?php } ?> 
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_heading; ?></label>
                <div class="col-sm-10">
                 <?php foreach ($languages as $language) { ?>
                  <div class="input-group"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="tmd_productdimension_multi[<?php echo $language['language_id']; ?>][headingtext]" value="<?php echo isset($tmd_productdimension_multi[$language['language_id']]) ? $tmd_productdimension_multi[$language['language_id']]['headingtext'] : ''; ?>" placeholder="<?php echo $entry_heading; ?>" class="form-control" />
                  </div>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_choosebox; ?></label>
                <div class="col-sm-10">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="tmd_productdimension_multi[<?php echo $language['language_id']; ?>][choosebox]" value="<?php echo isset($tmd_productdimension_multi[$language['language_id']]) ? $tmd_productdimension_multi[$language['language_id']]['choosebox'] : ''; ?>" placeholder="<?php echo $entry_choosebox; ?>" class="form-control" />
                  </div>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_quantity; ?></label>
                <div class="col-sm-10">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="tmd_productdimension_multi[<?php echo $language['language_id']; ?>][quantity]" value="<?php echo isset($tmd_productdimension_multi[$language['language_id']]) ? $tmd_productdimension_multi[$language['language_id']]['quantity'] : ''; ?>" placeholder="<?php echo $entry_quantity; ?>" class="form-control" />
                  </div>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_price; ?></label>
                <div class="col-sm-10">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="tmd_productdimension_multi[<?php echo $language['language_id']; ?>][price]" value="<?php echo isset($tmd_productdimension_multi[$language['language_id']]) ? $tmd_productdimension_multi[$language['language_id']]['price'] : ''; ?>" placeholder="<?php echo $entry_price; ?>" class="form-control" />
                  </div>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_placeholder; ?></label>
                  <div class="col-sm-10">
                    <div class="row">
                    <?php foreach ($languages as $language) { ?>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                        <input type="text" name="tmd_productdimension_multi[<?php echo $language['language_id']; ?>][width]" value="<?php echo isset($tmd_productdimension_multi[$language['language_id']]) ? $tmd_productdimension_multi[$language['language_id']]['width'] : ''; ?>" placeholder="<?php echo $entry_width; ?>" class="form-control" />
                        <div class="input-group-addon"><?php echo $entry_width; ?></div>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                        <input type="text" name="tmd_productdimension_multi[<?php echo $language['language_id']; ?>][height]" value="<?php echo isset($tmd_productdimension_multi[$language['language_id']]) ? $tmd_productdimension_multi[$language['language_id']]['height'] : ''; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
                        <div class="input-group-addon"><?php echo $entry_height; ?></div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_error_d; ?></label>
                <div class="col-sm-10">
                    <div class="row">
                    <?php foreach ($languages as $language) { ?>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                        <input type="text" name="tmd_productdimension_multi[<?php echo $language['language_id']; ?>][errorwidth]" value="<?php echo isset($tmd_productdimension_multi[$language['language_id']]) ? $tmd_productdimension_multi[$language['language_id']]['errorwidth'] : ''; ?>" placeholder="<?php echo $entry_errorwidth; ?>" class="form-control" />
                        <div class="input-group-addon"><?php echo $entry_errorwidth ; ?></div>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                        <input type="text" name="tmd_productdimension_multi[<?php echo $language['language_id']; ?>][errorheight]" value="<?php echo isset($tmd_productdimension_multi[$language['language_id']]) ? $tmd_productdimension_multi[$language['language_id']]['errorheight'] : ''; ?>" placeholder="<?php echo $entry_errorheight; ?>" class="form-control" />
                        <div class="input-group-addon"><?php echo $entry_errorheight; ?></div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_errorlimit; ?></label>
                  <div class="col-sm-10">
                    <div class="row">
                    <?php foreach ($languages as $language) { ?>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                        <input type="text" name="tmd_productdimension_multi[<?php echo $language['language_id']; ?>][errorlimitwidth]" value="<?php echo isset($tmd_productdimension_multi[$language['language_id']]) ? $tmd_productdimension_multi[$language['language_id']]['errorlimitwidth'] : ''; ?>" placeholder="<?php echo $entry_width; ?>" class="form-control" />
                        <div class="input-group-addon"><?php echo $entry_width; ?></div>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="input-group">
                        <span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                        <input type="text" name="tmd_productdimension_multi[<?php echo $language['language_id']; ?>][errorlimitheight]" value="<?php echo isset($tmd_productdimension_multi[$language['language_id']]) ? $tmd_productdimension_multi[$language['language_id']]['errorlimitheight'] : ''; ?>" placeholder="<?php echo $entry_height; ?>" class="form-control" />
                        <div class="input-group-addon"><?php echo $entry_height; ?></div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_errornot; ?></label>
                <div class="col-sm-10">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="tmd_productdimension_multi[<?php echo $language['language_id']; ?>][not_faund]" value="<?php echo isset($tmd_productdimension_multi[$language['language_id']]) ? $tmd_productdimension_multi[$language['language_id']]['not_faund'] : ''; ?>" placeholder="<?php echo $entry_errornot; ?>" class="form-control" />
                  </div>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_erroroption; ?></label>
                <div class="col-sm-10">
                  <?php foreach ($languages as $language) { ?>
                  <div class="input-group"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                    <input type="text" name="tmd_productdimension_multi[<?php echo $language['language_id']; ?>][erroroption]" value="<?php echo isset($tmd_productdimension_multi[$language['language_id']]) ? $tmd_productdimension_multi[$language['language_id']]['erroroption'] : ''; ?>" placeholder="<?php echo $entry_erroroption; ?>" class="form-control" />
                  </div>
                  <?php } ?>
                </div>
              </div>

            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
			$(document).ready(function() {
				$('.loadlicensekey').load('index.php?route=extension/keysubmit/loadfrom&token=<?php echo $token; ?>');
				});
				//--></script>
<?php echo $footer; ?>

<script src="view/javascript/colorbox/jquery.minicolors.js"></script>
<link rel="stylesheet" href="view/javascript/colorbox/jquery.minicolors.css">
<script>
  $(document).ready( function() {
    $('.color-picker').each(function() {
      $(this).minicolors({
        control: $(this).attr('data-control') || 'hue',
        defaultValue: $(this).attr('data-defaultValue') || '',
        inline: $(this).attr('data-inline') === 'true',
        letterCase: $(this).attr('data-letterCase') || 'lowercase',
        opacity: $(this).attr('data-opacity'),
        position: $(this).attr('data-position') || 'bottom left',
        change: function(hex, opacity) {
          if( !hex ) return;
          if( opacity ) hex += ', ' + opacity;
          try {
            console.log(hex);
          } catch(e) {}
        },
        theme: 'bootstrap'
      });
    });
  });
</script>

<script type="text/javascript">
  var price_row = <?php echo $price_row;?>;
  function addPrice() {
    html = '<tr id="price-row' + price_row + '">';
    html += '  <td class="text-right"><input type="number" name="tmd_productdimension_productsqr[' + price_row + '][from_sqr]" value="" placeholder="<?php echo $entry_from;?>" class="form-control" /></td>';
    html += '  <td class="text-right"><input type="number" name="tmd_productdimension_productsqr[' + price_row + '][to_sqr]" value="" placeholder="<?php echo $entry_to;?>" class="form-control" /></td>';
    html += '  <td class="text-right"><input type="number" name="tmd_productdimension_productsqr[' + price_row + '][price]" value="" placeholder="<?php echo $entry_price;?>" class="form-control" /></td>';
    html += '  <td class="text-right"><div class="input-group"><div class="input-group-addon"><i class="fa fa-percent" aria-hidden="true"></i><b>%</b></div><input type="number" name="tmd_productdimension_productsqr[' + price_row + '][discount]" value="" placeholder="<?php echo $entry_discount;?>" class="form-control" /></div></td>';
    html += '  <td class="text-left"><button type="button" onclick="$(\'#price-row' + price_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove ;?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';
    $('#tmddiscount tbody').append(html);
    price_row++;
  }
</script>

<script>
// product
$('input[name=\'tmdproducts\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token;?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['product_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'tmdproducts\']').val('');
    $('#book-product' + item['value']).remove();
    $('#book-product').append('<div id="book-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="tmd_productdimension_pproducts[]" value="' + item['value'] + '" /></div>');
  }
});
$('#book-product').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

/// Categories
$('input[name=\'category\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token;?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['category_id'],
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'category\']').val('');

    $('#tmdscategory' + item['value']).remove();

    $('#tmdscategory').append('<div id="tmdscategory' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="tmd_productdimension_category[]" value="' + item['value'] + '" /></div>');
  }
});

$('#tmdscategory').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

/// Manufacturer
$('input[name=\'manufacturer\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/manufacturer/autocomplete&token=<?php echo $token;?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['manufacturer_id'],
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'manufacturer\']').val('');

    $('#tmdsmanufacturer' + item['value']).remove();

    $('#tmdsmanufacturer').append('<div id="tmdsmanufacturer' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="tmd_productdimension_manufacturer[]" value="' + item['value'] + '" /></div>');
  }
});

$('#tmdsmanufacturer').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});
</script>
<style>
.input-group{
  margin-bottom:10px;
}
#tmdtimes label{
  margin-bottom:10px;
}
</style>
