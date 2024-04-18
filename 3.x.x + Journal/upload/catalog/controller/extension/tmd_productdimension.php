<?php
class ControllerExtensionTmdproductdimension extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('product/product');
		$this->load->language('extension/tmd_productdimension');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
			
		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}

		if (isset($this->request->get['path'])) {
			$data['category_id'] = $this->request->get['path'];
		} else {
			$data['category_id'] = 0;
		}

		if (isset($this->request->get['manufacturer_id'])) {
			$data['manufacturer_id'] = $this->request->get['manufacturer_id'];
		} else {
			$data['manufacturer_id'] = 0;
		}
	
		$data['product_id'] = $product_id;
		$product_info = $this->model_catalog_product->getProduct($this->request->get['product_id']);
		
		$status = $this->config->get('module_tmd_productdimension_status');

		if($status==1) {
			$tmdtext = $this->config->get('module_tmd_productdimension_multi');

			if(!empty($tmdtext[$this->config->get('config_language_id')]['errorlimitwidth'])){
				$data['text_errorwidth'] = $tmdtext[$this->config->get('config_language_id')]['errorlimitwidth'];
			} else {
				$data['text_errorwidth'] = $this->language->get('text_errorwidth');
			}

			if(!empty($tmdtext[$this->config->get('config_language_id')]['errorlimitheight'])){
				$data['text_errorhight'] = $tmdtext[$this->config->get('config_language_id')]['errorlimitheight'];
			} else {
				$data['text_errorhight'] = $this->language->get('text_errorhight');
			}

			$data['width_min'] 	= $this->config->get('module_tmd_productdimension_width_min');
			$data['width_max'] 	= $this->config->get('module_tmd_productdimension_width_max');
			$data['height_min'] = $this->config->get('module_tmd_productdimension_height_min');
			$data['height_max'] = $this->config->get('module_tmd_productdimension_height_max');
/* 19 06 2020 */
			$this->load->model('extension/tmd_productdimension');
			$setting_info = $this->model_extension_tmd_productdimension->getSqrSetting($this->request->get['product_id']);
			if(!empty($setting_info['width_min'])) {
				$data['width_min'] = $setting_info['width_min'];
			} else {
				$data['width_min'] = $data['width_min'];
			}

			if(!empty($setting_info['width_max'])) {
				$data['width_max'] = $setting_info['width_max'];
			} else {
				$data['width_max'] = $data['width_max'];
			}

			if(!empty($setting_info['height_min'])) {
				$data['height_min'] = $setting_info['height_min'];
			} else {
				$data['height_min'] = $data['height_min'];
			}

			if(!empty($setting_info['height_max'])) {
				$data['height_max'] = $setting_info['height_max'];
			} else {
				$data['height_max'] = $data['height_max'];
			}
/* 19 06 2020 */

			$data['error_size'] = $data['text_errorwidth'] .' ('.$data['width_min'].','.$data['width_max'].')'.' , '.$data['text_errorhight'] .' ('.$data['height_min'].','.$data['height_max'].')';
			
			$data['textwidth']  = $data['text_errorwidth'] .' ('.$data['width_min'].','.$data['width_max'].')';
			$data['textheight'] = $data['text_errorhight'] .' ('.$data['height_min'].','.$data['height_max'].')';

			$tmd_productdimension_h_color = $this->config->get('module_tmd_productdimension_h_color');
			if($tmd_productdimension_h_color) {
				$data['tmd_productdimension_h_color'] = $tmd_productdimension_h_color;
			} else {
				$data['tmd_productdimension_h_color'] = '#1c95e6';
			}
			$tmd_productdimension_h_textcolor = $this->config->get('module_tmd_productdimension_h_textcolor');
			if($tmd_productdimension_h_textcolor) {
				$data['tmd_productdimension_h_textcolor'] = $tmd_productdimension_h_textcolor;
			} else {
				$data['tmd_productdimension_h_textcolor'] = '#fff';
			}
				
			if(!empty($tmdtext[$this->config->get('config_language_id')]['headingtext'])){
				$data['text_size'] = $tmdtext[$this->config->get('config_language_id')]['headingtext'];
			} else {
				$data['text_size'] = $this->language->get('text_size');
			}

			if(!empty($tmdtext[$this->config->get('config_language_id')]['width'])){
				$data['text_width'] = $tmdtext[$this->config->get('config_language_id')]['width'];
			} else {
				$data['text_width'] = $this->language->get('text_width');
			}

			if(!empty($tmdtext[$this->config->get('config_language_id')]['height'])){
				$data['text_height'] = $tmdtext[$this->config->get('config_language_id')]['height'];
			} else {
				$data['text_height'] = $this->language->get('text_height');
			}
		}
		
		if(!empty($status)){
			$data['status']=true;
		}else{
			$data['status']=false;
		}

		$data['text_option'] = $this->language->get('text_option');
		$data['text_none'] = $this->language->get('text_none');
		$this->load->model('extension/tmd_productdimension');
		$data['sqrpriceinfos'] = $this->model_extension_tmd_productdimension->getSqrPrices($product_id);
		$data['infos'] = $this->model_extension_tmd_productdimension->getTmdProductPricestatus($product_id);
		if($data['infos']){		
			return $this->load->view('extension/tmd_productdimension', $data);
		} else if($data['sqrpriceinfos']) {
			return $this->load->view('extension/tmd_productdimension', $data);
		}

	}

	public function quantityprice() {	
		$this->load->language('extension/tmd_productdimension');
		$this->load->language('product/product');
		$this->load->model('extension/tmd_productdimension');
		$this->load->model('catalog/product');
		$data['sqr_quantitys']=array();
		if (isset($this->request->get['product_id'])) {
			$product_id = $this->request->get['product_id'];
		} else {
			$product_id = 0;
		}
		
		if (isset($this->request->get['width'])) {
			$width = $this->request->get['width'];
		} else {
			$width = 0;
		}

		if (isset($this->request->get['height'])) {
			$height = $this->request->get['height'];
		} else {
			$height = 0;
		}

		$infos = $this->model_extension_tmd_productdimension->getTmdProductPrice($product_id,$width,$height);
		
		$sqrpriceinfos = $this->model_extension_tmd_productdimension->getSqrPrices($product_id);
		if (!empty($sqrpriceinfos)) {
			$data['sqr_quantitys']=array();
			foreach ($sqrpriceinfos as $key => $sqr_info) {
				$discount_val = $sqr_info['discount'];
				
				$tmdsize = $width*$height;
				if($sqr_info['to_sqr']>$tmdsize){
					$tmdsqr = $sqr_info['to_sqr']/$tmdsize;
					$qty = round($tmdsqr);

					$p_price = $tmdsize*$sqr_info['price']; 
					$p_price =$p_price-($discount_val*$p_price/100); 
					$newprice = $p_price*$qty;

					if(!empty($tmdtext[$this->config->get('config_language_id')]['totaltext'])){
					$text_totaltext = $tmdtext[$this->config->get('config_language_id')]['totaltext'];
					} else {
						$text_totaltext = $this->language->get('text_totaltext');
					}

					if(!empty($tmdtext[$this->config->get('config_language_id')]['discounttext'])){
						$text_discounttext = $tmdtext[$this->config->get('config_language_id')]['discounttext'];
					} else {
						$text_discounttext = $this->language->get('text_discounttext');
					}

					$total = $this->currency->format($newprice, $this->session->data['currency']);

					$subtotal = $text_totaltext.' '.$total.' - '.$discount_val.'% '. $text_discounttext;

					if(!empty($qty)) {
						$key1 = $key+1;
						$data['sqr_quantitys'][] = array(
							'key_id'  	=> $key1,
							'quantity'  => $qty,
							'sub'  		=> $newprice,
							'price1'	=> $p_price,
							'price'		=> $subtotal,
						);
					}
				}
			}
		} else {
			$data['sqr_quantitys']=array();
			$sqrpriceinfos = $this->model_extension_tmd_productdimension->getSqrPrices($product_id);
			foreach ($infos as $key => $sqr_info) {
				if(!empty($sqr_info['quantity'])) {
					$key1 = $key+1;
						$data['sqr_quantitys'][] = array(
						'key_id'  	=> $key1,
						'quantity'  => $sqr_info['quantity'],
						'sub'  		=> $sqr_info['sub'],
						'price1'	=> $sqr_info['price1'],
						'price'		=> $sqr_info['price'],
					);
				}
			}
		}

		$statuss = $this->config->get('module_tmd_productdimension_status');
		if($statuss==1) {
			$tmdtext = $this->config->get('module_tmd_productdimension_multi');
			
			if(!empty($tmdtext[$this->config->get('config_language_id')]['totaltext'])){
				$text_totaltext = $tmdtext[$this->config->get('config_language_id')]['totaltext'];
			} else {
				$text_totaltext = $this->language->get('text_totaltext');
			}

			if(!empty($tmdtext[$this->config->get('config_language_id')]['discounttext'])){
				$text_discounttext = $tmdtext[$this->config->get('config_language_id')]['discounttext'];
			} else {
				$text_discounttext = $this->language->get('text_discounttext');
			}
		}

		$status = $this->config->get('module_tmd_productdimension_status');
		
		if($status==1) {
			$tmd_productdimension_h_color = $this->config->get('module_tmd_productdimension_h_color');
			if($tmd_productdimension_h_color) {
				$data['tmd_productdimension_h_color'] = $tmd_productdimension_h_color;
			} else {
				$data['tmd_productdimension_h_color'] = '#1c95e6';
			}
			
			$tmd_productdimension_h_textcolor = $this->config->get('module_tmd_productdimension_h_textcolor');
			if($tmd_productdimension_h_textcolor) {
				$data['tmd_productdimension_h_textcolor'] = $tmd_productdimension_h_textcolor;
			} else {
				$data['tmd_productdimension_h_textcolor'] = '#fff';
			}

			$tmdtext = $this->config->get('module_tmd_productdimension_multi');
				
			if(!empty($tmdtext[$this->config->get('config_language_id')]['headingtext'])){
				$data['text_size'] = $tmdtext[$this->config->get('config_language_id')]['headingtext'];
			} else {
				$data['text_size'] = $this->language->get('text_size');
			}

			if(!empty($tmdtext[$this->config->get('config_language_id')]['choosebox'])){
				$data['text_checked'] = $tmdtext[$this->config->get('config_language_id')]['choosebox'];
			} else {
				$data['text_checked'] = $this->language->get('text_checked');
			}

			if(!empty($tmdtext[$this->config->get('config_language_id')]['quantity'])){
				$data['text_qty'] = $tmdtext[$this->config->get('config_language_id')]['quantity'];
			} else {
				$data['text_qty'] = $this->language->get('text_qty');
			}

			if(!empty($tmdtext[$this->config->get('config_language_id')]['price'])){
				$data['text_price'] = $tmdtext[$this->config->get('config_language_id')]['price'];
			} else {
				$data['text_price'] = $this->language->get('text_price');
			}

			if(!empty($tmdtext[$this->config->get('config_language_id')]['totaltext'])){
				$data['text_totaltext'] = $tmdtext[$this->config->get('config_language_id')]['totaltext'];
			} else {
				$data['text_totaltext'] = $this->language->get('text_totaltext');
			}

			if(!empty($tmdtext[$this->config->get('config_language_id')]['discounttext'])){
				$data['text_discounttext'] = $tmdtext[$this->config->get('config_language_id')]['discounttext'];
			} else {
				$data['text_discounttext'] = $this->language->get('text_discounttext');
			}
		}

		if(!empty($data['sqr_quantitys'])) {
			$data['sqrprice']=$data['sqr_quantitys'];
		} else {
			if(!empty($tmdtext[$this->config->get('config_language_id')]['not_faund'])){
				$data['error'] = $tmdtext[$this->config->get('config_language_id')]['not_faund'];
			} else {
				$data['error'] = $this->language->get('text_error');
			}
		}
				
		$this->response->setOutput($this->load->view('extension/loadquantity', $data));
	}

}