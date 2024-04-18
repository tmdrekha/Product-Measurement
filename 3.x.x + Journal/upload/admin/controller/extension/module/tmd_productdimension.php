<?php
//lib
require_once(DIR_SYSTEM.'library/tmd/system.php');
//lib
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
		$this->registry->set('tmd', new TMD($this->registry));
		$keydata=array(
		'code'=>'tmdkey_tmd_productdimension',
		'eid'=>'NDMwNTE=',
		'route'=>'extension/module/tmd_productdimension',
		);
		$tmd_productdimension=$this->tmd->getkey($keydata['code']);
		$data['getkeyform']=$this->tmd->loadkeyform($keydata);

		$this->load->language('extension/module/tmd_productdimension');

		$this->document->setTitle($this->language->get('heading_title1'));

		$this->load->model('setting/setting');
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
		$this->load->model('catalog/manufacturer');

		if(isset($this->session->data['token'])){
			$tokenexchange 	= 'token=' . $this->session->data['token'];
		} else{
			$tokenexchange	='user_token=' . $this->session->data['user_token'];
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$this->model_setting_setting->editSetting('module_tmd_productdimension', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			if(!empty($this->request->get['status'])) {
				$this->response->redirect($this->url->link('extension/module/tmd_productdimension', $tokenexchange));
				$this->session->data['success'] = $this->language->get('text_success');
			} else {
				$this->response->redirect($this->url->link('marketplace/extension', $tokenexchange . '&type=module', true));
			}
		}

		$data['heading_title'] 		= $this->language->get('heading_title');

		$data['text_edit'] 			= $this->language->get('text_edit');
		$data['text_enabled'] 		= $this->language->get('text_enabled');
		$data['text_disabled'] 		= $this->language->get('text_disabled');
		$data['text_select'] 		= $this->language->get('text_select');

		$data['button_save'] 		= $this->language->get('button_save');
		$data['button_stay'] 		= $this->language->get('button_stay');
		$data['button_cancel'] 		= $this->language->get('button_cancel');
		$data['button_remove'] 		= $this->language->get('button_remove');
		$data['user_token'] 		= $this->session->data['user_token'];

		if (isset($this->session->data['warning'])) {
			$data['error_warning'] = $this->session->data['warning'];
		
			unset($this->session->data['warning']);
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', $tokenexchange, true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', $tokenexchange . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/tmd_productdimension', $tokenexchange, true)
		);


		$data['action'] 	= $this->url->link('extension/module/tmd_productdimension', $tokenexchange, true);
		$data['staysave'] 	= $this->url->link('extension/module/tmd_productdimension', '&status=1&user_token=' . $this->session->data['user_token'], true);
		$data['cancel'] 	= $this->url->link('marketplace/extension', $tokenexchange . '&type=module', true);
		
		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->request->post['module_tmd_productdimension_status'])) {
			$data['module_tmd_productdimension_status'] = $this->request->post['module_tmd_productdimension_status'];
		} else {
			$data['module_tmd_productdimension_status'] = $this->config->get('module_tmd_productdimension_status');
		}

		if (isset($this->request->post['module_tmd_productdimension_productsqr'])) {
			$tmd_productdimension_productsqr = $this->request->post['module_tmd_productdimension_productsqr'];
		} elseif ($this->config->get('module_tmd_productdimension_productsqr')) {
			$tmd_productdimension_productsqr = $this->config->get('module_tmd_productdimension_productsqr');
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
		
		if (isset($this->request->post['module_tmd_productdimension_pproducts'])) {
			$tmd_productdimensionproducts = $this->request->post['module_tmd_productdimension_pproducts'];
		} elseif ($this->config->get('module_tmd_productdimension_pproducts')) {
			$tmd_productdimensionproducts = $this->config->get('module_tmd_productdimension_pproducts');
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
		if (isset($this->request->post['module_tmd_productdimension_category'])) {
			$tmd_productdimensioncategories = $this->request->post['module_tmd_productdimension_category'];
		} elseif ($this->config->get('module_tmd_productdimension_category')) {
			$tmd_productdimensioncategories = $this->config->get('module_tmd_productdimension_category');
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
		if (isset($this->request->post['module_tmd_productdimension_manufacturer'])) {
			$tmd_productdimensionmanufacturers = $this->request->post['module_tmd_productdimension_manufacturer'];
		} elseif ($this->config->get('module_tmd_productdimension_manufacturer')) {
			$tmd_productdimensionmanufacturers = $this->config->get('module_tmd_productdimension_manufacturer');
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

		if (isset($this->request->post['module_tmd_productdimension_h_color'])) {
			$data['module_tmd_productdimension_h_color'] = $this->request->post['module_tmd_productdimension_h_color'];
		} else {
			$data['module_tmd_productdimension_h_color'] = $this->config->get('module_tmd_productdimension_h_color');
		}

		if (isset($this->request->post['module_tmd_productdimension_h_textcolor'])) {
			$data['module_tmd_productdimension_h_textcolor'] = $this->request->post['module_tmd_productdimension_h_textcolor'];
		} else {
			$data['module_tmd_productdimension_h_textcolor'] = $this->config->get('module_tmd_productdimension_h_textcolor');
		}

		if (isset($this->request->post['module_tmd_productdimension_width_min'])) {
			$data['module_tmd_productdimension_width_min'] = $this->request->post['module_tmd_productdimension_width_min'];
		} else {
			$data['module_tmd_productdimension_width_min'] = $this->config->get('module_tmd_productdimension_width_min');
		}

		if (isset($this->request->post['module_tmd_productdimension_width_max'])) {
			$data['module_tmd_productdimension_width_max'] = $this->request->post['module_tmd_productdimension_width_max'];
		} else {
			$data['module_tmd_productdimension_width_max'] = $this->config->get('module_tmd_productdimension_width_max');
		}

		if (isset($this->request->post['module_tmd_productdimension_height_min'])) {
			$data['module_tmd_productdimension_height_min'] = $this->request->post['module_tmd_productdimension_height_min'];
		} else {
			$data['module_tmd_productdimension_height_min'] = $this->config->get('module_tmd_productdimension_height_min');
		}

		if (isset($this->request->post['module_tmd_productdimension_height_max'])) {
			$data['module_tmd_productdimension_height_max'] = $this->request->post['module_tmd_productdimension_height_max'];
		} else {
			$data['module_tmd_productdimension_height_max'] = $this->config->get('module_tmd_productdimension_height_max');
		}
		
		if (isset($this->request->post['module_tmd_productdimension_multi'])) {
			$data['module_tmd_productdimension_multi'] = $this->request->post['module_tmd_productdimension_multi'];
		} elseif ($this->config->get('module_tmd_productdimension_multi')) {
			$data['module_tmd_productdimension_multi'] = $this->config->get('module_tmd_productdimension_multi');
		} else {
			$data['module_tmd_productdimension_multi'] = array();
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
		
		$tmd_productdimension=$this->config->get('tmdkey_tmd_productdimension');
		if (empty(trim($tmd_productdimension))) {			
		$this->session->data['warning'] ='Module will Work after add License key!';
		$this->response->redirect($this->url->link('extension/module/tmd_productdimension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}
	public function keysubmit() {
		$json = array(); 
		
      	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$keydata=array(
			'code'=>'tmdkey_tmd_productdimension',
			'eid'=>'NDMwNTE=',
			'route'=>'extension/module/tmd_productdimension',
			'moduledata_key'=>$this->request->post['moduledata_key'],
			);
			$this->registry->set('tmd', new TMD($this->registry));
            $json=$this->tmd->matchkey($keydata);       
		} 
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}