<?php
class ControllerExtensionModuleTmdproductdimension extends Controller {
	private $error = array();

	public function install(){
		$this->load->model('extension/tmdproductdimension');
		$this->model_extension_tmdproductdimension->install();
	}	
	
	public function uninstall() {
		$this->load->model('extension/tmdproductdimension');
		$this->model_extension_tmdproductdimension->uninstall();
	}

	public function index() {

		$this->load->language('extension/module/tmd_productdimension');

		$this->document->setTitle($this->language->get('heading_title1'));

		$this->load->model('setting/setting');
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
		$this->load->model('catalog/manufacturer');

		if(isset($this->session->data['token'])){
			$tokenexchange 	= 'token=' . $this->session->data['token'];
		} else{
			$tokenexchange	='token=' . $this->session->data['token'];
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$this->model_setting_setting->editSetting('tmd_productdimension', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			if(!empty($this->request->get['status'])) {
				$this->response->redirect($this->url->link('extension/module/tmd_productdimension', $tokenexchange));
			} else {
				$this->response->redirect($this->url->link('extension/extension', $tokenexchange . '&type=module', true));
			}
		}

		$data['heading_title'] 		    = $this->language->get('heading_title');

		$data['text_edit'] 			    = $this->language->get('text_edit');
		$data['text_enabled'] 		    = $this->language->get('text_enabled');
		$data['text_disabled'] 		    = $this->language->get('text_disabled');
		$data['text_select'] 		    = $this->language->get('text_select');

		$data['button_save'] 		    = $this->language->get('button_save');
		$data['button_stay'] 		    = $this->language->get('button_stay');
		$data['button_cancel'] 		    = $this->language->get('button_cancel');
		$data['button_remove'] 		    = $this->language->get('button_remove');
		$data['button_discount_add']    = $this->language->get('button_discount_add');

		$data['text_extension'] 		= $this->language->get('text_extension');
		$data['text_success'] 		    = $this->language->get('text_success');
		$data['text_edit'] 		        = $this->language->get('text_edit');

		$data['tab_general'] 		    = $this->language->get('tab_general');
		$data['tab_language'] 		    = $this->language->get('tab_language');
		$data['tab_link'] 		        = $this->language->get('tab_link');


		$data['entry_status'] 		    = $this->language->get('entry_status');
		$data['entry_headingcolor']     = $this->language->get('entry_headingcolor');
		$data['entry_textcolor'] 		= $this->language->get('entry_textcolor');
		$data['entry_heading'] 		    = $this->language->get('entry_heading');
		$data['entry_choosebox'] 		= $this->language->get('entry_choosebox');
		$data['entry_min'] 		        = $this->language->get('entry_min');
		$data['entry_max'] 		        = $this->language->get('entry_max');
		$data['entry_discount'] 		= $this->language->get('entry_discount');

		$data['entry_sqrprice'] 		= $this->language->get('entry_sqrprice');
		$data['entry_sqrqty'] 		    = $this->language->get('entry_sqrqty');
		$data['entry_textcolor'] 		= $this->language->get('entry_textcolor');
		$data['entry_action'] 		    = $this->language->get('entry_action');
		$data['entry_quantity'] 		= $this->language->get('entry_quantity');
		$data['entry_price'] 		    = $this->language->get('entry_price');
		$data['entry_placeholder'] 		= $this->language->get('entry_placeholder');
		$data['entry_width'] 		    = $this->language->get('entry_width');
		$data['entry_height'] 		    = $this->language->get('entry_height');

		$data['entry_error_d'] 		    = $this->language->get('entry_error_d');
		$data['entry_errorwidth'] 		= $this->language->get('entry_errorwidth');
		$data['entry_errorheight'] 		= $this->language->get('entry_errorheight');
		$data['entry_errornot'] 		= $this->language->get('entry_errornot');
		$data['entry_erroroption'] 		= $this->language->get('entry_erroroption');
		$data['entry_errorlimit'] 		= $this->language->get('entry_errorlimit');
		$data['entry_placeholder'] 		= $this->language->get('entry_placeholder');
		$data['entry_total'] 		    = $this->language->get('entry_total');
		$data['entry_discounttext']     = $this->language->get('entry_discounttext');

		$data['entry_from'] 		    = $this->language->get('entry_from');
		$data['entry_to'] 		        = $this->language->get('entry_to');
		$data['entry_price'] 		    = $this->language->get('entry_price');
		$data['entry_product'] 		    = $this->language->get('entry_product');
		$data['entry_quantity'] 		= $this->language->get('entry_quantity');
		$data['entry_category'] 		= $this->language->get('entry_category');
		$data['entry_manufacture'] 		= $this->language->get('entry_manufacture');
		$data['entry_total'] 		    = $this->language->get('entry_total');
		$data['button_stay'] 		    = $this->language->get('button_stay');

		$data['column_from'] 		    = $this->language->get('column_from');
		$data['column_to'] 		        = $this->language->get('column_to');
		$data['column_price'] 		    = $this->language->get('column_price');
		$data['column_quantity'] 		= $this->language->get('column_quantity');

		$data['help_category'] 	        = $this->language->get('help_category');
		$data['help_manufacture'] 		= $this->language->get('help_manufacture');

		$data['token'] 		= $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['error_keynotfound'])) {
				$data['error_keynotfound'] = $this->error['error_keynotfound'];
			} else {
				$data['error_keynotfound'] = '';
			}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', $tokenexchange, true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', $tokenexchange . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/tmd_productdimension', $tokenexchange, true)
		);


		$data['action'] 	= $this->url->link('extension/module/tmd_productdimension', $tokenexchange, true);
		$data['staysave'] 	= $this->url->link('extension/module/tmd_productdimension', '&status=1&token=' . $this->session->data['token'], true);
		$data['cancel'] 	= $this->url->link('extension/extension', $tokenexchange . '&type=module', true);
		$data['token'] = $this->session->data['token'];
		if (isset($this->request->post['tmd_productdimension_status'])) {
			$data['tmd_productdimension_status'] = $this->request->post['tmd_productdimension_status'];
		} else {
			$data['tmd_productdimension_status'] = $this->config->get('tmd_productdimension_status');
		}

		if (isset($this->request->post['tmd_productdimension_productsqr'])) {
			$tmd_productdimension_productsqr = $this->request->post['tmd_productdimension_productsqr'];
		} elseif ($this->config->get('tmd_productdimension_productsqr')) {
			$tmd_productdimension_productsqr = $this->config->get('tmd_productdimension_productsqr');
		} else {
			$tmd_productdimension_productsqr = array();
		}	

		$data['tmd_productdimension_product_sqrs'] = array();

		if(isset($tmd_productdimension_productsqr)) {
			foreach ($tmd_productdimension_productsqr as $result) {
				$data['tmd_productdimension_product_sqrs'][] = array(
					'from_sqr'  => $result['from_sqr'],
					'to_sqr'    => $result['to_sqr'],
					'price'     => $result['price'],
					'discount'	=> $result['discount']
				);
			}
		}

//products
		$data['tmd_productdimension_products']  = array();
		
		if (isset($this->request->post['tmd_productdimension_pproducts'])) {
			$tmd_productdimensionproducts = $this->request->post['tmd_productdimension_pproducts'];
		} elseif ($this->config->get('tmd_productdimension_pproducts')) {
			$tmd_productdimensionproducts = $this->config->get('tmd_productdimension_pproducts');
		} else {
			$tmd_productdimensionproducts = array();
		}	

		foreach ($tmd_productdimensionproducts as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);

			if ($product_info) {
				$data['tmd_productdimension_products'][] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name']
				);
			}
		}

//category
		if (isset($this->request->post['tmd_productdimension_category'])) {
			$tmd_productdimensioncategories = $this->request->post['tmd_productdimension_category'];
		} elseif ($this->config->get('tmd_productdimension_category')) {
			$tmd_productdimensioncategories = $this->config->get('tmd_productdimension_category');
		} else {
			$tmd_productdimensioncategories = array();
		}

		$data['tmd_productdimension_categories'] = array();

		foreach ($tmd_productdimensioncategories as $category_id) {
			$cate_info = $this->model_catalog_category->getCategory($category_id);

			if ($cate_info) {
				$data['tmd_productdimension_categories'][] = array(
					'category_id'	=> $cate_info['category_id'],
					'name'        	=> ($cate_info['path']) ? $cate_info['path'] . ' &gt; ' . $cate_info['name'] : $cate_info['name']
				);
			}
		}

	//manufacturer
		if (isset($this->request->post['tmd_productdimension_manufacturer'])) {
			$tmd_productdimensionmanufacturers = $this->request->post['tmd_productdimension_manufacturer'];
		} elseif ($this->config->get('tmd_productdimension_manufacturer')) {
			$tmd_productdimensionmanufacturers = $this->config->get('tmd_productdimension_manufacturer');
		} else {
			$tmd_productdimensionmanufacturers = array();
		}

		$data['tmd_productdimension_manufacturers'] = array();

		foreach ($tmd_productdimensionmanufacturers as $manufacturer_id) {
			$manu_info = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);

			if ($manu_info) {
				$data['tmd_productdimension_manufacturers'][] = array(
					'manufacturer_id' 	=> $manu_info['manufacturer_id'],
					'name'       		=> $manu_info['name']
				);
			}
		}

		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['tmd_productdimension_h_color'])) {
			$data['tmd_productdimension_h_color'] = $this->request->post['tmd_productdimension_h_color'];
		} else {
			$data['tmd_productdimension_h_color'] = $this->config->get('tmd_productdimension_h_color');
		}

		if (isset($this->request->post['tmd_productdimension_h_textcolor'])) {
			$data['tmd_productdimension_h_textcolor'] = $this->request->post['tmd_productdimension_h_textcolor'];
		} else {
			$data['tmd_productdimension_h_textcolor'] = $this->config->get('tmd_productdimension_h_textcolor');
		}

		if (isset($this->request->post['tmd_productdimension_width_min'])) {
			$data['tmd_productdimension_width_min'] = $this->request->post['tmd_productdimension_width_min'];
		} else {
			$data['tmd_productdimension_width_min'] = $this->config->get('tmd_productdimension_width_min');
		}

		if (isset($this->request->post['tmd_productdimension_width_max'])) {
			$data['tmd_productdimension_width_max'] = $this->request->post['tmd_productdimension_width_max'];
		} else {
			$data['tmd_productdimension_width_max'] = $this->config->get('tmd_productdimension_width_max');
		}

		if (isset($this->request->post['tmd_productdimension_height_min'])) {
			$data['tmd_productdimension_height_min'] = $this->request->post['tmd_productdimension_height_min'];
		} else {
			$data['tmd_productdimension_height_min'] = $this->config->get('tmd_productdimension_height_min');
		}

		if (isset($this->request->post['tmd_productdimension_height_max'])) {
			$data['tmd_productdimension_height_max'] = $this->request->post['tmd_productdimension_height_max'];
		} else {
			$data['tmd_productdimension_height_max'] = $this->config->get('tmd_productdimension_height_max');
		}
		
		if (isset($this->request->post['tmd_productdimension_multi'])) {
			$data['tmd_productdimension_multi'] = $this->request->post['tmd_productdimension_multi'];
		} elseif ($this->config->get('tmd_productdimension_multi')) {
			$data['tmd_productdimension_multi'] = $this->config->get('tmd_productdimension_multi');
		} else {
			$data['tmd_productdimension_multi'] = array();
		}
	
	
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/tmd_productdimension', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/tmd_productdimension')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		$key=$this->config->get('moduledata_dimensionsize_key');
			if (empty(trim($key))) {			
				 $this->error['warning'] ='Module will Work after add License key!';
			}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}
}