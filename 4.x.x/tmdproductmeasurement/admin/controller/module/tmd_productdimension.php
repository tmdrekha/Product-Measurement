<?php
namespace Opencart\Admin\Controller\Extension\Tmdproductmeasurement\Module;
// Lib Include 
require_once(DIR_EXTENSION.'/tmdproductmeasurement/system/library/tmd/system.php');
// Lib Include 

use \Opencart\System\Helper as Helper;
class Tmdproductdimension extends \Opencart\System\Engine\Controller {	

	public function index() {
		
		$this->registry->set('tmd', new  \Tmdproductmeasurement\System\Library\Tmd\System($this->registry));
		$keydata=array(
		'code'=>'tmdkey_tmd_productdimension',
		'eid'=>'NDMwNTE=',
		'route'=>'extension/tmdproductmeasurement/module/tmd_productdimension',
		);
		$tmd_productdimension=$this->tmd->getkey($keydata['code']);
		$data['getkeyform']=$this->tmd->loadkeyform($keydata);
		
		$this->load->language('extension/tmdproductmeasurement/module/tmd_productdimension');
		$this->document->setTitle($this->language->get('heading_title1'));


		$this->document->addScript('view/javascript/ckeditor/ckeditor.js');
		$this->document->addScript('view/javascript/ckeditor/adapters/jquery.js');

		
		$this->load->model('setting/setting');
         $data['VERSION'] = VERSION;
         $data['HTTP_CATALOG'] = HTTP_CATALOG;
		 
		 if (isset($this->session->data['warning'])) {
			$data['error_warning'] = $this->session->data['warning'];
		
			unset($this->session->data['warning']);
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = [];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
		];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=total')
		];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/tmdproductmeasurement/module/tmd_productdimension', 'user_token=' . $this->session->data['user_token'])
		];


		if(VERSION>='4.0.2.0'){
		$data['save'] = $this->url->link('extension/tmdproductmeasurement/module/tmd_productdimension.save', 'user_token=' . $this->session->data['user_token']);
		}else{
		$data['save'] = $this->url->link('extension/tmdproductmeasurement/module/tmd_productdimension|save', 'user_token=' . $this->session->data['user_token']);

		}
		
		$data['back'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module');
		

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['module_tmd_productdimension_status'] = $this->config->get('module_tmd_productdimension_status');
		$data['module_tmd_productdimension_h_color'] = $this->config->get('module_tmd_productdimension_h_color');
		$data['module_tmd_productdimension_h_textcolor'] = $this->config->get('module_tmd_productdimension_h_textcolor');
		$data['module_tmd_productdimension_width_min'] = $this->config->get('module_tmd_productdimension_width_min');
		$data['module_tmd_productdimension_width_max'] = $this->config->get('module_tmd_productdimension_width_max');
		$data['module_tmd_productdimension_height_min'] = $this->config->get('module_tmd_productdimension_height_min');
		$data['module_tmd_productdimension_height_max'] = $this->config->get('module_tmd_productdimension_height_max');
		$data['module_tmd_productdimension_multi'] = $this->config->get('module_tmd_productdimension_multi');

		$tmd_productdimension_productsqr = $this->config->get('module_tmd_productdimension_productsqr');


	if (!empty($tmd_productdimension_productsqr)) {
	$tmd_productdimension_productsqr = $this->config->get('module_tmd_productdimension_productsqr');
	}else{
		$tmd_productdimension_productsqr = '';
	}
		$data['tmd_productdimension_product_sqrs'] = [];
		if(!empty($tmd_productdimension_productsqr)) {

			foreach ($tmd_productdimension_productsqr as $result) {
				$data['tmd_productdimension_product_sqrs'][] = [
					'from_sqr'  => $result['from_sqr'],
					'to_sqr'    => $result['to_sqr'],
					'price'     => $result['price'],
					'discount'	=> $result['discount']
				];
			}
		}
	

	//products
		$tmd_productdimensionproducts = $this->config->get('module_tmd_productdimension_pproducts');
		

		if (!empty($tmd_productdimensionproducts)) {
			$tmd_productdimensionproducts = $this->config->get('module_tmd_productdimension_pproducts');
		}else{
			$tmd_productdimensionproducts = '';
		}
		$this->load->Model('catalog/product');
		$data['tmd_productdimension_products']  = [];

		if (!empty($tmd_productdimensionproducts)) {

		foreach ($tmd_productdimensionproducts as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);

			if ($product_info) {
				$data['tmd_productdimension_products'][] = [
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name']
				];
			}
		}
		}

		//category
	$tmd_productdimensioncategories = $this->config->get('module_tmd_productdimension_category');

	if (!empty($tmd_productdimensioncategories)) {
	$tmd_productdimensioncategories = $this->config->get('module_tmd_productdimension_category');
	}else{
		$tmd_productdimensioncategories = '';
	}

		$this->load->Model('catalog/category');
		$data['tmd_productdimension_categories'] = [];

if (!empty($tmd_productdimensioncategories)) {
	
		foreach ($tmd_productdimensioncategories as $category_id) {
			$cate_info = $this->model_catalog_category->getCategory($category_id);

			if ($cate_info) {
				$data['tmd_productdimension_categories'][] = [
					'category_id'	=> $cate_info['category_id'],
					'name'        	=> ($cate_info['path']) ? $cate_info['path'] . ' &gt; ' . $cate_info['name'] : $cate_info['name']
				];
			}
}
		}

		//manufacturer

			$tmd_productdimensionmanufacturers = $this->config->get('module_tmd_productdimension_manufacturer');
		if (!empty($tmd_productdimensionmanufacturers)) {
			$tmd_productdimensionmanufacturers = $this->config->get('module_tmd_productdimension_manufacturer');
		}else{
			$tmd_productdimensionmanufacturers = '';
		}

		$this->load->Model('catalog/manufacturer');
		$data['tmd_productdimension_manufacturers'] = [];
      if (!empty($tmd_productdimensionmanufacturers)) {
      	
		foreach ($tmd_productdimensionmanufacturers as $manufacturer_id) {
			$manu_info = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);

			if ($manu_info) {
				$data['tmd_productdimension_manufacturers'][] = [
					'manufacturer_id' 	=> $manu_info['manufacturer_id'],
					'name'       		=> $manu_info['name']
				];
			}
		}
      }


		$data['user_token'] = $this->session->data['user_token'];
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/tmdproductmeasurement/module/tmd_productdimension', $data));
	}


public function save(): void {
		$this->load->language('extension/tmdproductmeasurement/module/tmd_productdimension');

		$json = [];

		if (!$this->user->hasPermission('modify', 'extension/tmdproductmeasurement/module/tmd_productdimension')) {
			$json['error'] = $this->language->get('error_permission');
		}
		if (isset($json['error']) && !isset($json['error']['warning'])) {
		$json['error']['warning'] = $this->language->get('error_warning');
		}
		
		$tmd_productdimension=$this->config->get('tmdkey_tmd_productdimension');
		if (empty(trim($tmd_productdimension))) {			
		$json['error'] ='Module will Work after add License key!';
		}

		if (!$json) {
			$this->load->model('setting/setting');

			$this->model_setting_setting->editSetting('module_tmd_productdimension', $this->request->post);

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function keysubmit() {
		$json = array(); 
		
      	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$keydata=array(
			'code'=>'tmdkey_tmd_productdimension',
			'eid'=>'NDMwNTE=',
			'route'=>'extension/tmdproductmeasurement/module/tmd_productdimension',
			'moduledata_key'=>$this->request->post['moduledata_key'],
			);
			$this->registry->set('tmd', new  \Tmdproductmeasurement\System\Library\Tmd\System($this->registry));
		
            $json=$this->tmd->matchkey($keydata);       
		} 
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


	public function install(){
    $this->load->model('setting/event');
    $this->load->model('user/user_group');

       	$this->load->model('extension/tmdproductmeasurement/tmd/productdimension');
		$this->model_extension_tmdproductmeasurement_tmd_productdimension->install();

    $this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/tmdproductmeasurement/module/tmd_productdimension');
    $this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/tmdproductmeasurement/module/tmd_productdimension');

    // admin menu event

		$this->model_setting_event->deleteEventByCode('module_productmeasurementmenu');

		if(VERSION >='4.0.2.0'){
		$eventaction='extension/tmdproductmeasurement/module/tmd_productdimension.tmdproductmeasurementmenu';
		}
		else{
		$eventaction='extension/tmdproductmeasurement/module/tmd_productdimension|tmdproductmeasurementmenu';
		}

		$eventrequest=[
		'code'=>'module_productmeasurementmenu',
		'description'=>'TMD Product Measurement Menu',
		'trigger'=>'admin/view/common/column_left/before',
		'action'=>$eventaction,
		'status'=>'1',
		'sort_order'=>'1',
		];

		if(VERSION=='4.0.0.0')
		{
		$this->model_setting_event->addEvent('module_productmeasurementmenu', 'TMD Product Measurement Menu','admin/view/common/column_left/before', 'extension/tmdproductmeasurement/module/tmd_productdimension|tmdproductmeasurementmenu', true, 1);
		}else{
		$this->model_setting_event->addEvent($eventrequest);
		}
    // admin menu event


       // admin product event

		$this->model_setting_event->deleteEventByCode('module_productmeasurementproduct');

		if(VERSION >='4.0.2.0'){
		$eventaction='extension/tmdproductmeasurement/module/tmd_productdimension.tmdproductmeasurementproduct';
		}
		else{
		$eventaction='extension/tmdproductmeasurement/module/tmd_productdimension|tmdproductmeasurementproduct';
		}

		$eventrequest=[
		'code'=>'module_productmeasurementproduct',
		'description'=>'TMD Product Measurement Product',
		'trigger'=>'admin/view/catalog/product_form/before',
		'action'=>$eventaction,
		'status'=>'1',
		'sort_order'=>'1',
		];

		if(VERSION=='4.0.0.0')
		{
		$this->model_setting_event->addEvent('module_productmeasurementproduct', 'TMD Product Measurement Product','admin/view/catalog/product_form/before', 'extension/tmdproductmeasurement/module/tmd_productdimension|tmdproductmeasurementproduct', true, 1);
		}else{
		$this->model_setting_event->addEvent($eventrequest);
		}
// admin product event


 // admin addproduct model event

		$this->model_setting_event->deleteEventByCode('module_productmeasurementaddproduct');

		if(VERSION >='4.0.2.0'){
		$eventaction='extension/tmdproductmeasurement/module/tmd_productdimension.addProduct';
		}
		else{
		$eventaction='extension/tmdproductmeasurement/module/tmd_productdimension|addProduct';
		}

		$eventrequest=[
		'code'=>'module_productmeasurementaddproduct',
		'description'=>'TMD Product Measurement Add Product',
		'trigger'=>'admin/model/catalog/product/addProduct/after',
		'action'=>$eventaction,
		'status'=>'1',
		'sort_order'=>'1',
		];

		if(VERSION=='4.0.0.0')
		{
		$this->model_setting_event->addEvent('module_productmeasurementaddproduct', 'TMD Product Measurement Add Product','admin/model/catalog/product/addProduct/after', 'extension/tmdproductmeasurement/module/tmd_productdimension|addProduct', true, 1);
		}else{
		$this->model_setting_event->addEvent($eventrequest);
		}
// admin addproduct event


// admin editproduct model event

		$this->model_setting_event->deleteEventByCode('module_productmeasurementeditproduct');

		if(VERSION >='4.0.2.0'){
		$eventaction='extension/tmdproductmeasurement/module/tmd_productdimension.addProduct';
		}
		else{
		$eventaction='extension/tmdproductmeasurement/module/tmd_productdimension|addProduct';
		}

		$eventrequest=[
		'code'=>'module_productmeasurementeditproduct',
		'description'=>'TMD Product Measurement Edit Product',
		'trigger'=>'admin/model/catalog/product/editProduct/after',
		'action'=>$eventaction,
		'status'=>'1',
		'sort_order'=>'1',
		];

		if(VERSION=='4.0.0.0')
		{
		$this->model_setting_event->addEvent('module_productmeasurementeditproduct', 'TMD Product Measurement Edit Product','admin/model/catalog/product/editProduct/after', 'extension/tmdproductmeasurement/module/tmd_productdimension|addProduct', true, 1);
		}else{
		$this->model_setting_event->addEvent($eventrequest);
		}
// admin editproduct model event

// admin copyproduct model event

		$this->model_setting_event->deleteEventByCode('module_productmeasurementcopyproduct');

		if(VERSION >='4.0.2.0'){
		$eventaction='extension/tmdproductmeasurement/module/tmd_productdimension.tmdproductmeasurementcopyproduct';
		}
		else{
		$eventaction='extension/tmdproductmeasurement/module/tmd_productdimension|tmdproductmeasurementcopyproduct';
		}

		$eventrequest=[
		'code'=>'module_productmeasurementcopyproduct',
		'description'=>'TMD Product Measurement Copy Product',
		'trigger'=>'admin/view/catalog/product/before',
		'action'=>$eventaction,
		'status'=>'1',
		'sort_order'=>'1',
		];

		if(VERSION=='4.0.0.0')
		{
		$this->model_setting_event->addEvent('module_productmeasurementcopyproduct', 'TMD Product Measurement Copy Product','admin/view/catalog/product/before', 'extension/tmdproductmeasurement/module/tmd_productdimension|tmdproductmeasurementcopyproduct', true, 1);
		}else{
		$this->model_setting_event->addEvent($eventrequest);
		}
// admin copyproduct model event

// admin deleteproduct model event

		$this->model_setting_event->deleteEventByCode('module_productmeasurementdeleteproduct');

		if(VERSION >='4.0.2.0'){
		$eventaction='extension/tmdproductmeasurement/module/tmd_productdimension.deleteProduct';
		}
		else{
		$eventaction='extension/tmdproductmeasurement/module/tmd_productdimension|deleteProduct';
		}

		$eventrequest=[
		'code'=>'module_productmeasurementdeleteproduct',
		'description'=>'TMD Product Measurement Delete Product',
		'trigger'=>'admin/model/catalog/product/deleteProduct/after',
		'action'=>$eventaction,
		'status'=>'1',
		'sort_order'=>'1',
		];

		if(VERSION=='4.0.0.0')
		{
		$this->model_setting_event->addEvent('module_productmeasurementdeleteproduct', 'TMD Product Measurement Delete Product','admin/model/catalog/product/deleteProduct/after', 'extension/tmdproductmeasurement/module/tmd_productdimension|deleteProduct', true, 1);
		}else{
		$this->model_setting_event->addEvent($eventrequest);
		}
// admin deleteproduct model event


// admin get order option
		$this->model_setting_event->deleteEventByCode('module_productmeasurementorderinfo');

		if(VERSION >= '4.0.2.0'){
			$eventaction='extension/tmdproductmeasurement/module/tmd_productdimension.tmdproductmeasurementorderinfo';
		}
		else{
			$eventaction='extension/tmdproductmeasurement/module/tmd_productdimension|tmdproductmeasurementorderinfo';
		}

		$eventrequest=[
					'code'=>'module_productmeasurementorderinfo',
					'description'=>'TMD Product Measurement Order Info ',
					'trigger'=>'admin/view/sale/order_info/before',
					'action'=>$eventaction,
					'status'=>'1',
					'sort_order'=>'1',
				];
				
		if(VERSION=='4.0.0.0')
		{
	 $this->model_setting_event->addEvent('module_productmeasurementorderinfo', 'TMD Product Measurement Order Info', 'admin/view/sale/order_info/before','extension/tmdproductmeasurement/module/tmd_productdimension|tmdproductmeasurementorderinfo', true, 1);
		}else{
			$this->model_setting_event->addEvent($eventrequest);
		}
// admin get order option

// catalog product  event

		$this->model_setting_event->deleteEventByCode('module_productmeasurementcatalogproduct');

		if(VERSION >='4.0.2.0'){
		$eventaction='extension/tmdproductmeasurement/module/tmd_productdimensionevents.tmdproductmeasurementcatalogproduct';
		}
		else{
		$eventaction='extension/tmdproductmeasurement/module/tmd_productdimensionevents|tmdproductmeasurementcatalogproduct';
		}

		$eventrequest=[
		'code'=>'module_productmeasurementcatalogproduct',
		'description'=>'TMD Product Measurement Catalog Product',
    	'trigger'=>'catalog/view/product/product/before',
		'action'=>$eventaction,
		'status'=>'1',
		'sort_order'=>'1',
		];

		if(VERSION=='4.0.0.0')
		{
		$this->model_setting_event->addEvent('module_productmeasurementcatalogproduct', 'TMD Product Measurement Catalog Product','catalog/view/product/product/before', 'extension/tmdproductmeasurement/module/tmd_productdimensionevents|tmdproductmeasurementcatalogproduct', true, 1);
		}else{
		$this->model_setting_event->addEvent($eventrequest);
		}
// admin deleteproduct model event


		// / Add startup to catalog
      $startup_data = [
        'code'    => 'module_tmdproductdimension',
        'description' => 'tmdproductdimension extension',
         'action'   => 'catalog/extension/tmdproductmeasurement/startup/cart',
        'status'   => 1,
        'sort_order' => 2
      ];

      // Add startup for admin
      $this->load->model('setting/startup');
      $this->model_setting_startup->addStartup($startup_data);

        // event cart
		// catalog cart event 



  
        }
					public function uninstall(){
					$this->load->model('setting/event');
					$this->load->model('user/user_group');    

					$this->load->model('extension/tmdproductmeasurement/tmd/productdimension');
					$this->model_extension_tmdproductmeasurement_tmd_productdimension->uninstall();

					$this->model_setting_event->deleteEventByCode('module_productmeasurementmenu');
					$this->model_setting_event->deleteEventByCode('module_productmeasurementproduct');
					$this->model_setting_event->deleteEventByCode('module_productmeasurementaddproduct');
					$this->model_setting_event->deleteEventByCode('module_productmeasurementeditproduct');
					$this->model_setting_event->deleteEventByCode('module_productmeasurementcopyproduct');
					$this->model_setting_event->deleteEventByCode('module_productmeasurementdeleteproduct');
					$this->model_setting_event->deleteEventByCode('module_productmeasurementcatalogproduct');
					$this->model_setting_event->deleteEventByCode('module_productmeasurementorderinfo');


        $this->model_user_user_group->removePermission($this->user->getGroupId(), 'access', 'extension/tmdproductmeasurement/module/tmd_productdimension');
        $this->model_user_user_group->removePermission($this->user->getGroupId(), 'modify', 'extension/tmdproductmeasurement/module/tmd_productdimension');
    }

    // admin menu event

		public function tmdproductmeasurementmenu(string&$route, array&$args, mixed&$output):void {
		$this->load->language('extension/tmdproductmeasurement/module/tmd_productdimension');
		$productdimensionstatus=$this->config->get('module_tmd_productdimension_status');
		if(!empty($productdimensionstatus)){
		$args['menus'][] = [
		'id'       => 'menu-dashboard',
		'icon'	   => 'fas fa-cogs',
		'name'	   => $this->language->get('text_productdimension'),
		'href'     => $this->url->link('extension/tmdproductmeasurement/module/tmd_productdimension', 'user_token=' . $this->session->data['user_token'], true),
		'children' => []
		];


		}
		}
		// admin menu event


public function tmdproductmeasurementorderinfo(string &$route, array &$args, mixed &$output): void {
		$productdimensionstatus=$this->config->get('module_tmd_productdimension_status');
		if(!empty($productdimensionstatus)){
			foreach($args['order_products'] as $key => $result){
  				$orderproduct_ids = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_product` WHERE `order_id` = '" . (int)$args['order_id'] . "' AND product_id ='".$result['product_id']."'"); 
       
     			foreach($orderproduct_ids->rows as $key2 => $orderproduct_id){
      
        		$p_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_option` WHERE `order_id` = '" . (int)$args['order_id'] . "' AND order_product_id = '" .$orderproduct_id['order_product_id'] . "'");
          			foreach($p_query->rows as $key2 =>  $value){
				        if(!empty($value)){
				          	$args['order_products'][$key]['option'][$key2]['value']  = $value['value'];      	
				          	$args['order_products'][$key]['option'][$key2]['name']  = $value['name'];      	
				        }
				    }
		    	}
	    	}
		}
	}

     
       // admin product event
		public function tmdproductmeasurementproduct(string&$route, array&$args, mixed&$output):void {

		$this->load->language('extension/tmdproductmeasurement/tmd/product');
		$productdimensionstatus=$this->config->get('module_tmd_productdimension_status');
		if(!empty($productdimensionstatus)){

        if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} elseif (isset($this->request->get['master_id'])) {
			$product_id = (int)$this->request->get['master_id'];
		} else {
			$product_id = 0;
		}

            $this->load->model('catalog/product');
            $this->load->model('extension/tmdproductmeasurement/tmd/product');
			$setting_info = $this->model_extension_tmdproductmeasurement_tmd_product->getSqrSetting($product_id);

				if (!empty($setting_info)) {
					$args['width_min'] = $setting_info['width_min'];
				} else {
					$args['width_min'] = '';
				}

				if (!empty($setting_info)) {
					$args['width_max'] = $setting_info['width_max'];
				} else {
					$args['width_max'] = '';
				}

			    if (!empty($setting_info)) {
					$args['height_min'] = $setting_info['height_min'];
				} else {
					$args['height_min'] = '';
				}

				if (!empty($setting_info)) {
					$args['height_max'] = $setting_info['height_max'];
				} else {
					$args['height_max'] = '';
				}

				if ($product_id) {
				$product_prices = $this->model_extension_tmdproductmeasurement_tmd_product->getProductPrices($product_id);
				} else {
				$product_prices = [];
				}

				$args['product_prices'] = [];

				foreach ($product_prices as $product_price) {
					$args['product_prices'][] = [
						'from_sqr'  => $product_price['from_sqr'],
						'to_sqr'    => $product_price['to_sqr'],
						'price'		=> $product_price['price'],
						'discount'	=> $product_price['discount']
					];
				}

        $template_buffer = $this->getTemplateBuffer($route,$output);

        $find='<li class="nav-item"><a href="#tab-design" data-bs-toggle="tab" class="nav-link">{{ tab_design }}</a></li>';

        $replace='<li class="nav-item"><a href="#tab-design" data-bs-toggle="tab" class="nav-link">{{ tab_design }}</a></li>'. ' <li class="nav-item"><a href="#tab-tmd_productdimension" data-bs-toggle="tab" class="nav-link">{{ tab_p_price }}</a></li>';

        $output = str_replace($find, $replace, $template_buffer); 

        $template_buffer = $this->getTemplateBuffer($route,$output);

        $find=' <div id="tab-design" class="tab-pane">';

        $replace=file_get_contents(DIR_EXTENSION.'tmdproductmeasurement/admin/view/template/tmd/product.twig'). ' <div id="tab-design" class="tab-pane">';
     
        $output = str_replace($find, $replace, $template_buffer);
       }
     }
     // admin product event


public function tmdproductmeasurementcopyproduct(string&$route, array&$args, mixed&$output):void {

	$this->load->language('extension/tmdproductmeasurement/module/tmd_productdimension');
		$productdimensionstatus=$this->config->get('module_tmd_productdimension_status');
		if(!empty($productdimensionstatus)){
          

if(VERSION>='4.0.2.0'){
$args['copy'] = $this->url->link('extension/tmdproductmeasurement/module/tmd_productdimension.copydata', 'user_token=' . $this->session->data['user_token']);
}else{
$args['copy'] = $this->url->link('extension/tmdproductmeasurement/module/tmd_productdimension|copydata', 'user_token=' . $this->session->data['user_token']);

}
		}

}
     // admin product model add event
       public function addProduct(string&$route,array&$args):void {
		$products ='';
		foreach($args as $values){
		$products= $values;
		}
		$this->load->model('extension/tmdproductmeasurement/tmd/product');
		$products_event = $this->model_extension_tmdproductmeasurement_tmd_product->addProduct($products);
		}

     // admin product model add event

	
 // admin product model delete event
       public function deleteProduct(string&$route,array&$args):void {
		$products ='';
		foreach($args as $values){
		$products= $values;
		}
		$this->load->model('extension/tmdproductmeasurement/tmd/product');
		$deleteproducts_event = $this->model_extension_tmdproductmeasurement_tmd_product->deleteProduct($products);
		}

     // admin product model delete event

		

     protected function getTemplateBuffer($route, $event_template_buffer) {

		// if there already is a modified template from view/*/before events use that one
		if ($event_template_buffer) {
		return $event_template_buffer;
		}

		// load the template file (possibly modified by ocmod and vqmod) into a string buffer

		if ($this->config->get('config_theme') == 'default') {
		$theme = $this->config->get('theme_default_directory');
		} else {
		$theme = $this->config->get('config_theme');
		}
		$dir_template = DIR_TEMPLATE;

		$template_file = $dir_template.$route.'.twig';
		if (file_exists($template_file) && is_file($template_file)) {

		return file_get_contents($template_file);
		}
		if ($this->isAdmin()) {
		trigger_error("Cannot find template file for route '$route'");
		exit;
		}
		$dir_template  = DIR_TEMPLATE.'default/template/';
		$template_file = $dir_template.$route.'.twig';
		if (file_exists($template_file) && is_file($template_file)) {

		return file_get_contents($template_file);
		}
		trigger_error("Cannot find template file for route '$route'");
		exit;
		} 


		public function copydata(): void {
		$this->load->language('catalog/product');

		$json = [];

		if (isset($this->request->post['selected'])) {
			$selected = $this->request->post['selected'];
		} else {
			$selected = [];
		}


		if (!$this->user->hasPermission('modify', 'catalog/product')) {
			$json['error'] = $this->language->get('error_permission');
		}

		if (!$json) {
			$this->load->model('extension/tmdproductmeasurement/tmd/product');

			foreach ($selected as $product_id) {

			 $this->model_extension_tmdproductmeasurement_tmd_product->copyProductdata($product_id);

			}

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}