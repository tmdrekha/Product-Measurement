<?php 
namespace Opencart\Catalog\Controller\Extension\Tmdproductmeasurement\Startup;
require_once(DIR_EXTENSION.'tmdproductmeasurement/system/library/tmd/cart.php');
use \Opencart\System\Helper as Helper;
class Cart extends \Opencart\System\Engine\Controller {
	public function index(): void {		
		$this->registry->set('cart', new \Opencart\Extension\Tmdproductmeasurement\System\Library\Tmd\Cart($this->registry));
	}
}
