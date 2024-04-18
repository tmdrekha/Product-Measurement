<?php
namespace Opencart\Admin\Model\Extension\Tmdproductmeasurement\Tmd;
class Product extends \Opencart\System\Engine\Model {
		public function addProduct($data) {
	if ($data['product_id']) {
	$this->db->query("DELETE FROM " . DB_PREFIX . "product_price_setting WHERE product_id = '" . (int)$data['product_id'] . "'");
	if (isset($data['width_min']) && isset($data['width_max']) && isset($data['height_min']) && isset($data['height_max'])) {
	$this->db->query("INSERT INTO " . DB_PREFIX . "product_price_setting SET width_min = '" . $data['width_min'] . "',width_max = '" . $data['width_max'] . "',height_min = '" . $data['height_min'] . "',height_max = '" . $data['height_max'] . "',product_id = '" . (int)$data['product_id'] . "'");
	}
	$this->db->query("DELETE FROM " . DB_PREFIX . "product_prices WHERE product_id = '" . (int)$data['product_id'] . "'");
	if (isset($data['product_price'])) {
	foreach ($data['product_price'] as $product_price) {
	$this->db->query("INSERT INTO " . DB_PREFIX . "product_prices SET product_id = '" . (int)$data['product_id'] . "',  from_sqr = '" . (int)$product_price['from_sqr'] . "', to_sqr = '" . (int)$product_price['to_sqr'] . "', price = '" . (float)$product_price['price'] . "', discount = '" . (float)$product_price['discount'] . "'");
	}
	}
	}else{

	$query = $this->db->query("SELECT * FROM ".DB_PREFIX."product ORDER BY product_id DESC ");


	if (isset($data['width_min']) && isset($data['width_max']) && isset($data['height_min']) && isset($data['height_max'])) {
	$this->db->query("INSERT INTO " . DB_PREFIX . "product_price_setting SET width_min = '" . $data['width_min'] . "',width_max = '" . $data['width_max'] . "',height_min = '" . $data['height_min'] . "',height_max = '" . $data['height_max'] . "',product_id = '" . (int)$query->row['product_id'] . "'");
	}

	if (isset($data['product_price'])) {
	foreach ($data['product_price'] as $product_price) {
	$this->db->query("INSERT INTO " . DB_PREFIX . "product_prices SET product_id = '" . (int)$query->row['product_id'] . "',  from_sqr = '" . (int)$product_price['from_sqr'] . "', to_sqr = '" . (int)$product_price['to_sqr'] . "', price = '" . (float)$product_price['price'] . "', discount = '" . (float)$product_price['discount'] . "'");
	}
	}
	}

	}

	public function copyProductdata(int $product_id): void {
		$this->load->Model('catalog/product');
		$product_info = $this->model_catalog_product->getProduct($product_id);


		if ($product_info) {
			$product_data = $product_info;

			$product_data['sku'] = '';
			$product_data['upc'] = '';
			$product_data['status'] = '0';

			$product_data['product_attribute'] = $this->model_catalog_product->getAttributes($product_id);
			$product_data['product_category'] = $this->model_catalog_product->getCategories($product_id);
			$product_data['product_description'] = $this->model_catalog_product->getDescriptions($product_id);
			$product_data['product_discount'] = $this->model_catalog_product->getDiscounts($product_id);
			$product_data['product_download'] = $this->model_catalog_product->getDownloads($product_id);
			$product_data['product_filter'] = $this->model_catalog_product->getFilters($product_id);
			$product_data['product_image'] = $this->model_catalog_product->getImages($product_id);
			$product_data['product_layout'] = $this->model_catalog_product->getLayouts($product_id);
			$product_data['product_option'] = $this->model_catalog_product->getOptions($product_id);
			$product_data['product_subscription'] = $this->model_catalog_product->getSubscriptions($product_id);
			$product_data['product_related'] = $this->model_catalog_product->getRelated($product_id);
			$product_data['product_reward'] = $this->model_catalog_product->getRewards($product_id);
			$product_data['product_special'] = $this->model_catalog_product->getSpecials($product_id);
			$product_data['product_store'] = $this->model_catalog_product->getStores($product_id);
			$product_data['product_price'] = $this->model_extension_tmdproductmeasurement_tmd_product->getProductPrices($product_id);
			

			$this->model_catalog_product->addProduct($product_data);
		}
	}



	public function getSqrSetting($product_id) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_price_setting WHERE product_id = '" . (int)$product_id . "'");

				return $query->row;
			}
			public function getProductPrices($product_id) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_prices WHERE product_id = '" . (int)$product_id . "' order by  discount asc");

				return $query->rows;
			}


public function deleteProduct($product_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "product_price_setting WHERE product_id = '" . (int)$product_id . "'");
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_prices WHERE product_id = '" . (int)$product_id . "'");
	
}
}