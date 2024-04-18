<?php
class ModelExtensionTmdproductdimension extends Model {
	public function getSqrPrices($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_prices  WHERE product_id = '" . (int)$product_id . "'  order by  discount asc");
		
		return $query->rows;
	}

	public function getProductSqrPrices($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_prices  WHERE product_id = '" . (int)$product_id . "'  order by  discount asc");
		
		return $query->rows;
	}

	public function getTmdProductPrice($product_id,$width,$height) {
		$data='';
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

		$status=false;
		$sqr_quantitys=array();

		$product_ids = $this->config->get('module_tmd_productdimension_pproducts');
		$manufacturer_ids = $this->config->get('module_tmd_productdimension_manufacturer');
		$categorie_ids = $this->config->get('module_tmd_productdimension_category');
		//print_r($categorie_ids);die();
		if(isset($product_ids)) {
			$product_ids = $product_ids;
		} else {
			$product_ids=array();
		}
		if(isset($manufacturer_ids)) {
			$manufacturer_ids = $manufacturer_ids;
		} else {
			$manufacturer_ids=array();
		}
		if(isset($categorie_ids)) {
			$categorie_ids = $categorie_ids;
		} else {
			$categorie_ids=array();
		}

		if (in_array($product_id, $product_ids)){ 
			$status=true;
			
		}

		$query2 = $this->db->query("SELECT category_id from ". DB_PREFIX ."product_to_category where product_id= '".(int)$product_id."'");
		if(!empty($query2->rows)) {
			foreach($query2->rows as $rowc) {
				$category_id=$rowc['category_id'];
				if (in_array($category_id, $categorie_ids)){
					$status=true;
				}
			}
		}

		$query4 = $this->db->query("SELECT manufacturer_id from ". DB_PREFIX ."product where product_id= '".(int)$product_id."'");
		if(!empty($query4->row['manufacturer_id'])) {
			$manufacturer_id=$query4->row['manufacturer_id'];
			if (in_array($manufacturer_id, $manufacturer_ids)){
				$status=true;
			}
		}

		if($status==true) {
			$sqrprice_info = $this->config->get('module_tmd_productdimension_productsqr');
			
			if(!empty($sqrprice_info)){
			foreach ($sqrprice_info as $sqr_info) {
				$discount_val = $sqr_info['discount'];

				$tmdsize = $width*$height;
				$tmdsqr = $sqr_info['to_sqr']/$tmdsize;
				$qty = round($tmdsqr);

				$p_price = $tmdsize*$sqr_info['price'];
				$p_price =$p_price-($discount_val*$p_price/100);
				$newprice = $p_price*$qty;
				
				$total = $this->currency->format($newprice, $this->session->data['currency']);
				
				$subtotal = $text_totaltext.' '.$total.' - '.$discount_val.'% '. $text_discounttext;

				if(!empty($qty)) {
					$sqr_quantitys[] = array(
						'quantity'  => $qty,
						'sub'  		=> $newprice,
						'price1'	=> $p_price,
						'price'		=> $subtotal,
					);
				}
			} }
		} else {
			return false;
		}
		
		return $sqr_quantitys;
	}

	public function getTmdProductPricestatus($product_id) {
		$data='';
		$statuss = $this->config->get('module_tmd_productdimension_status');
		if($statuss==0) {
			return false;
		}

		$status=false;
		$sqr_quantitys=array();

		$product_ids = $this->config->get('module_tmd_productdimension_pproducts');
		$manufacturer_ids = $this->config->get('module_tmd_productdimension_manufacturer');
		$categorie_ids = $this->config->get('module_tmd_productdimension_category');
		
		$product_ids = !empty($product_ids)?$product_ids:array();
		$categorie_ids = !empty($categorie_ids)?$categorie_ids:array();
		$manufacturer_ids = !empty($manufacturer_ids)?$manufacturer_ids:array();
		
		if (in_array($product_id, $product_ids)){ 
			$status=true;
		}

		$query2 = $this->db->query("SELECT category_id from ". DB_PREFIX ."product_to_category where product_id= '".(int)$product_id."'");
		if(!empty($query2->rows)) {
			foreach($query2->rows as $rowc) {
				$category_id=$rowc['category_id'];
				if (in_array($category_id, $categorie_ids)){
					$status=true;
				}
			}
		}

		$query4 = $this->db->query("SELECT manufacturer_id from ". DB_PREFIX ."product where product_id= '".(int)$product_id."'");
		if(!empty($query4->row['manufacturer_id'])) {
			$manufacturer_id=$query4->row['manufacturer_id'];
			if (in_array($manufacturer_id, $manufacturer_ids)){
				$status=true;
			}
		}
		return $status;
	}
	
/* 19 06 2020 */
	public function getSqrSetting($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_price_setting WHERE product_id = '" . (int)$product_id . "'");
		return $query->row;
	}
/* 19 06 2020 */

}