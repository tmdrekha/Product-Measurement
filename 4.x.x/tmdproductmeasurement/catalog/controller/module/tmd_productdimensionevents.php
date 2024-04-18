<?php
namespace Opencart\Catalog\Controller\Extension\Tmdproductmeasurement\Module;
use \Opencart\System\Helper as Helper;
class Tmdproductdimensionevents extends \Opencart\System\Engine\Controller {	
	
    
		public function tmdproductmeasurementcatalogproduct(string&$route, array&$args, mixed&$output):void {

        $this->load->language('extension/tmdproductmeasurement/module/tmd_productdimension');
		$productdimensionstatus=$this->config->get('module_tmd_productdimension_status');
		if(!empty($productdimensionstatus)){

			if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
			} else {
			$product_id = 0;
			}
        $product_info = $this->model_catalog_product->getProduct($product_id);

			// XML
			if (isset($this->request->get['product_id'])) {
					$args['tmd_product_id'] = $this->request->get['product_id'];
				} else {
					$args['tmd_product_id'] = 0;
				}

				if (isset($this->request->get['manufacturer_id'])) {
					$args['tmd_manufacturer_id'] = $this->request->get['manufacturer_id'];
				} else {
					$args['tmd_manufacturer_id'] = 0;
				}

				if (isset($this->request->get['path'])) {
					$path = '';
					$parts = explode('_', (string)$this->request->get['path']);
					$args['tmd_category_id'] = (int)array_pop($parts);
				} else {
					$args['tmd_category_id'] = 0;
				}


				$sqr_products = $this->config->get('module_tmd_productdimension_pproducts');
				if(isset($sqr_products)) {
					$args['sqr_products'] = $sqr_products;
				} else {
					$args['sqr_products']=[];
				}
				$sqr_manufacturers = $this->config->get('module_tmd_productdimension_manufacturer');
				if(isset($sqr_manufacturers)) {
					$args['sqr_manufacturers'] = $sqr_manufacturers;
				} else {
					$args['sqr_manufacturers']=[];
				}
				$sqr_categories = $this->config->get('module_tmd_productdimension_category');
				if(isset($sqr_categories)) {
					$args['sqr_categories'] = $sqr_categories;
				} else {
					$args['sqr_categories']=[];
				}
				$this->load->language('extension/tmdproductmeasurment/tmd/tmd_productdimension');
				
				$status1 = $this->config->get('module_tmd_productdimension_status');

				if(!empty($status1)){
					$args['dispay']=true;
				}else{
					$args['dispay']=false;
				}



				$args['tmd_productdimension'] = $this->load->controller('extension/tmdproductmeasurement/tmd/productdimension');

			

			$template_buffer = $this->getTemplateBuffer($route,$output);

			$find='{% if options %}';

			$replace='{% if not options %}

			{% if dispay %}
			<div class="tmd_productdimensions"></div>
			{{ tmd_productdimension }}
			{% endif %}
			{% endif %}
			{% if options %}';

			$output = str_replace($find, $replace, $template_buffer);


			 $template_buffer = $this->getTemplateBuffer($route,$output);

			$find=' <h3>{{ text_option }}</h3>';

				$replace=' <h3>{{ text_option }}</h3>'.'{% if options %}
				{% if dispay %}
				<div class="tmd_productdimensions"></div>
				{{ tmd_productdimension }}
				{% endif %}
				{% endif %}';

			$output = str_replace($find, $replace, $template_buffer); 

			 $template_buffer = $this->getTemplateBuffer($route,$output);

			$find='<li>{{ text_tax }} {{ tax }}</li>';

				$replace='<li class="tax">{{ text_tax }} {{ tax }}</li>';

			$output = str_replace($find, $replace, $template_buffer); 


			$template_buffer = $this->getTemplateBuffer($route,$output);

        $find=file_get_contents(DIR_EXTENSION.'tmdproductmeasurement/catalog/view/template/module/product_find.twig');
        $replace=file_get_contents(DIR_EXTENSION.'tmdproductmeasurement/catalog/view/template/module/product_replace.twig');
     
        $output = str_replace($find, $replace, $template_buffer);
		$template_buffer = $this->getTemplateBuffer($route,$output);
        if(VERSION >='4.0.2.0'){
        $find='index.php?route=checkout/cart.add&language={{ language }}';
        $replace='index.php?route=extension/tmdproductmeasurement/module/tmd_productdimensionevents.add&language={{ language }}';
     }else{
     	 $find='index.php?route=checkout/cart|add&language={{ language }}';
        $replace='index.php?route=extension/tmdproductmeasurement/module/tmd_productdimensionevents|add&language={{ language }}';
     }
        $output = str_replace($find, $replace, $template_buffer);
		}

		}
     
		

	
	
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


public function add(): void {
		$this->load->language('checkout/cart');

		$json = [];

		if (isset($this->request->post['product_id'])) {
			$product_id = (int)$this->request->post['product_id'];
		} else {
			$product_id = 0;
		}

		if (isset($this->request->post['quantity'])) {
			$quantity = (int)$this->request->post['quantity'];
		} else {
			$quantity = 1;
		}

		if (isset($this->request->post['option'])) {
			$option = array_filter($this->request->post['option']);
		} else {
			$option = [];
		}

		if (isset($this->request->post['subscription_plan_id'])) {
			$subscription_plan_id = (int)$this->request->post['subscription_plan_id'];
		} else {
			$subscription_plan_id = 0;
		}

		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);

		if ($product_info) {
			// If variant get master product
			if ($product_info['master_id']) {
				$product_id = $product_info['master_id'];
			}

			// Only use values in the override
			if (isset($product_info['override']['variant'])) {
				$override = $product_info['override']['variant'];
			} else {
				$override = [];
			}

			// Merge variant code with options
			foreach ($product_info['variant'] as $key => $value) {
				if (in_array($key, $override)) {
					$option[$key] = $value;
				}
			}

			// Validate options
			$product_options = $this->model_catalog_product->getOptions($product_id);

			foreach ($product_options as $product_option) {
				if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
					$json['error']['option_' . $product_option['product_option_id']] = sprintf($this->language->get('error_required'), $product_option['name']);
				}
			}

			// Validate subscription products
			$subscriptions = $this->model_catalog_product->getSubscriptions($product_id);

			if ($subscriptions) {
				$subscription_plan_ids = [];

				foreach ($subscriptions as $subscription) {
					$subscription_plan_ids[] = $subscription['subscription_plan_id'];
				}

				if (!in_array($subscription_plan_id, $subscription_plan_ids)) {
					$json['error']['subscription'] = $this->language->get('error_subscription');
				}
			}
		} else {
			$json['error']['warning'] = $this->language->get('error_product');
		}

		/* 10 06 2020 */
			if (!empty($this->config->get('module_tmd_productdimension_status'))) {				

				$tmdtext = $this->config->get('module_tmd_productdimension_multi');
					
				if(!empty($tmdtext[$this->config->get('config_language_id')]['errorwidth'])){
					$data['error_width'] = $tmdtext[$this->config->get('config_language_id')]['errorwidth'];
				} else {
					$data['error_width'] = $this->language->get('error_width');
				}

				if(!empty($tmdtext[$this->config->get('config_language_id')]['errorheight'])){
					$data['error_height'] = $tmdtext[$this->config->get('config_language_id')]['errorheight'];
				} else {
					$data['error_height'] = $this->language->get('error_height');
				}

				if(!empty($tmdtext[$this->config->get('config_language_id')]['erroroption'])){
					$data['error_erroroption'] = $tmdtext[$this->config->get('config_language_id')]['erroroption'];
				} else {
					$data['error_erroroption'] = $this->language->get('error_erroroption');
				}

				if (isset($this->request->post['width'])) {
					$width = $this->request->post['width'];
				} else {
					$width = 0;
				}

				if (isset($this->request->post['height'])) {
					$height = $this->request->post['height'];
				} else {
					$height = 0;
				}



				$this->load->model('extension/tmdproductmeasurement/tmd/tmd_productdimension');
				$sqrpriceinfos = $this->model_extension_tmdproductmeasurement_tmd_tmd_productdimension->getSqrPrices($product_id);
				$infos = $this->model_extension_tmdproductmeasurement_tmd_tmd_productdimension->getTmdProductPricestatus($product_id);
				if($infos){	
					$this->load->language('extension/tmdproductmeasurement/tmd/tmd_productdimension');
					if (empty($option['sqr_height'])) {
						$json['error']['sqr_height'] = $data['error_height'];
					}
					if (empty($option['sqr_width'])) {
						$json['error']['sqr_width'] = $data['error_width'];
					}

					if (empty($this->request->post['customoption']['cus_price'])) {
						$json['error']['cus_price'] = $data['error_erroroption'];
					}
				} elseif ($sqrpriceinfos) {
					$this->load->language('extension/tmdproductmeasurement/tmd/tmd_productdimension');
					if (empty($option['sqr_height'])) {
						$json['error']['sqr_height'] = $data['error_height'];
					}
					if (empty($option['sqr_width'])) {
						$json['error']['sqr_width'] = $data['error_width'];
					}

					if (empty($this->request->post['customoption']['cus_price'])) {
						$json['error']['cus_price'] = $data['error_erroroption'];
					}
				}
			}
			/* 10 06 2020 */

		if (!$json) {
			$this->cart->add($product_id, $quantity, $option, $subscription_plan_id);

			$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'language=' . $this->config->get('config_language') . '&product_id=' . $product_id), $product_info['name'], $this->url->link('checkout/cart', 'language=' . $this->config->get('config_language')));

			// Unset all shipping and payment methods
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_methods']);
		} else {
			$json['redirect'] = $this->url->link('product/product', 'language=' . $this->config->get('config_language') . '&product_id=' . $this->request->post['product_id'], true);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}