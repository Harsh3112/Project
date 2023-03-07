<?php
require_once 'Action.php'; 
/**
 * 
 * 
 */
class Product extends Action
{
	public function gridAction()
	{
		require_once 'View\product\grid.phtml';
	}

	public function addAction()
	{
		require_once 'View\product\add.phtml';
	}

	public function editAction()
	{
		require_once 'View\product\edit.phtml';
	}

	public function errorAction($action)
	{
		throw new Exception("Method :{$action} does not exist", 1);
	}

	public function insertAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $product = $_POST['product'];
		$request = new Request();
		$product = $request->getPost('product');

		date_default_timezone_set('Asia/Kolkata');
		$createdAt = date("Y-m-d h:i:s");

		// if (!isset($product)) {
		// 	throw new Exception("Invalid Request.", 1);
		// }
		$request->isPost();

		$sql = "INSERT INTO `product`(`name`, `sku`, `cost`, `price`, `quantity`, `description`, `status`, `color`, `material`,`created_at`) VALUES ('$product[name]','$product[sku]','$product[cost]','$product[price]','$product[quantity]','$product[description]','$product[status]','$product[color]','$product[material]','$createdAt')";

		$result = new Model_adapter();
		$data = $result->insert($sql);

		header('Location: index.php?c=product&a=grid');
	}

	public function updateAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';
		
		// $id = $_GET['id'];
		// $product = $_POST['product'];
		$request = new Request();
		$id = $request->getparams('id');
		$product = $request->getPost('product');

		date_default_timezone_set('Asia/Kolkata');
		$updated_at = date("Y-m-d h:i:s");

		// if (!isset($product)) {
		// 	throw new Exception("Invalid Request.", 1);	
		// }
		$request->isPost();


		$sql = "UPDATE `product` SET `name`='$product[name]',`sku`='$product[sku]',`cost`='$product[cost]',`price`='$product[price]',`quantity`='$product[quantity]',`description`='$product[description]',`status`='$product[status]',`color`='$product[color]',`material`='$product[material]', `updated_at`='$updated_at' WHERE `product_id`=$id";

		$result = new Model_adapter();
		$data = $result->insert($sql);

		header('Location: index.php?c=product&a=grid');
	}

	public function deleteAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';
		
		// $id = $_GET['id'];
		$request = new Request();
		$id = $request->getparams('id');
		
		$sql =  "DELETE FROM `product` WHERE `product_id`=$id";
		$result = new Model_adapter();
		$data = $result->delete($sql);
		
		header('Location: index.php?c=product&a=grid');
	}
}

// $action = $_GET['a'].'Action';
$con = new Product();
// if (method_exists($product, $action) == false){
// 	$product->errorAction($action);
// }
// else{
// 	$product->$action();
// }
?>