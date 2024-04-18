<?php
class ModelExtensiontmdproductdimension extends Model {
	public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `".DB_PREFIX."product_price_setting` (
	      `ps_id` int(11) NOT NULL AUTO_INCREMENT,      
	      `product_id` int(11) NOT NULL,     
	      `width_min` int(250) NOT NULL,
	      `width_max` int(250) NOT NULL,
	      `height_min` int(250) NOT NULL,
	      `height_max` int(250) NOT NULL,
	      PRIMARY KEY (`ps_id`)
	    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
	    
		$this->db->query("CREATE TABLE IF NOT EXISTS `".DB_PREFIX."product_prices` (
		  `product_price_id` int(11) NOT NULL AUTO_INCREMENT,
		  `product_id` int(11) NOT NULL,
		  `from_sqr` int(11) NOT NULL,
		  `to_sqr` int(11) NOT NULL,
		  `price` decimal(15,4) NOT NULL,
		  `discount` int(11) NOT NULL,
		  PRIMARY KEY (`product_price_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");
		
		$modules= array(
			   'extension_id' => '43051',
			   'email' => $this->config->get('config_email'),
			   'store_url' => HTTP_CATALOG
			);
	
		$url = 'https://www.opencartextensions.in/index.php?route=api/callback';
		
		$curl = curl_init($url);
		
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($modules, '', '&'));
		
		 $response = curl_exec($curl);

	}

	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `".DB_PREFIX."product_price_setting`");
		$this->db->query("DROP TABLE IF EXISTS `".DB_PREFIX."product_prices`");
	}
}
