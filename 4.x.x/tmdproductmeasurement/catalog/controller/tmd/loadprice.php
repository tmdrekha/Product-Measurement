<?php
namespace Opencart\Catalog\Controller\Extension\Tmdproductmeasurement\Tmd;
use \Opencart\System\Helper as Helper;
class Loadprice extends \Opencart\System\Engine\Controller {	
	
	public function index() {
		$this->load->language('product/product');

		$this->load->model('catalog/product');
		$json=array();

		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}

		if (isset($this->request->get['sqrprice'])) {
			$sqrprice = (float)$this->request->get['sqrprice'];
		} else {
			$sqrprice = 0;
		}

		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);

		if ($product_info) {
			$sqprice = $sqrprice;
			$this->session->data['sqrprice'] = $sqprice;

			if ((float)$product_info['special']) {
				$sp_price = $product_info['special'];
				$json['special'] = $this->currency->format($this->tax->calculate($sqprice, $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				$json['pprice'] = $this->currency->format($this->tax->calculate($sqprice , $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
			} else {
				$sp_price = $product_info['price'];
				$json['pprice'] = $this->currency->format($this->tax->calculate($sqprice , $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
			}

			if ($this->config->get('config_tax')) {
				$json['tax'] = $this->language->get('text_tax').' '.$this->currency->format($sqprice, $this->session->data['currency']);
			} else {
				$json['tax'] = false;
			}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}